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
	//testa se a variavel tipo existe
	if(isset($_REQUEST['tipo'])) {
		$tipo = $_REQUEST['tipo'];	
	} else {
		$tipo = "";
	}
	//testa se a variavel semestre existe
	if(isset($_REQUEST['semestre'])) {
		$semestre = $_REQUEST['semestre'];	
	} else {
		$semestre = "";
	}
	//testa se a variavel turno existe
	if(isset($_REQUEST['turno'])) {
		$turno = $_REQUEST['turno'];	
	} else {
		$turno = "";
	}
	//testa se a variavel instituicao existe
	if(isset($_REQUEST['instituicao'])) {
		$instituicao = $_REQUEST['instituicao'];	
	} else {
		$instituicao = "";
	}
	//testa se a variavel instituicaoOutra existe
	if(isset($_REQUEST['instituicaoOutra'])) {
		$instituicaoOutra = $_REQUEST['instituicaoOutra'];	
	} else {
		$instituicaoOutra = "";
	}
	//testa se a variavel curso existe
	if(isset($_REQUEST['curso'])) {
		$curso = $_REQUEST['curso'];	
	} else {
		$curso = "";
	}
	//testa se a variavel cursoOutro existe
	if(isset($_REQUEST['cursoOutro'])) {
		$cursoOutro = $_REQUEST['cursoOutro'];	
	} else {
		$cursoOutro = "";
	}
	
	//testar se a variavel dataIngresso existe
	if(isset($_GET['dataIngresso'])) {
		$dataIngresso = $_GET['dataIngresso'];	
	} else {
		$dataIngresso = "";
	}
	//testa se a variavel dataConclusao existe
	if(isset($_REQUEST['dataConclusao'])) {
		$dataConclusao = $_REQUEST['dataConclusao'];	
	} else {
		$dataConclusao = "";
	}
?>
<!-- Sub-titulo -->
<h3>Inserir Formação Acadêmica</h3>
<script type="text/javascript">
<!--
$aUniversidades = new Array();
$aUniversidades[0] = "FADISMA";
$aUniversidades[1] = "FAMES";
$aUniversidades[2] = "FAPAS";
$aUniversidades[3] = "FASCLA";
$aUniversidades[4] = "UFSM";
$aUniversidades[5] = "ULBRA Santa Maria";
$aUniversidades[6] = "UNIFRA";
function abreCursosUniversidade(selecionado) {
	$('curso').value = "";
	for(var i=0; i< $aUniversidades.length; i++) {
		if($aUniversidades[i] == selecionado){
			blocoAbre($('curso'+i)); 
			$('curso').value=$('curso'+i).options[$('curso'+i).selectedIndex].value
		} else {			
			blocoFecha($('curso'+i)); 
		}
	}
}
//-->
</script>
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
				echo '<form action="dadosEducacionaisInsereBD.php" method="POST" name="dadosEducacionaisForm"
				 onsubmit="return verificaFormDadosEducacionais($(\''.(empty($cursoOutro)?$curso:$cursoOutro).'\'), $(\'tipo\'), $(\'instituicao\'), $(\'dataIngresso\'));">';
				echo '<table class="tabela">';
				//--------instituicao---------------
				echo '<tr><td>Instituição: <font class="erro">*</font></td>';
				echo '<td><select id="instituicao" name="instituicao" onchange="
				abreCursosUniversidade(this.options[this.selectedIndex].value); 
				if(this.options[this.selectedIndex].value==\'outra\') { 
					blocoAbre($(\'blocoOutra\')); 
				} else { 
					blocoFecha($(\'blocoOutra\'));
				}
				">';
				echo '<option value="0"> -- Selecione -- </option>';
				echo '<option value="FADISMA" '.($instituicao == "FADISMA"?'selected="selected"':"").'>FADISMA</option>';
				echo '<option value="FAMES" '.($instituicao == "FAMES"?'selected="selected"':"").'>FAMES</option>';
				echo '<option value="FAPAS" '.($instituicao == "FAPAS"?'selected="selected"':"").'>FAPAS</option>';
				echo '<option value="FASCLA" '.($instituicao == "FASCLA"?'selected="selected"':"").'>FASCLA</option>';
				echo '<option value="UFSM" '.($instituicao == "UFSM"?'selected="selected"':"").'>UFSM</option>';
				echo '<option value="ULBRA Santa Maria" '.($instituicao == "ULBRA Santa Maria"?'selected="selected"':"").'>ULBRA Santa Maria</option>';
				echo '<option value="UNIFRA" '.($instituicao == "FADISMA"?'selected="selected"':"").'>UNIFRA</option>';
				echo '<option value="outra" '.($instituicao == "outra"?'selected="selected"':"").'>Outra</option>';
				echo '</select><span id="blocoOutra" '.($instituicao == "outra"?'':'style="display:none"').'>
				&nbsp;&nbsp;<input type="text" name="instituicaoOutra" id="instituicaoOutra" value="'.$instituicaoOutra.'" size="20" maxlength="50"/>
				Curso: <input type="text" name="cursoOutro" id="cursoOutro" value="'.$cursoOutro.'" size="20" maxlength="50"/>
				</span>';
				echo '<input type="hidden" name="curso" id="curso" value="'.$curso.'" />';
				//Cursos FADISMA
				echo '&nbsp;&nbsp;<select id="curso0" '.($instituicao == "FADISMA"?"":'style="display:none"').' onchange="$(\'curso\').value=this.options[this.selectedIndex].value">';
				echo '<option value="0"> -- Selecione o curso -- </option>';
				echo '<option value="Direito" '.($curso == "Direito"?'selected="selected"':"").'>Direito</option>';
				echo '</select>';	
				//Cursos FAMES
				echo '<select id="curso1" '.($instituicao == "FAMES"?"":'style="display:none"').' onchange="$(\'curso\').value=this.options[this.selectedIndex].value">';
				echo '<option value="0"> -- Selecione o curso -- </option>';
				echo '<option value="Administração" '.($curso == "Administração"?'selected="selected"':"").'>Administração</option>';
				echo '<option value="Administração - Comércio Exterior" '.($curso == "Administração - Comércio Exterior"?'selected="selected"':"").'>Administração - Comércio Exterior</option>';
				echo '<option value="Administração Hospitalar" '.($curso == "Administração Hospitalar"?'selected="selected"':"").'>Administração Hospitalar</option>';
				echo '<option value="Direito" '.($curso == "Direito"?'selected="selected"':"").'>Direito</option>';
				echo '<option value="Educação Física" '.($curso == "Educação Física"?'selected="selected"':"").'>Educação Física</option>';
				echo '<option value="Letras" '.($curso == "Letras"?'selected="selected"':"").'>Letras</option>';
				echo '<option value="Sistemas de Informação" '.($curso == "Sistemas de Informação"?'selected="selected"':"").'>Sistemas de Informação</option>';	
				echo '</select>';
				//Cursos FAPAS
				echo '<select id="curso2" '.($instituicao == "FAPAS"?"":'style="display:none"').' onchange="$(\'curso\').value=this.options[this.selectedIndex].value">';
				echo '<option value="0"> -- Selecione o curso -- </option>';
				echo '<option value="Administração" '.($curso == "Administração"?'selected="selected"':"").'>Administração</option>';
				echo '<option value="Administração Hospitalar" '.($curso == "Administração Hospitalar"?'selected="selected"':"").'>Administração Hospitalar</option>';
				echo '<option value="Direito" '.($curso == "Direito"?'selected="selected"':"").'>Direito</option>';
				echo '<option value="Teologia" '.($curso == "Teologia"?'selected="selected"':"").'>Teologia</option>';
				echo '<option value="Filosofia" '.($curso == "Filosofia"?'selected="selected"':"").'>Filosofia</option>';
				echo '<option value="Biblioteconomia" '.($curso == "Biblioteconomia"?'selected="selected"':"").'>Biblioteconomia</option>';	
				echo '</select>';	
				//Cursos FASCLA
				echo '<select id="curso3" '.($instituicao == "FASCLA"?"":'style="display:none"').' onchange="$(\'curso\').value=this.options[this.selectedIndex].value">';
				echo '<option value="0"> -- Selecione o curso -- </option>';
				echo '<option value="Administração" '.($curso == "Administração"?'selected="selected"':"").'>Administração</option>';
				echo '<option value="Enfermagem" '.($curso == "Enfermagem"?'selected="selected"':"").'>Enfermagem</option>';
				echo '<option value="Psicologia" '.($curso == "Psicologia"?'selected="selected"':"").'>Psicologia</option>';	
				echo '</select>';
				//Cursos UFSM
				echo '<select id="curso4" '.($instituicao == "UFSM"?"":'style="display:none"').' onchange="$(\'curso\').value=this.options[this.selectedIndex].value">';
				echo '<option value="0"> -- Selecione o curso -- </option>';
				echo '<option value="Administração" '.($curso == "Administração"?'selected="selected"':"").'>Administração</option>';
				echo '<option value="Agronomia" '.($curso == "Agronomia"?'selected="selected"':"").'>Agronomia</option>';
				echo '<option value="Arquitetura e Urbanismo" '.($curso == "Arquitetura e Urbanismo"?'selected="selected"':"").'>Arquitetura e Urbanismo</option>';
				echo '<option value="Arquivologia" '.($curso == "Arquivologia"?'selected="selected"':"").'>Arquivologia</option>';
				echo '<option value="Artes Cênicas" '.($curso == "Artes Cênicas"?'selected="selected"':"").'>Artes Cênicas</option>';
				echo '<option value="Artes Visuais" '.($curso == "Artes Visuais"?'selected="selected"':"").'>Artes Visuais</option>';
				echo '<option value="Ciências Biológicas" '.($curso == "Ciências Biológicas"?'selected="selected"':"").'>Ciências Biológicas</option>';
				echo '<option value="Ciências Contábeis" '.($curso == "Ciências Contábeis"?'selected="selected"':"").'>Ciências Contábeis</option>';
				echo '<option value="Ciências Econômicas" '.($curso == "Ciências Econômicas"?'selected="selected"':"").'>Ciências Econômicas</option>';
				echo '<option value="Ciências Sociais" '.($curso == "Ciências Sociais"?'selected="selected"':"").'>Ciências Sociais</option>';
				echo '<option value="Ciência da Computação" '.($curso == "Ciência da Computação"?'selected="selected"':"").'>Ciência da Computação</option>';
				echo '<option value="Comunicação Social - Jornalismo" '.($curso == "Comunicação Social - Jornalismo"?'selected="selected"':"").'>Comunicação Social - Jornalismo</option>';
				echo '<option value="Comunicação Social - Publicidade e Propaganda" '.($curso == "Comunicação Social - Publicidade e Propaganda"?'selected="selected"':"").'>Comunicação Social - Publicidade e Propaganda</option>';
				echo '<option value="Comunicação Social - Relações Públicas" '.($curso == "Comunicação Social - Relações Públicas"?'selected="selected"':"").'>Comunicação Social - Relações Públicas</option>';
				echo '<option value="Desenho Industrial" '.($curso == "Desenho Industrial"?'selected="selected"':"").'>Desenho Industrial</option>';
				echo '<option value="Direito" '.($curso == "Direito"?'selected="selected"':"").'>Direito</option>';
				echo '<option value="Educação Especial" '.($curso == "Educação Especial"?'selected="selected"':"").'>Educação Especial</option>';
				echo '<option value="Educação Física" '.($curso == "Educação Física"?'selected="selected"':"").'>Educação Física</option>';
				echo '<option value="Enfermagem" '.($curso == "Enfermagem"?'selected="selected"':"").'>Enfermagem</option>';
				echo '<option value="Engenharia Civil" '.($curso == "Engenharia Civil"?'selected="selected"':"").'>Engenharia Civil</option>';
				echo '<option value="Engenharia Elétrica" '.($curso == "Engenharia Elétrica"?'selected="selected"':"").'>Engenharia Elétrica</option>';
				echo '<option value="Engenharia Florestal" '.($curso == "Engenharia Florestal"?'selected="selected"':"").'>Engenharia Florestal</option>';
				echo '<option value="Engenharia Mecânica" '.($curso == "Engenharia Mecânica"?'selected="selected"':"").'>Engenharia Mecânica</option>';
				echo '<option value="Engenharia Química" '.($curso == "Engenharia Química"?'selected="selected"':"").'>Engenharia Química</option>';
				echo '<option value="Farmácia" '.($curso == "Farmácia"?'selected="selected"':"").'>Farmácia</option>';
				echo '<option value="Filosofia" '.($curso == "Filosofia"?'selected="selected"':"").'>Filosofia</option>';
				echo '<option value="Física" '.($curso == "Física"?'selected="selected"':"").'>Física</option>';
				echo '<option value="Fisioterapia" '.($curso == "Fisioterapia"?'selected="selected"':"").'>Fisioterapia</option>';
				echo '<option value="Fonoaudiologia" '.($curso == "Fonoaudiologia"?'selected="selected"':"").'>Fonoaudiologia</option>';
				echo '<option value="Geografia" '.($curso == "Geografia"?'selected="selected"':"").'>Geografia</option>';
				echo '<option value="História" '.($curso == "História"?'selected="selected"':"").'>História</option>';
				echo '<option value="Letras Espanhol" '.($curso == "Letras Espanhol"?'selected="selected"':"").'>Letras Espanhol</option>';
				echo '<option value="Letras Inglês" '.($curso == "Letras Inglês"?'selected="selected"':"").'>Letras Inglês</option>';
				echo '<option value="Letras Português" '.($curso == "Letras Português"?'selected="selected"':"").'>Letras Português</option>';
				echo '<option value="Matemática" '.($curso == "Matemática"?'selected="selected"':"").'>Matemática</option>';
				echo '<option value="Medicina" '.($curso == "Medicina"?'selected="selected"':"").'>Medicina</option>';
				echo '<option value="Medicina Veterinária" '.($curso == "Medicina Veterinária"?'selected="selected"':"").'>Medicina Veterinária</option>';
				echo '<option value="Meteorologia" '.($curso == "Meteorologia"?'selected="selected"':"").'>Meteorologia</option>';
				echo '<option value="Música" '.($curso == "Música"?'selected="selected"':"").'>Música</option>';
				echo '<option value="Odontologia" '.($curso == "Odontologia"?'selected="selected"':"").'>Odontologia</option>';
				echo '<option value="Pedagogia" '.($curso == "Pedagogia"?'selected="selected"':"").'>Pedagogia</option>';
				echo '<option value="Psicologia" '.($curso == "Psicologia"?'selected="selected"':"").'>Psicologia</option>';
				echo '<option value="Química" '.($curso == "Química"?'selected="selected"':"").'>Química</option>';
				echo '<option value="Zootecnia" '.($curso == "Zootecnia"?'selected="selected"':"").'>Zootecnia</option>';	
				echo '</select>';	
				//Cursos ULBRA Santa Maria
				echo '<select id="curso5" '.($instituicao == "ULBRA Santa Maria"?"":'style="display:none"').' onchange="$(\'curso\').value=this.options[this.selectedIndex].value">';
				echo '<option value="0"> -- Selecione o curso -- </option>';
				echo '<option value="Administração" '.($curso == "Administração"?'selected="selected"':"").'>Administração</option>';
				echo '<option value="Arquitetura e Urbanismo" '.($curso == "Arquitetura e Urbanismo"?'selected="selected"':"").'>Arquitetura e Urbanismo</option>';
				echo '<option value="Direito" '.($curso == "Direito"?'selected="selected"':"").'>Direito</option>';
				echo '<option value="Educação Física" '.($curso == "Educação Física"?'selected="selected"':"").'>Educação Física</option>';
				echo '<option value="Estética e Cosmética" '.($curso == "Estética e Cosmética"?'selected="selected"':"").'>Estética e Cosmética</option>';
				echo '<option value="Fisioterapia" '.($curso == "Fisioterapia"?'selected="selected"':"").'>Fisioterapia</option>';
				echo '<option value="Psicologia" '.($curso == "Psicologia"?'selected="selected"':"").'>Psicologia</option>';
				echo '<option value="Sistemas de Informação" '.($curso == "Sistemas de Informação"?'selected="selected"':"").'>Sistemas de Informação</option>';	
				echo '</select>';	
				//Cursos UNIFRA
				echo '<select id="curso6" '.($instituicao == "UNIFRA"?"":'style="display:none"').' onchange="$(\'curso\').value=this.options[this.selectedIndex].value">';
				echo '<option value="0"> -- Selecione o curso -- </option>';
				echo '<option value="Administração" '.($curso == "Administração"?'selected="selected"':"").'>Administração</option>';
				echo '<option value="Arquitetura e Urbanismo" '.($curso == "Arquitetura e Urbanismo"?'selected="selected"':"").'>Arquitetura e Urbanismo</option>';
				echo '<option value="Biomedicina" '.($curso == "Biomedicina"?'selected="selected"':"").'>Biomedicina</option>';
				echo '<option value="Ciência da Computação" '.($curso == "Ciência da Computação"?'selected="selected"':"").'>Ciência da Computação</option>';
				echo '<option value="Ciências Contábeis" '.($curso == "Ciências Contábeis"?'selected="selected"':"").'>Ciências Contábeis</option>';
				echo '<option value="Comunicação Social - Jornalismo" '.($curso == "Comunicação Social - Jornalismo"?'selected="selected"':"").'>Comunicação Social - Jornalismo</option>';
				echo '<option value="Comunicação Social - Publicidade e Propaganda" '.($curso == "Comunicação Social - Publicidade e Propaganda"?'selected="selected"':"").'>Comunicação Social - Publicidade e Propaganda</option>';
				echo '<option value="Design" '.($curso == "Design"?'selected="selected"':"").'>Design</option>';
				echo '<option value="Direito" '.($curso == "Direito"?'selected="selected"':"").'>Direito</option>';
				echo '<option value="Economia" '.($curso == "Economia"?'selected="selected"':"").'>Economia</option>';
				echo '<option value="Educação Física" '.($curso == "Educação Física"?'selected="selected"':"").'>Educação Física</option>';
				echo '<option value="Enfermagem" '.($curso == "Enfermagem"?'selected="selected"':"").'>Enfermagem</option>';
				echo '<option value="Engenharia Ambiental" '.($curso == "Engenharia Ambiental"?'selected="selected"':"").'>Engenharia Ambiental</option>';
				echo '<option value="Farmácia" '.($curso == "Farmácia"?'selected="selected"':"").'>Farmácia</option>';
				echo '<option value="Filosofia" '.($curso == "Filosofia"?'selected="selected"':"").'>Filosofia</option>';
				echo '<option value="Física" '.($curso == "Física"?'selected="selected"':"").'>Física</option>';
				echo '<option value="Fisioterapia" '.($curso == "Fisioterapia"?'selected="selected"':"").'>Fisioterapia</option>';
				echo '<option value="Geografia" '.($curso == "Geografia"?'selected="selected"':"").'>Geografia</option>';
				echo '<option value="História" '.($curso == "História"?'selected="selected"':"").'>História</option>';
				echo '<option value="Letras Inglês" '.($curso == "Letras Inglês"?'selected="selected"':"").'>Letras Inglês</option>';
				echo '<option value="Letras Português" '.($curso == "Letras Português"?'selected="selected"':"").'>Letras Português</option>';
				echo '<option value="Matemática" '.($curso == "Matemática"?'selected="selected"':"").'>Matemática</option>';
				echo '<option value="Nutrição" '.($curso == "Nutrição"?'selected="selected"':"").'>Nutrição</option>';
				echo '<option value="Odontologia" '.($curso == "Odontologia"?'selected="selected"':"").'>Odontologia</option>';
				echo '<option value="Pedagogia" '.($curso == "Pedagogia"?'selected="selected"':"").'>Pedagogia</option>';
				echo '<option value="Psicologia" '.($curso == "Psicologia"?'selected="selected"':"").'>Psicologia</option>';
				echo '<option value="Química" '.($curso == "Química"?'selected="selected"':"").'>Química</option>';
				echo '<option value="Serviço Social" '.($curso == "Serviço Social"?'selected="selected"':"").'>Serviço Social</option>';		
				echo '<option value="Sistemas de Informação" '.($curso == "Sistemas de Informação"?'selected="selected"':"").'>Sistemas de Informação</option>';
				echo '<option value="Terapia Ocupacional" '.($curso == "Terapia Ocupacional"?'selected="selected"':"").'>Terapia Ocupacional</option>';	
				echo '<option value="Turismo" '.($curso == "Turismo"?'selected="selected"':"").'>Turismo</option>';		
				echo '</select>';	
				echo '</td></tr>';	
				
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
				
				//--------Turno---------------
				echo '<tr><td>Turno: </td>';
				echo '<td><select name="turno">';
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
			} else {
				echo '<ul class="aviso"><li>Para inserir ou editar uma experiência, é necessário cadastrar seus
				dados pessoais. Clique <a href="dadosPessoais.php">aqui</a>.</li></ul>';
			}
		} else {
			echo '<ul class="erro"><li>Erro de sistema! Contate o administrador do sistema!</li></ul>';
		}
	} 
include ("rodape.php"); 
?>