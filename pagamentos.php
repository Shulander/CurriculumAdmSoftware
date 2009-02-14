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
<h3>Módulo Administrador - Pagamentos</h3>
<?php
	if(!empty($aviso)) {
		echo '<ul class="erro"><li>'.$aviso.'</li></ul>';	
	}
?>
<ul>
<li><a href="pagamentoInsere.php">Setar pagamento inscrição</a></li>
<li><a href="pagamentoRemove.php">Remover pagamento</a></li>
</ul>
<center><a href="admin.php">Voltar para a página principal do módulo administrador</a></center>
<!-- Rodape -->
<?php include ("rodape.php"); ?>