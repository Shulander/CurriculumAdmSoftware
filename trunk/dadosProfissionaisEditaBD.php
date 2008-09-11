<?php
	require_once ("utils/BancoDados.php");
	require_once ("utils/sessao.php");
	include ("classes/ExpProfissional.php");
	include ("classes/Pessoa.php");
	include ("utils/Validador.php");
	restritoUsuario();
	$idLogin = $_SESSION['idLogin'] + 0;
	$idExpProf = $_POST['idExpProf'] + 0;
	$empresa = $_POST['empresa'];
	$tipo = $_POST['tipo'];
	$dataInicio = $_POST['dataInicio'];
	$dataConclusao = $_POST['dataConclusao'];
	$atividade = $_POST['atividade'];
	$location = "&empresa=".$empresa."&tipo=".$tipo."&dataInicio=".$dataInicio.
	"&dataConclusao=".$dataConclusao."&atividade=".$atividade;
	$conexaoBD = new BancoDados ();
	//verifica se a conexao ao banco de dados ocorreu corretamente
	if (!$conexaoBD->conecta()) {
		$aviso = "Erro de sistema! Contate o administrador do sistema!";
		header("Location:dadosProfissionaisInsere.php?aviso=".$aviso.$location);
		exit();
	}
	//Busca idPessoa
	$pessoa = new Pessoa ($idLogin, "", "", "", "", "", "", "", "", "", "", "", "", "", "", 0, $conexaoBD);
	$resultado = $pessoa->busca();
	if ($resultado == true) {
		$idPessoa = $pessoa->getId ();
	} else {
		$aviso = "Erro de sistema! Contate o administrador do sistema!";
		header("Location:dadosProfissionaisInsere.php?aviso=".$aviso.$location);
		exit();
	}
	$aviso = null;
	$validador = new Validador ();
	/*---------Empresa------------*/
	if(is_null ($aviso)) {
		if ($validador->isPreenchido ($empresa)) {
			if (!$validador->comprimento($empresa, 50)) {
				$aviso = "O campo 'Empresa' deve possuir no m�ximo 50 caracteres!";
			}
		}
	}
	/*------------Tipo----------------*/
	if(is_null ($aviso)) {		
		if (!$validador->isSelecionado($tipo)) {
			$aviso = "� necess�rio selecionar uma op��o no campo 'Tipo'!";	
		} 
	}
	/*------------Atividade----------------*/
	if(is_null ($aviso)) {		
		if (!$validador->isPreenchido($atividade)) {
			$aviso = "� necess�rio preencher o campo 'Atividade'!";	
		} 
	}
	/*---------Data de In�cio-----------*/	
	if(is_null ($aviso)) {
		if (!$validador->isPreenchido($dataInicio)) {
			$aviso = "� necess�rio preencher o campo 'Data de In�cio'!";	
		} else if($validador->isData($dataInicio)) {						
			$dataInicioBD = $validador->converteData ($dataInicio);
		} else {
			$erro = $validador->getErro();
			if (!is_null($erro)) {
				$aviso = $erro;
			} else {
				$aviso = "Erro de sistema!";
			}
		}
	}
	/*---------Data de Conclusao-----------*/
	if(is_null ($aviso)) {
		if (!$validador->isPreenchido($dataConclusao)) {
			if($validador->isData($dataConclusao)) {						
				$dataConclusaoBD = $validador->converteData ($dataConclusao);
			} else { //nao eh uma data valida
				$erro = $validador->getErro();
				if (!is_null($erro)) {
					$aviso = $erro;
				} else {
					$aviso = "Erro de sistema!";
				}
			}
		} else { //se nao esta preenchido	
			$dataConclusaoBD = "0000-00-00";
		}
	}
	/*----------Verifica se tem avisos----------*/
	if (!is_null($aviso)) {
		header("Location:dadosProfissionaisEdita.php?aviso=".$aviso.$location);
		exit();
	}
	/*-----------Editar expProfissional------------------*/
	$expProfissional = new ExpProfissional ($idExpProf, $idLogin, $idPessoa, $empresa, $tipo, $atividade, 
	$dataInicioBD, $dataConclusaoBD, $conexaoBD);
	$aviso = $expProfissional->edita();
	if ($aviso != sucesso) {
		header("Location:dadosProfissionaisEdita.php?aviso=".$aviso.$location);
	} else {
		header ("Location:dadosProfissionaisEdita.php?aviso=".$aviso);
	}
	exit();
?>