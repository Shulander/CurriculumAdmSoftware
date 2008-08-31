<!-- Cabecalho -->
<?php 
	require_once ("utils/sessao.php");
	restritoVisitante();
	include ("cabecalho.php");
	//testar se a variavel aviso existe
	if(isset($_GET['aviso'])) {
		$aviso = $_GET['aviso'];	
	} else {
		$aviso = '';
	}
?>
<!-- Corpo -->
<!-- Login -->
<h3>Login</h3>
<?php 
	if(!empty($aviso)) {
		echo "<ul class='erro'><li>".$aviso."</li></ul>";
	}
?>
<form action="utils/login.php" method="POST" onsubmit="return verificaFormularioUsuario($('usuario'), $('senha'));">
<center>
<div class="login">
<table>
	<tr><td>Usuário:&nbsp;&nbsp;</td><td><input name="usuario" id="usuario" type="text" size="30" maxlength="30" /></td></tr>
	<tr><td>Senha:</td><td><input name="senha" id="senha" type="password" size="30" maxlength="30"/></td></tr>
</table>
<br>
<input name="envia" type="submit" class="login" value="Entrar" />
</div>
</form>
<br>
<ul class="ajuda">
<li>Esqueci meu login ou senha! Clique <a class="link_cadastro" href="recuperaUsuario.php">aqui!</a></li>
<li>Ainda não tem cadastro? Clique <a class="link_cadastro" href="informacao.php">aqui!</a></li>
</ul>
</center>
<!-- Rodape -->
<?php include ("rodape.php"); ?>