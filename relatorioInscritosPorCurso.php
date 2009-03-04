h<?php
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
	$sql = "SELECT distinct curso FROM expacademica WHERE tipo='graduação' ORDER BY curso ASC";
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
		$sqlNome = "SELECT distinct idLogin,nome from pessoa,expacademica WHERE pessoa.id=expacademica.idPessoa and expacademica.curso='".$cursos[$i]."' ORDER BY nome ASC";
		$resultadoNome = mysql_query($sqlNome, $conexaoBD->getLink());
		if ($resultadoNome != 0) {
			echo '<ol class="normal">';
			while ($dadosNome  = mysql_fetch_array ($resultadoNome)) {
				echo '<li><a href="fpdf/index.php?id='.$dadosNome['idLogin'].'">'.$dadosNome['nome'].'</a></li>';
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