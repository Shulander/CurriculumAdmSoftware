<?php
	require_once ("utils/BancoDados.php");
	require_once ("utils/sessao.php");
	require_once ("classes/Usuario.php");
	include ("classes/ExpAcademica.php");
	include ("classes/Pessoa.php");
	include ("utils/Validador.php");
	restritoUsuario();
	$idLogin = $_SESSION['idLogin'] + 0;
	$pergunta1 = $_POST['pergunta1'];
	$pergunta2 = $_POST['pergunta2'];
	$pergunta3 = $_POST['pergunta3'];
	if (isset($_POST['pergunta4'])) {
		$pergunta4 = $_POST['pergunta4'];	
	} else {
		$pergunta4 = "";
	}
	$pergunta5Temp = array();
	for ($i=1; $i<=3; $i++) {
		if (isset($_POST['pergunta5_'.$i]) && !isset($pergunta5Temp[$_POST['pergunta5_'.$i]])) {
			$pergunta5[] = $_POST['pergunta5_'.$i];
			$pergunta5Temp[$_POST['pergunta5_'.$i]] = true;
		}
	}
	unset($pergunta5Temp);
	if (!isset($pergunta5)){
		$aviso = "� necess�rio selecionar pelo menos uma op��o na pergunta 5'!";
		$pergunta5Erro = serialize(array());
	} else {
		$pergunta5Erro = serialize(array_flip($pergunta5));
	}
	
	if (isset($_POST['pergunta6'])) {
		$pergunta6 = $_POST['pergunta6'];
		$pergunta6Erro = serialize(array_flip($pergunta6));	
	} else {
		$aviso = "� necess�rio selecionar pelo menos uma op��o na pergunta 6'!";
		$pergunta6Erro = serialize(array());
	}
	if(is_array($pergunta6) && count($pergunta6)>3) {
		$aviso = "� permitido selecionar at� 3 op��o na pergunta 6'!";
	}
	$outro1 = $_POST['outro1'];
	$outro2 = $_POST['outro2'];
	$outro3 = $_POST['outro3'];
	$recomendador = $_POST['recomendador'];
	$location = "&pergunta1=".$pergunta1."&pergunta2=".$pergunta2."&pergunta3=".$pergunta3."&pergunta4=".$pergunta4
	."&pergunta5=".$pergunta5Erro."&pergunta6=".$pergunta6Erro."&outro1=".$outro1."&outro2=".$outro2.
	"&outro3=".$outro3."&recomendador=".$recomendador;
	$conexaoBD = new BancoDados ();
	//verifica se a conexao ao banco de dados ocorreu corretamente
	if (!$conexaoBD->conecta()) {
		$aviso = "Erro de sistema! Contate o administrador do sistema!";
		header("Location:dadosExtras.php?aviso=".$aviso.$location);
		exit();
	}
	//Busca idPessoa
	$pessoa = new Pessoa ($idLogin, "", "", "", "", "", "", 0, "", "", 0, "", "", "", "", "", "", 0, $conexaoBD);
	$resultado = $pessoa->busca();
	if ($resultado == true) {
		$idPessoa = $pessoa->getId ();
	} else {
		$aviso = "Erro de sistema! Contate o administrador do sistema!";
		header("Location:dadosExtras.php?aviso=".$aviso.$location);
		exit();
	}
	if(empty($aviso)) {
		$aviso = null;
	}
	$validador = new Validador ();
	/*------------Pergunta 4----------------*/
	if(is_null ($aviso)) {
		if ($pergunta3 == "sim") {
			if (!$validador->isPreenchido($pergunta4)) {
				$aviso = "� necess�rio selecionar uma op��o na pergunta 4'!";	
			} else if ($pergunta4 == "Outro") {
				if (!$validador->isPreenchido($outro1)) {
					$aviso = "� necess�rio responder a pergunta 4'!";
				} else {
					$pergunta4 = $outro1;
				}
			} else {
				$outro1 = "";
			}
		} else { //pergunta 3 respondida como nao
			if ($validador->isPreenchido($pergunta4) || $validador->isPreenchido($outro1)) {
				$aviso = "Apenas responder a pergunta 4 se for selecionada a op��o Sim na pergunta 3!";
			}
		}
	}
	/*------------Pergunta 5----------------*/
	$pergunta5Text = "";
	if(is_null ($aviso)) {
		if (is_array($pergunta5)) {
			$pergunta5Aux = $pergunta5;
			for ($i = 0; $i < count($pergunta5); $i++) {
				if ($pergunta5[$i] == "Outro") {
					if (!$validador->isPreenchido($outro2)) {
						$aviso = "� necess�rio responder a pergunta 5'!";
					} else {
						$pergunta5Aux[$i] = $outro2;
					}

				}
			}
			$pergunta5Text = implode($pergunta5Aux,",");
		}
	}
	/*------------Pergunta 6----------------*/
	if(is_null ($aviso)) {
		$pergunta6Invert = array_flip($pergunta6);
		if (!$validador->isPreenchido($pergunta6)) {
			$aviso = "� necess�rio selecionar pelo menos uma op��o na pergunta 6'!";	
		} else if (isset($pergunta6Invert['Outro'])) {
			if (!$validador->isPreenchido($outro3)) {
				$aviso = "� necess�rio responder a pergunta 6'!";
			} else {
				$pergunta6[$pergunta6Invert['Outro']] = $outro3;
			}
		} else if (isset($pergunta6Invert['membro_alumnus'])) {
			$outro3 = "";
			if (!$validador->isPreenchido($recomendador)) {
				$aviso = "� necess�rio preencher o nome da pessoa que recomendou a AIESEC na pergunta 6'!";
			}
		} else {
			$outro3 = "";
			$recomendador = "";
		}
		$pergunta6Text = implode($pergunta6,",");
	}
	/*----------Verifica se tem avisos----------*/
	if (!is_null($aviso)) {
		header("Location:dadosExtras.php?aviso=".$aviso.$location);
		exit();
	}
	/*-----------Inserir dadosExtras------------------*/
	$sql = "UPDATE pessoa SET pergunta1='".$pergunta1."',pergunta2='".$pergunta2."',pergunta3='".$pergunta3."',
	pergunta4='".$pergunta4."',pergunta5='".$pergunta5Text."',pergunta6='".$pergunta6Text."',recomendador='".$recomendador."' 
	WHERE id=".$idPessoa;
	$resultado = mysql_query($sql, $conexaoBD->getLink()); 
	if (!$resultado) {
		if (!empty($outro1)) {
			$pergunta4 = $outro1;
		}
    	$aviso = "Erro no inser��o da pesquisa de imagem!".mysql_error();
    	header("Location:dadosExtras.php?aviso=".$aviso.$location);
	} else {
		$aviso = "sucesso";
		$result = $pessoa->alteraPesquisaBD(1);
		if ($result == "sucesso") {
			//verifica se todos os dados foram preenchidos
			$retorno = $pessoa->isDadosPreenchidos();
			if ($retorno == true) {
				//se todos os dados foram preenchidos seta dados preenchidos em usuario e manda para a pagina principal
				$usuario = new Usuario ("", "", "", $conexaoBD, $idLogin);
				if(!$usuario->isDadosPreenchidos()) {
					$valor = $usuario->setDadosPreenchidos(1);
					if ($valor == "sucesso") {
						//envia email para a pessoa dizendo q o cadastro foi salvo com sucesso
						$dados = $usuario->busca();
						if ($dados == false) {
							$aviso = "Erro de sistema! Contate o administrador do sistema!";
							header ("Location:dadosExtras.php?aviso=".$aviso.$location);
						} else {
							if ($usuario->getTipo () == "membro") {
								$enviado = enviaEmailMembro($usuario->getEmail());
							} else if ($usuario->getTipo () == "intercambista") {
								$enviado = enviaEmailIntercambista($usuario->getEmail());
							} else {
								$enviado = false;
							}
							if ($enviado == true) {
								$aviso = "sucesso";
								$mensagem = "Inscri��o realizada com sucesso!";
								header ("Location:principal.php?aviso=".$aviso."&mensagem=".$mensagem);
							} else {
								$aviso = "Erro de sistema! Problemas ao enviar o email de confirma��o da inscri��o! Contate o administrador do sistema!";
								header ("Location:dadosExtras.php?aviso=".$aviso.$location);			
							}
						}
					} else {
						header ("Location:dadosExtras.php?aviso=".$valor);
					}
				} else { //os dados ja estao todos preenchidos
					$aviso = "sucesso";
					$mensagem = "PARAB�NS! Voc� finalizou sua inscri��o com sucesso! <br />
							Esperamos voc� no dia 28 de mar�o, �s 13h:00, no Hotel Itaimb�.<br />
							O valor de sua inscri��o � R$ 8,00 e o pagamento ser� efetuado no dia 28 de mar�o, no Hotel Itaimb�. <br />
							Lembramos que seu comparecimento a esta etapa dia 28 de mar�o � obrigat�rio. O n�o comparecimento implica na sua elimina��o do Processo Seletivo 2009.<br />";
					header ("Location:principal.php?aviso=".$aviso."&mensagem=".$mensagem);
				}
			} else { //dados nao foram preenchidos
				$aviso = '<center>Para concluir sua inscri��o � necess�rio preencher todos os dados! Para preencher todos os dados s�o necess�rias as cinco etapas descritas no menu acima.
				Certifique-se de que voc� inseriu pelo menos uma forma��o acad�mica, selecionou as op��es obrigat�rias em habilidades e inseriu pelo menos uma experi�ncia profissional ou clicou na op��o que n�o tinha nenhuma experi�ncia.</center>';
				header ("Location:dadosExtras.php?aviso=".$aviso);	
			}
		} else {
			$aviso = "Erro de sistema! Contate o administrador do sistema!";
			header ("Location:dadosExtras.php?aviso=".$aviso.$location);
		}

	}
	$conexaoBD->desconecta();
	exit();
	
	function enviaEmailIntercambista ($email)
	{
		$remetente = "non-reply@aiesecsm.org";
		$assunto = "Processo Seletivo AIESEC";
		$contato = "<a href='mailto:aiesecsmpsel@gmail.com'>aiesecsmpsel@gmail.com</a>";
		$mensagem= "<b>Caro usu�rio,</b><br />
		
		
		ESTE E-MAIL CONFIRMA A EFETIVA��O DE SUA INSCRI��O!

		Esperamos voc� no dia 28 de mar�o, �s 13h:00, no Hotel Itaimb�.
		O valor de sua inscri��o � R$ 8,00 e o pagamento ser� efetuado no dia 28 de mar�o, no Hotel Itaimb�. 
		Lembramos que seu comparecimento a esta etapa dia 28 de mar�o � obrigat�rio. O n�o comparecimento implica na sua elimina��o do Processo Seletivo 2009.

		<br/> 
		Qualquer d�vida favor entrar em contato no telefone abaixo ou atrav�s do email ".$contato."<br/> 
		<br/>
		Atenciosamente, <br/>
		AIESEC em Santa Maria<br/>
		Rua Floriano Peixoto, 1184, 8� andar do CCSH - Centro<br/>
		Tel: 3220 9209<br/>
		Santa Maria - RS - Brasil<br/>
		<a href='http://www.aiesec.org.br/santamaria'>http://www.aiesec.org.br/santamaria</a><br/>";
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "From: AIESEC Santa Maria <".$remetente."> \r\n";
		
		$retorno = mail($email, $assunto, $mensagem, $headers);
		return $retorno;
	}

	function enviaEmailMembro($email)
	{
		$remetente = "non-reply@aiesecsm.org";
		$assunto = "Processo Seletivo AIESEC";
		$contato = "<a href='mailto:aiesecsmpsel@gmail.com'>aiesecsmpsel@gmail.com</a>";
		$mensagem= "<b>Caro usu�rio,</b><br />
		
		
		ESTE E-MAIL CONFIRMA A EFETIVA��O DE SUA INSCRI��O!

		Esperamos voc� no dia 28 de mar�o, �s 13h:00, no Hotel Itaimb�.
		O valor de sua inscri��o � R$ 8,00 e o pagamento ser� efetuado no dia 28 de mar�o, no Hotel Itaimb�. 
		Lembramos que seu comparecimento a esta etapa dia 28 de mar�o � obrigat�rio. O n�o comparecimento implica na sua elimina��o do Processo Seletivo 2009.

		<br/> 
		Qualquer d�vida favor entrar em contato no telefone abaixo ou atrav�s do email ".$contato."<br/> 
		<br/>
		Atenciosamente, <br/>
		AIESEC em Santa Maria<br/>
		Rua Floriano Peixoto, 1184, 8� andar do CCSH - Centro<br/>
		Tel: 3220 9209<br/>
		Santa Maria - RS - Brasil<br/>
		<a href='http://www.aiesec.org.br/santamaria'>http://www.aiesec.org.br/santamaria</a><br/>";
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "From: AIESEC Santa Maria <".$remetente."> \r\n";
		
		$retorno = mail($email, $assunto, $mensagem, $headers);
		return $retorno;
	}
?>