<?php
echo '<form action="'.$pagina.'" method="POST" 
onsubmit="return verificaFormDadosPessoais($(\'nome\'), $(\'nacionalidade\'), $(\'nacionalidadeEstrangeira\'), 
$(\'dataNascimento\'), $(\'sexo\'), $(\'estadoCivil\'), $(\'endereco\'), $(\'numero\'), $(\'cep\'), $(\'cidade\'), 
$(\'cidadeOutra\'), $(\'estado\'), $(\'estadoOutro\'), $(\'celular\'));">';
echo '<table class="tabela">';
//-------------Nome---------------
echo '<tr><td>Nome:<font class="erro">*</font></td>';
echo '<td><input type="text" id="nome" name="nome" value="'.$nome.'" size="50" maxlength="50"></td></tr>';
//-------------Nacionalidade-------
echo '<tr><td>Nacionalidade:<font class="erro">*</font></td>';
echo '<td><select id="nacionalidade" name="nacionalidade" onchange="
if(this.options[this.selectedIndex].value==\'Estrangeira\') { 
	blocoAbre($(\'blocoEstrangeira\')); 
} else { blocoFecha($(\'blocoEstrangeira\')); }
">';
echo '<option value="0"> -- Selecione -- </option>';
echo '<option value="Brasileira" '.($nacionalidade == "Brasileira"?'selected="selected"':"").'>
Brasileira</option>';
echo '<option value="Estrangeira" '.($nacionalidade == "Estrangeira"?'selected="selected"':"").'>
Estrangeira</option>';
echo '</select><span id="blocoEstrangeira" '.($nacionalidade == "Estrangeira"?'':'style="display:none"').'>
&nbsp;&nbsp;&nbsp;<input type="text" name="nacionalidadeEstrangeira" id="nacionalidadeEstrangeira" 
value="'.$nacionalidadeEstrangeira.'" size="30" maxlength="30"/></span></td></tr>';
//----------Data de Nascimento---------
echo '<tr><td><a href="#" class="dica">Data de Nascimento:<span>Esse campo deve ter o formato dd/mm/aaaa!</span>
</a><font class="erro">*</font>&nbsp;&nbsp;</td>';
echo '<td><input type="text" value="'.$dataNascimento.'" readonly id="dataNascimento" name="dataNascimento" size="10" maxlength="10">
<input type="button" value="Calendário" onClick=displayCalendar(document.forms[0].dataNascimento,"dd/mm/yyyy",this)>';
echo '</td></tr>';
echo '<tr></tr>';
//----------Sexo----------------------
echo '<tr><td>Sexo:<font class="erro">*</font></td>';
echo '<td><select id="sexo" name="sexo">';
echo '<option value="0"> -- Selecione -- </option>';
echo '<option value="Feminino" '.($sexo == "Feminino"?'selected="selected"':"").'>Feminino</option>';
echo '<option value="Masculino" '.($sexo == "Masculino"?'selected="selected"':"").'>Masculino</option>';
echo '</select></td></tr>';
//----------Estado civil----------------------
echo '<tr><td>Estado civil:<font class="erro">*</font></td>';
echo '<td><select id="estadoCivil" name="estadoCivil">';
echo '<option value="0"> -- Selecione -- </option>';
echo '<option value="Solteiro" '.($estadoCivil == "Solteiro"?'selected="selected"':"").'>Solteiro</option>';
echo '<option value="Casado" '.($estadoCivil == "Casado"?'selected="selected"':"").'>Casado</option>';
echo '<option value="Viúvo" '.($estadoCivil == "Viúvo"?'selected="selected"':"").'>Viúvo</option>';
echo '<option value="Separado" '.($estadoCivil == "Separado"?'selected="selected"':"").'>Separado</option>';
echo '<option value="Divorciado" '.($estadoCivil == "Divorciado"?'selected="selected"':"").'>Divorciado</option>';
echo '</select></td></tr>';
//----------Endereco-------------------
echo '<tr><td>Endereço:<font class="erro">*</font></td>';
echo '<td><input type="text" id="endereco" name="endereco" value="'.$endereco.'" size="50" maxlength="50"></td></tr>';
//Numero
echo '<tr><td><a href="#" class="dica">Número: <span>Esse campo só aceita valores numéricos!</span></a>
<font class="erro">*</font></td>';
echo '<td><input type="text" id="numero" name="numero" value="'.$numero.'" size="10" maxlength="10"></td></tr>';
//Complemento
echo '<tr><td>Complemento: </td><td><input type="text" id="complemento" value="'.$complemento.'" 
name="complemento" size="50" maxlength="50"></td></tr>';
//Bairro
echo '<tr><td>Bairro: </td><td><input type="text" id="bairro" value="'.$bairro.'" name="bairro" size="50" maxlength="50"></td></tr>';
//Cep
echo '<tr><td><a href="#" class="dica">CEP: <span>Esse campo só aceita valores numéricos!</span></a>
<font class="erro">*</font></td><td><input type="text" id="cep" value="'.$cep.'" name="cep" size="8" maxlenght="8"></td></tr>';
//--------------------------Cidade------------------------------
echo '<tr><td>Cidade: <font class="erro">*</font></td>';
echo '<td><select id="cidade" name="cidade" onchange="
if(this.options[this.selectedIndex].value==\'Outra\') { 
	blocoAbre($(\'blocoOutra\')); 
} else { blocoFecha($(\'blocoOutra\')); }
">';
echo '<option value="Santa Maria" '.($cidade == "Santa Maria"?'selected="selected"':"").'>Santa Maria</option>';
echo '<option value="Outra" '.($cidade == "Outra"?'selected="selected"':"").'>Outra</option>';
echo '</select><span id="blocoOutra" '.($cidade == "Outra"?'':'style="display:none"').'>
&nbsp;&nbsp;<input type="text" name="cidadeOutra" id="cidadeOutra" 
value="'.$cidadeOutra.'" size="30" maxlength="30"/></span></td></tr>';
echo '</td></tr>';
//------------------------Estado---------------------------------
echo '<tr><td>Estado: <font class="erro">*</font></td>';
echo '<td><select id="estado" name="estado" onchange="
if(this.options[this.selectedIndex].value==\'Outro\') { 
	blocoAbre($(\'blocoOutro\')); 
} else { blocoFecha($(\'blocoOutro\')); }
">';
echo '<option value="RS" '.($estado == "RS"?'selected="selected"':"").'>Rio Grande do Sul</option>
<option value="Outro" '.($estado == "Outro"?'selected="selected"':"").'>Outro</option>
</select><span id="blocoOutro" '.($estado == "Outro"?'':'style="display:none"').'>
<input type="text" name="estadoOutro" id="estadoOutro" 
value="'.$estadoOutro.'" size="27" maxlength="50"/></span></td></tr>';
//---------------------Telefone Residencial-------------------------
echo '<tr><td><a href="#" class="dica">Telefone Residencial:<span>Esse campo deve ter o formato(prefixo) 
dddd-dddd, onde prefixo é o número do prefixo e d é um dígito(número)!</span></a></td>';
echo '<td><input type="text" id="telResidencial" value="'.$telResidencial.'" NAME="telResidencial" 
size="20" maxlength="16"></td></tr>';
//Celular
echo '<tr><td><a href="#" class="dica">Celular: <span>Esse campo deve ter o formato (prefixo)dddd-dddd, 
onde prefixo é o número do prefixo e d é um dígito(número)!</span></a><font class="erro">*</font></td>';
echo '<td><input type="text" id="celular" name="celular" value="'.$celular.'" size="20" 
maxlength="16"></td></tr>';
//--------------
echo '</table><br />';
echo '<center>';
echo '<table cellpadding="15">';
echo '<tr><td><input type=Submit value="Salvar" /></form></td>';
echo '<td><form action="principal.php"><input type="submit" value="Voltar"></form></td></tr>';
echo '</table>';
echo '</center>';
echo '<ul class="ajuda"><li>Os campos marcados com asterisco (<font class="erro">*</font>) são obrigatórios!</li></ul>';
?>