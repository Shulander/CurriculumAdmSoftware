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
	if(isset($_REQUEST['outro1Nivel'])) {
		$outro1Nivel = $_REQUEST['outro1Nivel'];	
	} else {
		$outro1Nivel = "";
	}
	//testar se a variavel outro2 existe
	if(isset($_GET['outro2'])) {
		$outro2 = $_GET['outro2'];	
	} else {
		$outro2 = "";
	}
	//testar se a variavel outro2Nivel existe
	if(isset($_GET['outro2Nivel'])) {
		$outro2Nivel = $_GET['outro2Nivel'];	
	} else {
		$outro2Nivel = "";
	}
	//testar se a variavel word existe
	if(isset($_GET['word'])) {
		$word = $_GET['word'];	
	} else {
		$word = "";
	}
	//testar se a variavel excel existe
	if(isset($_GET['excel'])) {
		$excel = $_GET['excel'];	
	} else {
		$excel = "";
	}
	//testar se a variavel powerpoint existe
	if(isset($_GET['powerpoint'])) {
		$powerpoint = $_GET['powerpoint'];	
	} else {
		$powerpoint = "";
	}
?>
<!-- Sub-titulo -->
<h3>Habilidades</h3>
<?php
if(!empty($aviso)) {
	if ($aviso == "sucesso") {
		//echo '<ul class="sucesso"><li>Habilidades cadastradas com sucesso!</li></ul>';
		echo '<SCRIPT language="Javascript">alert("Habilidades cadastradas com sucesso!")</SCRIPT>';
		header ("Location:dadosProfissionais.php");
	} else {
		echo '<ul class="erro"><li>'.$aviso.'</li></ul>';	
	}						
}
echo '<form action="habilidadesBD.php" method="POST">';
echo '<h4>Idiomas</h4>';
echo '<table class="tabela">';
//--------Ingles------------
echo '<tr><td>Ingl�s: <font class="erro">*</font></td>';
echo '<td><select name="ingles" >';
echo '<option value="0"> -- Selecione -- </option>';
echo '<option value="nenhum" '.($ingles == "nenhum"?'selected="selected"':"").'>Nenhum</option>';	
echo '<option value="basico" '.($ingles == "basico"?'selected="selected"':"").'>B�sico</option>';					
echo '<option value="intermediario" '.($ingles == "intermediario"?'selected="selected"':"").'>Intermedi�rio</option>';
echo '<option value="avancado" '.($ingles == "avancado"?'selected="selected"':"").'>Avan�ado</option>';							
echo '<option value="fluente" '.($ingles == "fluente"?'selected="selected"':"").'>Fluente</option>';	
echo '</select></td></tr>';
//--------Espanhol------------
echo '<tr><td>Espanhol: <font class="erro">*</font></td>';
echo '<td><select name="espanhol" >';
echo '<option value="0"> -- Selecione -- </option>';
echo '<option value="nenhum" '.($espanhol == "nenhum"?'selected="selected"':"").'>Nenhum</option>';
echo '<option value="basico" '.($espanhol == "basico"?'selected="selected"':"").'>B�sico</option>';					
echo '<option value="intermediario" '.($espanhol == "intermediario"?'selected="selected"':"").'>Intermedi�rio</option>';
echo '<option value="avancado" '.($espanhol == "avancado"?'selected="selected"':"").'>Avan�ado</option>';							
echo '<option value="fluente" '.($espanhol == "fluente"?'selected="selected"':"").'>Fluente</option>';	
echo '</select></td></tr>';
//--------Italiano------------
echo '<tr><td>Italiano: <font class="erro">*</font></td>';
echo '<td><select name="italiano" >';
echo '<option value="0"> -- Selecione -- </option>';
echo '<option value="nenhum" '.($italiano == "nenhum"?'selected="selected"':"").'>Nenhum</option>';
echo '<option value="basico" '.($italiano == "basico"?'selected="selected"':"").'>B�sico</option>';					
echo '<option value="intermediario" '.($italiano == "intermediario"?'selected="selected"':"").'>Intermedi�rio</option>';
echo '<option value="avancado" '.($italiano == "avancado"?'selected="selected"':"").'>Avan�ado</option>';							
echo '<option value="fluente" '.($italiano == "fluente"?'selected="selected"':"").'>Fluente</option>';	
echo '</select></td></tr>';
//--------Frances------------
echo '<tr><td>Franc�s: <font class="erro">*</font></td>';
echo '<td><select name="frances" >';
echo '<option value="0"> -- Selecione -- </option>';
echo '<option value="nenhum" '.($frances == "nenhum"?'selected="selected"':"").'>Nenhum</option>';
echo '<option value="basico" '.($frances == "basico"?'selected="selected"':"").'>B�sico</option>';					
echo '<option value="intermediario" '.($frances == "intermediario"?'selected="selected"':"").'>Intermedi�rio</option>';
echo '<option value="avancado" '.($frances == "avancado"?'selected="selected"':"").'>Avan�ado</option>';							
echo '<option value="fluente" '.($frances == "fluente"?'selected="selected"':"").'>Fluente</option>';	
echo '</select></td></tr>';
//--------Alemao------------
echo '<tr><td>Alem�o: <font class="erro">*</font></td>';
echo '<td><select name="alemao" >';
echo '<option value="0"> -- Selecione -- </option>';
echo '<option value="nenhum" '.($alemao == "nenhum"?'selected="selected"':"").'>Nenhum</option>';
echo '<option value="basico" '.($alemao == "basico"?'selected="selected"':"").'>B�sico</option>';					
echo '<option value="intermediario" '.($alemao == "intermediario"?'selected="selected"':"").'>Intermedi�rio</option>';
echo '<option value="avancado" '.($alemao == "avancado"?'selected="selected"':"").'>Avan�ado</option>';							
echo '<option value="fluente" '.($alemao == "fluente"?'selected="selected"':"").'>Fluente</option>';	
echo '</select></td></tr>';
//--------outro1---------------
echo '<tr rowspan="2"><td>Outro: </td>';
echo '<td><input type="text" id="outro1" name="outro1" value="'.$outro1.'" size="15" maxlength="30"></td>';
echo '<td><select name="outro1Nivel" id="outro1Nivel" >';
echo '<option value="0"> -- Selecione -- </option>';
echo '<option value="nenhum" '.($outro1Nivel == "nenhum"?'selected="selected"':"").'>Nenhum</option>';
echo '<option value="basico" '.($outro1Nivel == "basico"?'selected="selected"':"").'>B�sico</option>';					
echo '<option value="intermediario" '.($outro1Nivel == "intermediario"?'selected="selected"':"").'>Intermedi�rio</option>';
echo '<option value="avancado" '.($outro1Nivel == "avancado"?'selected="selected"':"").'>Avan�ado</option>';							
echo '<option value="fluente" '.($outro1Nivel == "fluente"?'selected="selected"':"").'>Fluente</option>';	
echo '</select></td>';
echo '</tr>';
//--------outro2---------------
echo '<tr rowspan="2"><td>Outro: </td>';
echo '<td><input type="text" id="outro2" name="outro2" value="'.$outro2.'" size="15" maxlength="30"></td>';
echo '<td><select name="outro2Nivel" id="outro2Nivel" >';
echo '<option value="0"> -- Selecione -- </option>';
echo '<option value="nenhum" '.($outro2Nivel == "nenhum"?'selected="selected"':"").'>Nenhum</option>';
echo '<option value="basico" '.($outro2Nivel == "basico"?'selected="selected"':"").'>B�sico</option>';					
echo '<option value="intermediario" '.($outro2Nivel == "intermediario"?'selected="selected"':"").'>Intermedi�rio</option>';
echo '<option value="avancado" '.($outro2Nivel == "avancado"?'selected="selected"':"").'>Avan�ado</option>';							
echo '<option value="fluente" '.($outro2Nivel == "fluente"?'selected="selected"':"").'>Fluente</option>';	
echo '</select></td>';
echo '</tr>';	
//--------------
echo '</table><br />';
echo '<hr />';
//-------------INFORMATICA----------------------
echo '<h4>Inform�tica</h4>';
echo '<table class="tabela">';
//--------------------Word-----------
echo '<tr><td>Word: <font class="erro">*</font></td>';
echo '<td><select name="word" >';
echo '<option value="0"> -- Selecione -- </option>';
echo '<option value="nenhum" '.($word == "nenhum"?'selected="selected"':"").'>Nenhum</option>';
echo '<option value="basico" '.($word == "basico"?'selected="selected"':"").'>B�sico</option>';					
echo '<option value="intermediario" '.($word == "intermediario"?'selected="selected"':"").'>Intermedi�rio</option>';
echo '<option value="avancado" '.($word == "avancado"?'selected="selected"':"").'>Avan�ado</option>';							
echo '<option value="fluente" '.($word == "fluente"?'selected="selected"':"").'>Fluente</option>';	
echo '</select></td></tr>';
//--------------------Excel-----------
echo '<tr><td>Excel: <font class="erro">*</font></td>';
echo '<td><select name="excel" >';
echo '<option value="0"> -- Selecione -- </option>';
echo '<option value="nenhum" '.($excel == "nenhum"?'selected="selected"':"").'>Nenhum</option>';
echo '<option value="basico" '.($excel == "basico"?'selected="selected"':"").'>B�sico</option>';					
echo '<option value="intermediario" '.($excel == "intermediario"?'selected="selected"':"").'>Intermedi�rio</option>';
echo '<option value="avancado" '.($excel == "avancado"?'selected="selected"':"").'>Avan�ado</option>';							
echo '<option value="fluente" '.($excel == "fluente"?'selected="selected"':"").'>Fluente</option>';	
echo '</select></td></tr>';
//--------------------Powerpoint-----------
echo '<tr><td>Powerpoint: <font class="erro">*</font></td>';
echo '<td><select name="powerpoint" >';
echo '<option value="0"> -- Selecione -- </option>';
echo '<option value="nenhum" '.($powerpoint == "nenhum"?'selected="selected"':"").'>Nenhum</option>';
echo '<option value="basico" '.($powerpoint == "basico"?'selected="selected"':"").'>B�sico</option>';					
echo '<option value="intermediario" '.($powerpoint == "intermediario"?'selected="selected"':"").'>Intermedi�rio</option>';
echo '<option value="avancado" '.($powerpoint == "avancado"?'selected="selected"':"").'>Avan�ado</option>';							
echo '<option value="fluente" '.($powerpoint == "fluente"?'selected="selected"':"").'>Fluente</option>';	
echo '</select></td></tr>';
//--------------
echo '</table><br />';
echo '<hr />';
//-------------Contabilidade----------------------
echo '<h4>Contabilidade</h4>';
echo '<table class="tabela">';
echo '<tr><td><input type="checkbox" id="auditoria" name="contabilidade[]" value="Auditoria">Auditoria </td><td></td></tr>';
echo '<tr><td><input type="checkbox" id="contabilidadeDeCustos" name="contabilidade[]" 
value="Contabilidade de Custos">Contabilidade de Custos </td><td></td></tr>';
echo '<tr><td><input type="checkbox" id="contabilidadeFinanceira" name="contabilidade[]" 
value="Contabilidade Financeira">Contabilidade Financeira </td><td></td></tr>';
echo '<tr><td><input type="checkbox" id="contabilidadeIntrodutoria" name="contabilidade[]" 
value="Contabilidade Introdut�ria">Contabilidade Introdut�ria </td><td></td></tr>';
echo '<tr><td><input type="checkbox" id="contabilidadeGerencial" name="contabilidade[]" 
value="Contabilidade Gerencial">Contabilidade Gerencial </td><td></td></tr>';
echo '</table><br />';
echo '<hr />';
//-------------Administracao----------------------
echo '<h4>Administra��o</h4>';
echo '<table class="tabela">';
echo '<tr><td><input type="checkbox" id="gerenciamentoEventos" name="administracao[]" 
value="Gerenciamento de Eventos">Gerenciamento de Eventos </td><td></td></tr>';
echo '<tr><td><input type="checkbox" id="gerenciamentoIndustrial" name="administracao[]" 
value="Gerenciamento Industrial">Gerenciamento Industrial </td><td></td></tr>';
echo '<tr><td><input type="checkbox" id="gerenciamentoInternacional" name="administracao[]" 
value="Gerenciamento Internacional">Gerenciamento Internacional </td><td></td></tr>';
echo '<tr><td><input type="checkbox" id="introducaoAdm" name="administracao[]" 
value="Introdu��o � Administra��o">Introdu��o � Administra��o </td><td></td></tr>';
echo '</table><br />';
echo '<hr />';
//-------------Economia----------------------
echo '<h4>Economia</h4>';
echo '<table class="tabela">';
echo '<tr><td><input type="checkbox" id="comercioInternacional" name="economia[]" 
value="Com�rcio Internacional + Balan�a de Pagamentos">Com�rcio Internacional + Balan�a de Pagamentos</td><td></td></tr>';
echo '<tr><td><input type="checkbox" id="introducaoEconomia" name="economia[]" 
value="Introdu��o � Economia">Introdu��o � Economia</td><td></td></tr>';
echo '<tr><td><input type="checkbox" id="macroeconomia" name="economia[]" 
value="Macroeconomia">Macroeconomia</td><td></td></tr>';
echo '<tr><td><input type="checkbox" id="microeconomia" name="economia[]" 
value="Microeconomia">Microeconomia</td><td></td></tr>';
echo '<tr><td><input type="checkbox" id="economiaMonetaria" name="economia[]" 
value="Economia Monet�ria + Finan�as P�blicas">Economia Monet�ria + Finan�as P�blicas</td><td></td></tr>';
echo '<tr><td><input type="checkbox" id="estatistica" name="economia[]" 
value="Estat�stica">Estat�stica</td><td></td></tr>';
echo '</table><br />';
echo '<hr />';
//-------------Financas----------------------
echo '<h4>Finan�as</h4>';
echo '<table class="tabela">';
echo '<tr><td><input type="checkbox" id="banking" name="financas[]" 
value="Banking">Banking</td><td></td></tr>';
echo '<tr><td><input type="checkbox" id="planejamentoFinancas" name="financas[]" 
value="Planejamento de Finan�as + Or�amento">Planejamento de Finan�as + Or�amento</td><td></td></tr>';
echo '<tr><td><input type="checkbox" id="gestaoInternacionalFinancas" name="financas[]" 
value="Gest�o Internacional de Finan�as">Gest�o Internacional de Finan�as</td><td></td></tr>';
echo '</table><br />';
/*
<table>
<td><p>
<tr>
<td>
<strong>Finan�as</strong>
</td></tr>

</p></td>
<td><p>
<tr>
<td>
<input type="radio">Banking
</td></tr>
</p></td>
<tr>
<td>
<input type="radio">Planejamento de Finan�as + Or�amento
</td></tr>


</table>

<table>
<td><p>

<tr>
<td>
<strong>Recursos Humanos</strong>
</td></tr>
</p></td>
<td><p>
<tr>
<td>
<input type="radio">Gest�o avan�ada de RH
</td></tr>
</p></td>
<tr>
<td>
<input type="radio">Introdu��o a RH
</td></tr>

<tr>
<td>
<input type="radio">Recrutamento e Aloca��o
</td></tr>


</table>

<table>
<td><p>
<tr>
<td>
<strong>Tecnologia da Informa��o</strong>
</td></tr>
</p></td>
<td><p>

<tr>
<td>
<input type="radio">Gerenciamento de Banco de Dados
</td></tr>
</p></td>
<tr>
<td>
<input type="radio">Gerenciemento de Redes + Tranmiss�o de Dados
</td></tr>

<tr>
<td>
<input type="radio">Desenvolvimento de Software e Programa��o
</td></tr>

<tr>
<td>
<input type="radio">Anal�se e design de sistemas
</td></tr>

<tr>
<td>
<input type="radio">Cria��o e Gerenciamento de p�ginas web
</td></tr>


</table>

<table>
<td><p>
<tr>
<td>

<strong>Marketing</strong>
</td></tr>
</p></td>
<td><p>
<tr>
<td>
<input type="radio">Publicidade + Rela��es P�blicas
</td></tr>
</p></td>
<tr>
<td>
<input type="radio">Importa��o - Exporta��o
</td></tr>

<tr>
<td>

<input type="radio">Planejamento, Desenvolvimento e Controle de Produto
</td></tr>

<tr>
<td>
<input type="radio">Varejo + Marketing de Vendas
</td></tr>


</table>

<table>
<td><p>
<tr>
<td>
<strong>Outros Estudos</strong>

</td></tr>
</p></td>
<td><p>
<tr>
<td>
<input type="radio">Engenharia Qu�mica
</td></tr>
</p></td>
<tr>
<td>
<input type="radio">Engenharia Civil
</td></tr>

<tr>
<td>
<input type="radio">Engenharia El�trica
</td></tr>

<tr>
<td>
<input type="radio">Engenharia Eletr�nica
</td></tr>

<tr>
<td>
<input type="radio">Engenharia Industrial
</td></tr>

<tr>
<td>
<input type="radio">Engenharia Mec�nica
</td></tr>

<tr>

<td>
<input type="radio">Jornalismo
</td></tr>

<tr>
<td>
<input type="radio">Ci�ncia Social
</td></tr>


</table></body></html>

echo '</table><br />';*/
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