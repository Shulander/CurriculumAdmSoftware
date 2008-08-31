<?php
	require_once ("utils/sessao.php");
	require_once ("utils/BancoDados.php");
	include ("classes/Usuario.php");
	restritoVisitante();
	$login = $_POST['usuario'];
	$senha = $_POST['senha'];
			
	//tenta conectar-se ao banco de dados
	$conexaoBD = new BancoDados ();
	//verifica se a conexao ao banco de dados ocorreu corretamente
	if (!$conexaoBD->conecta ()) {
		$aviso = "Erro de sistema! Contate o administrador do sistema!";
		header("Location:cadastro.php?aviso=".$aviso);
		exit();
	}
	$usuario = new Usuario ($login, $senha, $conexaoBD, 0);
	$aviso = $usuario->insere();
	$conexaoBD->desconecta();
	
	if ($aviso == "sucesso") {
		header("Location:utils/login.php?usuario=".$login."&senha=".$senha);
	} else {
		header("Location:cadastro.php?aviso=".$aviso."&usuario=".$login);
	}
	exit();
?>