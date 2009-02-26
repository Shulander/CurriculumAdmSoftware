<?php 
	require_once ("utils/sessao.php");
	include ("cabecalho.php");
	require_once ("utils/BancoDados.php");		
	restritoUsuario ();	
	$idLogin = $_SESSION['idLogin'];
	//testa se a variavel aviso existe
	if(isset($_GET['aviso'])) {
		$aviso = $_GET['aviso'];	
	} else {
		$aviso = "";
	}
?>
<!-- Sub-titulo -->
<h3>Módulo Administrador - Relatórios</h3>
<?php
	if(!empty($aviso)) {
		echo '<ul class="erro"><li>'.$aviso.'</li></ul>';	
	}
?>
<ul>
<li><a href="relatorioInscritos.php">Relação de inscritos</a></li>
<li><a href="relatorioEPsInscritos.php">Relação de EPs inscritos</a></li>
<li><a href="relatorioMembrosInscritos.php">Relação de membros inscritos</a></li>
<li><a href="relatorioInscritosPorCurso.php">Relação de inscritos por curso</a></li>
<li><a href="relatorioEPsInscritosPorCurso.php">Relação de EPs inscritos por curso</a></li>
<li><a href="relatorioMembrosInscritosPorCurso.php">Relação de membros inscritos por curso</a></li>
<li><a href="relatorioInscritosPago.php">Relação de inscritos com inscrição paga</a></li>
<li><a href="relatorioEntrevistaAreaMembros.php">Relação de entrevistas por área - membros</a></li>
<li><a href="relatorioEntrevistaAreaIntercambistas.php">Relação de entrevistas por área - intercambista</a></li>
</ul>
<center><a href="admin.php">Voltar para a página principal do módulo administrador</a></center>
<!-- Rodape -->
<?php include ("rodape.php"); ?>