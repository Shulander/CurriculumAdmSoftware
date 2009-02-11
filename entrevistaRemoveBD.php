<?php
	require_once ("utils/sessao.php");
	require_once ("utils/BancoDados.php");
	require_once ("utils/sessao.php");
	include ("utils/Validador.php");
	include ("classes/Horario.php");
	restritoUsuario ();	
	$idLogin = $_SESSION['idLogin'];
	$id = $_POST['id'];
	if (empty($id)) {
		$aviso = "É necessário selecionar um horário!";
		header("Location:entrevistaRemove.php?aviso=".$aviso);
		exit ();
	}
	$conexaoBD = new BancoDados ();
	//verifica se a conexao ao banco de dados ocorreu corretamente
	if (!$conexaoBD->conecta()) {
		$aviso = "Erro de sistema (1)! Contate o administrador do sistema!";
		header("Location:entrevistaRemove.php?aviso=".$aviso);
		exit();
	}
	$horario = new Horario ($id, 0, 0, "", "", "", "", "sim", $conexaoBD);
	$aviso = $horario->removeEntrevista();
	header("Location:entrevistaRemove.php?aviso=".$aviso);
	exit();
?>