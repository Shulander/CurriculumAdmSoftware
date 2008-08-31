<!-- Cabecalho -->
<?php 
	include ("cabecalho.php");
	include ("menu.php");
	require_once ("utils/sessao.php");	
	restritoUsuario ();	 
	/*-------------Testa variaveis------------------*/
	//testa se a variavel aviso existe
	if(isset($_GET['aviso'])) {
		$aviso = $_GET['aviso'];	
	} else {
		$aviso = "";
	}
	//testa se a variavel pergunta1 existe
	if(isset($_REQUEST['pergunta1'])) {
		$pergunta1 = $_REQUEST['pergunta1'];	
	} else {
		$pergunta1 = "N�o";
	}
	//testa se a variavel pergunta2 existe
	if(isset($_REQUEST['pergunta2'])) {
		$pergunta2 = $_REQUEST['pergunta2'];	
	} else {
		$pergunta2 = "N�o pretendo";
	}
	//testa se a variavel pergunta3 existe
	if(isset($_REQUEST['pergunta3'])) {
		$pergunta3 = $_REQUEST['pergunta3'];	
	} else {
		$pergunta3 = "N�o";
	}
	//testa se a variavel pergunta4 existe
	if(isset($_REQUEST['pergunta4'])) {
		$pergunta4 = $_REQUEST['pergunta4'];	
	} else {
		$pergunta4 = "N�o";
	}	
	//testa se a variavel outro1 existe
	if(isset($_REQUEST['outro1'])) {
		$outro1 = $_REQUEST['outro1'];	
	} else {
		$outro1 = "";
	}	
	//testa se a variavel pergunta5 existe
	if(isset($_REQUEST['pergunta5'])) {
		$pergunta5 = $_REQUEST['pergunta5'];	
	} else {
		$pergunta5 = "";
	}	
	//testa se a variavel outro2 existe
	if(isset($_REQUEST['outro2'])) {
		$outro2 = $_REQUEST['outro2'];	
	} else {
		$outro2 = "";
	}
	//testa se a variavel pergunta6 existe
	if(isset($_REQUEST['pergunta6'])) {
		$pergunta6 = $_REQUEST['pergunta6'];	
	} else {
		$pergunta6 = "";
	}
	//testa se a variavel outro3 existe
	if(isset($_REQUEST['outro3'])) {
		$outro3 = $_REQUEST['outro3'];	
	} else {
		$outro3 = "";
	}		
?>
<!-- Sub-titulo -->
<h3>Dados Adicionais</h3>
<h4>Pesquisa de Imagem</h4>
<?php
if(!empty($aviso)) {
	if ($aviso == "sucesso") {
		echo '<ul class="sucesso"><li>Pessoa cadastrada com sucesso!</li></ul>';
	} else {
		echo '<ul class="erro"><li>'.$aviso.'</li></ul>';	
	}						
}
echo '<form action="dadosAdicionaisBD.php" method="POST">';
//-------------Pergunta 1---------------
echo '<ol class="normal">';
echo '<li>Voc� conhecia a AIESEC antes do processo seletivo?<font class="erro">*</font>';
	echo '<ul class="none">';
	echo '<li><input type="radio" id="pergunta1" name="pergunta1" value="Sim" '.($pergunta1 == "Sim"?'CHECKED"':"").'>Sim</li>';
	echo '<li><input type="radio" id="pergunta1" name="pergunta1" value="N�o" '.($pergunta1 == "N�o"?'CHECKED"':"").'>N�o</li>';
	echo '</ul>';
echo '</li>';
echo '<br/>'; 
//-------------Pergunta 2---------------
echo '<li>Voc� pretende realizar interc�mbio pela AIESEC?<font class="erro">*</font>';
	echo '<ul class="none">';
	echo '<li><input type="radio" id="pergunta2" name="pergunta2" value="Em at� seis meses" '.($pergunta2 == "Em at� seis meses"?'CHECKED"':"").'>Em at� seis meses</li>';
	echo '<li><input type="radio" id="pergunta2" name="pergunta2" value="Em at� 1 ano" '.($pergunta2 == "Em at� 1 ano"?'CHECKED"':"").'>Em at� 1 ano</li>';
	echo '<li><input type="radio" id="pergunta2" name="pergunta2" value="Futuramente" '.($pergunta2 == "Futuramente"?'CHECKED"':"").'>Futuramente</li>';
	echo '<li><input type="radio" id="pergunta2" name="pergunta2" value="N�o pretendo" '.($pergunta2 == "N�o pretendo"?'CHECKED"':"").'>N�o pretendo</li>';
	echo '</ul>';
echo '</li>';
echo '<br/>';
//-------------Pergunta 3---------------
echo '<li>J� teve experi�ncia internacional?<font class="erro">*</font>';
	echo '<ul class="none">';
	echo '<li><input type="radio" id="pergunta3" name="pergunta3" value="Sim" '.($pergunta3 == "Sim"?'CHECKED"':"").'>Sim</li>';
	echo '<li><input type="radio" id="pergunta3" name="pergunta3" value="N�o" '.($pergunta3 == "N�o"?'CHECKED"':"").'>N�o</li>';
	echo '</ul>';
echo '</li>';
echo '<br/>';
//-------------Pergunta 4---------------
echo '<li>Qual?';
	echo '<ul class="none">';
	echo '<li><input type="radio" id="pergunta4" name="pergunta4" value="Interc�mbio" '.($pergunta4 == "Interc�mbio"?'CHECKED"':"").'>Interc�mbio</li>';
	echo '<li><input type="radio" id="pergunta4" name="pergunta4" value="Turismo" '.($pergunta4 == "Turismo"?'CHECKED"':"").'>Turismo</li>';
	echo '<li><input type="radio" id="pergunta4" name="pergunta4" value="J� morei no exterior" '.($pergunta4 == "J� morei no exterior"?'CHECKED"':"").'>J� morei no exterior</li>';
	echo '<li><input type="radio" id="pergunta4" name="pergunta4" value="Outro" '.($pergunta4 == "Outro"?'CHECKED"':"").'>Outro&nbsp;&nbsp;<input type="text" value="'.$outro1.'" id="outro1" name="outro1" size="50" maxlength="50"></li>';
	echo '</ul>';
echo '</li>';
echo '<br/>';
//-------------Pergunta 5---------------
echo '<li>Por que voc� est� se inscrevendo para o processo seletivo da AIESEC?<font class="erro">*</font>';
	echo '<ul class="none">';
	echo '<li><input type="checkbox" id="pergunta5" name="pergunta5" value="Desenvolvimento profissional e pessoal" '.($pergunta5 == "Desenvolvimento profissional e pessoal"?'CHECKED"':"").'>Desenvolvimento pessoal e profissional</li>';
	echo '<li><input type="checkbox" id="pergunta5" name="pergunta5" value="Conhecimento sobre outras culturas" '.($pergunta5 == "Conhecimento sobre outras culturas"?'CHECKED"':"").'>Conhecimento sobre outras culturas</li>';
	echo '<li><input type="checkbox" id="pergunta5" name="pergunta5" value="Interc�mbio profissional" '.($pergunta5 == "Interc�mbio profissional"?'CHECKED"':"").'>Interc�mbio profissional</li>';
	echo '<li><input type="checkbox" id="pergunta5" name="pergunta5" value="Contribuir com o desenvolvimento social" '.($pergunta5 == "Contribuir com o desenvolvimento social"?'CHECKED"':"").'>Contribuir com o desenvolvimento social</li>';
	echo '<li><input type="checkbox" id="pergunta5" name="pergunta5" value="Desenvolvimento de lideran�a" '.($pergunta5 == "Desenvolvimento de lideran�a"?'CHECKED"':"").'>Desenvolvimento de lideran�a</li>';
	echo '<li><input type="checkbox" id="pergunta5" name="pergunta5" value="Contato com pessoas e organiza��es" '.($pergunta5 == "Contato com pessoas e organiza��es"?'CHECKED"':"").'>Contato com pessoas e organiza��es</li>';
	echo '<li><input type="checkbox" id="pergunta5" name="pergunta5" value="Networking profisional" '.($pergunta5 == "Networking profisional"?'CHECKED"':"").'>Networking profisional</li>';		
	echo '<li><input type="checkbox" id="pergunta5" name="pergunta5" value="Outro" '.($pergunta5 == "Outro"?'CHECKED"':"").'>Outro&nbsp;&nbsp;<input type="text" value="'.$outro2.'" id="outro2" name="outro2" size="50" maxlength="50"></li>';
	echo '</ul>';
echo '</li>';
echo '<br/>';
//-------------Pergunta 6---------------
echo '<li>Como ficou sabendo sobre a AIESEC?<font class="erro">*</font>';
	echo '<ul class="none">';
	echo '<li><input type="checkbox" id="pergunta6" name="pergunta6" value="membro_alumnus" '.($pergunta6 == "membro_alumnus"?'CHECKED"':"").'>Recomenda��o de pessoa que faz (ou j� fez) parte da AIESEC</li>';
	echo '<li><input type="checkbox" id="pergunta6" name="pergunta6" value="recomendacao_outros" '.($pergunta6 == "recomendacao_outros"?'CHECKED"':"").'>Recomenda��o de outros</li>';
	echo '<li><input type="checkbox" id="pergunta6" name="pergunta6" value="website" '.($pergunta6 == "website"?'CHECKED"':"").'>Website da AIESEC</li>';
	echo '<li><input type="checkbox" id="pergunta6" name="pergunta6" value="panfleto_flyer" '.($pergunta6 == "panfleto_flyer"?'CHECKED"':"").'>Panfleto/Flyer</li>';
	echo '<li><input type="checkbox" id="pergunta6" name="pergunta6" value="cartaz_poster_painelEletronico" '.($pergunta6 == "cartaz_poster_painelEletronico"?'CHECKED"':"").'>Cartaz/p�ster/Painel Eletr�nico</li>';
	echo '<li><input type="checkbox" id="pergunta6" name="pergunta6" value="faixa_banner" '.($pergunta6 == "faixa_banner"?'CHECKED"':"").'>Faixa/Banners</li>';
	echo '<li><input type="checkbox" id="pergunta6" name="pergunta6" value="newsletter_malaDireta" '.($pergunta6 == "newsletter_malaDireta"?'CHECKED"':"").'>Newsletter/Mala direta</li>';
	echo '<li><input type="checkbox" id="pergunta6" name="pergunta6" value="internet" '.($pergunta6 == "internet"?'CHECKED"':"").'>Internet (google, blogs, websites...)</li>';
	echo '<li><input type="checkbox" id="pergunta6" name="pergunta6" value="evento" '.($pergunta6 == "evento"?'CHECKED"':"").'>Evento promovido pela AIESEC</li>';
	echo '<li><input type="checkbox" id="pergunta6" name="pergunta6" value="TV" '.($pergunta6 == "TV"?'CHECKED"':"").'>Televis�o</li>';
	echo '<li><input type="checkbox" id="pergunta6" name="pergunta6" value="revista" '.($pergunta6 == "revista"?'CHECKED"':"").'>Revista</li>';
	echo '<li><input type="checkbox" id="pergunta6" name="pergunta6" value="jornal" '.($pergunta6 == "jornal"?'CHECKED"':"").'>Jornal</li>';
	echo '<li><input type="checkbox" id="pergunta6" name="pergunta6" value="radio" '.($pergunta6 == "radio"?'CHECKED"':"").'>R�dio</li>';
	echo '<li><input type="checkbox" id="pergunta6" name="pergunta6" value="sala_de_aula" '.($pergunta6 == "sala_de_aula"?'CHECKED"':"").'>Divulga��o em sala de aula</li>';
	echo '<li><input type="checkbox" id="pergunta6" name="pergunta6" value="revista" '.($pergunta6 == "revista"?'CHECKED"':"").'>Revista</li>';		
	echo '<li><input type="checkbox" id="pergunta6" name="pergunta6" value="Outro" '.($pergunta6 == "Outro"?'CHECKED"':"").'>Outro&nbsp;&nbsp;<input type="text" value="'.$outro3.'" id="outro3" name="outro3" size="50" maxlength="50"></li>';
	echo '</ul>';
echo '</li>';
echo '</ol>';
//--------------
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