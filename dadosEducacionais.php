<!-- Cabecalho -->
<?php include ("cabecalho.php");
	include ("menu.php");
	require_once ("utils/sessao.php");
	restritoUsuario ();	
?>
<!-- Sub-titulo -->
<h3>Forma��o Acad�mica</h3>
<ul><li>Clique na op��o desejada:
	<ul>
		<li><a href="dadosEducacionaisInsere.php">Inserir nova experi�ncia acad�mica</a></li>
		<li><a href="dadosEducacionaisEdita.php">Editar experi�ncia acad�mica existente</a></li>
	</ul>
</li></ul>
<?php include ("rodape.php"); ?>