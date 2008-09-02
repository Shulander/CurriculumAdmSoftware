<?php
	require_once ("utils/BancoDados.php");
	require_once ("utils/sessao.php");
	include ("classes/ExpAcademica.php");
	include ("classes/Pessoa.php");
	include ("utils/Validador.php");
	restritoUsuario();
	$idLogin = $_SESSION['idLogin'] + 0;
	$ingles = $_POST['ingles'];
	$espanhol = $_POST['espanhol'];
	$italiano = $_POST['italiano'];
	$frances = $_POST['frances'];
	$alemao = $_POST['alemao'];
	$outro1 = $_POST['outro1'];
	$outro1Nivel = $_POST['outro1Nivel'];
	$outro2 = $_POST['outro2'];
	$outro2Nivel = $_POST['outro2Nivel'];
	$word = $_POST['word'];
	$excel = $_POST['excel'];
	$powerpoint = $_POST['powerpoint'];
	$location = "&ingles=".$ingles."&espanhol=".$espanhol."&italiano=".$italiano."&frances=".$frances
	."&alemao=".$alemao."&outro1=".$outro1."&outro1Nivel=".$outro1Nivel."&outro2=".$outro2.
	"&outro2Nivel=".$outro2Nivel."&word=".$word."&excel=".$excel."&powerpoint=".$powerpoint;
	$conexaoBD = new BancoDados ();
	//verifica se a conexao ao banco de dados ocorreu corretamente
	if (!$conexaoBD->conecta()) {
		$aviso = "Erro de sistema! Contate o administrador do sistema!";
		header("Location:habilidades.php?aviso=".$aviso.$location);
		exit();
	}
	//Busca idPessoa
	$pessoa = new Pessoa ($idLogin, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", 0, $conexaoBD);
	$resultado = $pessoa->busca();
	if ($resultado == true) {
		$idPessoa = $pessoa->getId ();
	} else {
		$aviso = "Erro de sistema! Contate o administrador do sistema!";
		header("Location:habilidades.php?aviso=".$aviso.$location);
		exit();
	}
	$aviso = null;
	$validador = new Validador ();
	/*------------Ingles----------------*/
	if(is_null ($aviso)) {		
		if (!$validador->isSelecionado($ingles)) {
			$aviso = "Й necessбrio selecionar uma opзгo no campo 'Inglкs'!";	
		}
	}
	/*------------Espanhol----------------*/
	if(is_null ($aviso)) {		
		if (!$validador->isSelecionado($espanhol)) {
			$aviso = "Й necessбrio selecionar uma opзгo no campo 'Espanhol'!";	
		}
	}
	/*------------Italiano----------------*/
	if(is_null ($aviso)) {		
		if (!$validador->isSelecionado($italiano)) {
			$aviso = "Й necessбrio selecionar uma opзгo no campo 'Italiano'!";	
		}
	}
	/*------------Frances----------------*/
	if(is_null ($aviso)) {		
		if (!$validador->isSelecionado($frances)) {
			$aviso = "Й necessбrio selecionar uma opзгo no campo 'Francкs'!";	
		}
	}
	/*------------Alemao----------------*/
	if(is_null ($aviso)) {		
		if (!$validador->isSelecionado($alemao)) {
			$aviso = "Й necessбrio selecionar uma opзгo no campo 'Alemгo'!";	
		}
	}
	/*---------Outro1-----------*/
	if(is_null ($aviso)) {
		if ($validador->isSelecionado($outro1Nivel) && !$validador->isPreenchido($outro1)) {
			$aviso = "Й necessбrio preencher o campo 'Outro'!";	
		}
		if (!$validador->isSelecionado($outro1Nivel) && $validador->isPreenchido($outro1)) {
			$aviso = "Й necessбrio selecionar o nнvel do campo 'Outro'!";	
		}
	}
	/*---------Outro2-----------*/
	if(is_null ($aviso)) {
		if ($validador->isSelecionado($outro2Nivel) && !$validador->isPreenchido($outro2)) {
			$aviso = "Й necessбrio preencher o campo 'Outro'!";	
		}
		if (!$validador->isSelecionado($outro2Nivel) && $validador->isPreenchido($outro2)) {
			$aviso = "Й necessбrio selecionar o nнvel do campo 'Outro'!";	
		}
	}
	/*------------word----------------*/
	if(is_null ($aviso)) {		
		if (!$validador->isSelecionado($word)) {
			$aviso = "Й necessбrio selecionar uma opзгo no campo 'Word'!";	
		}
	}
	/*------------excel----------------*/
	if(is_null ($aviso)) {		
		if (!$validador->isSelecionado($excel)) {
			$aviso = "Й necessбrio selecionar uma opзгo no campo 'Excel'!";	
		}
	}
	/*------------powerpoint----------------*/
	if(is_null ($aviso)) {		
		if (!$validador->isSelecionado($powerpoint)) {
			$aviso = "Й necessбrio selecionar uma opзгo no campo 'Powerpoint'!";	
		}
	}
	/*----------Verifica se tem avisos----------*/
	if (!is_null($aviso)) {
		header("Location:habilidades.php?aviso=".$aviso.$location);
		exit();
	}
	/*-----------Inserir habilidades------------------*/
	$sql = "UPDATE pessoa SET ingles='".$ingles."',espanhol='".$espanhol."',italiano='".$italiano."',
	frances='".$frances."',alemao='".$alemao."',outro1='".$outro1."',outro2='".$outro2."',
	outro1Nivel='".$outro1Nivel."',outro2Nivel='".$outro2Nivel."',word='".$word."',
	excel='".$excel."',powerpoint='".$powerpoint."' WHERE id=".$idPessoa;
	$resultado = mysql_query($sql, $conexaoBD->getLink()); 
	if (!$resultado) {
    	$aviso = "Erro no inserзгo das habilidades!".mysql_error();
	} else {
		$aviso = "sucesso";
	}
	if ($aviso != sucesso) {	
		header("Location:habilidades.php?aviso=".$aviso.$location);
		exit();
	} else {
		header ("Location:habilidades.php?aviso=".$aviso);
	}
	exit();
?>