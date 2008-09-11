<?php
	require_once ("utils/BancoDados.php");
	require_once ("utils/sessao.php");
	include ("classes/Pessoa.php");
	include ("utils/Validador.php");
	restritoUsuario();
	$idLogin = $_SESSION['idLogin'] + 0;
	$conexaoBD = new BancoDados ();
	//verifica se a conexao ao banco de dados ocorreu corretamente
	if (!$conexaoBD->conecta()) {
		$aviso = "Erro de sistema! Contate o administrador do sistema!";
		header("Location:dadosProfissionais.php?aviso=".$aviso);
		exit();
	}
	$pessoa = new Pessoa ($idLogin, "", "", "", "", "", "", "", "", "", "", "", "", "", "", 0, $conexaoBD);
	$result = $pessoa->alteraDadosProfissionaisBD (1);
	if ($result == "sucesso") {
		header ("Location:dadosExtras.php");
	} else {
		$aviso = "Erro de sistema! Contate o administrador do sistema!";
		header("Location:dadosProfissionais.php?aviso=".$aviso.$location);
	}
	exit();
?>