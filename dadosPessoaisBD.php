<?php
	require_once ("utils/BancoDados.php");
	require_once ("utils/sessao.php");
	include ("classes/Pessoa.php");
	include ("utils/Validador.php");
	restritoUsuario();
	$idLogin = $_SESSION['idLogin'] + 0;
	$nome = $_POST['nome'];
	$dataNascimento = $_POST['dataNascimento'];
	$sexo = $_POST['sexo'];
	$cidade = $_POST['cidade'];
	$cidadeOutra = $_POST['cidadeOutra'];
	$estado = $_POST['estado'];
	$estadoOutro = $_POST['estadoOutro'];
	$telResidencial = $_POST['telResidencial'];
	$celular = $_POST['celular'];
	$msn = $_POST['msn'];
	$orkut = $_POST['orkut'];
	$conexaoBD = new BancoDados ();
	$location = "&nome=".$nome.
	"&dataNascimento=".$dataNascimento."&sexo=".$sexo.
	"&cidade=".$cidade."&cidadeOutra=".$cidadeOutra."&estado=".$estado."&estadoOutro=".$estadoOutro."&telResidencial=".$telResidencial.
	"&celular=".$celular."&msn=".$msn."&orkut=".$orkut;
	//verifica se a conexao ao banco de dados ocorreu corretamente
	if (!$conexaoBD->conecta()) {
		$aviso = "Erro de sistema! Contate o administrador do sistema!";
		header("Location:dadosPessoais.php?aviso=".$aviso.$location);
		exit();
	}
	$aviso = null;
	$validador = new Validador ();
	/*------------Foto----------------*/
	if(is_null ($aviso)) {	
		if(isset($_FILES['foto']) && $_FILES['foto']['size'] >  0)
		{
			$fileName = $_FILES['foto']['name'];
			$tmpName  = $_FILES['foto']['tmp_name'];
			$fileSize = $_FILES['foto']['size'];
			$fileType = $_FILES['foto']['type'];
			
			$tiposPermitidosArquivo = array('image/jpeg' => 1,'image/gif' => 1,'image/png' => 1,'image/bmp' => 1);
			if(!isset($tiposPermitidosArquivo[$fileType])) {
				$aviso = "A imagem deve ser dos tipos jpg, gif, png, bmp!";
			} else {			
				$fp      = fopen($tmpName, 'r');
				$content = fread($fp, filesize($tmpName));
				$content = addslashes($content);
				fclose($fp);
				
				if(!get_magic_quotes_gpc())
				{
				    $fileName = addslashes($fileName);
				}
				
				$query = "REPLACE INTO fotos (fk_login, name, size, type, content ) ".
				"VALUES ('".$_SESSION['idLogin']."', '$fileName', '$fileSize', '$fileType', '$content')";
				
				mysql_query($query) or die('Error, query failed'. mysql_error());
			}
		} else {
			//verificar se ja existe foto cadastrada no bd
			$consulta = "SELECT * FROM fotos WHERE fk_login=".$idLogin;
			$resultado = mysql_query($consulta, $conexaoBD->getLink());
			$numLinhas = mysql_num_rows ($resultado);
			if ($numLinhas == 0) {
				$aviso = "Щ necessсrio adicionar uma foto ao cadastro!";
			}
		}
	}
	/*------------Nome----------------*/
	if(is_null ($aviso)) {		
		if (!$validador->isPreenchido ($nome)) {
			$aviso = "Щ necessсrio preencher o campo 'Nome'!";	
		} else if (!$validador->comprimento($nome, 50)) {
			$aviso = "O campo 'Nome' deve possuir no mсximo 50 caracteres!";
		}
	}
	/*---------Data de Nascimento-----------*/	
	if(is_null ($aviso)) {
		if (!$validador->isPreenchido($dataNascimento)) {
				$aviso = "Щ necessсrio preencher o campo 'Data de Nascimento'!";	
		} else if($validador->isData($dataNascimento)) {
			if ($validador->isDataMinima($dataNascimento)) {
				$dataNascimentoBD = $validador->converteData ($dataNascimento);	
			} else {
				$erro = $validador->getErro();
				if (!is_null($erro)) {
					$aviso = $erro;
				} else {
					$aviso = "Erro de sistema!";
				}	
			}
		} else {
			$erro = $validador->getErro();
			if (!is_null($erro)) {
				$aviso = $erro;
			} else {
				$aviso = "Erro de sistema!";
			}
		}
	}
	/*---------Sexo-----------*/	
	if(is_null ($aviso)) {
		if (!$validador->isSelecionado($sexo)) {
			$aviso = "Щ necessсrio selecionar uma opчуo do campo 'Sexo'!";	
		} else if(!$validador->isLetra($sexo)) {
			$aviso = "Campo 'Sexo' invсlido!";
		} else if ($sexo != "Feminino" && $sexo != "Masculino") {
			$aviso = "O campo 'Sexo' deve possuir valor 'Feminino' ou 'Masculino'!";
		}
	}
	/*---------Cidade-----------*/
	if(is_null ($aviso)) {
		if ($cidade == "Outra") {
			if (!$validador->isPreenchido($cidadeOutra)) {
				$aviso = "Щ necessсrio preencher o campo 'Cidade'!";	
			} else {
				if (!$validador->comprimento($cidadeOutra, 30)) {
					$aviso = "O campo 'Cidade' deve possuir no mсximo 30 caracteres!";	
				} else {
					$cidade = $cidadeOutra;
				}
			}
		}
	}
	/*---------Estado-----------*/
	if(is_null ($aviso)) {
		if ($estado == "Outro") {
			if (!$validador->isPreenchido($estadoOutro)) {
				$aviso = "Щ necessсrio preencher o campo 'Estado'!";	
			} else {
				if (!$validador->comprimento($estadoOutro, 30)) {
					$aviso = "O campo 'Estado' deve possuir no mсximo 30 caracteres!";	
				} else {
					$estado = $estadoOutro;
				}
			}
		}
	}
	/*------------telResidencial----------------*/
	if(is_null ($aviso)) {
		if (!empty ($telResidencial)) {
			if (!$validador->comprimento($telResidencial, 16)) {
				$aviso = "O campo 'Telefone Residencial' deve possuir no mсximo 16 caracteres!";
			}/* else if (isTelefone($telResidencial)) {
				$aviso = "Campo 'Telefone Residencial' invсlido!";
			}*/
		}
	}
	/*------------celular----------------*/
	if(is_null ($aviso)) {
		if (!$validador->isPreenchido ($celular)) {
			$aviso = "Щ necessсrio preencher o campo 'Celular'!";	
		} else if (!$validador->comprimento($celular, 16)) {
			$aviso = "O campo 'Celular' deve possuir no mсximo 16 caracteres!";
		}/* else if (!$validador->isTelefone($telResidencial)) {
			$aviso = "Campo 'Telefone Residencial' invсlido!";
		}*/
	}
	/*------------MSN----------------*/
	if(is_null ($aviso)) {		
		if (!$validador->isPreenchido ($msn)) {
			$aviso = "Щ necessсrio preencher o campo 'MSN'!";	
		} else if (!$validador->comprimento($msn, 50)) {
			$aviso = "O campo 'MSN' deve possuir no mсximo 50 caracteres!";
		} else if (!$validador->isEmail($msn)) {
			$aviso = "Campo 'MSN' invсlido!";
		}
	}	
	/*----------Verifica se tem avisos----------*/
	if (!is_null($aviso)) {
		if (!empty ($cidadeOutra)) {
			$cidade = "outra";
		}
		if (!empty ($estadoOutro)) {
			$estado = "outro";
		}
		header("Location:dadosPessoais.php?aviso=".$aviso.$location);
		exit ();
	}
	/*-----------Inserir pessoa------------------*/
	$pessoa = new Pessoa ($idLogin, $nome, "", $dataNascimentoBD, $sexo, "", "", 0, "", "", 0, $cidade, $estado, $telResidencial,
	$celular, $msn, $orkut, 0, $conexaoBD);	
	$pessoaExiste = $pessoa->buscaPorIdUsuario ();
	if ($pessoaExiste != true) {	
		$aviso = $pessoa->insere();
	} else {
		$aviso = $pessoa->edita();
	} 
	if ($aviso != sucesso) {
		if (!empty ($cidadeOutra)) {
			$cidade = "outra";
		}
		if (!empty ($estadoOutro)) {
			$estado = "outro";
		}
		header("Location:dadosPessoais.php?aviso=".$aviso.$location);
	} else {
		$result = $pessoa->alteraDadosPessoaisBD (1);
		if ($result == "sucesso") {
			header ("Location:dadosEducacionais.php?aviso=".$aviso);
		} else {
			$aviso = "Erro de sistema! Contate o administrador do sistema!";
			header("Location:dadosPessoais.php?aviso=".$aviso.$location);
		}
	}
	$conexaoBD->desconecta ();
	exit();
	?>