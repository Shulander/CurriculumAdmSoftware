<?php
	require_once ("utils/BancoDados.php");
	require_once ("utils/sessao.php");
	include ("classes/Pessoa.php");
	include ("utils/Validador.php");
	restritoUsuario();
	$idLogin = $_SESSION['idLogin'] + 0;
	$nome = $_POST['nome'];
	$nacionalidade = $_POST['nacionalidade'];
	$nacionalidadeEstrangeira = $_POST['nacionalidadeEstrangeira'];
	$dataNascimento = $_POST['dataNascimento'];
	$sexo = $_POST['sexo'];
	$estadoCivil = $_POST['estadoCivil'];
	$endereco = $_POST['endereco'];
	$numero = $_POST['numero'];
	$complemento = $_POST['complemento'];
	$bairro = $_POST['bairro'];
	$cep = $_POST['cep'];
	$cidade = $_POST['cidade'];
	$cidadeOutra = $_POST['cidadeOutra'];
	$estado = $_POST['estado'];
	$estadoOutro = $_POST['estadoOutro'];
	$telResidencial = $_POST['telResidencial'];
	$celular = $_POST['celular'];
	$conexaoBD = new BancoDados ();
	$aviso = "";
	$location = "&nome=".$nome."&nacionalidade=".$nacionalidade.
		"&nacionalidadeEstrangeira=".$nacionalidadeEstrangeira."&dataNascimento=".$dataNascimento."&sexo=".$sexo.
		"&estadoCivil=".$estadoCivil."&endereco=".$endereco."&numero=".$numero."&complemento=".$complemento.
		"&bairro=".$bairro.	"&cep=".$cep."&cidade=".$cidade."&cidadeOutra=".$cidadeOutra."&estado=".$estado.
		"&estadoOutro=".$estadoOutro."&telResidencial=".$telResidencial."&celular=".$celular;
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
			$aviso = "� necess�rio preencher o campo 'Nome'!";	
		} else if (!$validador->comprimento($nome, 50)) {
			$aviso = "O campo 'Nome' deve possuir no m�ximo 50 caracteres!";
		}
	}
	/*---------Nacionalidade-----------*/
	if(is_null ($aviso)) {
		if (!$validador->isPreenchido($nacionalidade)) {
			$aviso = "� necess�rio preencher o campo 'Nacionalidade'!";	
		}
	}
	if(is_null ($aviso)) {
		if ($nacionalidade == "estrangeira") {
			if (!$validador->isPreenchido($nacionalidadeEstrangeira)) {
				$aviso = "� necess�rio preencher o campo 'Nacionalidade'!";	
			} else {
				if (!$validador->comprimento($nacionalidadeEstrangeira, 30)) {
					$aviso = "O campo 'Nacionalidade' deve possuir no m�ximo 30 caracteres!";	
				} else {
					$nacionalidade = $nacionalidadeEstrangeira;
				}
			}
		}
	}
	/*---------Data de Nascimento-----------*/	
	if(is_null ($aviso)) {
		if (!$validador->isPreenchido($dataNascimento)) {
			$aviso = "� necess�rio preencher o campo 'Data de Nascimento'!";	
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
			$aviso = "� necess�rio selecionar uma op��o do campo 'Sexo'!";	
		} else if(!$validador->isLetra($sexo)) {
			$aviso = "Campo 'Sexo' inv�lido!";
		} else if ($sexo != "Feminino" && $sexo != "Masculino") {
			$aviso = "O campo 'Sexo' deve possuir valor 'Feminino' ou 'Masculino'!";
		}
	}
	/*---------Estado Civil------------*/
	if(is_null ($aviso)) {
		if (!$validador->isSelecionado($estadoCivil)) {
			$aviso = "� necess�rio selecionar uma op��o do campo 'Estado civil'!";	
		} 
	}
	/*------------Endereco----------------*/
	if(is_null ($aviso)) {
		if (!$validador->isPreenchido ($endereco)) {
			$aviso = "� necess�rio preencher o campo 'Endere�o'!";	
		} else if (!$validador->comprimento($endereco, 50)) {
			$aviso = "O campo 'Endere�o' deve possuir no m�ximo 50 caracteres!";
		}
	}
	/*------------Numero----------------*/
	if(is_null ($aviso)) {
		if (!$validador->isPreenchido ($numero)) {
			$aviso = "� necess�rio preencher o campo 'Numero'!";	
		} else if (!$validador->comprimento($numero, 10)) {
			$aviso = "O campo 'N�mero' deve possuir no m�ximo 10 caracteres!";
		} else if (!$validador->isNumero($numero)) {
			$aviso = "O campo 'N�mero' deve possuir valor num�rico!";
		}
	}
	/*------------Complemento----------------*/
	if(is_null ($aviso)) {
		if (!empty ($complemento)) {
			if (!$validador->comprimento($complemento, 50)) {
				$aviso = "O campo 'Complemento' deve possuir no m�ximo 50 caracteres!";
			}
		}
	}
	/*------------Bairro----------------*/
	if(is_null ($aviso)) {
		if (!empty ($bairro)) {
			if (!$validador->comprimento($bairro, 50)) {
				$aviso = "O campo 'Bairro' deve possuir no m�ximo 50 caracteres!";
			}
		}
	}
	/*------------CEP----------------*/
	if(is_null ($aviso)) {
		if (!$validador->isPreenchido ($cep)) {
			$aviso = "� necess�rio preencher o campo 'CEP'!";	
		} else if (!$validador->comprimento($cep, 8)) {
			$aviso = "O campo 'CEP' deve possuir no m�ximo 10 caracteres!";
		} else if (!$validador->isNumero($cep)) {
			$aviso = "O campo 'CEP' deve possuir valor num�rico!";
		}
	}
	/*---------Cidade-----------*/
	if(is_null ($aviso)) {
		if (!$validador->isPreenchido($cidade)) {
			$aviso = "� necess�rio preencher o campo 'Cidade'!";	
		}
	}
	if(is_null ($aviso)) {
		if ($cidade == "outra") {
			if (!$validador->isPreenchido($cidadeOutra)) {
				$aviso = "� necess�rio preencher o campo 'Cidade'!";	
			} else {
				if (!$validador->comprimento($cidadeOutra, 30)) {
					$aviso = "O campo 'Cidade' deve possuir no m�ximo 30 caracteres!";	
				} else {
					$cidade = $cidadeOutra;
				}
			}
		}
	}
	/*---------Estado-----------*/
	if(is_null ($aviso)) {
		if (!$validador->isPreenchido($estado)) {
			$aviso = "� necess�rio preencher o campo 'Estado'!";	
		}
	}
	if(is_null ($aviso)) {
		if ($estado == "outro") {
			if (!$validador->isPreenchido($estadoOutro)) {
				$aviso = "� necess�rio preencher o campo 'Estado'!";	
			} else {
				if (!$validador->comprimento($estadoOutro, 30)) {
					$aviso = "O campo 'Estado' deve possuir no m�ximo 30 caracteres!";	
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
				$aviso = "O campo 'Telefone Residencial' deve possuir no m�ximo 16 caracteres!";
			}/* else if (isTelefone($telResidencial)) {
				$aviso = "Campo 'Telefone Residencial' inv�lido!";
			}*/
		}
	}
	/*------------celular----------------*/
	if(is_null ($aviso)) {
		if (!$validador->isPreenchido ($celular)) {
			$aviso = "� necess�rio preencher o campo 'Celular'!";	
		} else if (!$validador->comprimento($celular, 16)) {
			$aviso = "O campo 'Celular' deve possuir no m�ximo 16 caracteres!";
		}/* else if (!$validador->isTelefone($telResidencial)) {
			$aviso = "Campo 'Telefone Residencial' inv�lido!";
		}*/
	}
	/*------------foto----------------*/
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
			$aviso = "� necess�rio adicionar uma foto ao cadastro!";
		}
	}
	/*----------Verifica se tem avisos----------*/
	if (!is_null($aviso)) {
		if (!empty ($nacionalidadeEstrangeira)) {
			$nacionalidade = "estrangeira";
		}
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
	$pessoa = new Pessoa ($idLogin, $nome, $nacionalidade, $dataNascimentoBD, $sexo, $estadoCivil, $endereco, $numero,
	$complemento, $bairro, $cep, $cidade, $estado, $telResidencial, $celular, 0, $conexaoBD);
	$aviso = $pessoa->insere();
	if ($aviso != sucesso) {
		if (!empty ($nacionalidadeEstrangeira)) {
			$nacionalidade = "estrangeira";
		}
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
	exit();
	?>