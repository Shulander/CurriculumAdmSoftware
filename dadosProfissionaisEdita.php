<?php
	require_once ("utils/sessao.php"); 
	include ("cabecalho.php");
	include ("menu.php");
	require_once ("utils/BancoDados.php");
	require_once ("classes/ExpProfissional.php");
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
		if ($_REQUEST['dataConclusao'] == "00/00/0000") {
			$dataConclusao = "";
		} else {
			$dataConclusao = $_REQUEST['dataConclusao'];
		}	
	} else {
		$dataConclusao = "";
	}
	//testa se a variavel idExpProf existe
	if(isset($_REQUEST['idExpProf'])) {
		$idExpProf = $_REQUEST['idExpProf'];	
	} else {
		$idExpProf = "";
	}
?>
<!-- Sub-titulo -->
<h3>Editar Experiência Profissional</h3>
<?php
if(!empty($aviso)) {
	if ($aviso == "sucesso") {
		echo '<ul class="sucesso"><li>Experiência profissional alterada com sucesso!</li></ul>';
		header ("Location:dadosExtras.php");
	} else {
		echo '<ul class="erro"><li>'.$aviso.'</li></ul>';	
	}						
}
$conexaoBD = new BancoDados ();
if (!$conexaoBD->conecta()) {
	echo '<ul class="erro"><li>Erro de sistema! Contate o administrador do sistema!</li></ul>';
} else {
	if (isset($idLogin)) {
		$pessoa = new Pessoa ($idLogin, "", "", "", "", "", "", "", "", "", "", "", "", "", "", 0, $conexaoBD); 
		$resultado = $pessoa->buscaPorIdUsuario ();
		if ($resultado == true) { //se pessoa foi cadastrada
			$expProfissionais = new ExpProfissional (0, $idLogin, 0, "", "", "", "", "", $conexaoBD);
			$resultado = $expProfissionais->busca();//retorna array de ids de experiencias profissionais
			if ($resultado == 0) {
				echo '<ul class="aviso"><li>Não há experiências profissionais cadastradas. Para cadastrar uma experiência
				profissional clique <a href="dadosProfissionaisInsere.php">aqui</a>.</li></ul>';	
			} else if (is_array($resultado)) {
				$numExpProfissionais = count($resultado);
				for ($i = 0; $i < $numExpProfissionais; $i++) {
					$idExpProf = $resultado[$i];
					$expProf = new ExpProfissional ($resultado[$i], $idLogin, 0, "", "", "", "", "", $conexaoBD);
					$result = $expProf->buscaPorIdPessoa();
					if ($result == true) {
						//mostra experiencia profissional
						$empresa = $expProf->getEmpresa();
						$tipo = $expProf->getTipo();
						$atividade = $expProf->getAtividade();
						$dataInicio = $expProf->converteDataInicio();
						$dataConclusao = $expProf->converteDataConclusao();
						echo '<ul>';
						echo '<li>'.$empresa.' - '.$tipo.' | <a href="javascript: void(0);" onclick="blocoExibe(\'expProf\', '.($i+1).', '.$numExpProfissionais.');">editar</a>';
						echo '<span id="expProf'.($i+1).'" style="display: none;">';
						//---FORM
						echo '<form action="dadosProfissionaisEditaBD.php" method="POST" name="dadosProfissionaisForm"
						 onsubmit="return verificaFormDadosProfisisonais($(\'empresa\'), $(\'tipo\'), $(\'atividade\'), $(\'dataInicio\'));">';
						echo '<table class="tabela">';
						//--------empresa---------------
						echo '<input type="hidden" id="idExpProf" name="idExpProf" value='.$idExpProf.' \>';
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
						//--------Data de Início---------------
						echo '<tr><td><a href="#" class="dica">Data de Início:<span>Esse campo deve ter o formato dd/mm/aaaa!</span></a><font class="erro">*</font> </td>';
						echo '<td><input type="text" value="'.$dataInicio.'" readonly id="dataInicio'.$i.'" name="dataInicio" size="10" maxlength="10">
						<input type="button" value="Calendário" onClick=displayCalendar($(\'dataInicio'.$i.'\'),"dd/mm/yyyy",this)>';
						echo '</td></tr>';
						echo '<tr></tr>';				
						//-------Data de conclusao-----------
						echo '<tr><td><a href="#" class="dica">Data de Conclusão: <span>Esse campo deve ter o formato dd/mm/aaaa!</span></a> </td>';
						echo '<td><input type="text" readonly value="'.$dataConclusao.'" id="dataConclusao'.$i.'" name="dataConclusao" size="10" maxlength="10">
						<input type="button" value="Calendário" onClick=displayCalendar($(\'dataConclusao'.$i.'\'),"dd/mm/yyyy",this)>';
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
						//---
						echo '</span>';
						echo '</li>';
						echo '</ul>';
					} else {
						echo '<ul class="erro"><li>Erro de sistema! Contate o administrador do sistema!</li></ul>';
					}
				}
			} else {
				echo '<ul class="erro"><li>Erro de sistema! Contate o administrador do sistema!</li></ul>';
			}
		} else { //pessoa ainda nao foi cadastrada
			echo '<ul class="aviso"><li>Para inserir ou editar uma experiência, é necessário cadastrar seus
			dados pessoais. Clique <a href="dadosPessoais.php">aqui</a>.</li></ul>';	
		}
	} else {
		echo '<ul class="erro"><li>Erro de sistema! Contate o administrador do sistema!</li></ul>';
	}
}
include ("rodape.php"); 
?>