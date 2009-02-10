<?php
require_once ("utils/BancoDados.php");
require_once ("utils/sessao.php");
if(isset($_GET['id']))
{
	$conexaoBD = new BancoDados ();

	//verifica se a conexao ao banco de dados ocorreu corretamente
	if (!$conexaoBD->conecta()) {
		$aviso = "Erro de sistema! Contate o administrador do sistema!";
		header("Location:dadosPessoais.php?aviso=".$aviso.$location);
		exit();
	}
	// if id is set then get the file with the id from database
	$id = $_GET['id']+0;
	$query = "SELECT name, type, size, content " .
	         "FROM fotos WHERE fk_login = $id";
	
	$result = mysql_query($query) or die('Error, query failed '.mysql_error());
	list($name, $type, $size, $content) = mysql_fetch_array($result);

	header("Content-length: $size");
	header("Content-type: $type");
	print $content;
	exit;
}

?>