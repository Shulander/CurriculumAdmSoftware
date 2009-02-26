<?php
	require_once ("utils/sessao.php");
	include ("cabecalho.php");
	require_once ("utils/BancoDados.php");
	require_once ("classes/Horario.php");
	restritoUsuario ();	
	$idLogin = $_SESSION['idLogin'];
	echo "<a name='topo'></a>";
	echo "<h3>Relatório de Entrevistas por Área - Membros</h3>";
	$conexaoBD = new BancoDados ();
	//verifica se a conexao ao banco de dados ocorreu corretamente
	if (!$conexaoBD->conecta()) {
		$aviso = "Erro de sistema! Contate o administrador do sistema!";
		header("Location:relatorios.php?aviso=".$aviso);
		exit();
	}
	echo "<ul>";
	echo '<li><a href="#FIN">Finanças</a></li>';
	echo '<li><a href="#IM">Gestão da Informação</a></li>';
	echo '<li><a href="#TM">Gestão de Talentos</a></li>';
	echo '<li><a href="#X">Intercâmbio</a></li>';
	echo '<li><a href="#MKT">Marketing e Comunicação</a></li>';
	echo '<li><a href="#ER">Relações Externas</a></li>';
	echo '<li><a href="#NA">Indefinida</a></li>';
	echo "</ul>";
	
	$horario = new Horario (0, 0, 0, "", "", "", "", "nao", $conexaoBD);
	$resultado = $horario->buscaHorariosEntrevistasMarcados ();
	if ($resultado == 0) {
		$aviso = "Não há nenhuma entrevista inscrita no sistema!";
		header("Location:relatorios.php?aviso=".$aviso);
		exit();
	} else {
		echo "<hr />";
		echo '<h4><A NAME="FIN">Finanças</A></h4>';
		consultaEntrevistasMembros ("Finanças", $conexaoBD);
		echo "<br />";
		echo "<hr />";
		echo '<h4><A NAME="IM">Gestão da Informação</A></h4>';	
		consultaEntrevistasMembros ("Gestão da Informação", $conexaoBD);
		echo "<br />";
		echo "<hr />";
		echo '<h4><A NAME="TM">Gestão de Talentos</A></h4>';	
		consultaEntrevistasMembros ("Gestão de Talentos", $conexaoBD);
		echo "<br />";
		echo "<hr />";
		echo '<h4><A NAME="X">Intercâmbio</A></h4>';
		consultaEntrevistasMembros ("Intercâmbio", $conexaoBD);
		echo "<br />";
		echo "<hr />";
		echo '<h4><A NAME="MKT">Marketing e Comunicação</A></h4>';
		consultaEntrevistasMembros ("Marketing e Comunicação", $conexaoBD);
		echo "<br />";
		echo "<hr />";
		echo '<h4><A NAME="ER">Relações Externas</A></h4>';	
		consultaEntrevistasMembros ("Relações Externas", $conexaoBD);
		echo "<br />";
		echo "<hr />";
		echo '<h4><A NAME="NA">Indefinida</A></h4>';
		consultaEntrevistasMembros ("Indefinida", $conexaoBD);
		echo "<br />";
		echo "<hr />";
	}
	$conexaoBD->desconecta ();
	echo "<br/>";
	echo '<center><a href="relatorios.php">Voltar para a página anterior</a></center>';
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
			echo "<center>Não há nenhuma entrevista cadastrada para essa área!</center>";
			echo '<p align="right"><a href="#topo"><u>Topo</u></a></p>';
		}
	}
?>