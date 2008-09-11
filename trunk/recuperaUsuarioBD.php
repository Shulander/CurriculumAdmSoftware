<?php
	require_once ("utils/sessao.php");
	require_once ("utils/BancoDados.php");
	include ("utils/Validador.php");
	include ("classes/Usuario.php");
	restritoVisitante();
	$email = $_POST['email'];
	$aviso = null;
	//tenta conectar-se ao banco de dados
	$conexaoBD = new BancoDados ();
	//verifica se a conexao ao banco de dados ocorreu corretamente
	if (!$conexaoBD->conecta ()) {
		$aviso = "Erro de sistema! Contate o administrador do sistema!";
		header("Location:recuperaUsuario.php?aviso=".$aviso);
		exit();
	}
	$validador = new Validador ();	
	/*Testa se o email eh vazio ou valido*/
	if (!$validador->isPreenchido ($email)) {
		$aviso = "É necessário preencher o campo 'E-mail'!";	
	} else if (!$validador->comprimento($email, 50)) {
		$aviso = "O campo 'Email' deve possuir no máximo 50 caracteres!";
	} else if (!$validador->isEmail($email)) {
		$aviso = "Campo 'E-mail' inválido!";
	}
	if (!is_null($aviso)) {
		header("Location:recuperaUsuario.php?aviso=".$aviso."&email=".$email);
		exit();
	}
	$usuario = new Usuario ($email, "", "", $conexaoBD, 0);	
	$id = $usuario->buscaPorEmail();
	if ($id != 0) {
		//gerar senha aleatoria
		$senha = geraSenhaAleatoria ();
		//setar nova senha no bd
		$usuario->setId($id);
		$usuario->setSenha($senha);
		$resultado = $usuario->alteraSenha();
		if ($resultado != "sucesso") {
			$aviso = $resultado;
		} else {
			//enviar email para o usuario com o login e a nova senha
			$retorno = enviaEmail ($email, $senha);
			if ($retorno == true) {
				//enviar mensagem de sucesso
				$aviso = "sucesso";
			} else {
				$aviso = "Erro no envio dos dados! Contate o administrador do sistema!";
			}
		}
	} else {
		$aviso = "Usuário não encontrado!";
	}
	$conexaoBD->desconecta();
	if ($aviso == "sucesso") {
		header("Location:recuperaUsuario.php?aviso=".$aviso);
	} else {
		header("Location:recuperaUsuario.php?aviso=".$aviso."&email=".$email);
	}
	exit();
	
	/*----------------Funcoes --------------------*/
	function geraSenhaAleatoria ()
	{
		$caracteresAceitos = 'abcdxywzABCDZYWZ0123456789';
		$max = strlen($caracteresAceitos)-1;
		$senha = null;
		for ($i = 0; $i < 8; $i++) {
			$senha .= $caracteresAceitos{mt_rand(0, $max)};
		}
		return $senha;
	}
	
	function enviaEmail ($email, $senha)
	{
		$remetente = "non-reply@aiesecsm.org";
		$assunto = "Processo Seletivo AIESEC";
		$contato = "<a href='mailto:aiesecsmpsel@gmail.com'>aiesecsmpsel@gmail.com</a>";
		$mensagem= "<b>Caro usuário,</b><br />
		
		Este e-mail é uma resposta ao seu pedido por enviar seus dados de acesso ao sistema do processo seletivo<br/> 
		da AIESEC em Santa Maria. Seu login de acesso é \"".$email."\" e sua nova senha é \"".$senha."\".<br/>
		Para acessar o sistema, clique em <a href='http://www.aiesecsm.org/psel2008_2/'>http://www.aiesecsm.org/psel2008_2/</a>.<br/> 
		Caso tenha alguma dúvida sobre o processo seletivo, contate-nos através do email <".$contato.">.<br/><br/>
		Atenciosamente, <br/>
		AIESEC em Santa Maria<br/>
		Rua Floriano Peixoto, 1184, 8° andar do CCSH - Centro<br/>
		Santa Maria - RS - Brasil<br/>
		<a href='http://www.aiesec.org.br/santamaria'>http://www.aiesec.org.br/santamaria</a><br/>";
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "From: AIESEC Santa Maria <".$remetente."> \r\n";
		
		$retorno = mail($email, $assunto, $mensagem, $headers);
		return $retorno;
	}
?>