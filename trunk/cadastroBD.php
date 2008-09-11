<?php
	require_once ("utils/sessao.php");
	require_once ("utils/BancoDados.php");
	require_once ("utils/Validador.php");
	include ("classes/Usuario.php");
	restritoVisitante();
	$email = $_POST['email'];
	$senha = $_POST['senha'];
	$tipo = $_POST['tipo'];
	$location = "&email=".$email."&tipo=".$tipo;
	$aviso = null;
	$validador = new Validador ();
	//tenta conectar-se ao banco de dados
	$conexaoBD = new BancoDados ();
	//verifica se a conexao ao banco de dados ocorreu corretamente
	if (!$conexaoBD->conecta ()) {
		$aviso = "Erro de sistema! Contate o administrador do sistema!";
		header("Location:cadastro.php?aviso=".$aviso);
		exit();
	}
	/*------------email----------------*/
	if (!$validador->isPreenchido ($email)) {
		$aviso = "Щ necessсrio preencher o campo 'E-mail'!";	
	} else if (!$validador->comprimento($email, 50)) {
		$aviso = "O campo 'Email' deve possuir no mсximo 50 caracteres!";
	} else if (!$validador->isEmail($email)) {
		$aviso = "Campo 'E-mail' invсlido!";
	}
	/*---------Tipo------------*/
	if (is_null ($aviso)) {
		if (!$validador->isSelecionado($tipo)) {
			$aviso = "Щ necessсrio selecionar uma opчуo do campo 'Tipo de Inscriчуo'!";	
		}
	}
	if (!is_null ($aviso)) {
		header("Location:cadastro.php?aviso=".$aviso.$location);
		exit ();
	}
	//verifica se email ja foi cadastrado anteriormente
	$usuario = new Usuario ($email, $senha, $tipo, $conexaoBD, 0);
	$retorno = $usuario->buscaPorEmail();
	if ($retorno != 0) {
		//alguem ja se cadastrou com esse email
		$aviso = "Esse usuсrio jс estс cadastrado no sistema!";
		header("Location:cadastro.php?aviso=".$aviso.$location);
		exit ();
	}
	//se esta tudo ok, insere usuario
	$aviso = $usuario->insere();
	$conexaoBD->desconecta();
	
	if ($aviso == "sucesso") {
		header("Location:utils/login.php?email=".$email."&senha=".$senha);
	} else {
		header("Location:cadastro.php?aviso=".$aviso.$location);
	}
	exit();
?>