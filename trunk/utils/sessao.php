<?php
	session_name("sessao");
	session_start();
	if(empty($_SESSION['logado'])){
		$_SESSION['logado'] = false;
	}
	
	function restritoUsuario ()
	{
		//se nao ta logado volta pra tela de login
		if ($_SESSION['logado'] == false) {
			header ("Location: index.php");
			exit;
		}
	}
	
	function restritoVisitante ()
	{
		//se ta logado nao pode voltar pra tela de login
		if ($_SESSION['logado']) {
			header ("Location: principal.php");
			exit;
		}
	}
?>