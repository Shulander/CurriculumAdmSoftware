<?php
	require_once ("utils/sessao.php");
	require_once ("utils/BancoDados.php");
	require_once ("utils/sessao.php");
	include ("classes/Usuario.php");
	restritoUsuario ();	
	$idLogin = $_SESSION['idLogin'];
	$id = $_POST['id'];
	$conexaoBD = new BancoDados ();
	//verifica se a conexao ao banco de dados ocorreu corretamente
	if (!$conexaoBD->conecta()) {
		$aviso = "Erro de sistema! Contate o administrador do sistema!";
		header("Location:pagamentoRemove.php?aviso=".$aviso);
		exit();
	}
	if(empty ($id)) {
		$aviso = "É necessário selecionar um inscrito!!";
		header("Location:pagamentoRemove.php?aviso=".$aviso);
		exit();
	}
	
	/*-----------Inserir pagamento------------------*/

	$login = new Usuario ("", "", "", $conexaoBD, $id);
	$login->setPago (0);
	$aviso = $login->setPagoBD();
	$conexaoBD->desconecta();
	header("Location:pagamentoRemove.php?aviso=".$aviso);
	exit();
?>