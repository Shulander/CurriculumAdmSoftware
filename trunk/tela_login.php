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
<h3>Processo seletivo AIESEC 2009</h3>
<?php 
	if(!empty($aviso)) {
		echo "<ul class='erro'><li>".$aviso."</li></ul>";
	}
?>
<form action="utils/login.php" method="POST" onsubmit="return verificaFormularioUsuario($('email'), $('senha'));">
<center>
<div class="login">
<table>
	<tr><td>E-mail:&nbsp;&nbsp;</td><td><input name="email" id="email" type="text" size="30" maxlength="30" /></td></tr>
	<tr><td>Senha:</td><td><input name="senha" id="senha" type="password" size="30" maxlength="30"/></td></tr>
</table>
<br>
<input name="envia" type="submit" class="login" value="Entrar" />
</div>
</form>
<br>
<ul class="ajuda">
<li>Esqueci minha senha! Clique <a class="link_cadastro" href="recuperaUsuario.php">aqui!</a></li>
<li>Reportar problemas no sistema? Favor contate-nos através do e-mail: <a href="mailto:santamaria@aiesec.org.br">santamaria@aiesec.org.br</a>.</li>
<li><a href="index.php">Voltar para a página anterior</a></li>
</ul>
</center>
<!-- Rodape -->
<br/>
<center><font class="aiesecRodape">AIESEC in Santa Maria</font></center>
<address>
Rua Floriano Peixoto, 1184, 8° andar do CCSH - Centro<br/>
Santa Maria - RS - Brasil<br/>
<a href="http://www.aiesec.org.br/santamaria">http://www.aiesec.org.br/santamaria</a><br/>
</address>
<br/>
</center>
</div>
</body>
</html>