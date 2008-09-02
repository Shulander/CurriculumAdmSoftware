<?php
	require_once ("utils/BancoDados.php");
	require_once ("utils/sessao.php");
	include ("classes/ExpAcademica.php");
	include ("classes/Pessoa.php");
	include ("utils/Validador.php");
	restritoUsuario();
	$idLogin = $_SESSION['idLogin'] + 0;
	$pergunta1 = $_POST['pergunta1'];
	$pergunta2 = $_POST['pergunta2'];
	$pergunta3 = $_POST['pergunta3'];
	if (isset($_POST['pergunta4'])) {
		$pergunta4 = $_POST['pergunta4'];	
	} else {
		$pergunta4 = "";
	}
	if (isset($_POST['pergunta5'])) {
		$pergunta5 = $_POST['pergunta5'];
		$pergunta5Erro = serialize(array_flip($pergunta5));	
	} else {
		$aviso = "É necessário selecionar pelo menos uma opção na pergunta 5'!";
		$pergunta5Erro = serialize(array());
	}
	if (isset($_POST['pergunta6'])) {
		$pergunta6 = $_POST['pergunta6'];	
	} else {
		$pergunta6 = "";
	}
	$outro1 = $_POST['outro1'];
	$outro2 = $_POST['outro2'];
	$outro3 = $_POST['outro3'];
	$recomendador = $_POST['recomendador'];
	$location = "&pergunta1=".$pergunta1."&pergunta2=".$pergunta2."&pergunta3=".$pergunta3."&pergunta4=".$pergunta4
	."&pergunta5=".$pergunta5Erro."&pergunta6=".$pergunta6."&outro1=".$outro1."&outro2=".$outro2.
	"&outro3=".$outro3."&recomendador=".$recomendador;
	$conexaoBD = new BancoDados ();
	//verifica se a conexao ao banco de dados ocorreu corretamente
	if (!$conexaoBD->conecta()) {
		$aviso = "Erro de sistema! Contate o administrador do sistema!";
		header("Location:dadosExtras.php?aviso=".$aviso.$location);
		exit();
	}
	//Busca idPessoa
	$pessoa = new Pessoa ($idLogin, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", 0, $conexaoBD);
	$resultado = $pessoa->busca();
	if ($resultado == true) {
		$idPessoa = $pessoa->getId ();
	} else {
		$aviso = "Erro de sistema! Contate o administrador do sistema!";
		header("Location:dadosExtras.php?aviso=".$aviso.$location);
		exit();
	}
	if(empty($aviso)) {
		$aviso = null;
	}
	$validador = new Validador ();
	/*------------Pergunta 4----------------*/
	if(is_null ($aviso)) {		
		if (!$validador->isPreenchido($pergunta4)) {
			$aviso = "É necessário selecionar uma opção na pergunta 4'!";	
		} else if ($pergunta4 == "Outro") {
			if (!$validador->isPreenchido($outro1)) {
				$aviso = "É necessário responder a pergunta 4'!";
			} else {
				$pergunta4 = $outro1;
			}
		} else {
			$outro1 = "";
		}
	}
	/*------------Pergunta 5----------------*/
	$pergunta5Text = "";
	if(is_null ($aviso)) {
		if (is_array($pergunta5)) {
			$pergunta5Aux = $pergunta5;
			for ($i = 0; $i < count($pergunta5); $i++) {
				if ($pergunta5[$i] == "Outro") {
					if (!$validador->isPreenchido($outro2)) {
						$aviso = "É necessário responder a pergunta 5'!";
					} else {
						$pergunta5Aux[$i] = $outro2;
					}

				}
			}
			$pergunta5Text = implode($pergunta5Aux,",");
		}
	}
	/*------------Pergunta 6----------------*/
	if(is_null ($aviso)) {
		if (!$validador->isPreenchido($pergunta6)) {
			$aviso = "É necessário selecionar pelo menos uma opção na pergunta 6'!";	
		} else if ($pergunta6 == "Outro") {
			$recomendador = "";
			if (!$validador->isPreenchido($outro3)) {
				$aviso = "É necessário responder a pergunta 6'!";
			} else {
				$pergunta6 = $outro3;
			}
		} else if ($pergunta6 == "membro_alumnus") {
			$outro3 = "";
			if (!$validador->isPreenchido($recomendador)) {
				$aviso = "É necessário preencher o nome da pessoa que recomendou a AIESEC na pergunta 6'!";
			}
		} else {
			$outro3 = "";
			$recomendador = "";
		}
	}
	/*----------Verifica se tem avisos----------*/
	if (!is_null($aviso)) {
		header("Location:dadosExtras.php?aviso=".$aviso.$location);
		exit();
	}
	/*-----------Inserir dadosExtras------------------*/
	$sql = "UPDATE pessoa SET pergunta1='".$pergunta1."',pergunta2='".$pergunta2."',pergunta3='".$pergunta3."',
	pergunta4='".$pergunta4."',pergunta5='".$pergunta5Text."',pergunta6='".$pergunta6."',recomendador='".$recomendador."' 
	WHERE id=".$idPessoa;
	$resultado = mysql_query($sql, $conexaoBD->getLink()); 
	if (!$resultado) {
		if (!empty($outro1)) {
			$pergunta4 = $outro1;
		}
		if (!empty($outro3)) {
			$pergunta6 = $outro3;
		}
    	$aviso = "Erro no inserção da pesquisa de imagem!".mysql_error();
    	header("Location:dadosExtras.php?aviso=".$aviso.$location);
	} else {
		$aviso = "sucesso";
		header ("Location:dadosExtras.php?aviso=".$aviso);
	}
	exit();
?>