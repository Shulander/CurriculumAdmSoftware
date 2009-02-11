<?php
	require_once ("utils/sessao.php");
	require_once ("utils/BancoDados.php");
	require_once ("utils/sessao.php");
	include ("utils/Validador.php");
	include ("classes/Horario.php");
	restritoUsuario ();	
	$idLogin = $_SESSION['idLogin'];

	$data = $_POST['data'];
	$hora = $_POST['hora'];
	$area = $_POST['area'];
	$tipo = $_POST['tipo'];
	$conexaoBD = new BancoDados ();
	$aviso = "";
	$location = "&data=".$data."&hora=".$hora."&area=".$area."&tipo=".$tipo;
	//verifica se a conexao ao banco de dados ocorreu corretamente
	if (!$conexaoBD->conecta()) {
		$aviso = "Erro de sistema! Contate o administrador do sistema!";
		header("Location:entrevistaInsere.php?aviso=".$aviso.$location);
		exit();
	}
	$aviso = null;
	$validador = new Validador ();
	/*---------Data-----------*/	
	if(is_null ($aviso)) {
		if (!$validador->isPreenchido($data)) {
			$aviso = "Щ necessсrio preencher o campo 'Data'!";	
		} else if($validador->isData2($data)) {
			$dataBD = $validador->converteData ($data);	
		} else {
			$erro = $validador->getErro();
			if (!is_null($erro)) {
				$aviso = $erro;
			} else {
				$aviso = "Erro de sistema!";
			}
		}
	}
	/*---------Hora-----------*/	
	if(is_null ($aviso)) {
		if (!$validador->isSelecionado($hora)) {
			$aviso = "Щ necessсrio selecionar uma opчуo do campo 'Hora'!";	
		}
	}
	/*---------Area-----------*/	
	if(is_null ($aviso)) {
		if (!$validador->isSelecionado($area)) {
			$aviso = "Щ necessсrio selecionar uma opчуo do campo 'Сrea'!";	
		}
	}
	/*---------Tipo-----------*/	
	if(is_null ($aviso)) {
		if (!$validador->isSelecionado($tipo)) {
			$aviso = "Щ necessсrio selecionar uma opчуo do campo 'Tipo'!";	
		}
	}
	/*----------Verifica se tem avisos----------*/
	if (!is_null($aviso)) {
		header("Location:entrevistaInsere.php?aviso=".$aviso.$location);
		exit ();
	}	
	/*-----------Inserir horario------------------*/

	$horario = new Horario (0, 0, 0, $area, $tipo, $dataBD, $hora, "sim", $conexaoBD);
	$aviso = $horario->insereEntrevista();
	if ($aviso != sucesso) {
		header("Location:entrevistaInsere.php?aviso=".$aviso.$location);
	} else {
		header("Location:entrevistaInsere.php?aviso=".$aviso);
	}
	exit();
?>