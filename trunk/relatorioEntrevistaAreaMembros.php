<?php
	require_once ("utils/sessao.php");
	include ("cabecalho.php");
	require_once ("utils/BancoDados.php");
	require_once ("classes/Horario.php");
	restritoUsuario ();	
	$idLogin = $_SESSION['idLogin'];
	echo "<a name='topo'></a>";
	echo "<h3>Relat�rio de Entrevistas por �rea - Membros</h3>";
	$conexaoBD = new BancoDados ();
	//verifica se a conexao ao banco de dados ocorreu corretamente
	if (!$conexaoBD->conecta()) {
		$aviso = "Erro de sistema! Contate o administrador do sistema!";
		header("Location:relatorios.php?aviso=".$aviso);
		exit();
	}
	echo "<ul>";
	echo '<li><a href="#FIN">Finan�as</a></li>';
	echo '<li><a href="#IM">Gest�o da Informa��o</a></li>';
	echo '<li><a href="#TM">Gest�o de Talentos</a></li>';
	echo '<li><a href="#X">Interc�mbio</a></li>';
	echo '<li><a href="#MKT">Marketing e Comunica��o</a></li>';
	echo '<li><a href="#ER">Rela��es Externas</a></li>';
	echo '<li><a href="#NA">Indefinida</a></li>';
	echo "</ul>";
	
	$horario = new Horario (0, 0, 0, "", "", "", "", "nao", $conexaoBD);
	$resultado = $horario->buscaHorariosEntrevistasMarcados ();
	if ($resultado == 0) {
		$aviso = "N�o h� nenhuma entrevista inscrita no sistema!";
		header("Location:relatorios.php?aviso=".$aviso);
		exit();
	} else {
		echo "<hr />";
		echo '<h4><A NAME="FIN">Finan�as</A></h4>';
		consultaEntrevistasMembros ("Finan�as", $conexaoBD);
		echo "<br />";
		echo "<hr />";
		echo '<h4><A NAME="IM">Gest�o da Informa��o</A></h4>';	
		consultaEntrevistasMembros ("Gest�o da Informa��o", $conexaoBD);
		echo "<br />";
		echo "<hr />";
		echo '<h4><A NAME="TM">Gest�o de Talentos</A></h4>';	
		consultaEntrevistasMembros ("Gest�o de Talentos", $conexaoBD);
		echo "<br />";
		echo "<hr />";
		echo '<h4><A NAME="X">Interc�mbio</A></h4>';
		consultaEntrevistasMembros ("Interc�mbio", $conexaoBD);
		echo "<br />";
		echo "<hr />";
		echo '<h4><A NAME="MKT">Marketing e Comunica��o</A></h4>';
		consultaEntrevistasMembros ("Marketing e Comunica��o", $conexaoBD);
		echo "<br />";
		echo "<hr />";
		echo '<h4><A NAME="ER">Rela��es Externas</A></h4>';	
		consultaEntrevistasMembros ("Rela��es Externas", $conexaoBD);
		echo "<br />";
		echo "<hr />";
		echo '<h4><A NAME="NA">Indefinida</A></h4>';
		consultaEntrevistasMembros ("Indefinida", $conexaoBD);
		echo "<br />";
		echo "<hr />";
	}
	$conexaoBD->desconecta ();
	echo "<br/>";
	echo '<center><a href="relatorios.php">Voltar para a p�gina anterior</a></center>';
	//Rodape
	include ("rodape.php");

	function consultaEntrevistasMembros ($area, $conexaoBD)
	{
		$sql = "SELECT pessoa.nome,horario.data,horario.hora from pessoa,horario WHERE pessoa.id=horario.idPessoa AND horario.tipo='membro' AND area='".$area."' ORDER BY data, hora ASC";
		$resultado = mysql_query($sql, $conexaoBD->getLink());
		$numLinhas = mysql_num_rows ($resultado);
		if ($numLinhas != 0) {
			echo '<ol class="normal">';
			while ($dados  = mysql_fetch_array ($resultado)) {
				$dataBD = explode("-", $dados['data']);
				$data = $dataBD[2]."/".$dataBD[1]."/".$dataBD[0];	
				echo "<li>".$data." - ".$dados['hora']." - ".$dados['nome']."</li>";
			}
			echo "</ol>";
			echo '<p align="right"><a href="#topo"><u>Topo</u></a></p>';
		} else {
			echo "<center>N�o h� nenhuma entrevista cadastrada para essa �rea!</center>";
			echo '<p align="right"><a href="#topo"><u>Topo</u></a></p>';
		}
	}
?>