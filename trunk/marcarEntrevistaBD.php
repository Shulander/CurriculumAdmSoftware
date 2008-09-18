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
	$dados = explode("_", $entrevista);
	$hora = $dados[0];
	$data = $dados[1];
	$area = $dados[2];
	$location = "&hora=".$hora."&data=".$data."&area=".$area;
	//conexaoBD
	$conexaoBD = new BancoDados ();
	if (!$conexaoBD->conecta()) {
		$aviso = "Erro de sistema! Contate o administrador do sistema3!";
		header("Location:marcarEntrevista.php?aviso=".$aviso.$location);
		exit ();
	}
	//pessoa - getIdPessoa
	$pessoa = new Pessoa ($idLogin, "", "", "", "", "", "", "", "", "", "", "", "", "", "", 0, $conexaoBD); 
	$resultado = $pessoa->busca ();
	if ($resultado == false) {
		$aviso = "Erro de sistema! Contate o administrador do sistema4!";
		header("Location:marcarEntrevista.php?aviso=".$aviso.$location);
		exit ();
	}
	$idPessoa = $pessoa->getId();
	//busca id da entrevista
	echo "idlogin:".$idLogin."<br>";
	echo "idpessoa:".$idPessoa."<br>";
	echo "area:".$area."<br>";
	echo "data:".$data."<br>";
	echo "hora:".$hora."<br>";
	exit ();
	$horario = new Horario (0, $idLogin, $idPessoa, $area, "", $data, $hora, "nao", $conexaoBD);
	$result = $horario->buscaPorEntrevista ();
	if ($result == false) {
		$aviso = "Erro de sistema! Contate o administrador do sistema5!";
		header("Location:marcarEntrevista.php?aviso=".$aviso.$location);
		exit ();
	}
	//atualiza entrevista com o id da pessoa
	$aviso = $horario->marcaEntrevista ();
	header("Location:marcarEntrevista.php?aviso=".$retorno.$location);
	exit ();
?>