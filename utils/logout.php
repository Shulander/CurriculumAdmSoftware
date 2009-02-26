<?php
	require_once("sessao.php");
	restritoUsuario();
	session_destroy();	
	header("Location:../tela_login.php");
	exit();	
?>