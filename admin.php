<?php 
	require_once ("utils/sessao.php");
	include ("cabecalho.php");
	restritoUsuario ();	
	$idLogin = $_SESSION['idLogin'];				
?>
<!-- Sub-titulo -->
<h3>Módulo Administrador</h3>
<ul>
<li><a href="relatorios.php">Relatórios</a></li>
<li><a href="entrevistas.php">Inserir/remover entrevistas</a></li>
</ul>
<!-- Rodape -->
<?php include ("rodape.php"); ?>