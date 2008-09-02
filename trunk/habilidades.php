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
echo '<tr><td>Inglês: <font class="erro">*</font></td>';
echo '<td><select name="ingles" >';
echo '<option value="0"> -- Selecione -- </option>';
echo '<option value="nenhum" '.($ingles == "nenhum"?'selected="selected"':"").'>Nenhum</option>';	
echo '<option value="basico" '.($ingles == "basico"?'selected="selected"':"").'>Básico</option>';					
echo '<option value="intermediario" '.($ingles == "intermediario"?'selected="selected"':"").'>Intermediário</option>';
echo '<option value="avancado" '.($ingles == "avancado"?'selected="selected"':"").'>Avançado</option>';							
echo '<option value="fluente" '.($ingles == "fluente"?'selected="selected"':"").'>Fluente</option>';	
echo '</select></td></tr>';
//--------Espanhol------------
echo '<tr><td>Espanhol: <font class="erro">*</font></td>';
echo '<td><select name="espanhol" >';
echo '<option value="0"> -- Selecione -- </option>';
echo '<option value="nenhum" '.($espanhol == "nenhum"?'selected="selected"':"").'>Nenhum</option>';
echo '<option value="basico" '.($espanhol == "basico"?'selected="selected"':"").'>Básico</option>';					
echo '<option value="intermediario" '.($espanhol == "intermediario"?'selected="selected"':"").'>Intermediário</option>';
echo '<option value="avancado" '.($espanhol == "avancado"?'selected="selected"':"").'>Avançado</option>';							
echo '<option value="fluente" '.($espanhol == "fluente"?'selected="selected"':"").'>Fluente</option>';	
echo '</select></td></tr>';
//--------Italiano------------
echo '<tr><td>Italiano: <font class="erro">*</font></td>';
echo '<td><select name="italiano" >';
echo '<option value="0"> -- Selecione -- </option>';
echo '<option value="nenhum" '.($italiano == "nenhum"?'selected="selected"':"").'>Nenhum</option>';
echo '<option value="basico" '.($italiano == "basico"?'selected="selected"':"").'>Básico</option>';					
echo '<option value="intermediario" '.($italiano == "intermediario"?'selected="selected"':"").'>Intermediário</option>';
echo '<option value="avancado" '.($italiano == "avancado"?'selected="selected"':"").'>Avançado</option>';							
echo '<option value="fluente" '.($italiano == "fluente"?'selected="selected"':"").'>Fluente</option>';	
echo '</select></td></tr>';
//--------Frances------------
echo '<tr><td>Francês: <font class="erro">*</font></td>';
echo '<td><select name="frances" >';
echo '<option value="0"> -- Selecione -- </option>';
echo '<option value="nenhum" '.($frances == "nenhum"?'selected="selected"':"").'>Nenhum</option>';
echo '<option value="basico" '.($frances == "basico"?'selected="selected"':"").'>Básico</option>';					
echo '<option value="intermediario" '.($frances == "intermediario"?'selected="selected"':"").'>Intermediário</option>';
echo '<option value="avancado" '.($frances == "avancado"?'selected="selected"':"").'>Avançado</option>';							
echo '<option value="fluente" '.($frances == "fluente"?'selected="selected"':"").'>Fluente</option>';	
echo '</select></td></tr>';
//--------Alemao------------
echo '<tr><td>Alemão: <font class="erro">*</font></td>';
echo '<td><select name="alemao" >';
echo '<option value="0"> -- Selecione -- </option>';
echo '<option value="nenhum" '.($alemao == "nenhum"?'selected="selected"':"").'>Nenhum</option>';
echo '<option value="basico" '.($alemao == "basico"?'selected="selected"':"").'>Básico</option>';					
echo '<option value="intermediario" '.($alemao == "intermediario"?'selected="selected"':"").'>Intermediário</option>';
echo '<option value="avancado" '.($alemao == "avancado"?'selected="selected"':"").'>Avançado</option>';							
echo '<option value="fluente" '.($alemao == "fluente"?'selected="selected"':"").'>Fluente</option>';	
echo '</select></td></tr>';
//--------outro1---------------
echo '<tr rowspan="2"><td>Outro: </td>';
echo '<td><input type="text" id="outro1" name="outro1" value="'.$outro1.'" size="15" maxlength="30"></td>';
echo '<td><select name="outro1Nivel" id="outro1Nivel" >';
echo '<option value="0"> -- Selecione -- </option>';
echo '<option value="nenhum" '.($outro1Nivel == "nenhum"?'selected="selected"':"").'>Nenhum</option>';
echo '<option value="basico" '.($outro1Nivel == "basico"?'selected="selected"':"").'>Básico</option>';					
echo '<option value="intermediario" '.($outro1Nivel == "intermediario"?'selected="selected"':"").'>Intermediário</option>';
echo '<option value="avancado" '.($outro1Nivel == "avancado"?'selected="selected"':"").'>Avançado</option>';							
echo '<option value="fluente" '.($outro1Nivel == "fluente"?'selected="selected"':"").'>Fluente</option>';	
echo '</select></td>';
echo '</tr>';
//--------outro2---------------
echo '<tr rowspan="2"><td>Outro: </td>';
echo '<td><input type="text" id="outro2" name="outro2" value="'.$outro2.'" size="15" maxlength="30"></td>';
echo '<td><select name="outro2Nivel" id="outro2Nivel" >';
echo '<option value="0"> -- Selecione -- </option>';
echo '<option value="nenhum" '.($outro2Nivel == "nenhum"?'selected="selected"':"").'>Nenhum</option>';
echo '<option value="basico" '.($outro2Nivel == "basico"?'selected="selected"':"").'>Básico</option>';					
echo '<option value="intermediario" '.($outro2Nivel == "intermediario"?'selected="selected"':"").'>Intermediário</option>';
echo '<option value="avancado" '.($outro2Nivel == "avancado"?'selected="selected"':"").'>Avançado</option>';							
echo '<option value="fluente" '.($outro2Nivel == "fluente"?'selected="selected"':"").'>Fluente</option>';	
echo '</select></td>';
echo '</tr>';	
//--------------
echo '</table><br />';
echo '<hr />';
//-------------INFORMATICA----------------------
echo '<h4>Informática</h4>';
echo '<table class="tabela">';
//--------------------Word-----------
echo '<tr><td>Word: <font class="erro">*</font></td>';
echo '<td><select name="word" >';
echo '<option value="0"> -- Selecione -- </option>';
echo '<option value="nenhum" '.($word == "nenhum"?'selected="selected"':"").'>Nenhum</option>';
echo '<option value="basico" '.($word == "basico"?'selected="selected"':"").'>Básico</option>';					
echo '<option value="intermediario" '.($word == "intermediario"?'selected="selected"':"").'>Intermediário</option>';
echo '<option value="avancado" '.($word == "avancado"?'selected="selected"':"").'>Avançado</option>';							
echo '<option value="fluente" '.($word == "fluente"?'selected="selected"':"").'>Fluente</option>';	
echo '</select></td></tr>';
//--------------------Excel-----------
echo '<tr><td>Excel: <font class="erro">*</font></td>';
echo '<td><select name="excel" >';
echo '<option value="0"> -- Selecione -- </option>';
echo '<option value="nenhum" '.($excel == "nenhum"?'selected="selected"':"").'>Nenhum</option>';
echo '<option value="basico" '.($excel == "basico"?'selected="selected"':"").'>Básico</option>';					
echo '<option value="intermediario" '.($excel == "intermediario"?'selected="selected"':"").'>Intermediário</option>';
echo '<option value="avancado" '.($excel == "avancado"?'selected="selected"':"").'>Avançado</option>';							
echo '<option value="fluente" '.($excel == "fluente"?'selected="selected"':"").'>Fluente</option>';	
echo '</select></td></tr>';
//--------------------Powerpoint-----------
echo '<tr><td>Powerpoint: <font class="erro">*</font></td>';
echo '<td><select name="powerpoint" >';
echo '<option value="0"> -- Selecione -- </option>';
echo '<option value="nenhum" '.($powerpoint == "nenhum"?'selected="selected"':"").'>Nenhum</option>';
echo '<option value="basico" '.($powerpoint == "basico"?'selected="selected"':"").'>Básico</option>';					
echo '<option value="intermediario" '.($powerpoint == "intermediario"?'selected="selected"':"").'>Intermediário</option>';
echo '<option value="avancado" '.($powerpoint == "avancado"?'selected="selected"':"").'>Avançado</option>';							
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
value="Contabilidade Introdutória">Contabilidade Introdutória </td><td></td></tr>';
echo '<tr><td><input type="checkbox" id="contabilidadeGerencial" name="contabilidade[]" 
value="Contabilidade Gerencial">Contabilidade Gerencial </td><td></td></tr>';
echo '</table><br />';
echo '<hr />';
//-------------Administracao----------------------
echo '<h4>Administração</h4>';
echo '<table class="tabela">';
echo '<tr><td><input type="checkbox" id="gerenciamentoEventos" name="administracao[]" 
value="Gerenciamento de Eventos">Gerenciamento de Eventos </td><td></td></tr>';
echo '<tr><td><input type="checkbox" id="gerenciamentoIndustrial" name="administracao[]" 
value="Gerenciamento Industrial">Gerenciamento Industrial </td><td></td></tr>';
echo '<tr><td><input type="checkbox" id="gerenciamentoInternacional" name="administracao[]" 
value="Gerenciamento Internacional">Gerenciamento Internacional </td><td></td></tr>';
echo '<tr><td><input type="checkbox" id="introducaoAdm" name="administracao[]" 
value="Introdução à Administração">Introdução à Administração </td><td></td></tr>';
echo '</table><br />';
echo '<hr />';
//-------------Economia----------------------
echo '<h4>Economia</h4>';
echo '<table class="tabela">';
echo '<tr><td><input type="checkbox" id="comercioInternacional" name="economia[]" 
value="Comércio Internacional + Balança de Pagamentos">Comércio Internacional + Balança de Pagamentos</td><td></td></tr>';
echo '<tr><td><input type="checkbox" id="introducaoEconomia" name="economia[]" 
value="Introdução à Economia">Introdução à Economia</td><td></td></tr>';
echo '<tr><td><input type="checkbox" id="macroeconomia" name="economia[]" 
value="Macroeconomia">Macroeconomia</td><td></td></tr>';
echo '<tr><td><input type="checkbox" id="microeconomia" name="economia[]" 
value="Microeconomia">Microeconomia</td><td></td></tr>';
echo '<tr><td><input type="checkbox" id="economiaMonetaria" name="economia[]" 
value="Economia Monetária + Finanças Públicas">Economia Monetária + Finanças Públicas</td><td></td></tr>';
echo '<tr><td><input type="checkbox" id="estatistica" name="economia[]" 
value="Estatística">Estatística</td><td></td></tr>';
echo '</table><br />';
echo '<hr />';
//-------------Financas----------------------
echo '<h4>Finanças</h4>';
echo '<table class="tabela">';
echo '<tr><td><input type="checkbox" id="banking" name="financas[]" 
value="Banking">Banking</td><td></td></tr>';
echo '<tr><td><input type="checkbox" id="planejamentoFinancas" name="financas[]" 
value="Planejamento de Finanças + Orçamento">Planejamento de Finanças + Orçamento</td><td></td></tr>';
echo '<tr><td><input type="checkbox" id="gestaoInternacionalFinancas" name="financas[]" 
value="Gestão Internacional de Finanças">Gestão Internacional de Finanças</td><td></td></tr>';
echo '</table><br />';
/*
<table>
<td><p>
<tr>
<td>
<strong>Finanças</strong>
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
<input type="radio">Planejamento de Finanças + Orçamento
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
<input type="radio">Gestão avançada de RH
</td></tr>
</p></td>
<tr>
<td>
<input type="radio">Introdução a RH
</td></tr>

<tr>
<td>
<input type="radio">Recrutamento e Alocação
</td></tr>


</table>

<table>
<td><p>
<tr>
<td>
<strong>Tecnologia da Informação</strong>
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
<input type="radio">Gerenciemento de Redes + Tranmissão de Dados
</td></tr>

<tr>
<td>
<input type="radio">Desenvolvimento de Software e Programação
</td></tr>

<tr>
<td>
<input type="radio">Analíse e design de sistemas
</td></tr>

<tr>
<td>
<input type="radio">Criação e Gerenciamento de páginas web
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
<input type="radio">Publicidade + Relações Públicas
</td></tr>
</p></td>
<tr>
<td>
<input type="radio">Importação - Exportação
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
<input type="radio">Engenharia Química
</td></tr>
</p></td>
<tr>
<td>
<input type="radio">Engenharia Civil
</td></tr>

<tr>
<td>
<input type="radio">Engenharia Elétrica
</td></tr>

<tr>
<td>
<input type="radio">Engenharia Eletrônica
</td></tr>

<tr>
<td>
<input type="radio">Engenharia Industrial
</td></tr>

<tr>
<td>
<input type="radio">Engenharia Mecânica
</td></tr>

<tr>

<td>
<input type="radio">Jornalismo
</td></tr>

<tr>
<td>
<input type="radio">Ciência Social
</td></tr>


</table></body></html>

echo '</table><br />';*/
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