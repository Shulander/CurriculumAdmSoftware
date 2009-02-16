<?php
	require_once ("utils/sessao.php");
	include ("cabecalho.php");
	require_once ("utils/BancoDados.php");
	restritoUsuario ();	
	$idLogin = $_SESSION['idLogin'];

	echo "<h3>Relatório de Inscritos</h3>";
	$conexaoBD = new BancoDados ();
	//verifica se a conexao ao banco de dados ocorreu corretamente
	if (!$conexaoBD->conecta()) {
		$aviso = "Erro de sistema! Contate o administrador do sistema!";
		header("Location:relatorios.php?aviso=".$aviso);
		exit();
	}
	$sql = "SELECT idLogin, nome FROM pessoa,login WHERE login.id=pessoa.idLogin and login.tipo<>'admin' ORDER BY nome ASC";
	$resultado = mysql_query($sql, $conexaoBD->getLink());
	$numLinhas = mysql_num_rows ($resultado);

	if ($resultado != 0) {
		echo '<ol class="normal">';
		while ($dados  = mysql_fetch_array ($resultado)) {
			echo '<li><a href="http://localhost/Curriculo/fpdf/index.php?id='.$dados['idLogin'].'">'.$dados['nome'].'</a></li>';
		}
		echo "</ol>";
		echo "<center>Total de inscritos: ".$numLinhas."</center>";
	} else {
		$aviso = "Não há nenhum inscrito no sistema!";
		header("Location:relatorios.php?aviso=".$aviso);
		exit();
	}
	$conexaoBD->desconecta ();
	echo "<br/>";
	echo '<center><a href="relatorios.php">Voltar para a página anterior</a></center>';
	//Rodape
	include ("rodape.php");
?>