<?php
	require_once ("utils/sessao.php");
	include ("cabecalho.php");
	require_once ("utils/BancoDados.php");
	require_once ("classes/Horario.php");
	restritoUsuario ();	
	$idLogin = $_SESSION['idLogin'];
	echo "<a name='topo'></a>";
	echo "<h3>Relatório de Entrevistas por Área</h3>";
	$conexaoBD = new BancoDados ();
	//verifica se a conexao ao banco de dados ocorreu corretamente
	if (!$conexaoBD->conecta()) {
		$aviso = "Erro de sistema! Contate o administrador do sistema!";
		header("Location:relatorios.php?aviso=".$aviso);
		exit();
	}
	$horario = new Horario (0, 0, 0, "", "", "", "", "nao", $conexaoBD);
	$resultado = $horario->buscaHorariosEntrevistasMarcados ();
	if ($resultado != 0) {
		$areas = array ();
		echo "<ul>";
		for ($i = 0; $i < count ($resultado); $i++) {
			$areas[] = $resultado[$i]->getArea();
			echo '<li><a href="#'.$resultado[$i]->getArea().'">'.$resultado[$i]->getArea().'</a></li>';
		}
		echo "</ul>";
	} else {
		$aviso = "Não há nenhuma entrevista inscrita no sistema!";
		header("Location:relatorios.php?aviso=".$aviso);
		exit();
	}
	echo "<br/>";
	echo '<center><a href="relatorios.php">Voltar para a página anterior</a></center>';
	echo "<hr>";
	for ($j = 0; $j < count($areas); $j++) {
		echo '<h4><A NAME="'.$areas[$j].'">'.$areas[$j].'</A></h4>';
		$sqlNome = "SELECT distinct nome from login,pessoa,expacademica WHERE login.id=pessoa.idLogin AND pessoa.id=expacademica.idPessoa AND  expacademica.curso='".$cursos[$i]."' AND login.tipo='intercambista' ORDER BY nome ASC";
		$resultadoNome = mysql_query($sqlNome, $conexaoBD->getLink());
		if ($resultadoNome != 0) {
			echo '<ol class="normal">';
			while ($dadosNome  = mysql_fetch_array ($resultadoNome)) {
				echo "<li>".$dadosNome['nome']."</li>";
			}
			echo "</ol>";
			echo '<p align="right"><a href="#topo"><u>Topo</u></a></p>';
		} else {
			$aviso = "Erro de sistema! Contate o administrador do sistema!";
			header("Location:relatorios.php?aviso=".$aviso);
			exit();
		}

	}
	$conexaoBD->desconecta ();
	echo "<br/>";
	echo '<center><a href="relatorios.php">Voltar para a página anterior</a></center>';
	//Rodape
	include ("rodape.php");

?>