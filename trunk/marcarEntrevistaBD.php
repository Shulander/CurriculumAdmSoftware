<?php
	require_once ("utils/BancoDados.php");
	require_once ("utils/sessao.php");
	require_once ("classes/Usuario.php");
	include ("classes/Pessoa.php");
	include ("classes/Horario.php");
	include ("utils/Validador.php");
	restritoUsuario();
	$idLogin = $_SESSION['idLogin'] + 0;
	$entrevista = $_POST['entrevista'];
	if (empty($entrevista)) {
		$aviso = "É necessário selecionar um horário!";
		header("Location:marcarEntrevista.php?aviso=".$aviso);
		exit ();
	}
	$dados = explode("_", $entrevista);
	$hora = $dados[0];
	$data = $dados[1];
	$area = $dados[2];
	//conexaoBD
	$conexaoBD = new BancoDados ();
	if (!$conexaoBD->conecta()) {
		$aviso = "Erro de sistema! Contate o administrador do sistema!";
		header("Location:marcarEntrevista.php?aviso=".$aviso);
		exit ();
	}
	//pessoa - getIdPessoa
	$pessoa = new Pessoa ($idLogin, "", "", "", "", "", "", "", "", "", "", "", "", "", "", 0, $conexaoBD); 
	$resultado = $pessoa->busca ();
	if ($resultado == false) {
		$aviso = "Erro de sistema! Contate o administrador do sistema!";
		header("Location:marcarEntrevista.php?aviso=".$aviso);
		exit ();
	}
	$idPessoa = $pessoa->getId();
	//busca id da entrevista
	$horario = new Horario (0, $idLogin, $idPessoa, $area, "", $data, $hora, "nao", $conexaoBD);
	$result = $horario->buscaPorEntrevista ();
	if ($result == false) {
		$aviso = "Erro de sistema! Contate o administrador do sistema!";
		header("Location:marcarEntrevista.php?aviso=".$aviso);
		exit ();
	}
	//atualiza entrevista com o id da pessoa
	$aviso = $horario->marcaEntrevista ();
	if ($aviso == false) {
		$aviso = "Erro de sistema! Contate o administrador do sistema!";
		header("Location:marcarEntrevista.php?aviso=".$aviso);
		exit ();
	}
	//seta tabela login com entrevista marcada
	$usuario = new Usuario ("", "", "", $conexaoBD, $idLogin);
	$aviso = $usuario->setEntrevistaMarcada();
	header("Location:marcarEntrevista.php?aviso=".$aviso);
	exit ();
?>