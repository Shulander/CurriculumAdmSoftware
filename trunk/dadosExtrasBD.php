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
	if (isset($_POST['pergunta5'])) {
		$pergunta5 = $_POST['pergunta5'];
		$pergunta5Erro = serialize(array_flip($pergunta5));	
	} else {
		$aviso = "É necessário selecionar pelo menos uma opção na pergunta 5'!";
		$pergunta5Erro = serialize(array());
	}
	if (isset($_POST['pergunta6'])) {
		$pergunta6 = $_POST['pergunta6'];	
	} else {
		$pergunta6 = "";
	}
	$outro1 = $_POST['outro1'];
	$outro2 = $_POST['outro2'];
	$outro3 = $_POST['outro3'];
	$recomendador = $_POST['recomendador'];
	$location = "&pergunta1=".$pergunta1."&pergunta2=".$pergunta2."&pergunta3=".$pergunta3."&pergunta4=".$pergunta4
	."&pergunta5=".$pergunta5Erro."&pergunta6=".$pergunta6."&outro1=".$outro1."&outro2=".$outro2.
	"&outro3=".$outro3."&recomendador=".$recomendador;
	$conexaoBD = new BancoDados ();
	//verifica se a conexao ao banco de dados ocorreu corretamente
	if (!$conexaoBD->conecta()) {
		$aviso = "Erro de sistema! Contate o administrador do sistema!";
		header("Location:dadosExtras.php?aviso=".$aviso.$location);
		exit();
	}
	//Busca idPessoa
	$pessoa = new Pessoa ($idLogin, "", "", "", "", "", "", "", "", "", "", "", "", "", "", 0, $conexaoBD);
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
				$aviso = "É necessário selecionar uma opção na pergunta 4'!";	
			} else if ($pergunta4 == "Outro") {
				if (!$validador->isPreenchido($outro1)) {
					$aviso = "É necessário responder a pergunta 4'!";
				} else {
					$pergunta4 = $outro1;
				}
			} else {
				$outro1 = "";
			}
		} else { //pergunta 3 respondida como nao
			if ($validador->isPreenchido($pergunta4) || $validador->isPreenchido($outro1)) {
				$aviso = "Apenas responder a pergunta 4 se for selecionada a opção Sim na pergunta 3!";
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
						$aviso = "É necessário responder a pergunta 5'!";
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
		if (!$validador->isPreenchido($pergunta6)) {
			$aviso = "É necessário selecionar pelo menos uma opção na pergunta 6'!";	
		} else if ($pergunta6 == "Outro") {
			$recomendador = "";
			if (!$validador->isPreenchido($outro3)) {
				$aviso = "É necessário responder a pergunta 6'!";
			} else {
				$pergunta6 = $outro3;
			}
		} else if ($pergunta6 == "membro_alumnus") {
			$outro3 = "";
			if (!$validador->isPreenchido($recomendador)) {
				$aviso = "É necessário preencher o nome da pessoa que recomendou a AIESEC na pergunta 6'!";
			}
		} else {
			$outro3 = "";
			$recomendador = "";
		}
	}
	/*----------Verifica se tem avisos----------*/
	if (!is_null($aviso)) {
		header("Location:dadosExtras.php?aviso=".$aviso.$location);
		exit();
	}
	/*-----------Inserir dadosExtras------------------*/
	$sql = "UPDATE pessoa SET pergunta1='".$pergunta1."',pergunta2='".$pergunta2."',pergunta3='".$pergunta3."',
	pergunta4='".$pergunta4."',pergunta5='".$pergunta5Text."',pergunta6='".$pergunta6."',recomendador='".$recomendador."' 
	WHERE id=".$idPessoa;
	$resultado = mysql_query($sql, $conexaoBD->getLink()); 
	if (!$resultado) {
		if (!empty($outro1)) {
			$pergunta4 = $outro1;
		}
		if (!empty($outro3)) {
			$pergunta6 = $outro3;
		}
    	$aviso = "Erro no inserção da pesquisa de imagem!".mysql_error();
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
								$mensagem = "Inscrição realizada com sucesso!";
								header ("Location:principal.php?aviso=".$aviso."&mensagem=".$mensagem);
							} else {
								$aviso = "Erro de sistema! Contate o administrador do sistema!";
								header ("Location:dadosExtras.php?aviso=".$aviso.$location);			
							}
						}
					} else {
						header ("Location:dadosExtras.php?aviso=".$valor);
					}
				} else { //os dados ja estao todos preenchidos
					$aviso = "sucesso";
					$mensagem = "Dados alterados com sucesso!";
					header ("Location:principal.php?aviso=".$aviso."&mensagem=".$mensagem);
				}
			} else { //dados nao foram preenchidos
				$aviso = "Para concluir sua inscrição é necessário preencher todos os dados!";
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
		$mensagem= "<b>Caro usuário,</b><br />
		
		
		Seu cadastro foi salvo com sucesso. <br/>
		Sua inscrição só será confirmada assim que pagar a taxa (R$ 5,00) e entregar o currículo impresso,<br/> 
		com uma foto 3x4 ou digitalizada, em uma das palestras de apresentação. Ao pagar, aguarde que em um <br/>
		prazo máximo de 48h você será liberado, recebendo um email de confirmação, para marcar sua entrevista,<br/> 
		em um dos horários disponibilizados pelo sistema. Não se esqueça de participar de uma das palestras, <br/>
		já que são obrigatórias e de caráter eliminatório. <br/>
		<b>Datas e locais das palestras de apresentação (escolher um horário):</b><br/>
		<ul>
			<li>Dia 24/09: 11h, na Faculdade de Comunicação, prédio 21, UFSM - Campus.</li>
			<li>Dia 24/09: 18h no auditório do CCSH - UFSM, Centro.</li>
			<li>Dia 25/09: 11h, no auditório do CCSH - UFSM, Centro.</li>
		</ul>
		<br/> 
		Para alterar seus dados ou conferir o andamento do processo favor acessar o endereço 
		<a href='http://www.aiesecsm.org/psel2008_2/'>http://www.aiesecsm.org/psel2008_2/</a>.<br/>
		Qualquer dúvida favor entrar em contato no telefone abaixo ou através do email ".$contato."<br/> 
		<br/>
		Atenciosamente, <br/>
		AIESEC em Santa Maria<br/>
		Rua Floriano Peixoto, 1184, 8° andar do CCSH - Centro<br/>
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
		$mensagem= "<b>Caro usuário,</b><br />
		
		
		Seu cadastro foi salvo com sucesso. <br/>
		Sua inscrição só será confirmada assim que pagar a taxa (R$ 5,00) e entregar o currículo impresso,<br/> 
		com uma foto 3x4 ou digitalizada, em uma das palestras de apresentação. Ao pagar, aguarde que em um <br/>
		prazo máximo de 48h você será liberado, recebendo um email de confirmação, para marcar sua entrevista,<br/> 
		em um dos horários disponibilizados pelo sistema. Não se esqueça de participar de uma das palestras, <br/>
		já que são obrigatórias e de caráter eliminatório. <br/>
		<b>Datas e locais das palestras de apresentação:</b><br/>
		<ul>
			<li>Dia 17/09 no SENAC (Rua Professor Braga, 60 - Centro) às 13:30h</li>
			<li>Dia 17/09 no SENAC (Rua Professor Braga, 60 - Centro) às 18:30 até 19:30</li>
		</ul>
		<br/> 
		Para alterar seus dados ou conferir o andamento do processo favor acessar o endereço 
		<a href='http://www.aiesecsm.org/psel2008_2/'>http://www.aiesecsm.org/psel2008_2/</a>.<br/>
		Qualquer dúvida favor entrar em contato no telefone abaixo ou através do email ".$contato."<br/> 
		<br/>
		Atenciosamente, <br/>
		AIESEC em Santa Maria<br/>
		Rua Floriano Peixoto, 1184, 8° andar do CCSH - Centro<br/>
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