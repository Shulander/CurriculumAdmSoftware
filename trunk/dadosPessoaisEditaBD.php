<?php
	require_once ("utils/BancoDados.php");
	require_once ("utils/sessao.php");
	include ("classes/Pessoa.php");
	include ("utils/Validador.php");
	restritoUsuario();
	$idLogin = $_SESSION['idLogin'] + 0;
	$nome = $_POST['nome'];
	/*$nacionalidade = $_POST['nacionalidade'];
	$nacionalidadeEstrangeira = $_POST['nacionalidadeEstrangeira'];*/
	$dataNascimento = $_POST['dataNascimento'];
	$sexo = $_POST['sexo'];
	/*$estadoCivil = $_POST['estadoCivil'];
	/$endereco = $_POST['endereco'];
	$numero = $_POST['numero'];
	$complemento = $_POST['complemento'];
	$bairro = $_POST['bairro'];
	$cep = $_POST['cep'];*/
	$cidade = $_POST['cidade'];
	$cidadeOutra = $_POST['cidadeOutra'];
	$estado = $_POST['estado'];
	$estadoOutro = $_POST['estadoOutro'];
	$telResidencial = $_POST['telResidencial'];
	$celular = $_POST['celular'];
	$conexaoBD = new BancoDados ();
	$location = "&nome=".$nome.
	/*"&nacionalidade=".$nacionalidade."&nacionalidadeEstrangeira=".$nacionalidadeEstrangeira.*/
	"&dataNascimento=".$dataNascimento."&sexo=".$sexo.
	/*"&estadoCivil=".$estadoCivil."&endereco=".$endereco."&numero=".$numero."&complemento=".$complemento."&bairro=".$bairro."&cep=".$cep.*/
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
	/*------------Nome----------------*/
	if(is_null ($aviso)) {		
		if (!$validador->isPreenchido ($nome)) {
			$aviso = "É necessário preencher o campo 'Nome'!";	
		} else if (!$validador->comprimento($nome, 50)) {
			$aviso = "O campo 'Nome' deve possuir no máximo 50 caracteres!";
		}
	}
	/*---------Nacionalidade-----------*/
	/*
	if(is_null ($aviso)) {
		if (!$validador->isPreenchido($nacionalidade)) {
			$aviso = "É necessário preencher o campo 'Nacionalidade'!";	
		}
	}
	if(is_null ($aviso)) {
		if ($nacionalidade == "estrangeira") {
			if (!$validador->isPreenchido($nacionalidadeEstrangeira)) {
				$aviso = "É necessário preencher o campo 'Nacionalidade'!";	
			} else {
				if (!$validador->comprimento($nacionalidadeEstrangeira, 30)) {
					$aviso = "O campo 'Nacionalidade' deve possuir no máximo 30 caracteres!";	
				} else {
					$nacionalidade = $nacionalidadeEstrangeira;
				}
			}
		}
	}*/
	/*---------Data de Nascimento-----------*/	
	if(is_null ($aviso)) {
		if (!$validador->isPreenchido($dataNascimento)) {
				$aviso = "É necessário preencher o campo 'Data de Nascimento'!";	
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
			$aviso = "É necessário selecionar uma opção do campo 'Sexo'!";	
		} else if(!$validador->isLetra($sexo)) {
			$aviso = "Campo 'Sexo' inválido!";
		} else if ($sexo != "Feminino" && $sexo != "Masculino") {
			$aviso = "O campo 'Sexo' deve possuir valor 'Feminino' ou 'Masculino'!";
		}
	}
	/*---------Estado Civil------------*/
	/*
	if(is_null ($aviso)) {
		if (!$validador->isSelecionado($estadoCivil)) {
			$aviso = "É necessário selecionar uma opção do campo 'Estado civil'!";	
		}
	}*/
	/*------------Endereco----------------*/
	/*if(is_null ($aviso)) {
		if (!$validador->isPreenchido ($endereco)) {
			$aviso = "É necessário preencher o campo 'Endereço'!";	
		} else if (!$validador->comprimento($endereco, 50)) {
			$aviso = "O campo 'Endereço' deve possuir no máximo 50 caracteres!";
		}
	}*/
	/*------------Numero----------------*/
	/*
	if(is_null ($aviso)) {
		if (!$validador->isPreenchido ($numero)) {
			$aviso = "É necessário preencher o campo 'Numero'!";	
		} else if (!$validador->comprimento($numero, 10)) {
			$aviso = "O campo 'Número' deve possuir no máximo 10 caracteres!";
		} else if (!$validador->isNumero($numero)) {
			$aviso = "O campo 'Número' deve possuir valor numérico!";
		}
	}*/
	/*------------Complemento----------------*/
	/*
	if(is_null ($aviso)) {
		if (!empty ($complemento)) {
			if (!$validador->comprimento($complemento, 50)) {
				$aviso = "O campo 'Complemento' deve possuir no máximo 50 caracteres!";
			}
		}
	}*/
	/*------------Bairro----------------*/
	/*
	if(is_null ($aviso)) {
		if (!empty ($bairro)) {
			if (!$validador->comprimento($bairro, 50)) {
				$aviso = "O campo 'Bairro' deve possuir no máximo 50 caracteres!";
			}
		}
	}*/
	/*------------CEP----------------*/
	/*
	if(is_null ($aviso)) {
		if (!$validador->isPreenchido ($cep)) {
			$aviso = "É necessário preencher o campo 'CEP'!";	
		} else if (!$validador->comprimento($cep, 8)) {
			$aviso = "O campo 'CEP' deve possuir no máximo 10 caracteres!";
		} else if (!$validador->isNumero($cep)) {
			$aviso = "O campo 'CEP' deve possuir valor numérico!";
		}
	}*/
	/*---------Cidade-----------*/
	if(is_null ($aviso)) {
		if (!$validador->isPreenchido($cidade)) {
			$aviso = "É necessário preencher o campo 'Cidade'!";	
		}
	}
	if(is_null ($aviso)) {
		if ($cidade == "outra") {
			if (!$validador->isPreenchido($cidadeOutra)) {
				$aviso = "É necessário preencher o campo 'Cidade'!";	
			} else {
				if (!$validador->comprimento($cidadeOutra, 30)) {
					$aviso = "O campo 'Cidade' deve possuir no máximo 30 caracteres!";	
				} else {
					$cidade = $cidadeOutra;
				}
			}
		}
	}
	/*---------Estado-----------*/
	if(is_null ($aviso)) {
		if (!$validador->isPreenchido($estado)) {
			$aviso = "É necessário preencher o campo 'Estado'!";	
		}
	}
	if(is_null ($aviso)) {
		if ($estado == "outro") {
			if (!$validador->isPreenchido($estadoOutro)) {
				$aviso = "É necessário preencher o campo 'Estado'!";	
			} else {
				if (!$validador->comprimento($estadoOutro, 30)) {
					$aviso = "O campo 'Estado' deve possuir no máximo 30 caracteres!";	
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
				$aviso = "O campo 'Telefone Residencial' deve possuir no máximo 16 caracteres!";
			}/* else if (isTelefone($telResidencial)) {
				$aviso = "Campo 'Telefone Residencial' inválido!";
			}*/
		}
	}
	/*------------celular----------------*/
	if(is_null ($aviso)) {
		if (!$validador->isPreenchido ($celular)) {
			$aviso = "É necessário preencher o campo 'Celular'!";	
		} else if (!$validador->comprimento($celular, 16)) {
			$aviso = "O campo 'Celular' deve possuir no máximo 16 caracteres!";
		}/* else if (!$validador->isTelefone($telResidencial)) {
			$aviso = "Campo 'Telefone Residencial' inválido!";
		}*/
	}
	/*------------MSN----------------*/
	if(is_null ($aviso)) {		
		if (!$validador->isPreenchido ($msn)) {
			$aviso = "É necessário preencher o campo 'MSN'!";	
		} else if (!$validador->comprimento($msn, 50)) {
			$aviso = "O campo 'MSN' deve possuir no máximo 50 caracteres!";
		} else if (!$validador->isEmail($msn)) {
			$aviso = "Campo 'MSN' inválido!";
		}
	}	
	/*------------Orkut----------------*/
	if(is_null ($aviso)) {		
		if (!$validador->isPreenchido ($orkut)) {
			$aviso = "É necessário preencher o campo 'Perfil do Orkut'!";	
		} else if (!$validador->comprimento($orkut, 50)) {
			$aviso = "O campo 'Perfil do Orkut' deve possuir no máximo 200 caracteres!";
		}
	}
	/*------------foto----------------*/
	if(is_null ($aviso)) {
		if(isset($_FILES['foto']))
		{
			echo "<pre>";
			var_dump ($_FILES);
			exit ();
			if ($_FILES['foto']['error'] == UPLOAD_ERR_FORM_SIZE) {
				$aviso = 'Tamanho da imagem excedeu o limite de 2 Mbytes permitido. Reduza o tamanho da imagem.';
			} else if($_FILES['foto']['size'] > 0) {
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
			}
		} else {
			//verifica se existe uma foto cadastrada

			$aviso = "É necessário adicionar uma foto ao cadastro!";
		}
	}
	/*----------Verifica se tem avisos----------*/
	if (!is_null($aviso)) {
		/*if (!empty ($nacionalidadeEstrangeira)) {
			$nacionalidade = "estrangeira";
		}*/
		if (!empty ($cidadeOutra)) {
			$cidade = "outra";
		}
		if (!empty ($estadoOutro)) {
			$estado = "outro";
		}
		header("Location:dadosPessoais.php?aviso=".$aviso.$location);
		exit ();
	}

	/*-----------Editar pessoa------------------*/
	$pessoa = new Pessoa ($idLogin, $nome, "", $dataNascimentoBD, $sexo, "", "", 0, "", "", 0, $cidade, $estado, $telResidencial,
	$celular, $msn, $orkut, 0, $conexaoBD);
	$aviso = $pessoa->edita();
	if ($aviso != sucesso) {
		/*if (!empty ($nacionalidadeEstrangeira)) {
			$nacionalidade = "estrangeira";
		}*/
		if (!empty ($cidadeOutra)) {
			$cidade = "outra";
		}
		if (!empty ($estadoOutro)) {
			$estado = "outro";
		}
		header("Location:dadosPessoais.php?aviso=".$aviso.$location);
	} else {
		header ("Location:dadosEducacionais.php?aviso=".$aviso);
	}
	$conexaoBD->desconecta ();
	exit();
?>