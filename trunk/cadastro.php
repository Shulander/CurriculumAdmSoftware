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
	//testa se a variavel tipo existe
	if(isset($_REQUEST['tipo'])) {
		$tipo = $_REQUEST['tipo'];	
	} else {
		$tipo = "";
	}
?>
<!-- Corpo -->
<h3>Cadastro de Usuários</h3>
<?php 
	if(!empty($aviso)) {
		if ($aviso == "sucesso") {
			echo '<ul class="sucesso"><li>Usuário inserido com sucesso!</li></ul>';
		} else {
			echo '<ul class="erro"><li>'.$aviso.'</li></ul>';	
		}						
	}
?>				
<center>
<form action="cadastroBD.php" method="POST" onsubmit="return verificaFormularioUsuario($('email'), $('senha'), $('tipo'));">
<table class="dados">
	<tr>
		<!-- email -->
		<td><a href="#" class="dica">E-mail:<span>Esse campo deve ser preenchido com um e-mail válido!</span> </a><font class="erro">*</font></td>
		<td><input name="email" id="email" value="<?php echo $email;?>" type="text" size="30" maxlength="30" /></td>
	</tr>
	<tr>
		<!-- SENHA -->
		<td>Senha: <font class="erro">*</font></td>
		<td><input name="senha" id="senha" type="password" size="30" maxlength="30" /></td>
	</tr>
	<!-- TIPO -->
	<tr><td>Tipo de inscrição:<font class="erro">*</font>&nbsp;&nbsp;</td>
	<td><select id="tipo" name="tipo">
	<option value="0"> -- Selecione -- </option>
	<?php 
	echo '<option value="Intercambista"  '.($tipo == "Intercambista"?'selected="selected"':"").' >Intercambista</option>'; 
	echo '<option value="Membro" '.($tipo == "Membro"?'selected="selected"':"").'>Membro</option>';
	?>
	</select></td></tr>
</table>
<br/>
<input name="envia" type="submit" value="Salvar" />
</form>
<br />
<ul class="ajuda"><li>Os campos marcados com asterisco (<font class="erro">*</font>) são obrigatórios!</li></ul>
<br />
<a href="index.php">Voltar</a>
<br />
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