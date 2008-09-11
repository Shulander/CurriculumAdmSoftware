<?php 
	require_once ("utils/sessao.php");
	require_once ("utils/BancoDados.php");	
	include ("cabecalho.php");
	include ("menu.php");
	require_once ("classes/Pessoa.php");	
	restritoUsuario ();	 
	$idLogin = $_SESSION['idLogin'];
	/*-------------Testa variaveis------------------*/
	//testa se a variavel aviso existe
	if(isset($_GET['aviso'])) {
		$aviso = $_GET['aviso'];	
	} else {
		$aviso = "";
	}
	//testa se a variavel nome existe
	if(isset($_REQUEST['nome'])) {
		$nome = $_REQUEST['nome'];	
	} else {
		$nome = "";
	}
	//testa se a variavel nacionalidade existe
	if(isset($_REQUEST['nacionalidade'])) {
		$nacionalidade = $_REQUEST['nacionalidade'];	
	} else {
		$nacionalidade = "";
	}
	//testa se a variavel nacionalidade existe
	if(isset($_REQUEST['nacionalidadeEstrangeira'])) {
		$nacionalidadeEstrangeira = $_REQUEST['nacionalidadeEstrangeira'];	
	} else {
		$nacionalidadeEstrangeira = "";
	}
	//testa se a variavel dataNascimento existe
	if(isset($_REQUEST['dataNascimento'])) {
		$dataNascimento = $_REQUEST['dataNascimento'];	
	} else {
		$dataNascimento = "";
	}
	//testa se a variavel endereco existe
	if(isset($_REQUEST['estadoCivil'])) {
		$estadoCivil = $_REQUEST['estadoCivil'];	
	} else {
		$estadoCivil = "";
	}
	//testa se a variavel sexo existe
	if(isset($_REQUEST['sexo'])) {
		$sexo = $_REQUEST['sexo'];	
	} else {
		$sexo = "";
	}
	//testa se a variavel endereco existe
	if(isset($_REQUEST['endereco'])) {
		$endereco = $_REQUEST['endereco'];	
	} else {
		$endereco = "";
	}
	//testa se a variavel numero existe
	if(isset($_REQUEST['numero'])) {
		$numero = $_REQUEST['numero'];	
	} else {
		$numero = "";
	}
	//testa se a variavel complemento existe
	if(isset($_REQUEST['complemento'])) {
		$complemento = $_REQUEST['complemento'];	
	} else {
		$complemento = "";
	}
	//testa se a variavel bairro existe
	if(isset($_REQUEST['bairro'])) {
		$bairro = $_REQUEST['bairro'];	
	} else {
		$bairro = "";
	}
	//testa se a variavel cep existe
	if(isset($_REQUEST['cep'])) {
		$cep = $_REQUEST['cep'];	
	} else {
		$cep = "";
	}
	//testa se a variavel cidade existe
	if(isset($_REQUEST['cidade'])) {
		$cidade = $_REQUEST['cidade'];	
	} else {
		$cidade = "Santa Maria";
	}
	//testa se a variavel cidadeOutra existe
	if(isset($_REQUEST['cidadeOutra'])) {
		$cidadeOutra = $_REQUEST['cidadeOutra'];	
	} else {
		$cidadeOutra = "";
	}
	//testa se a variavel estado existe
	if(isset($_REQUEST['estado'])) {
		$estado = $_REQUEST['estado'];	
	} else {
		$estado = "RS";
	}
	//testa se a variavel estadoOutro existe
	if(isset($_REQUEST['estadoOutro'])) {
		$estadoOutro = $_REQUEST['estadoOutro'];	
	} else {
		$estadoOutro = "";
	}
	//testa se a variavel telResidencial existe
	if(isset($_REQUEST['telResidencial'])) {
		$telResidencial = $_REQUEST['telResidencial'];	
	} else {
		$telResidencial = "";
	}
	//testa se a variavel celular existe
	if(isset($_REQUEST['celular'])) {
		$celular = $_REQUEST['celular'];	
	} else {
		$celular = "";
	}
	//testa se a variavel email existe
	if(isset($_REQUEST['email'])) {
		$email = $_REQUEST['email'];	
	} else {
		$email = "";
	}
	//testa se a variavel tipo existe
	if(isset($_REQUEST['tipo'])) {
		$tipo = $_REQUEST['tipo'];	
	} else {
		$tipo = "";
	}
?>
<!-- Sub-titulo -->
<h3>Dados Pessoais</h3>
<?php
if(!empty($aviso)) {
	echo '<ul class="erro"><li>'.$aviso.'</li></ul>';	
}
$conexaoBD = new BancoDados ();
if (!$conexaoBD->conecta()) {
	echo '<ul class="erro"><li>Erro de sistema! Contate o administrador do sistema!</li></ul>';
} else {
	if (isset($idLogin)) {
		$pessoa = new Pessoa ($idLogin, "", "", "", "", "", "", "", "", "", "", "", "", "", "", 0, $conexaoBD); 
		$resultado = $pessoa->buscaPorIdUsuario ();
		if ($resultado == true) {
			echo '<ul class="ajuda"><li>Seus dados já foram cadastrados. Para editá-los, modifique o formulário abaixo.</li></ul> '; 
			//editar dados pessoais
			$result = $pessoa->busca();
			if ($result == true) {
				if (empty ($aviso)) {
					$nome = $pessoa->getNome ();
					$nacionalidade = $pessoa->getNacionalidade();
					if ($nacionalidade != "Brasileira") {
						$nacionalidadeEstrangeira = $nacionalidade;
						$nacionalidade = "Estrangeira"; 
					}
					$dataNascimento = $pessoa->converteDataNascimento();
					$sexo = $pessoa->getSexo();
					$estadoCivil = $pessoa->getEstadoCivil();
					$endereco = $pessoa->getEndereco();
					$numero = $pessoa->getNumero();
					$complemento = $pessoa->getComplemento();
					$bairro = $pessoa->getBairro();
					$cep = $pessoa->getCep();
					$cidade = $pessoa->getCidade ();
					if ($cidade == "Outra") {
						$cidadeOutra = $pessoa->getCidade(); 
					}
					$estado = $pessoa->getEstado(); 
					if ($estado == "Outro") {
						$estadoOutro = $pessoa->getEstado(); 
					}
					$telResidencial = $pessoa->getTelResidencial();
					$celular = $pessoa->getCelular();
				}
				$pagina = "dadosPessoaisEditaBD.php";
				include ("dadosPessoaisForm.php");
			} else {
				echo '<ul class="erro"><li>Erro de sistema! Contate o administrador do sistema!</li></ul>';
			}
		} else {
			//cadastrar dados pessoais
			$pagina = "dadosPessoaisInsereBD.php";
			include ("dadosPessoaisForm.php");
		}	
	} else {
		echo '<ul class="erro"><li>Erro de sistema! Contate o administrador do sistema!</li></ul>';
	}
}
//---------------Rodape-------------------
include ("rodape.php"); 
?>