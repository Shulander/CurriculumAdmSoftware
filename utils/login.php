<?php
	require_once ("sessao.php");
	require_once ("BancoDados.php");
	restritoVisitante();
	//dados
	$usuario = $_REQUEST['usuario'];
	$senha = $_REQUEST['senha'];
	//se usuario e/ou senha estao vazios, transmite o erro na pagina inicial
	if(empty($usuario) || empty($senha)) {
		$aviso = "� necess�rio preencher os campos usu�rio e senha!";
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
	$sql = "SELECT id as idLogin FROM login WHERE usuario LIKE '".$usuario."' AND senha LIKE '".md5($senha)."'";
	$result = mysql_query($sql, $conexao->getLink());
	if (mysql_num_rows ($result)!= 1){
		$aviso = "Erro de login! Os campos usu�rio e/ou senha est�o incorretos!";
		voltaParaPaginaInicial ($aviso);
	}
	//se chegou ate aqui, a conexao foi aceita
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	$conexao->setIdLogin($row['idLogin']);
	$conexao->setNome ($usuario);
	$conexao->setSession(); //salva na sessao
	$_SESSION['logado'] = true;
	mysql_free_result($result);	
	header("Location:../principal.php");
	exit();
	
	function voltaParaPaginaInicial ($aviso)
	{
		if (empty($aviso)) {
			header("Location:../index.php");
		} else {
			header("Location:../index.php?aviso=".$aviso);			
		}
		exit();
	}
?>