<!-- Cabecalho -->
<?php include ("cabecalho.php");
	include ("menu.php");
	require_once ("utils/sessao.php");	
	restritoUsuario ();	 
	/*--------Testa variaveis ---------*/
	//testa se a variavel aviso existe
	if(isset($_GET['aviso'])) {
		$aviso = $_GET['aviso'];	
	} else {
		$aviso = "";
	}
	//testa se a variavel ingles existe
	if(isset($_REQUEST['ingles'])) {
		$ingles = $_REQUEST['ingles'];	
	} else {
		$ingles = "";
	}
	//testa se a variavel espanhol existe
	if(isset($_REQUEST['espanhol'])) {
		$espanhol = $_REQUEST['espanhol'];	
	} else {
		$espanhol = "";
	}
	//testa se a variavel italiano existe
	if(isset($_REQUEST['italiano'])) {
		$italiano = $_REQUEST['italiano'];	
	} else {
		$italiano = "";
	}
	//testa se a variavel frances existe
	if(isset($_REQUEST['frances'])) {
		$frances = $_REQUEST['frances'];	
	} else {
		$frances = "";
	}
	//testa se a variavel alemao existe
	if(isset($_REQUEST['alemao'])) {
		$alemao = $_REQUEST['alemao'];	
	} else {
		$alemao = "";
	}
	//testa se a variavel outro1 existe
	if(isset($_REQUEST['outro1'])) {
		$outro1 = $_REQUEST['outro1'];	
	} else {
		$outro1 = "";
	}
	//testa se a variavel nivelOutro1 existe
	if(isset($_REQUEST['nivelOutro1'])) {
		$nivelOutro1 = $_REQUEST['nivelOutro1'];	
	} else {
		$nivelOutro1 = "";
	}
	//testar se a variavel outro2 existe
	if(isset($_GET['outro2'])) {
		$outro2 = $_GET['outro2'];	
	} else {
		$outro2 = "";
	}
	//testar se a variavel nivelOutro2 existe
	if(isset($_GET['nivelOutro2'])) {
		$nivelOutro2 = $_GET['nivelOutro2'];	
	} else {
		$nivelOutro2 = "";
	}
?>
<!-- Sub-titulo -->
<h3>Idiomas</h3>
<?php
if(!empty($aviso)) {
	if ($aviso == "sucesso") {
		echo '<ul class="sucesso"><li>Idiomas cadastrados com sucesso!</li></ul>';
	} else {
		echo '<ul class="erro"><li>'.$aviso.'</li></ul>';	
	}						
}
echo '<form action="idiomasBD.php" method="POST">';
echo '<table class="tabela">';
//--------Ingles------------
echo '<tr><td>Inglês: <font class="erro">*</font></td>';
echo '<td><select name="ingles" onchange="submit();">';
echo '<option value="0"> -- Selecione -- </option>';
echo '<option value="Nenhum" '.($ingles == "Nenhum"?'selected="selected"':"").'>Nenhum</option>';	
echo '<option value="Básico" '.($ingles == "Básico"?'selected="selected"':"").'>Básico</option>';					
echo '<option value="Intermediário" '.($ingles == "Técnologo"?'selected="selected"':"").'>Intermediário</option>';
echo '<option value="Avançado" '.($ingles == "Avançado"?'selected="selected"':"").'>Avançado</option>';							
echo '<option value="Fluente" '.($ingles == "Fluente"?'selected="selected"':"").'>Fluente</option>';	
echo '</select></td></tr>';
//--------Espanhol------------
echo '<tr><td>Espanhol: <font class="erro">*</font></td>';
echo '<td><select name="espanhol" onchange="submit();">';
echo '<option value="0"> -- Selecione -- </option>';
echo '<option value="Nenhum" '.($espanhol == "Nenhum"?'selected="selected"':"").'>Nenhum</option>';
echo '<option value="Básico" '.($espanhol == "Básico"?'selected="selected"':"").'>Básico</option>';					
echo '<option value="Intermediário" '.($espanhol == "Técnologo"?'selected="selected"':"").'>Intermediário</option>';
echo '<option value="Avançado" '.($espanhol == "Avançado"?'selected="selected"':"").'>Avançado</option>';							
echo '<option value="Fluente" '.($espanhol == "Fluente"?'selected="selected"':"").'>Fluente</option>';	
echo '</select></td></tr>';
//--------Italiano------------
echo '<tr><td>Italiano: <font class="erro">*</font></td>';
echo '<td><select name="italiano" onchange="submit();">';
echo '<option value="0"> -- Selecione -- </option>';
echo '<option value="Nenhum" '.($italiano == "Nenhum"?'selected="selected"':"").'>Nenhum</option>';
echo '<option value="Básico" '.($italiano == "Básico"?'selected="selected"':"").'>Básico</option>';					
echo '<option value="Intermediário" '.($italiano == "Técnologo"?'selected="selected"':"").'>Intermediário</option>';
echo '<option value="Avançado" '.($italiano == "Avançado"?'selected="selected"':"").'>Avançado</option>';							
echo '<option value="Fluente" '.($italiano == "Fluente"?'selected="selected"':"").'>Fluente</option>';	
echo '</select></td></tr>';
//--------Frances------------
echo '<tr><td>Francês: <font class="erro">*</font></td>';
echo '<td><select name="frances" onchange="submit();">';
echo '<option value="0"> -- Selecione -- </option>';
echo '<option value="Nenhum" '.($frances == "Nenhum"?'selected="selected"':"").'>Nenhum</option>';
echo '<option value="Básico" '.($frances == "Básico"?'selected="selected"':"").'>Básico</option>';					
echo '<option value="Intermediário" '.($frances == "Técnologo"?'selected="selected"':"").'>Intermediário</option>';
echo '<option value="Avançado" '.($frances == "Avançado"?'selected="selected"':"").'>Avançado</option>';							
echo '<option value="Fluente" '.($frances == "Fluente"?'selected="selected"':"").'>Fluente</option>';	
echo '</select></td></tr>';
//--------Alemao------------
echo '<tr><td>Alemão: <font class="erro">*</font></td>';
echo '<td><select name="alemao" onchange="submit();">';
echo '<option value="0"> -- Selecione -- </option>';
echo '<option value="Nenhum" '.($alemao == "Nenhum"?'selected="selected"':"").'>Nenhum</option>';
echo '<option value="Básico" '.($alemao == "Básico"?'selected="selected"':"").'>Básico</option>';					
echo '<option value="Intermediário" '.($alemao == "Técnologo"?'selected="selected"':"").'>Intermediário</option>';
echo '<option value="Avançado" '.($alemao == "Avançado"?'selected="selected"':"").'>Avançado</option>';							
echo '<option value="Fluente" '.($alemao == "Fluente"?'selected="selected"':"").'>Fluente</option>';	
echo '</select></td></tr>';
//--------outro1---------------
echo '<tr rowspan="2"><td>Outro: </td>';
echo '<td><input type="text" id="outro1" name="outro1" value="'.$outro1.'" size="15" maxlength="30"></td>';
echo '<td><select name="nivelOutro1" id="nivelOutro1" onchange="submit();">';
echo '<option value="0"> -- Selecione -- </option>';
echo '<option value="Nenhum" '.($nivelOutro1 == "Nenhum"?'selected="selected"':"").'>Nenhum</option>';
echo '<option value="Básico" '.($nivelOutro1 == "Básico"?'selected="selected"':"").'>Básico</option>';					
echo '<option value="Intermediário" '.($nivelOutro1 == "Técnologo"?'selected="selected"':"").'>Intermediário</option>';
echo '<option value="Avançado" '.($nivelOutro1 == "Avançado"?'selected="selected"':"").'>Avançado</option>';							
echo '<option value="Fluente" '.($nivelOutro1 == "Fluente"?'selected="selected"':"").'>Fluente</option>';	
echo '</select></td>';
echo '</tr>';
//--------outro2---------------
echo '<tr rowspan="2"><td>Outro: </td>';
echo '<td><input type="text" id="outro2" name="outro2" value="'.$outro2.'" size="15" maxlength="30"></td>';
echo '<td><select name="nivelOutro2" id="nivelOutro2" onchange="submit();">';
echo '<option value="0"> -- Selecione -- </option>';
echo '<option value="Nenhum" '.($nivelOutro2 == "Nenhum"?'selected="selected"':"").'>Nenhum</option>';
echo '<option value="Básico" '.($nivelOutro2 == "Básico"?'selected="selected"':"").'>Básico</option>';					
echo '<option value="Intermediário" '.($nivelOutro2 == "Técnologo"?'selected="selected"':"").'>Intermediário</option>';
echo '<option value="Avançado" '.($nivelOutro2 == "Avançado"?'selected="selected"':"").'>Avançado</option>';							
echo '<option value="Fluente" '.($nivelOutro2 == "Fluente"?'selected="selected"':"").'>Fluente</option>';	
echo '</select></td>';
echo '</tr>';	
//--------------
echo '</table><br />';
echo '<center>';
echo '<table cellpadding="15">';
echo '<tr><td><input type=Submit value="Salvar" /></form></td>';
echo '<td><form action="principal.php"><input type="submit" value="Voltar"></form></td></tr>';
echo '</table>';
echo '</center>';
echo '<ul class="ajuda"><li>Os campos marcados com asterisco (<font class="erro">*</font>) são obrigatórios!</li></ul>';
//---------------Rodape-------------------
include ("rodape.php"); 
?>