<?php 
	require_once ("utils/sessao.php");
	include ("cabecalho.php");
	restritoAdministrador ();	
	$idLogin = $_SESSION['idLogin'];
?>
<!-- Sub-titulo -->
<h3>M�dulo Administrador</h3>
<ul>
<li><a href="relatorios.php">Relat�rios</a></li>
<li><a href="entrevistas.php">Inserir/remover entrevistas</a></li>
<li><a href="pagamentos.php">Inserir/Remover pagamento de membro no sistema</a></li>
</ul>
<!-- Rodape -->
<?php include ("rodape.php"); ?>