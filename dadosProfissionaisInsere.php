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
	//testa se a variavel empresa existe
	if(isset($_REQUEST['empresa'])) {
		$empresa = $_REQUEST['empresa'];	
	} else {
		$empresa = "";
	}
	//testa se a variavel instituicao existe
	if(isset($_REQUEST['atividade'])) {
		$atividade = $_REQUEST['atividade'];	
	} else {
		$atividade = "";
	}
	//testar se a variavel dataInicio existe
	if(isset($_REQUEST['dataInicio'])) {
		$dataInicio = $_REQUEST['dataInicio'];	
	} else {
		$dataInicio = "";
	}
	//testa se a variavel dataConclusao existe
	if(isset($_REQUEST['dataConclusao'])) {
		$dataConclusao = $_REQUEST['dataConclusao'];	
	} else {
		$dataConclusao = "";
	}
//Sub-titulo
echo '<h3>Inserir Experiência Profissional</h3>';
if(!empty($aviso)) {
	echo '<ul class="erro"><li>'.$aviso.'</li></ul>';							
}
$conexaoBD = new BancoDados ();
if (!$conexaoBD->conecta()) {
	echo '<ul class="erro"><li>Erro de sistema! Contate o administrador do sistema!</li></ul>';
} else {
	if (isset($idLogin)) {
		$pessoa = new Pessoa ($idLogin, "", "", "", "", "", "", 0, "", "", 0, "", "", "", "", "", "", 0, $conexaoBD);
		$resultado = $pessoa->buscaPorIdUsuario ();
		if ($resultado == true) { //se pessoa foi cadastrada
			echo '<form action="dadosProfissionaisInsereBD.php" method="POST" name="dadosProfissionaisForm"
			 onsubmit="return verificaFormDadosProfissionais($(\'curso\'), $(\'tipo\'), $(\'instituicao\'), $(\'dataInicio\'));">';
			echo '<table class="tabela">';
			//--------empresa---------------
			echo '<tr><td>Empresa: <font class="erro">*</font></td>';
			echo '<td><input type="text" id="empresa" name="empresa" value="'.$empresa.'" size="30" maxlength="50">';
			echo '</td></tr>';	
			//--------Tipo---------------
			echo '<tr><td>Tipo: <font class="erro">*</font></td>';
			echo '<td><select name="tipo">';
			echo '<option value="0"> -- Selecione o tipo  -- </option>';
			echo '<option value="estagiário" '.($tipo == "estagiário"?'selected="selected"':"").'>Estagiário</option>';					
			echo '<option value="funcionário" '.($tipo == "funcionário"?'selected="selected"':"").'>Funcionário</option>';
			echo '<option value="proprietário" '.($tipo == "proprietário"?'selected="selected"':"").'>Proprietário</option>';								
			echo '</select></td></tr>';
			//--------Data de Ingresso---------------
			echo '<tr><td><a href="#" class="dica">Data de Início:<span>Esse campo deve ter o formato dd/mm/aaaa!</span></a><font class="erro">*</font> </td>';
			echo '<td><input type="text" value="'.$dataInicio.'" readonly id="dataInicio" name="dataInicio" size="10" maxlength="10">
			<input type="button" value="Calendário" onClick=displayCalendar(document.forms[0].dataInicio,"dd/mm/yyyy",this)>';
			echo '</td></tr>';
			echo '<tr></tr>';				
			//-------Data de conclusao-----------
			echo '<tr><td><a href="#" class="dica">Data de Conclusão: <span>Esse campo deve ter o formato dd/mm/aaaa! .</span></a></td>';
			echo '<td><input type="text" readonly value="'.$dataConclusao.'" id="dataConclusao" name="dataConclusao" size="10" maxlength="10">
			<input type="button" value="Calendário" onClick=displayCalendar(document.forms[0].dataConclusao,"dd/mm/yyyy",this)>';
			echo '</td></tr>';
			//--------Atividade---------------
			echo '<tr><td>Atividade: <font class="erro">*</font></td>';
			echo '<td><textarea cols="40"rows="5" id="atividade" name="atividade">'.$atividade.'</textarea>';
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