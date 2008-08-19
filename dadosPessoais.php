<!-- Cabecalho -->
<?php include ("cabecalho.php"); ?>
<div class="container">
<!-- Sub-titulo -->
<h2>Dados Pessoais</h2>
<form action="checaDadosPessoais.php" method="POST">
<table>
<!-- Nome -->
<tr><td>Nome:*</td>
<td><INPUT TYPE=TEXT ID="nome" NAME="nome" size="50" maxlength="50"></td>
</tr>
<!-- Nacionalidade -->
<tr><td>Nacionalidade:</td>
<td><select id="nacionalidade" nome="nacionalidade">
<option value="brasileira">Brasileira</option>
<option value="estrangeira">Estrangeira</option>
</select></td></tr>
<!-- Data de Nascimento -->
<tr><td>Data de Nascimento*:</td>
<td><INPUT TYPE=TEXT ID="dataNascimento" NAME="dataNascimento" size="10" " maxlength="10"></td></tr>
<tr></tr>
<!-- Endereço-->
<tr><th>Endereço</th><td></td></tr>
<tr><td>Logradouro: </td><td><INPUT TYPE=TEXT ID="logradouro" NAME="logradouro" size="50"></td></tr>
<tr><td>Número: </td><td><INPUT TYPE=TEXT ID="numero" NAME="numero" size="20"></td></tr>
<tr><td>Complemento: </td><td><INPUT TYPE=TEXT ID="complemento" NAME="complemento" size="50"></td></tr>
<tr><td>Bairro: </td><td><INPUT TYPE=TEXT ID="bairro" NAME="bairro" size="50"></td></tr>
<tr><td>Cidade: </td><td><INPUT TYPE=TEXT ID="cidade" NAME="cidade" size="50"></td></tr>
<tr><td>Estado: </td>
<td>
<select id="estado" nome="estado">
<option value="0">-- Selecione --</option>
<option value="RS">Rio Grande do Sul</option>
<option value="outro">Outro</option>
</select>
</td></tr>
<!-- Telefone -->
<tr><td>Telefone Residencial:&nbsp;</td><td><INPUT TYPE=TEXT id="telResidencial" NAME="telResidencial" size="20" maxlength="11"></td></tr>
<tr><td>Celular: </td><td><INPUT TYPE=TEXT ID="telCelular" NAME="telCelular" size="20" maxlength="11"></td></tr>
<tr><td>E-mail:*</td><td><INPUT TYPE=TEXT ID="email" NAME="email" size="30"></td></tr>
</table>
<br />
<input type=Submit value="Próxima Página" />
</form>
<br>
</div>
<?php include ("rodape.php"); ?>