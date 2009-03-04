<?php
	require_once ("utils/sessao.php");
	include ("cabecalho.php");
	require_once ("utils/BancoDados.php");
	restritoUsuario ();	
	$idLogin = $_SESSION['idLogin'];

	echo "<h3>Relat�rio de Inscritos com Inscri��o Paga</h3>";
	$conexaoBD = new BancoDados ();
	//verifica se a conexao ao banco de dados ocorreu corretamente
	if (!$conexaoBD->conecta()) {
		$aviso = "Erro de sistema! Contate o administrador do sistema!";
		header("Location:relatorios.php?aviso=".$aviso);
		exit();
	}
	$sql = "SELECT login.id,nome FROM pessoa,login WHERE login.id=pessoa.idLogin and login.pago=1 ORDER BY nome ASC";
	$resultado = mysql_query($sql, $conexaoBD->getLink());
	$numLinhas = mysql_num_rows ($resultado);

	if ($resultado != 0) {
		echo '<ol class="normal">';
		while ($dados  = mysql_fetch_array ($resultado)) {
			echo '<li><a href="fpdf/index.php?id='.$dados['id'].'">'.$dados['nome'].'</a></li>';
		}
		echo "</ol>";
		echo "<center>Total de inscritos: ".$numLinhas."</center>";
	} else {
		$aviso = "N�o h� nenhum inscrito no sistema que j� pagou sua inscri��o!";
		header("Location:relatorios.php?aviso=".$aviso);
		exit();
	}
	$conexaoBD->desconecta ();
	echo "<br/>";
	echo '<center><a href="relatorios.php">Voltar para a p�gina anterior</a></center>';
	//Rodape
	include ("rodape.php");
?>