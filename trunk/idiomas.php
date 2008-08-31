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
echo '<tr><td>Ingl�s: <font class="erro">*</font></td>';
echo '<td><select name="ingles" onchange="submit();">';
echo '<option value="0"> -- Selecione -- </option>';
echo '<option value="Nenhum" '.($ingles == "Nenhum"?'selected="selected"':"").'>Nenhum</option>';	
echo '<option value="B�sico" '.($ingles == "B�sico"?'selected="selected"':"").'>B�sico</option>';					
echo '<option value="Intermedi�rio" '.($ingles == "T�cnologo"?'selected="selected"':"").'>Intermedi�rio</option>';
echo '<option value="Avan�ado" '.($ingles == "Avan�ado"?'selected="selected"':"").'>Avan�ado</option>';							
echo '<option value="Fluente" '.($ingles == "Fluente"?'selected="selected"':"").'>Fluente</option>';	
echo '</select></td></tr>';
//--------Espanhol------------
echo '<tr><td>Espanhol: <font class="erro">*</font></td>';
echo '<td><select name="espanhol" onchange="submit();">';
echo '<option value="0"> -- Selecione -- </option>';
echo '<option value="Nenhum" '.($espanhol == "Nenhum"?'selected="selected"':"").'>Nenhum</option>';
echo '<option value="B�sico" '.($espanhol == "B�sico"?'selected="selected"':"").'>B�sico</option>';					
echo '<option value="Intermedi�rio" '.($espanhol == "T�cnologo"?'selected="selected"':"").'>Intermedi�rio</option>';
echo '<option value="Avan�ado" '.($espanhol == "Avan�ado"?'selected="selected"':"").'>Avan�ado</option>';							
echo '<option value="Fluente" '.($espanhol == "Fluente"?'selected="selected"':"").'>Fluente</option>';	
echo '</select></td></tr>';
//--------Italiano------------
echo '<tr><td>Italiano: <font class="erro">*</font></td>';
echo '<td><select name="italiano" onchange="submit();">';
echo '<option value="0"> -- Selecione -- </option>';
echo '<option value="Nenhum" '.($italiano == "Nenhum"?'selected="selected"':"").'>Nenhum</option>';
echo '<option value="B�sico" '.($italiano == "B�sico"?'selected="selected"':"").'>B�sico</option>';					
echo '<option value="Intermedi�rio" '.($italiano == "T�cnologo"?'selected="selected"':"").'>Intermedi�rio</option>';
echo '<option value="Avan�ado" '.($italiano == "Avan�ado"?'selected="selected"':"").'>Avan�ado</option>';							
echo '<option value="Fluente" '.($italiano == "Fluente"?'selected="selected"':"").'>Fluente</option>';	
echo '</select></td></tr>';
//--------Frances------------
echo '<tr><td>Franc�s: <font class="erro">*</font></td>';
echo '<td><select name="frances" onchange="submit();">';
echo '<option value="0"> -- Selecione -- </option>';
echo '<option value="Nenhum" '.($frances == "Nenhum"?'selected="selected"':"").'>Nenhum</option>';
echo '<option value="B�sico" '.($frances == "B�sico"?'selected="selected"':"").'>B�sico</option>';					
echo '<option value="Intermedi�rio" '.($frances == "T�cnologo"?'selected="selected"':"").'>Intermedi�rio</option>';
echo '<option value="Avan�ado" '.($frances == "Avan�ado"?'selected="selected"':"").'>Avan�ado</option>';							
echo '<option value="Fluente" '.($frances == "Fluente"?'selected="selected"':"").'>Fluente</option>';	
echo '</select></td></tr>';
//--------Alemao------------
echo '<tr><td>Alem�o: <font class="erro">*</font></td>';
echo '<td><select name="alemao" onchange="submit();">';
echo '<option value="0"> -- Selecione -- </option>';
echo '<option value="Nenhum" '.($alemao == "Nenhum"?'selected="selected"':"").'>Nenhum</option>';
echo '<option value="B�sico" '.($alemao == "B�sico"?'selected="selected"':"").'>B�sico</option>';					
echo '<option value="Intermedi�rio" '.($alemao == "T�cnologo"?'selected="selected"':"").'>Intermedi�rio</option>';
echo '<option value="Avan�ado" '.($alemao == "Avan�ado"?'selected="selected"':"").'>Avan�ado</option>';							
echo '<option value="Fluente" '.($alemao == "Fluente"?'selected="selected"':"").'>Fluente</option>';	
echo '</select></td></tr>';
//--------outro1---------------
echo '<tr rowspan="2"><td>Outro: </td>';
echo '<td><input type="text" id="outro1" name="outro1" value="'.$outro1.'" size="15" maxlength="30"></td>';
echo '<td><select name="nivelOutro1" id="nivelOutro1" onchange="submit();">';
echo '<option value="0"> -- Selecione -- </option>';
echo '<option value="Nenhum" '.($nivelOutro1 == "Nenhum"?'selected="selected"':"").'>Nenhum</option>';
echo '<option value="B�sico" '.($nivelOutro1 == "B�sico"?'selected="selected"':"").'>B�sico</option>';					
echo '<option value="Intermedi�rio" '.($nivelOutro1 == "T�cnologo"?'selected="selected"':"").'>Intermedi�rio</option>';
echo '<option value="Avan�ado" '.($nivelOutro1 == "Avan�ado"?'selected="selected"':"").'>Avan�ado</option>';							
echo '<option value="Fluente" '.($nivelOutro1 == "Fluente"?'selected="selected"':"").'>Fluente</option>';	
echo '</select></td>';
echo '</tr>';
//--------outro2---------------
echo '<tr rowspan="2"><td>Outro: </td>';
echo '<td><input type="text" id="outro2" name="outro2" value="'.$outro2.'" size="15" maxlength="30"></td>';
echo '<td><select name="nivelOutro2" id="nivelOutro2" onchange="submit();">';
echo '<option value="0"> -- Selecione -- </option>';
echo '<option value="Nenhum" '.($nivelOutro2 == "Nenhum"?'selected="selected"':"").'>Nenhum</option>';
echo '<option value="B�sico" '.($nivelOutro2 == "B�sico"?'selected="selected"':"").'>B�sico</option>';					
echo '<option value="Intermedi�rio" '.($nivelOutro2 == "T�cnologo"?'selected="selected"':"").'>Intermedi�rio</option>';
echo '<option value="Avan�ado" '.($nivelOutro2 == "Avan�ado"?'selected="selected"':"").'>Avan�ado</option>';							
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
echo '<ul class="ajuda"><li>Os campos marcados com asterisco (<font class="erro">*</font>) s�o obrigat�rios!</li></ul>';
//---------------Rodape-------------------
include ("rodape.php"); 
?>