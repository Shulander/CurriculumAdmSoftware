<?php
	require_once ("utils/BancoDados.php");
	require_once ("utils/sessao.php");
	include ("classes/ExpAcademica.php");
	include ("classes/Pessoa.php");
	include ("utils/Validador.php");
	restritoUsuario();
	$idLogin = $_SESSION['idLogin'] + 0;
	$instituicao = $_POST['instituicao'];
	$instituicaoOutra = $_POST['instituicaoOutra'];
	$curso = $_POST['curso'];
	$cursoOutro = $_POST['cursoOutro'];
	$turno = $_POST['turno'];
	$semestre = $_POST['semestre'];
	$dataIngresso = $_POST['dataIngresso'];
	$dataConclusao = $_POST['dataConclusao'];
	$tipo = $_POST['tipo'];
	$location = "&instituicao=".$instituicao."&curso=".$curso.
		"&instituicaoOutra=".$instituicaoOutra."&cursoOutro=".$cursoOutro."&tipo=".$tipo."&turno=".$turno."&semestre=".$semestre.
		"&dataIngresso=".$dataIngresso."&dataConclusao=".$dataConclusao;
	$conexaoBD = new BancoDados ();
	//verifica se a conexao ao banco de dados ocorreu corretamente
	if (!$conexaoBD->conecta()) {
		$aviso = "Erro de sistema! Contate o administrador do sistema!";
		header("Location:dadosEducacionaisInsere.php?aviso=".$aviso.$location);
		exit();
	}
	//Busca idPessoa
	$pessoa = new Pessoa ($idLogin, "", "", "", "", "", "", 0, "", "", 0, "", "", "", "", "", "", 0, $conexaoBD);
	$resultado = $pessoa->busca();
	if ($resultado == true) {
		$idPessoa = $pessoa->getId ();
	} else {
		$aviso = "Erro de sistema! Contate o administrador do sistema!";
		header("Location:dadosEducacionaisInsere.php?aviso=".$aviso.$location);
		exit();
	}
		$aviso = null;
	$validador = new Validador ();
	/*------------Instituicao----------------*/
	if(is_null ($aviso)) {		
		if (!$validador->isSelecionado($instituicao)) {
			$aviso = "Й necessбrio selecionar uma opзгo no campo 'Instituiзгo'!";	
		} 
		if ($instituicao == "outra") {
			if (!$validador->isPreenchido($instituicaoOutra)) {
				$aviso = "Й necessбrio preencher o campo 'Instituiзгo'!";	
			} else {
				if (!$validador->isPreenchido($cursoOutro)) {
					$aviso = "Й necessбrio preencher o campo 'Curso'!";
				} else {
					$instituicao = $instituicaoOutra;
					$curso = $cursoOutro;
				}
			}
		}
	}
	/*---------Curso-----------*/
	if(is_null ($aviso)) {
		if (!$validador->isSelecionado($curso)) {
			$aviso = "Й necessбrio selecionar uma opзгo no campo 'Curso'!";	
		}
	}
	/*------------Tipo----------------*/
	if(is_null ($aviso)) {		
		if (!$validador->isSelecionado($tipo)) {
			$aviso = "Й necessбrio selecionar uma opзгo no campo 'Tipo'!";	
		} 
	}
	/*---------Data de Ingresso-----------*/	
	if(is_null ($aviso)) {
		if (!$validador->isPreenchido($dataIngresso)) {
			$aviso = "Й necessбrio preencher o campo 'Data de Ingresso'!";	
		} else if($validador->isData($dataIngresso)) {						
			$dataIngressoBD = $validador->converteData ($dataIngresso);
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
			$aviso = "Й necessбrio preencher o campo 'Data de Conclusгo'!";	
		} else if($validador->isData($dataConclusao)) {						
			$dataConclusaoBD = $validador->converteData ($dataConclusao);
		} else {
			$erro = $validador->getErro();
			if (!is_null($erro)) {
				if ($erro != "A data deve ser anterior a data atual!") {
					$aviso = $erro;
				} else {
					$dataConclusaoBD = $validador->converteData ($dataConclusao);
				}
			} else {
				$aviso = "Erro de sistema!";
			}
		}
	}
	//compara as datas
	if (is_null($aviso)) {
		if (!$validador->comparaDatas($dataIngresso,$dataConclusao)) {
			$aviso = "A data de ingresso deve ser anterior a data de conclusгo!";
		}
	}
	/*---------Semestre------------*/
	if(is_null ($aviso)) {
		if ($validador->isPreenchido ($semestre)) {
			if (!$validador->comprimento($semestre, 2)) {
				$aviso = "O campo 'Semestre' deve possuir no mбximo 2 dнgitos!";
			} else if (!$validador->isNumero($semestre)) {
				$aviso = "O campo 'Semestre' deve possuir valor numйrico!";
			}
		}
	}
	/*----------Verifica se tem avisos----------*/
	if (!is_null($aviso)) {
		if (!empty ($instituicaoOutra)) {
			$instituicao = "outra";
		}
		header("Location:dadosEducacionaisInsere.php?aviso=".$aviso.$location);
		exit();
	}
	/*-----------Inserir expAcademica------------------*/
	$expAcademica = new ExpAcademica (0, $idLogin, $idPessoa, $curso, $tipo, $instituicao, $turno, $semestre, 
	$dataIngressoBD, $dataConclusaoBD, $conexaoBD);
	$aviso = $expAcademica->insere();
	if ($aviso != sucesso) {
		if (!empty ($instituicaoOutra)) {
			$instituicao = "outra";
		}
		if (!empty ($cursoOutro)) {
			$curso = "outro";
		}
		header("Location:dadosEducacionaisInsere.php?aviso=".$aviso.$location);
		exit();
	} else {
		$result = $pessoa->alteraDadosEducacionaisBD (1);
		if ($result == "sucesso") {
			$aviso = "sucesso1";
			header ("Location:dadosEducacionais.php?aviso=".$aviso);
		} else {
			header("Location:dadosEducacionaisInsere.php?aviso=".$aviso.$location);
		}
	}
	exit();
?>