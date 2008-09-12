<?php
	require_once ("utils/BancoDados.php");
	require_once ("utils/sessao.php");
	require_once ("classes/ExpAcademica.php");
	require_once ("classes/Pessoa.php");
	require_once ("classes/Usuario.php");
	require_once ("utils/Validador.php");
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
	$office = $_POST['office'];
	$webdesign = $_POST['webdesign'];
	$editorImagem = $_POST['editorImagem'];
	//testa se a variavel contabilidade existe
	if(isset($_POST['contabilidade'])) {
		$contabilidade = $_POST['contabilidade'];
		$contabilidadeErro = serialize(array_flip($contabilidade));
	} else {
		$contabilidade = "";
		$contabilidadeErro = serialize(array());	
	}
	//testa se a variavel administracao existe
	if(isset($_POST['administracao'])) {
		$administracao = $_POST['administracao'];
		$administracaoErro = serialize(array_flip($administracao));	
	} else {
		$administracao = "";
		$administracaoErro = serialize(array());	
	}//testa se a variavel economia existe
	if(isset($_POST['economia'])) {
		$economia = $_POST['economia'];
		$economiaErro = serialize(array_flip($economia));		
	} else {
		$economia = "";
		$economiaErro = serialize(array());	
	}//testa se a variavel financas existe
	if(isset($_POST['financas'])) {
		$financas = $_POST['financas'];
		$financasErro = serialize(array_flip($financas));	
	} else {
		$financas = "";
		$financasErro = serialize(array());	
	}//testa se a variavel recursosHumanos existe
	if(isset($_POST['recursosHumanos'])) {
		$recursosHumanos = $_POST['recursosHumanos'];
		$recursosHumanosErro = serialize(array_flip($recursosHumanos));	
	} else {
		$recursosHumanos = "";
		$recursosHumanosErro = serialize(array());	
	}//testa se a variavel tecnologiaInformacao existe
	if(isset($_POST['tecnologiaInformacao'])) {
		$tecnologiaInformacao = $_POST['tecnologiaInformacao'];
		$tecnologiaInformacaoErro = serialize(array_flip($tecnologiaInformacao));	
	} else {
		$tecnologiaInformacao = "";
		$tecnologiaInformacaoErro = serialize(array());	
	}//testa se a variavel marketing existe
	if(isset($_POST['marketing'])) {
		$marketing = $_POST['marketing'];
		$marketingErro = serialize(array_flip($marketing));	
	} else {
		$marketing = "";
		$marketingErro = serialize(array());	
	}//testa se a variavel outrosEstudos existe
	if(isset($_POST['outrosEstudos'])) {
		$outrosEstudos = $_POST['outrosEstudos'];
		$outrosEstudosErro = serialize(array_flip($outrosEstudos));	
	} else {
		$outrosEstudos = "";
		$outrosEstudosErro = serialize(array());	
	}
	$location = "&ingles=".$ingles."&espanhol=".$espanhol."&italiano=".$italiano."&frances=".$frances
	."&alemao=".$alemao."&outro1=".$outro1."&outro1Nivel=".$outro1Nivel."&outro2=".$outro2.
	"&outro2Nivel=".$outro2Nivel."&office=".$office."&webdesign=".$webdesign."&editorImagem=".$editorImagem.
	"&contabilidade=".$contabilidadeErro."&administracao=".$administracaoErro."&economia=".$economiaErro.
	"&financas=".$financasErro."&recursosHumanos=".$recursosHumanosErro.
	"&tecnologiaInformacao=".$tecnologiaInformacaoErro."&marketing=".$marketingErro."&outrosEstudos=".$outrosEstudosErro;
	$conexaoBD = new BancoDados ();
	//verifica se a conexao ao banco de dados ocorreu corretamente
	if (!$conexaoBD->conecta()) {
		$aviso = "Erro de sistema! Contate o administrador do sistema!";
		header("Location:habilidades.php?aviso=".$aviso.$location);
		exit();
	}
	//Busca idPessoa
	$pessoa = new Pessoa ($idLogin, "", "", "", "", "", "", "", "", "", "", "", "", "", "", 0, $conexaoBD);
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
	/*------------office----------------*/
	if(is_null ($aviso)) {		
		if (!$validador->isSelecionado($office)) {
			$aviso = "Й necessбrio selecionar uma opзгo no campo 'office'!";	
		}
	}
	/*------------webdesign----------------*/
	if(is_null ($aviso)) {		
		if (!$validador->isSelecionado($webdesign)) {
			$aviso = "Й necessбrio selecionar uma opзгo no campo 'webdesign'!";	
		}
	}
	/*------------editorImagem----------------*/
	if(is_null ($aviso)) {		
		if (!$validador->isSelecionado($editorImagem)) {
			$aviso = "Й necessбrio selecionar uma opзгo no campo 'editorImagem'!";	
		}
	}
	/*------------Contabilidade----------------*/
	$contabilidadeText = "";
	if(is_null ($aviso)) {
		if (is_array($contabilidade)) {
			$contabilidadeText = implode($contabilidade,",");
		}
	}
	/*------------Administracao----------------*/
	$administracaoText = "";
	if(is_null ($aviso)) {
		if (is_array($administracao)) {
			$administracaoText = implode($administracao,",");
		}
	}
	/*------------Economia----------------*/
	$economiaText = "";
	if(is_null ($aviso)) {
		if (is_array($economia)) {
			$economiaText = implode($economia,",");
		}
	}
	/*------------Financas----------------*/
	$financasText = "";
	if(is_null ($aviso)) {
		if (is_array($financas)) {
			$financasText = implode($financas,",");
		}
	}
	/*------------Recursos Humanos----------------*/
	$recursosHumanosText = "";
	if(is_null ($aviso)) {
		if (is_array($recursosHumanos)) {
			$recursosHumanosText = implode($recursosHumanos,",");
		}
	}
	/*------------Tecnologia da Informacao----------------*/
	$tecnologiaInformacaoText = "";
	if(is_null ($aviso)) {
		if (is_array($tecnologiaInformacao)) {
			$tecnologiaInformacaoText = implode($tecnologiaInformacao,",");
		}
	}
	/*------------Marketing----------------*/
	$marketingText = "";
	if(is_null ($aviso)) {
		if (is_array($marketing)) {
			$marketingText = implode($marketing,",");
		}
	}
	/*------------Outros Estudos----------------*/
	$outrosEstudosText = "";
	if(is_null ($aviso)) {
		if (is_array($outrosEstudos)) {
			$outrosEstudosText = implode($outrosEstudos,",");
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
	outro1Nivel='".$outro1Nivel."',outro2Nivel='".$outro2Nivel."',office='".$office."',
	webdesign='".$webdesign."',editorImagem='".$editorImagem."',contabilidade='".$contabilidadeText."',administracao='".$administracaoText."'
	,economia='".$economiaText."',financas='".$financasText."',recursosHumanos='".$recursosHumanosText."'
	,tecnologiaInformacao='".$tecnologiaInformacaoText."',marketing='".$marketingText."',outrosEstudos='".$outrosEstudosText."' WHERE id=".$idPessoa;

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
		$result = $pessoa->alteraHabilidadesBD(1);
		if ($result == "sucesso") {
			$aviso = "sucesso";
			header ("Location:dadosProfissionais.php?aviso=".$aviso);		
		} else {
			header("Location:habilidades.php?aviso=".$result.$location);
		}
	}
	$conexaoBD->desconecta();
	exit();
?>