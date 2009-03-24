<?php
	require_once ("utils/sessao.php");
	include ("cabecalho.php");
	restritoUsuario ();	
	$idLogin = $_SESSION['idLogin'];
	/*-------------Testa variaveis------------------*/
	//testa se a variavel aviso existe
	if(isset($_GET['aviso'])) {
		$aviso = $_GET['aviso'];	
	} else {
		$aviso = "";
	}
	//testa se a variavel data existe
	if(isset($_REQUEST['data'])) {
		$data = $_REQUEST['data'];	
	} else {
		$data = "";
	}
	//testa se a variavel area existe
	if(isset($_REQUEST['area'])) {
		$area = $_REQUEST['area'];	
	} else {
		$area = "";
	}
	//testa se a variavel tipo existe
	if(isset($_REQUEST['tipo'])) {
		$tipo = $_REQUEST['tipo'];	
	} else {
		$tipo = "";
	}
	//testa se a variavel hora existe
	if(isset($_REQUEST['hora'])) {
		$hora = $_REQUEST['hora'];	
	} else {
		$hora = "";
	}
	echo "<h3>Inserir um novo hor�rio de entrevista</h3>";
	if(!empty($aviso)) {
		if ($aviso == "sucesso") {
			echo '<ul class="sucesso"><li>Hor�rio inserido com sucesso!</li></ul>';		
		} else {
			echo '<ul class="erro"><li>'.$aviso.'</li></ul>';	
		}
	}
	echo '<form action="entrevistaInsereBD.php" method="POST">';
	echo '<table class="tabela">';
	echo '<tr><td><a href="#" class="dica">Data:<span>Esse campo deve ter o formato dd/mm/aaaa!</span></a><font class="erro">*</font>&nbsp;&nbsp;</td>';
	echo '<td><input type="text" value="'.$data.'" readonly id="data" name="data" size="10" maxlength="10">
	<input type="button" value="Calend�rio" onClick=displayCalendar(document.forms[0].data,"dd/mm/yyyy",this)>';
	echo '</td></tr>';
	echo '<tr></tr>';
	echo '<tr><td>Hor�rio:<font class="erro">*</font></td>';
	echo '<td><select id="hora" name="hora">';
	echo '<option value="0"> -- Selecione -- </option>';
	echo '<option value="08:00:00" '.($hora == "08:00:00"?'selected="selected"':"").'>08:00</option>';
	echo '<option value="09:00:00" '.($hora == "09:00:00"?'selected="selected"':"").'>09:00</option>';
	echo '<option value="10:00:00" '.($hora == "10:00:00"?'selected="selected"':"").'>10:00</option>';
	echo '<option value="11:00:00" '.($hora == "11:00:00"?'selected="selected"':"").'>11:00</option>';
	echo '<option value="12:00:00" '.($hora == "12:00:00"?'selected="selected"':"").'>12:00</option>';
	echo '<option value="13:00:00" '.($hora == "13:00:00"?'selected="selected"':"").'>13:00</option>';
	echo '<option value="14:00:00" '.($hora == "14:00:00"?'selected="selected"':"").'>14:00</option>';
	echo '<option value="15:00:00" '.($hora == "15:00:00"?'selected="selected"':"").'>15:00</option>';
	echo '<option value="16:00:00" '.($hora == "16:00:00"?'selected="selected"':"").'>16:00</option>';
	echo '<option value="17:00:00" '.($hora == "17:00:00"?'selected="selected"':"").'>17:00</option>';
	echo '<option value="18:00:00" '.($hora == "18:00:00"?'selected="selected"':"").'>18:00</option>';
	echo '<option value="19:00:00" '.($hora == "19:00:00"?'selected="selected"':"").'>19:00</option>';
	echo '<option value="20:00:00" '.($hora == "20:00:00"?'selected="selected"':"").'>20:00</option>';
	echo '<option value="21:00:00" '.($hora == "21:00:00"?'selected="selected"':"").'>21:00</option>';
	echo '</select></td></tr>';
	echo '<tr><td>�rea:<font class="erro">*</font></td>';
	echo '<td><select id="area" name="area">';
	echo '<option value="0"> -- Selecione -- </option>';
	echo '<option value="Finan�as" '.($area == "Finan�as"?'selected="selected"':"").'>Finan�as</option>';
	echo '<option value="Gest�o da Informa��o" '.($area == "Gest�o da Informa��o"?'selected="selected"':"").'>Gest�o da Informa��o</option>';
	echo '<option value="Gest�o de Talentos" '.($area == "Gest�o de Talentos"?'selected="selected"':"").'>Gest�o de Talentos</option>';
	echo '<option value="Marketing e Comunica��o" '.($area == "Marketing e Comunica��o"?'selected="selected"':"").'>Marketing e Comunica��o</option>';
	echo '<option value="Rela��es Externas" '.($area == "Rela��es Externas"?'selected="selected"':"").'>Rela��es Externas</option>';
	echo '<option value="Administra��o" '.($area == "Administra��o"?'selected="selected"':"").'>Administra��o</option>';
	echo '<option value="Engenharias" '.($area == "Engenharias"?'selected="selected"':"").'>Engenharias</option>';
	echo '<option value="Letras" '.($area == "Letras"?'selected="selected"':"").'>Letras</option>';
	echo '<option value="Sa�de" '.($area == "Sa�de"?'selected="selected"':"").'>Sa�de</option>';
	echo '<option value="TI" '.($area == "TI"?'selected="selected"':"").'>Tecnologia da Informa��o</option>';
	echo '<option value="Indefinida" '.($area == "Indefinida"?'selected="selected"':"").'>Indefinida</option>';
	echo '</select></td></tr>';
	echo '<tr><td>Tipo:<font class="erro">*</font></td>';
	echo '<td><select id="tipo" name="tipo">';
	echo '<option value="0"> -- Selecione -- </option>';
	echo '<option value="intercambista" '.($tipo == "intercambista"?'selected="selected"':"").'>Intercambista</option>';
	echo '<option value="membro" '.($tipo == "membro"?'selected="selected"':"").'>Membro</option>';
	echo '</select></td></tr>';
	echo '</table><br />';
	echo '<center>';
	echo '<table cellpadding="15">';
	echo '<tr><td><input type=Submit value="Salvar" /></form></td>';
	echo '</table>';
	echo "<br/>";
	echo '<center><a href="entrevistas.php">Voltar para a p�gina anterior</a></center>';
	//Rodape
	include ("rodape.php");
?>