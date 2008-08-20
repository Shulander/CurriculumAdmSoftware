<!-- Cabecalho -->
<?php include ("cabecalho.php"); ?>
<!--  Testa variaveis -->
<?php
	//testa se a variavel aviso existe
	if(isset($_GET['aviso'])) {
		$aviso = $_GET['aviso'];	
	} else {
		$aviso = "";
	}
	//testa se a variavel nome existe
	if(isset($_REQUEST['nome'])) {
		$nome = $_REQUEST['nome'];	
	} else {
		$nome = "";
	}
	//testa se a variavel nacionalidade existe
	if(isset($_REQUEST['nacionalidade'])) {
		$nacionalidade = $_REQUEST['nacionalidade'];	
	} else {
		$nacionalidade = "";
	}
	//testa se a variavel nacionalidade existe
	if(isset($_REQUEST['nacionalidadeEstrangeira'])) {
		$nacionalidadeEstrangeira = $_REQUEST['nacionalidadeEstrangeira'];	
	} else {
		$nacionalidadeEstrangeira = "";
	}
	//testa se a variavel dataNascimento existe
	if(isset($_REQUEST['dataNascimento'])) {
		$dataNascimento = $_REQUEST['dataNascimento'];	
	} else {
		$dataNascimento = "dd/mm/aaaa";
	}
?>
<!-- Sub-titulo -->
<h2>Dados Pessoais</h2>
<?php
echo '<form action="checaDadosPessoais.php" method="POST">';
echo '<table>';
//--------Nome---------------
echo '<tr><td>Nome:<font class="erro">*</font> </td>';
echo '<td><INPUT TYPE=TEXT ID="nome" NAME="nome" value="'.$nome.'" size="50" maxlength="50"></td></tr>';
//-------Nacionalidade--------
echo '<tr><td>Nacionalidade:<font class="erro">*</font></td>';
echo '<td><select id="nacionalidade" name="nacionalidade"  onchange="if(this.options[this.selectedIndex].value==\'estrangeira\') { blocoAbre($(\'blocoEstrangeira\')); } else { blocoFecha($(\'blocoEstrangeira\')); }">';
echo '<option value="0"> -- Selecione -- </option>';
echo '<option value="brasileira" '.($nacionalidade == "brasileira"?'selected="selected"':"").'>Brasileira</option>';
echo '<option value="estrangeira" '.($nacionalidade == "estrangeira"?'selected="selected"':"").'>Estrangeira</option>';
echo '</select><span id="blocoEstrangeira" '.($nacionalidade == "estrangeira"?'':'style="display:none"').'>&nbsp;&nbsp;&nbsp;<input type="text" name="nacionalidadeEstrangeira" id="nacionalidadeEntrangeira" value="'.$nacionalidadeEstrangeira.'" size="30" maxlength="30"/></span></td></tr>';
//----------Data de Nacimento---------
echo '<tr><td><a href="#" class="dica">Data de Nascimento:<span>Esse campo deve ter o formato dd/mm/aaaa!</span></a><font class="erro">*</font>&nbsp;&nbsp;</td>';
echo '<td><input type="text" name="dataNascimento" id="dataNascimento" value="'.$dataNascimento.'" size="10" maxlength="10" value="dd/mm/aaaa" onfocus="if($(\'dataNascimento\').value==\'dd/mm/aaaa\') { $(\'dataNascimento\').value=\'\'; }"/></td></tr>';
echo '<tr></tr>';
?>
<!-- Endereço-->
<tr><th>Endereço</th><td></td></tr>
<tr><td>Logradouro:<font class="erro">*</font> </td><td><INPUT TYPE=TEXT ID="logradouro" NAME="logradouro" size="50"></td></tr>
<tr><td><a href="#" class="dica">Número: <span>Esse campo só aceita valores numéricos!</span></a><font class="erro">*</font></td><td><INPUT TYPE=TEXT ID="numero" NAME="numero" size="20"></td></tr>
<tr><td>Complemento: </td><td><INPUT TYPE=TEXT ID="complemento" NAME="complemento" size="50"></td></tr>
<tr><td>Bairro: </td><td><INPUT TYPE=TEXT ID="bairro" NAME="bairro" size="50"></td></tr>
<tr><td>Cidade: <font class="erro">*</font></td><td><INPUT TYPE=TEXT ID="cidade" NAME="cidade" size="50"></td></tr>
<tr><td>Estado: <font class="erro">*</font></td>
<td>
<select id="estado" nome="estado">
<option value="0">-- Selecione --</option>
<option value="RS">Rio Grande do Sul</option>
<option value="outro">Outro</option>
</select>
</td></tr>
<!-- Telefone -->
<tr><td><a href="#" class="dica">Telefone Residencial:<span>Esse campo deve ter o formato (prefixo)dddd-dddd, onde prefixo é o número do prefixo e d é um dígito(número)!</span></a></td><td><INPUT TYPE=TEXT id="telResidencial" NAME="telResidencial" size="20" maxlength="11"></td></tr>
<tr><td><a href="#" class="dica">Celular: <span>Esse campo deve ter o formato (prefixo)dddd-dddd, onde prefixo é o número do prefixo e d é um dígito(número)!</span></a><font class="erro">*</font></td><td><INPUT TYPE=TEXT ID="telCelular" NAME="telCelular" size="20" maxlength="11"></td></tr>
<tr><td>E-mail: <font class="erro">*</font></td><td><INPUT TYPE=TEXT ID="email" NAME="email" size="30"></td></tr>
</table>
<br />
<input type=Submit value="Próxima Página" />
<br />
<ul class="ajuda">
	<li>Os campos marcados com asterisco (<font class="erro">*</font>) são obrigatórios!</li>
</ul>
</form>
<?php include ("rodape.php"); ?>