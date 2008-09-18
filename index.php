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
<h3>Processo seletivo 2008/2</h3>
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
<li>Reportar problemas no sistema? Favor contate-nos através do e-mail: <a href="mailto:aiesecsmpsel@gmail.com">aiesecsmpsel@gmail.com</a>.</li>
<li>Ainda não tem cadastro?</li>
</ul>
<ul class="item">
<li class="intercambista">Para se cadastrar como <u>intercambista</u>, clique <a class="link_cadastro" href="informacao_intercambista.php">aqui!</a></li>
<li class="membro"><font class="erro">ATENÇÃO!</font> Inscrições para membros encerradas!!</li>
<!--  <li class="membro">Para se cadastrar como membro, clique <a class="link_cadastro" href="informacao_membro.php">aqui!</a></li> -->
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