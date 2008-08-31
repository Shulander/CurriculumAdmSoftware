<?php
	require_once("sessao.php");
	restritoUsuario();
	session_destroy();	
	header("Location:../index.php");
	exit();	
?>