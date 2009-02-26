<?php
	require_once ("sessao.php");
	require_once ("BancoDados.php");
	restritoVisitante();
	//dados
	$email = $_REQUEST['email'];
	$senha = $_REQUEST['senha'];
	//se usuario e/ou senha e/ou tipo estao vazios, transmite o erro na pagina inicial
	if(empty($email) || empty($senha)) {
		$aviso = "� necess�rio preencher os campos email e senha!";
		voltaParaPaginaInicial ($aviso);
	}
	//tenta conectar-se ao banco de dados
	$conexao = new BancoDados ();
	$conectou = $conexao->conecta ();	
	//verifica se a conexao ao banco de dados ocorreu corretamente
	if (!$conectou) {
		$aviso = "Erro de sistema! Contate o administrador do sistema!";
		voltaParaPaginaInicial ($aviso);
	}
	//verifica se o usuario e a senha estao corretos	
	$sql = "SELECT tipo,id as idLogin FROM login WHERE email LIKE '".$email."' AND senha LIKE '".md5($senha)."'";
	$result = mysql_query($sql, $conexao->getLink());
	if (mysql_num_rows ($result)!= 1){
		$aviso = "Erro de login! Os campos e-mail e/ou senha est�o incorretos!";
		voltaParaPaginaInicial ($aviso);
	}
	//se chegou ate aqui, a conexao foi aceita
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	$conexao->setIdLogin($row['idLogin']);
	$conexao->setTipo ($row['tipo']);
	$conexao->setNome ($email);
	$conexao->setSession(); //salva na sessao
	$_SESSION['logado'] = true;
	if ($conexao->getTipo() == "admin") {
		$_SESSION['admin'] = true;
		mysql_free_result($result);	
		header("Location:../admin.php");
		exit();
	} else {
		$_SESSION['admin'] = false;
	}
	mysql_free_result($result);	
	$conexao->desconecta ();
	header("Location:../principal.php");
	exit();
	
	function voltaParaPaginaInicial ($aviso)
	{
		if (empty($aviso)) {
			header("Location:../tela_login.php");
		} else {
			header("Location:../tela_login.php?aviso=".$aviso);			
		}
		exit();
	}
?>