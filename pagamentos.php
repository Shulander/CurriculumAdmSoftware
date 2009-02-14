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
<h3>M�dulo Administrador - Pagamentos</h3>
<?php
	if(!empty($aviso)) {
		echo '<ul class="erro"><li>'.$aviso.'</li></ul>';	
	}
?>
<ul>
<li><a href="pagamentoInsere.php">Setar pagamento inscri��o</a></li>
<li><a href="pagamentoRemove.php">Remover pagamento</a></li>
</ul>
<center><a href="admin.php">Voltar para a p�gina principal do m�dulo administrador</a></center>
<!-- Rodape -->
<?php include ("rodape.php"); ?>