<?php
	require_once ("utils/sessao.php");
	include ("cabecalho.php");
	require_once ("utils/BancoDados.php");
	restritoUsuario ();	
	$idLogin = $_SESSION['idLogin'];
	echo "<a name='topo'></a>";
	echo "<h3>Relatório de Inscritos Por Curso</h3>";
	$conexaoBD = new BancoDados ();
	//verifica se a conexao ao banco de dados ocorreu corretamente
	if (!$conexaoBD->conecta()) {
		$aviso = "Erro de sistema! Contate o administrador do sistema!";
		header("Location:relatorios.php?aviso=".$aviso);
		exit();
	}
	$sql = "SELECT distinct curso FROM login,pessoa,expacademica WHERE expacademica.tipo='graduação' AND login.id=pessoa.idLogin AND pessoa.id=expacademica.idPessoa AND login.tipo='intercambista' ORDER BY curso ASC";
	$resultado = mysql_query($sql, $conexaoBD->getLink());
	$numCursos = mysql_num_rows ($resultado);
	if ($resultado != 0) {
		$cursos = array ();
		echo "<ul>";
		while ($dados  = mysql_fetch_array ($resultado)) {
			$cursos[] = $dados['curso'];
			echo '<li><a href="#'.$dados['curso'].'">'.$dados['curso'].'</a></li>';
		}
		echo "</ul>";
	} else {
		$aviso = "Não há nenhum inscrito por curso no sistema!";
		header("Location:relatorios.php?aviso=".$aviso);
		exit();
	}
	echo "<br/>";
	echo '<center><a href="relatorios.php">Voltar para a página anterior</a></center>';
	echo "<hr>";
	for ($i = 0; $i < $numCursos; $i++) {
		echo '<h4><A NAME="'.$cursos[$i].'">'.$cursos[$i].'</A></h4>';
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