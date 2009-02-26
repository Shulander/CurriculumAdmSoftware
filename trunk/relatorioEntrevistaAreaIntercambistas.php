<?php
	require_once ("utils/sessao.php");
	include ("cabecalho.php");
	require_once ("utils/BancoDados.php");
	require_once ("classes/Horario.php");
	restritoUsuario ();	
	$idLogin = $_SESSION['idLogin'];
	echo "<a name='topo'></a>";
	echo "<h3>Relat�rio de Entrevistas por �rea - Intercambistas</h3>";
	$conexaoBD = new BancoDados ();
	//verifica se a conexao ao banco de dados ocorreu corretamente
	if (!$conexaoBD->conecta()) {
		$aviso = "Erro de sistema! Contate o administrador do sistema!";
		header("Location:relatorios.php?aviso=".$aviso);
		exit();
	}
	echo "<ul>";
	echo '<li><a href="#ADM">Administra��o</a></li>';
	echo '<li><a href="#CS">Comunica��o Social</a></li>';
	echo '<li><a href="#DES">Design/Arquitetura</a></li>';
	echo '<li><a href="#ENG">Engenharias</a></li>';
	echo '<li><a href="#MED">Sa�de</a></li>';
	echo '<li><a href="#TI">Tecnologia da Informa��o</a></li>';
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
		echo '<h4><A NAME="ADM">Administra��o</A></h4>';
		consultaEntrevistasIntercambistas ("Administra��o", $conexaoBD);
		echo "<br />";
		echo "<hr />";
		echo '<h4><A NAME="CS">Comunica��o Social</A></h4>';	
		consultaEntrevistasIntercambistas ("Comunica��o Social", $conexaoBD);
		echo "<br />";
		echo "<hr />";
		echo '<h4><A NAME="DES">Design/Arquitetura</A></h4>';	
		consultaEntrevistasIntercambistas ("Design/Arquitetura", $conexaoBD);
		echo "<br />";
		echo "<hr />";
		echo '<h4><A NAME="ENG">Engenharias</A></h4>';	
		consultaEntrevistasIntercambistas ("Engenharias", $conexaoBD);
		echo "<br />";
		echo "<hr />";
		echo '<h4><A NAME="X">Sa�de</A></h4>';
		consultaEntrevistasIntercambistas ("Sa�de", $conexaoBD);
		echo "<br />";
		echo "<hr />";
		echo '<h4><A NAME="TI">Tecnologia da Informa��o</A></h4>';
		consultaEntrevistasIntercambistas ("Tecnologia da Informa��o", $conexaoBD);
		echo "<br />";
		echo "<hr />";
		echo '<h4><A NAME="NA">Indefinida</A></h4>';
		consultaEntrevistasIntercambistas ("Indefinida", $conexaoBD);
		echo "<br />";
		echo "<hr />";
	}
	$conexaoBD->desconecta ();
	echo "<br/>";
	echo '<center><a href="relatorios.php">Voltar para a p�gina anterior</a></center>';
	//Rodape
	include ("rodape.php");

	function consultaEntrevistasIntercambistas ($area, $conexaoBD)
	{
		$sql = "SELECT pessoa.nome,horario.data,horario.hora from pessoa,horario WHERE pessoa.id=horario.idPessoa AND horario.tipo='intercambista' AND area='".$area."' ORDER BY data, hora ASC";
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