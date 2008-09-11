<?php	
	require_once("utils/sessao.php");	
	restritoVisitante();	
	include("cabecalho.php");
	//testa se a variavel aviso existe
	if(isset($_GET['aviso'])) {
		$aviso = $_GET['aviso'];	
	} else {
		$aviso = "";
	}
	//testa se a variavel email existe
	if(isset($_REQUEST['email'])) {
		$email = $_REQUEST['email'];	
	} else {
		$email = "";
	}
?>
<!-- Corpo -->
<h3>Recuperação de senha</h3>
<?php 
	if(!empty($aviso)) {
		if ($aviso == "sucesso") {
			echo '<ul class="sucesso"><li>Dados enviados com sucesso!</li></ul>';
		} else {
			echo '<ul class="erro"><li>'.$aviso.'</li></ul>';	
		}						
	}
?>
<center>
<form action="recuperaUsuarioBD.php" method="POST">
<table class="dados">
	<tr>
		<!-- USUARIO -->
		<td>Digite seu email: </td>
		<td><input name="email" id="email" value="<?php echo $email;?>" type="text" size="30" maxlength="30" /></td>
	</tr>
</table>
<br/>
<input name="envia" type="submit" value="Enviar" />
</form>
<br />
<a href="index.php">Voltar</a>
<br />
</center>			
<!-- Rodape -->
<br/>
<address>AIESEC in Santa Maria</address>
<br/>
</center>
</div>
</body>
</html>