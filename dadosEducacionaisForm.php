<?php
echo '<form action="'.$pagina.'" method="POST" onsubmit="return verificaFormDadosEducacionais($(\'curso\'),
 $(\'tipo\'), $(\'instituicao\'), $(\'dataIngresso\'));">';
echo '<table class="tabela">';
//--------Curso---------------
echo '<tr><td>Curso:<font class="erro">*</font> </td>';
echo '<td><input type="text" id="curso" name="curso" value="'.$curso.'" size="37" maxlength="50"></td></tr>';
//--------Tipo---------------
echo '<tr><td>Tipo: <font class="erro">*</font></td>';
echo '<td><select name="tipo">';
echo '<option value="0"> -- Selecione o tipo do curso -- </option>';
echo '<option value="técnico" '.($tipo == "técnico"?'selected="selected"':"").'>Técnico</option>';					
echo '<option value="técnologo" '.($tipo == "técnologo"?'selected="selected"':"").'>Tecnólogo</option>';
echo '<option value="graduação" '.($tipo == "graduação"?'selected="selected"':"").'>Graduação</option>';							
echo '<option value="especialização" '.($tipo == "especialização"?'selected="selected"':"").'>Especialização</option>';
echo '<option value="mestrado" '.($tipo == "mestrado"?'selected="selected"':"").'>Mestrado</option>';
echo '<option value="mba" '.($tipo == "mba"?'selected="selected"':"").'>Master Business Administration (MBA)</option>';
echo '<option value="doutorado" '.($tipo == "doutorado"?'selected="selected"':"").'>Doutorado</option>';
echo '<option value="phd" '.($tipo == "phd"?'selected="selected"':"").'>Pós-doutorado (PhD)</option>';	
echo '</select></td></tr>';
//--------instituicao---------------
echo '<tr><td>Instituição: <font class="erro">*</font></td>';
echo '<td><select id="instituicao" name="instituicao" onchange="
if(this.options[this.selectedIndex].value==\'outra\') { 
	blocoAbre($(\'blocoOutra\')); 
} else { blocoFecha($(\'blocoOutra\')); }
">';
echo '<option value="0"> -- Selecione -- </option>';
/*echo '<option value="0"> -- Selecione -- </option>';
if($instituicao == "FADISMA") {
	echo '<option value="FADISMA" selected="selected">FADISMA</option>';
	echo '<select name="curso_">';
	echo '<option value="0"> -- Selecione o curso -- </option>';
	echo '<option value="Direito" '.($curso_ == "Direito"?'selected="selected"':"").'>Direito</option>';
	echo '</select>';	
} else {
	echo '<option value="FADISMA">FADISMA</option>';	
} */

echo '<option value="FADISMA" '.($instituicao == "FADISMA"?'selected="selected"':"").'>FADISMA</option>';
echo '<option value="FAMES" '.($instituicao == "FAMES"?'selected="selected"':"").'>FAMES Santa Maria</option>';
echo '<option value="FAPAS" '.($instituicao == "FAPAS"?'selected="selected"':"").'>FAPAS</option>';
echo '<option value="FASCLA" '.($instituicao == "FASCLA"?'selected="selected"':"").'>FASCLA</option>';
echo '<option value="UFSM" '.($instituicao == "UFSM"?'selected="selected"':"").'>UFSM</option>';
echo '<option value="ULBRA" '.($instituicao == "ULBRA"?'selected="selected"':"").'>ULBRA Santa Maria</option>';
echo '<option value="UNIFRA" '.($instituicao == "UNIFRA"?'selected="selected"':"").'>UNIFRA</option>';
echo '<option value="outra" '.($instituicao == "outra"?'selected="selected"':"").'>Outra</option>';
echo '</select><span id="blocoOutra" '.($instituicao == "outra"?'':'style="display:none"').'>
&nbsp;&nbsp;<input type="text" name="instituicaoOutra" id="instituicaoOutra" 
value="'.$instituicaoOutra.'" size="30" maxlength="50"/></span></td></tr>';
echo '</td></tr>';
//--------Turno---------------
echo '<tr><td>Turno: </td>';
echo '<td><select name="turno" onchange="submit();">';
echo '<option value="0"> -- Selecione -- </option>';
echo '<option value="matutino" '.($turno == "matutino"?'selected="selected"':"").'>Matutino</option>';					
echo '<option value="vespertino" '.($turno == "vespertino"?'selected="selected"':"").'>Vespertino</option>';
echo '<option value="noturno" '.($turno == "noturno"?'selected="selected"':"").'>Noturno</option>';							
echo '<option value="integral" '.($turno == "integral"?'selected="selected"':"").'>Integral</option>';	
echo '</select></td></tr>';
//--------Semestre---------------
echo '<tr><td>Semestre:</td>';
echo '<td><input type="text" id="semestre" name="semestre" value="'.$semestre.'" size="2" maxlength="2"></td></tr>';
//--------Data de Ingresso---------------
echo '<tr><td><a href="#" class="dica">Data de Ingresso:<span>Esse campo deve ter o formato dd/mm/aaaa!</span></a><font class="erro">*</font> </td>';
echo '<td><input type="text" value="'.$dataIngresso.'" readonly id="dataIngresso" name="dataIngresso" size="10" maxlength="10">
<input type="button" value="Calendário" onClick=displayCalendar(document.forms[0].dataIngresso,"dd/mm/yyyy",this)>';
echo '</td></tr>';
echo '<tr></tr>';				
//-------Data de conclusao-----------
echo '<tr><td><a href="#" class="dica">Data de Conclusão: <span>Esse campo deve ter o formato dd/mm/aaaa! Pode ser uma previsão caso você ainda não tenha concluido.</span></a><font class="erro">*</font> </td>';
echo '<td><input type="text" readonly value="'.$dataConclusao.'" id="dataConclusao" name="dataConclusao" size="10" maxlength="10">
<input type="button" value="Calendário" onClick=displayCalendar(document.forms[0].dataConclusao,"dd/mm/yyyy",this)>';
echo '</td></tr>';	
//--------------
echo '</table><br />';
echo '<center>';
echo '<input type=Submit value="Salvar" /></form>';
echo '</center>';
echo '<ul class="ajuda"><li>Os campos marcados com asterisco (<font class="erro">*</font>) são obrigatórios!</li></ul>';
echo '<br />';
?>