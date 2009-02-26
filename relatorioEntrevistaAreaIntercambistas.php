<?php
	require_once ("utils/sessao.php");
	include ("cabecalho.php");
	require_once ("utils/BancoDados.php");
	require_once ("classes/Horario.php");
	restritoUsuario ();	
	$idLogin = $_SESSION['idLogin'];
	echo "<a name='topo'></a>";
	echo "<h3>Relatório de Entrevistas por Área - Intercambistas</h3>";
	$conexaoBD = new BancoDados ();
	//verifica se a conexao ao banco de dados ocorreu corretamente
	if (!$conexaoBD->conecta()) {
		$aviso = "Erro de sistema! Contate o administrador do sistema!";
		header("Location:relatorios.php?aviso=".$aviso);
		exit();
	}
	echo "<ul>";
	echo '<li><a href="#ADM">Administração</a></li>';
	echo '<li><a href="#CS">Comunicação Social</a></li>';
	echo '<li><a href="#DES">Design/Arquitetura</a></li>';
	echo '<li><a href="#ENG">Engenharias</a></li>';
	echo '<li><a href="#MED">Saúde</a></li>';
	echo '<li><a href="#TI">Tecnologia da Informação</a></li>';
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
		echo '<h4><A NAME="ADM">Administração</A></h4>';
		consultaEntrevistasIntercambistas ("Administração", $conexaoBD);
		echo "<br />";
		echo "<hr />";
		echo '<h4><A NAME="CS">Comunicação Social</A></h4>';	
		consultaEntrevistasIntercambistas ("Comunicação Social", $conexaoBD);
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
		echo '<h4><A NAME="X">Saúde</A></h4>';
		consultaEntrevistasIntercambistas ("Saúde", $conexaoBD);
		echo "<br />";
		echo "<hr />";
		echo '<h4><A NAME="TI">Tecnologia da Informação</A></h4>';
		consultaEntrevistasIntercambistas ("Tecnologia da Informação", $conexaoBD);
		echo "<br />";
		echo "<hr />";
		echo '<h4><A NAME="NA">Indefinida</A></h4>';
		consultaEntrevistasIntercambistas ("Indefinida", $conexaoBD);
		echo "<br />";
		echo "<hr />";
	}
	$conexaoBD->desconecta ();
	echo "<br/>";
	echo '<center><a href="relatorios.php">Voltar para a página anterior</a></center>';
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
			echo "<center>Não há nenhuma entrevista cadastrada para essa área!</center>";
			echo '<p align="right"><a href="#topo"><u>Topo</u></a></p>';
		}
	}
?>