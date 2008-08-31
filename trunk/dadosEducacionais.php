<!-- Cabecalho -->
<?php include ("cabecalho.php");
	include ("menu.php");
	require_once ("utils/sessao.php");
	restritoUsuario ();	
?>
<!-- Sub-titulo -->
<h3>Formação Acadêmica</h3>
<ul><li>Clique na opção desejada:
	<ul>
		<li><a href="dadosEducacionaisInsere.php">Inserir nova experiência acadêmica</a></li>
		<li><a href="dadosEducacionaisEdita.php">Editar experiência acadêmica existente</a></li>
	</ul>
</li></ul>
<?php include ("rodape.php"); ?>