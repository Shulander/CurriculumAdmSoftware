<!-- Cabecalho -->
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
	//testa se a variavel usuario existe
	if(isset($_REQUEST['usuario'])) {
		$usuario = $_REQUEST['usuario'];	
	} else {
		$usuario = "";
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
<form action="cadastroBD.php" method="POST" onsubmit="return verificaFormularioUsuario($('usuario'), $('senha'));">
<table class="dados">
	<tr>
		<!-- USUARIO -->
		<td><a href="#" class="dica">Usuário:<span>O campo usuário não deve conter espaços!</span> </a><font class="erro">*</font></td>
		<td><input name="usuario" id="usuario" value="<?php echo $usuario;?>" type="text" size="30" maxlength="30" /></td>
	</tr>
	<tr>
		<!-- SENHA -->
		<td>Senha: <font class="erro">*</font></td>
		<td><input name="senha" id="senha" type="password" size="30" maxlength="30" /></td>
	</tr>
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
<?php include ("rodape.php"); ?>