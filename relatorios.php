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
<h3>M�dulo Administrador - Relat�rios</h3>
<?php
	if(!empty($aviso)) {
		echo '<ul class="erro"><li>'.$aviso.'</li></ul>';	
	}
?>
<ul>
<li><a href="relatorioInscritos.php">Rela��o de inscritos</a></li>
<li><a href="relatorioEPsInscritos.php">Rela��o de EPs inscritos</a></li>
<li><a href="relatorioMembrosInscritos.php">Rela��o de membros inscritos</a></li>
<li><a href="relatorioInscritosPorCurso.php">Rela��o de inscritos por curso</a></li>
<li><a href="relatorioEPsInscritosPorCurso.php">Rela��o de EPs inscritos por curso</a></li>
<li><a href="relatorioMembrosInscritosPorCurso.php">Rela��o de membros inscritos por curso</a></li>
<li><a href="relatorioInscritosPago.php">Rela��o de inscritos com inscri��o paga</a></li>
<li><a href="relatorioEntrevistaAreaMembros.php">Rela��o de entrevistas por �rea - membros</a></li>
<li><a href="relatorioEntrevistaAreaIntercambistas.php">Rela��o de entrevistas por �rea - intercambista</a></li>
</ul>
<center><a href="admin.php">Voltar para a p�gina principal do m�dulo administrador</a></center>
<!-- Rodape -->
<?php include ("rodape.php"); ?>