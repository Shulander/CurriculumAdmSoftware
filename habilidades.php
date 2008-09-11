<?php 
	require_once ("utils/sessao.php");
	include ("cabecalho.php");
	include ("menu.php");
	require_once ("utils/BancoDados.php");
	require_once ("classes/Pessoa.php");
	restritoUsuario ();
	$idLogin = $_SESSION['idLogin'];
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
	//testar se a variavel office existe
	if(isset($_GET['office'])) {
		$office = $_GET['office'];	
	} else {
		$office = "";
	}
	//testar se a variavel webdesign existe
	if(isset($_GET['webdesign'])) {
		$webdesign = $_GET['webdesign'];	
	} else {
		$webdesign = "";
	}
	//testar se a variavel powerpoint existe
	if(isset($_GET['powerpoint'])) {
		$powerpoint = $_GET['powerpoint'];	
	} else {
		$powerpoint = "";
	}
	//testa se a variavel contabilidade existe
	if(isset($_REQUEST['contabilidade'])) {
		$contabilidade = unserialize($_REQUEST['contabilidade']);	
	} else {
		$contabilidade = array();	
	}
	//testa se a variavel administracao existe
	if(isset($_REQUEST['administracao'])) {
		$administracao = unserialize($_REQUEST['administracao']);	
	} else {
		$administracao = array();	
	}
	//testa se a variavel economia existe
	if(isset($_REQUEST['economia'])) {
		$economia = unserialize($_REQUEST['economia']);	
	} else {
		$economia = array();	
	}
	//testa se a variavel financas existe
	if(isset($_REQUEST['financas'])) {
		$financas = unserialize($_REQUEST['financas']);	
	} else {
		$financas = array();	
	}
	//testa se a variavel recursosHumanos existe
	if(isset($_REQUEST['recursosHumanos'])) {
		$recursosHumanos = unserialize($_REQUEST['recursosHumanos']);	
	} else {
		$recursosHumanos = array();	
	}
	//testa se a variavel tecnologiaInformacao existe
	if(isset($_REQUEST['tecnologiaInformacao'])) {
		$tecnologiaInformacao = unserialize($_REQUEST['tecnologiaInformacao']);	
	} else {
		$tecnologiaInformacao = array();	
	}
	//testa se a variavel marketing existe
	if(isset($_REQUEST['marketing'])) {
		$marketing = unserialize($_REQUEST['marketing']);	
	} else {
		$marketing = array();	
	}
	//testa se a variavel outrosEstudos existe
	if(isset($_REQUEST['outrosEstudos'])) {
		$outrosEstudos = unserialize($_REQUEST['outrosEstudos']);	
	} else {
		$outrosEstudos = array();	
	}		
?>
<!-- Sub-titulo -->
<h3>Habilidades</h3>
<?php
	if(!empty($aviso)) {
		echo '<ul class="erro"><li>'.$aviso.'</li></ul>';							
	}
	$conexaoBD = new BancoDados ();
	if (!$conexaoBD->conecta()) {
		echo '<ul class="erro"><li>Erro de sistema! Contate o administrador do sistema!</li></ul>';
	} else {
		if (isset($idLogin)) {
			$pessoa = new Pessoa ($idLogin, "", "", "", "", "", "", "", "", "", "", "", "", "", "", 0, $conexaoBD); 
			$resultado = $pessoa->buscaPorIdUsuario ();
			if ($resultado == true) { //se pessoa foi cadastrada
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
				//--------------------office-----------
				echo '<tr><td>Pacote Office: <font class="erro">*</font></td>';
				echo '<td><select name="office" >';
				echo '<option value="0"> -- Selecione -- </option>';
				echo '<option value="nenhum" '.($office == "nenhum"?'selected="selected"':"").'>Nenhum</option>';
				echo '<option value="basico" '.($office == "basico"?'selected="selected"':"").'>B�sico</option>';					
				echo '<option value="intermediario" '.($office == "intermediario"?'selected="selected"':"").'>Intermedi�rio</option>';
				echo '<option value="avancado" '.($office == "avancado"?'selected="selected"':"").'>Avan�ado</option>';							
				echo '<option value="expert" '.($office == "expert"?'selected="selected"':"").'>Expert</option>';	
				echo '</select></td></tr>';
				//--------------------webdesign-----------
				echo '<tr><td>Webdesign: <font class="erro">*</font></td>';
				echo '<td><select name="webdesign" >';
				echo '<option value="0"> -- Selecione -- </option>';
				echo '<option value="nenhum" '.($webdesign == "nenhum"?'selected="selected"':"").'>Nenhum</option>';
				echo '<option value="basico" '.($webdesign == "basico"?'selected="selected"':"").'>B�sico</option>';					
				echo '<option value="intermediario" '.($webdesign == "intermediario"?'selected="selected"':"").'>Intermedi�rio</option>';
				echo '<option value="avancado" '.($webdesign == "avancado"?'selected="selected"':"").'>Avan�ado</option>';							
				echo '<option value="expert" '.($webdesign == "expert"?'selected="selected"':"").'>Expert</option>';	
				echo '</select></td></tr>';
				//--------------------editorImagem-----------
				echo '<tr><td>Editores de Imagem: <font class="erro">*</font></td>';
				echo '<td><select name="editorImagem" >';
				echo '<option value="0"> -- Selecione -- </option>';
				echo '<option value="nenhum" '.($editorImagem == "nenhum"?'selected="selected"':"").'>Nenhum</option>';
				echo '<option value="basico" '.($editorImagem == "basico"?'selected="selected"':"").'>B�sico</option>';					
				echo '<option value="intermediario" '.($editorImagem == "intermediario"?'selected="selected"':"").'>Intermedi�rio</option>';
				echo '<option value="avancado" '.($editorImagem == "avancado"?'selected="selected"':"").'>Avan�ado</option>';							
				echo '<option value="expert" '.($editorImagem == "expert"?'selected="selected"':"").'>Expert</option>';	
				echo '</select></td></tr>';
				//--------------
				echo '</table><br />';
				echo '<hr />';
				//-------------contabilidade----------------------
				echo '<h4>Contabilidade</h4>';
				echo '<table class="tabela">';
				echo '<tr><td><input type="checkbox" id="auditoria" name="contabilidade[]" value="Auditoria" '.(isset($contabilidade["Auditoria"])?'CHECKED="CHECKED"':"").'>Auditoria </td><td></td></tr>';
				echo '<tr><td><input type="checkbox" id="contabilidadeDeCustos" name="contabilidade[]" 
				value="Contabilidade de Custos" '.(isset($contabilidade["Contabilidade de Custos"])?'CHECKED="CHECKED"':"").'>Contabilidade de Custos </td><td></td></tr>';
				echo '<tr><td><input type="checkbox" id="contabilidadeFinanceira" name="contabilidade[]" 
				value="Contabilidade Financeira" '.(isset($contabilidade["Contabilidade Financeira"])?'CHECKED="CHECKED"':"").'>
				Contabilidade Financeira </td><td></td></tr>';
				echo '<tr><td><input type="checkbox" id="contabilidadeIntrodutoria" name="contabilidade[]" 
				value="Contabilidade Introdut�ria" '.(isset($contabilidade["Contabilidade Introdut�ria"])?'CHECKED="CHECKED"':"").'>Contabilidade Introdut�ria </td><td></td></tr>';
				echo '<tr><td><input type="checkbox" id="contabilidadeGerencial" name="contabilidade[]" 
				value="Contabilidade Gerencial" '.(isset($contabilidade["Contabilidade Gerencial"])?'CHECKED="CHECKED"':"").'>Contabilidade Gerencial </td><td></td></tr>';
				echo '</table><br />';
				echo '<hr />';
				//-------------Administracao----------------------
				echo '<h4>Administra��o</h4>';
				echo '<table class="tabela">';
				echo '<tr><td><input type="checkbox" id="gerenciamentoEventos" name="administracao[]" 
				value="Gerenciamento de Eventos" '.(isset($administracao["Gerenciamento de Eventos"])?'CHECKED="CHECKED"':"").'>Gerenciamento de Eventos </td><td></td></tr>';
				echo '<tr><td><input type="checkbox" id="gerenciamentoIndustrial" name="administracao[]" 
				value="Gerenciamento Industrial" '.(isset($administracao["Gerenciamento Industrial"])?'CHECKED="CHECKED"':"").'>Gerenciamento Industrial </td><td></td></tr>';
				echo '<tr><td><input type="checkbox" id="gerenciamentoInternacional" name="administracao[]" 
				value="Gerenciamento Internacional" '.(isset($administracao["Gerenciamento Internacional"])?'CHECKED="CHECKED"':"").'>Gerenciamento Internacional </td><td></td></tr>';
				echo '<tr><td><input type="checkbox" id="introducaoAdm" name="administracao[]" 
				value="Introdu��o � Administra��o" '.(isset($administracao["Introdu��o � Administra��o"])?'CHECKED="CHECKED"':"").'>Introdu��o � Administra��o </td><td></td></tr>';
				echo '</table><br />';
				echo '<hr />';
				//-------------Economia----------------------
				echo '<h4>Economia</h4>';
				echo '<table class="tabela">';
				echo '<tr><td><input type="checkbox" id="comercioInternacional" name="economia[]" 
				value="Com�rcio Internacional + Balan�a de Pagamentos" '.(isset($economia["Com�rcio Internacional + Balan�a de Pagamentos"])?'CHECKED="CHECKED"':"").'>Com�rcio Internacional + Balan�a de Pagamentos</td><td></td></tr>';
				echo '<tr><td><input type="checkbox" id="introducaoEconomia" name="economia[]" 
				value="Introdu��o � Economia" '.(isset($economia["Introdu��o � Economia"])?'CHECKED="CHECKED"':"").'>Introdu��o � Economia</td><td></td></tr>';
				echo '<tr><td><input type="checkbox" id="macroeconomia" name="economia[]" 
				value="Macroeconomia" '.(isset($economia["Macroeconomia"])?'CHECKED="CHECKED"':"").'>Macroeconomia</td><td></td></tr>';
				echo '<tr><td><input type="checkbox" id="microeconomia" name="economia[]" 
				value="Microeconomia" '.(isset($economia["Microeconomia"])?'CHECKED="CHECKED"':"").'>Microeconomia</td><td></td></tr>';
				echo '<tr><td><input type="checkbox" id="economiaMonetaria" name="economia[]" 
				value="Economia Monet�ria + Finan�as P�blicas" '.(isset($economia["Economia Monet�ria + Finan�as P�blicas"])?'CHECKED="CHECKED"':"").'>Economia Monet�ria + Finan�as P�blicas</td><td></td></tr>';
				echo '<tr><td><input type="checkbox" id="estatistica" name="economia[]" 
				value="Estat�stica" '.(isset($economia["Estat�stica"])?'CHECKED="CHECKED"':"").'>Estat�stica</td><td></td></tr>';
				echo '</table><br />';
				echo '<hr />';
				//-------------Financas----------------------
				echo '<h4>Finan�as</h4>';
				echo '<table class="tabela">';
				echo '<tr><td><input type="checkbox" id="banking" name="financas[]" 
				value="Banking" '.(isset($financas["Banking"])?'CHECKED="CHECKED"':"").'>Banking</td><td></td></tr>';
				echo '<tr><td><input type="checkbox" id="planejamentoFinancas" name="financas[]" 
				value="Planejamento de Finan�as + Or�amento" '.(isset($financas["Planejamento de Finan�as + Or�amento"])?'CHECKED="CHECKED"':"").'>Planejamento de Finan�as + Or�amento</td><td></td></tr>';
				echo '<tr><td><input type="checkbox" id="gestaoInternacionalFinancas" name="financas[]" 
				value="Gest�o Internacional de Finan�as" '.(isset($financas["Gest�o Internacional de Finan�as"])?'CHECKED="CHECKED"':"").'>Gest�o Internacional de Finan�as</td><td></td></tr>';
				echo '</table><br />';
				echo '<hr />';
				//-------------Recursos Humanos-----------
				echo '<h4>Recursos Humanos</h4>';
				echo '<table class="tabela">';
				echo '<tr><td><input type="checkbox" id="gestaoRH" name="recursosHumanos[]" value="Gest�o de Recursos Humanos Avan�ada" '.(isset($recursosHumanos["Gest�o de Recursos Humanos Avan�ada"])?'CHECKED="CHECKED"':"").'>Gest�o de Recursos Humanos Avan�ada</td><td></td></tr>';
				echo '<tr><td><input type="checkbox" id="gestaoRHInternacional" name="recursosHumanos[]" value="Gest�o de Recursos Humanos Internacional" '.(isset($recursosHumanos["Gest�o de Recursos Humanos Internacional"])?'CHECKED="CHECKED"':"").'>Gest�o de Recursos Humanos Internacional</td><td></td></tr>';
				echo '<tr><td><input type="checkbox" id="introducaoGestaoRH" name="recursosHumanos[]" value="Introdu��o � Gest�o de Recursos Humanos" '.(isset($recursosHumanos["Introdu��o � Gest�o de Recursos Humanos"])?'CHECKED="CHECKED"':"").'>Introdu��o � Gest�o de Recursos Humanos</td><td></td></tr>';
				echo '<tr><td><input type="checkbox" id="recrutamento" name="tecnologiaDaInformacao[]" value="Recrutamento e Aloca��o" '.(isset($recursosHumanos["Recrutamento e Aloca��o"])?'CHECKED="CHECKED"':"").'>Recrutamento e Aloca��o</td><td></td></tr>';
				echo '</table><br />';
				echo '<hr />';
				//-------------Tecnologia da Informa��o-----------
				echo '<h4>Tecnologia da Informa��o</h4>';
				echo '<table class="tabela">';
				echo '<tr><td><input type="checkbox" id="gerenciamentoBD" name="tecnologiaInformacao[]" value="Gerenciamento de Banco de Dados" '.(isset($tecnologiaInformacao["Gerenciamento de Banco de Dados"])?'CHECKED="CHECKED"':"").'>Gerenciamento de Banco de Dados</td><td></td></tr>';
				echo '<tr><td><input type="checkbox" id="gerenciementoRedes" name="tecnologiaInformacao[]" value="Gerenciamento de Redes + Tranmiss�o de Dados" '.(isset($tecnologiaInformacao["Gerenciamento de Redes + Tranmiss�o de Dados"])?'CHECKED="CHECKED"':"").'>Gerenciamento de Redes + Tranmiss�o de Dados</td><td></td></tr>';
				echo '<tr><td><input type="checkbox" id="desenvolvimentoSoftware" name="tecnologiaInformacao[]" value="Desenvolvimento de Software e Programa��o" '.(isset($tecnologiaInformacao["Desenvolvimento de Software e Programa��o"])?'CHECKED="CHECKED"':"").'>Desenvolvimento de Software e Programa��o</td><td></td></tr>';
				echo '<tr><td><input type="checkbox" id="analiseistemas" name="tecnologiaInformacao[]" value="An�lise e Design de Sistemas" '.(isset($tecnologiaInformacao["An�lise e Design de Sistemas"])?'CHECKED="CHECKED"':"").'>An�lise e Design de Sistemas</td><td></td></tr>';
				echo '<tr><td><input type="checkbox" id="criacaoPaginas" name="tecnologiaInformacao[]" value="Cria��o e Gerenciamento de P�ginas Web" '.(isset($tecnologiaInformacao["Cria��o e Gerenciamento de P�ginas Web"])?'CHECKED="CHECKED"':"").'>Cria��o e Gerenciamento de P�ginas Web</td><td></td></tr>';
				echo '</table><br />';
				echo '<hr />';
				//-------------Marketing--------------------------
				echo '<h4>Marketing</h4>';
				echo '<table class="tabela">';
				echo '<tr><td><input type="checkbox" id="PublicidadeRelacoesPublicas" name="marketing[]" value="Publicidade + Rela��es P�blicas" '.(isset($marketing["Publicidade + Rela��es P�blicas"])?'CHECKED="CHECKED"':"").'>Publicidade + Rela��es P�blicas</td><td></td></tr>';
				echo '<tr><td><input type="checkbox" id="DesenvolvimentoDeSoftwareEProgramacao" name="marketing[]" value="Importa��o - Exporta��o" '.(isset($marketing["Importa��o - Exporta��o"])?'CHECKED="CHECKED"':"").'>Importa��o - Exporta��o</td><td></td></tr>';
				echo '<tr><td><input type="checkbox" id="PlanejamentoDesenvolvimentoEControleDeProduto" name="marketing[]" value="Planejamento, Desenvolvimento e Controle de Produto" '.(isset($marketing["Planejamento, Desenvolvimento e Controle de Produto"])?'CHECKED="CHECKED"':"").'>Planejamento, Desenvolvimento e Controle de Produto</td><td></td></tr>';
				echo '<tr><td><input type="checkbox" id="VarejoMarketingDeVendas" name="marketing[]" value="Varejo + Marketing de Vendas" '.(isset($marketing["Varejo + Marketing de Vendas"])?'CHECKED="CHECKED"':"").'>Varejo + Marketing de Vendas</td><td></td></tr>';
				echo '</table><br />';
				echo '<hr />';
				//-------------Outros Estudos---------------------
				echo '<h4>Outros Estudos</h4>';
				echo '<table class="tabela">';
				echo '<tr><td><input type="checkbox" id="engenhariaQuimica" name="outrosEstudos[]" value="Engenharia Qu�mica" '.(isset($outrosEstudos["Engenharia Qu�mica"])?'CHECKED="CHECKED"':"").'>Engenharia Qu�mica</td><td></td></tr>';
				echo '<tr><td><input type="checkbox" id="engenhariaCivil" name="outrosEstudos[]" value="Engenharia Civil" '.(isset($outrosEstudos["Engenharia Civil"])?'CHECKED="CHECKED"':"").'>Engenharia Civil</td><td></td></tr>';
				echo '<tr><td><input type="checkbox" id="engenhariaEletrica" name="outrosEstudos[]" value="Engenharia El�trica" '.(isset($outrosEstudos["Engenharia El�trica"])?'CHECKED="CHECKED"':"").'>Engenharia El�trica</td><td></td></tr>';
				echo '<tr><td><input type="checkbox" id="engenhariaEletronica" name="outrosEstudos[]" value="Engenharia Eletr�nica" '.(isset($outrosEstudos["Engenharia Eletr�nica"])?'CHECKED="CHECKED"':"").'>Engenharia Eletr�nica</td><td></td></tr>';
				echo '<tr><td><input type="checkbox" id="engenhariaIndustrial" name="outrosEstudos[]" value="Engenharia Industrial" '.(isset($outrosEstudos["Engenharia Industrial"])?'CHECKED="CHECKED"':"").'>Engenharia Industrial</td><td></td></tr>';
				echo '<tr><td><input type="checkbox" id="engenhariaMecanica" name="outrosEstudos[]" value="Engenharia Mec�nica" '.(isset($outrosEstudos["Engenharia Mec�nica"])?'CHECKED="CHECKED"':"").'>Engenharia Mec�nica</td><td></td></tr>';
				echo '<tr><td><input type="checkbox" id="jornalismo" name="outrosEstudos[]" value="Jornalismo" '.(isset($outrosEstudos["Jornalismo"])?'CHECKED="CHECKED"':"").'>Jornalismo</td><td></td></tr>';
				echo '<tr><td><input type="checkbox" id="cienciasocial" name="outrosEstudos[]" value="Ci�ncia Social" '.(isset($outrosEstudos["Ci�ncia Social"])?'CHECKED="CHECKED"':"").'>Ci�ncia Social</td><td></td></tr>';
				echo '</table><br />';
				echo '<center>';
				echo '<table cellpadding="15">';
				echo '<tr><td><input type=Submit value="Salvar" /></form></td>';
				echo '<td><form action="principal.php"><input type="submit" value="Voltar"></form></td></tr>';
				echo '</table>';
				echo '</center>';
				echo '<ul class="ajuda"><li>Os campos marcados com asterisco (<font class="erro">*</font>) s�o obrigat�rios!</li></ul>';
			} else { //pessoa ainda nao foi cadastrada
				echo '<ul class="aviso"><li>Para inserir ou editar uma experi�ncia, � necess�rio cadastrar seus
				dados pessoais. Clique <a href="dadosPessoais.php">aqui</a>.</li></ul>';	
			}
		} else {
			echo '<ul class="erro"><li>Erro de sistema! Contate o administrador do sistema!</li></ul>';
		}
	} 
			
//---------------Rodape-------------------
include ("rodape.php"); 
?>