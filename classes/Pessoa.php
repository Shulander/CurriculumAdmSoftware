<?php
require_once("Usuario.php");
class Pessoa
{
	var $id;
	var $idLogin;
	var $nome;
	var $nacionalidade;
	var $dataNascimento;
	var $sexo;
	var $estadoCivil;
	var $endereco;
	var $numero;
	var $complemento;
	var $bairro;
	var $cep;
	var $cidade;
	var $estado;
	var $telResidencial;
	var $celular;
	var $email;
	var $conexaoBD;
	
	function Pessoa ($idLogin=0, $nome="", $nacionalidade="", $dataNascimento="", $sexo="", $estadoCivil="",
	$endereco="", $numero="", $complemento="", $bairro="", $cep="", $cidade="", $estado="", $telResidencial="",
	$celular="", $email="", $id=0, $conexaoBD=false)
	{
		$this->id = $id + 0;
		$this->nome = strip_tags (htmlspecialchars ($nome, ENT_QUOTES));
		$this->nacionalidade = strip_tags (htmlspecialchars ($nacionalidade, ENT_QUOTES));
		$this->dataNascimento = strip_tags (htmlspecialchars ($dataNascimento, ENT_QUOTES));
		$this->sexo = strip_tags (htmlspecialchars ($sexo, ENT_QUOTES));
		$this->estadoCivil = strip_tags (htmlspecialchars ($estadoCivil, ENT_QUOTES));
		$this->endereco = strip_tags (htmlspecialchars ($endereco, ENT_QUOTES));
		$this->numero = $numero + 0;
		$this->complemento = strip_tags (htmlspecialchars ($complemento, ENT_QUOTES));
		$this->bairro = strip_tags (htmlspecialchars ($bairro, ENT_QUOTES));
		$this->cep = $cep + 0;
		$this->cidade = strip_tags (htmlspecialchars ($cidade, ENT_QUOTES));
		$this->estado = strip_tags (htmlspecialchars ($estado, ENT_QUOTES));
		$this->telResidencial = strip_tags (htmlspecialchars ($telResidencial, ENT_QUOTES));
		$this->celular = strip_tags (htmlspecialchars ($celular, ENT_QUOTES));
		$this->email = strip_tags (htmlspecialchars ($email, ENT_QUOTES));
		$this->idLogin = $idLogin + 0;
		$this->conexaoBD = $conexaoBD;
	}
	function getId ()
	{
		return $this->id;
	}
	
	function getNome ()
	{
		return $this->nome;
	}

	function getNacionalidade()
	{
		return $this->nacionalidade;
	}

	function getDataNascimento ()
	{
		return $this->dataNascimento;
	}

	function getSexo ()
	{
		return $this->sexo;
	}

	function getEstadoCivil ()
	{
		return $this->estadoCivil;
	}

	function getEndereco()
	{
		return $this->endereco;
	}

	function getNumero ()
	{
		return $this->numero;
	}

	function getComplemento ()
	{
		return $this->complemento;
	}
	
	function getBairro ()
	{
		return $this->bairro;
	}

	function getCep ()
	{
		return $this->cep;
	}

	function getCidade()
	{
		return $this->cidade;
	}

	function getEstado()
	{
		return $this->estado;
	}

	function getTelResidencial ()
	{
		return $this->telResidencial;
	}
	
	function getCelular ()
	{
		return $this->celular;
	}

	function getEmail ()
	{
		return $this->email;
	}
	
	/*Recebe uma data em formato aaaa-mm-dd e converte em uma data no formato dd/mm/aaaa*/
	function converteDataNascimento ()
	{
		$data = explode("-", $this->dataNascimento);
		return $data[2]."/".$data[1]."/".$data[0];	
	}
	
	function insere ()
	{
		$sql = "INSERT INTO pessoa(nome, nacionalidade, dataNascimento, sexo, estadoCivil, endereco, numero, 
		complemento, bairro, cep, cidade, estado, telResidencial, celular, email, idLogin) VALUES ('".$this->nome."', 
		'".$this->nacionalidade."', '".$this->dataNascimento."', '".$this->sexo."', '".$this->estadoCivil."', 
		'".$this->endereco."', ".$this->numero.", '".$this->complemento."', '".$this->bairro."', ".$this->cep.", 
		'".$this->cidade."', '".$this->estado."', '".$this->telResidencial."', '".$this->celular."', '".$this->email."',
		".$this->idLogin.")";
		mysql_query($sql, $this->conexaoBD->getLink());
		$result = mysql_affected_rows();
		if ($result == 1) {
			return "sucesso";
		} else {
			if (mysql_errno() == 1062) {
				return "Erro! Essa pessoa jс estс cadastrado no sistema!";	
			} else {
				return "Erro no cadastro dos dados pessoais!".mysql_error();
			}		
		}
	}
	
	function edita ()
	{
		$sql = "UPDATE pessoa SET nome='".$this->nome."', nacionalidade='".$this->nacionalidade."', 
		dataNascimento='".$this->dataNascimento."', sexo='".$this->sexo."', estadoCivil='".$this->estadoCivil."', 
		endereco='".$this->endereco."', numero=".$this->numero.", complemento='".$this->complemento."', 
		bairro='".$this->bairro."', cep=".$this->cep.", cidade='".$this->cidade."', estado='".$this->estado."', 
		telResidencial='".$this->telResidencial."', celular='".$this->celular."', email='".$this->email."'";
		//echo $sql;
		//exit();
		$result = mysql_query($sql, $this->conexaoBD->getLink()); 
		if (!$result) {
    		return "Erro no alteraчуo dos dados pessoais!".mysql_error();
		} else {
			return "sucesso";
		}
	}
	
	/*Verifica se existe uma pessoa relacionada ao usuario que esta utilizando o sistema ja cadastrada*/
	function buscaPorIdUsuario ()
	{
		$sql = "SELECT COUNT(*) AS resultado FROM pessoa,login WHERE pessoa.idLogin=login.id AND login.id=".$this->idLogin;
		$resultado = mysql_query($sql, $this->conexaoBD->getLink());
		$numLinhas = mysql_num_rows ($resultado);
		if ($numLinhas != 0) {
			while ($dados  = mysql_fetch_array ($resultado)) {
				$result = $dados['resultado'];
				if ($result == 1) {
					return true;
				} else {
					return false;
				}
			}
			return true;
		} else {
			return false;
		}
		
		
		//$numLinhas = mysql_num_rows ($resultado);
		if ($resultado == 1) {
			echo "bixa~!";
			exit ();
			return true; //pessoa relacionada a id ja foi cadastrada
		} else {
			return false;	
		}
	}
	
	/*Busca dados de pessoa no BD. Retorna true se existe pessoa cadastrada relacionada ao id do usuario*/
	function busca ()
	{
		$sql = "SELECT * FROM pessoa WHERE idLogin=".$this->idLogin;
		$resultado = mysql_query($sql, $this->conexaoBD->getLink());
		$numLinhas = mysql_num_rows ($resultado);
		if ($resultado != 0) {
			while ($dados  = mysql_fetch_array ($resultado)) {
				$this->nome = $dados['nome'];
				$this->nacionalidade = $dados['nacionalidade'];
				$this->dataNascimento = $dados['dataNascimento'];
				$this->sexo = $dados['sexo'];
				$this->estadoCivil = $dados['estadoCivil'];
				$this->endereco = $dados['endereco'];
				$this->numero = $dados['numero'];
				$this->complemento = $dados['complemento'];
				$this->bairro = $dados['bairro'];
				$this->cep = $dados['cep'];
				$this->cidade = $dados['cidade'];
				$this->estado = $dados['estado'];
				$this->telResidencial = $dados['telResidencial'];
				$this->celular = $dados['celular'];
				$this->email = $dados['email'];
				$this->id = $dados['id'];			
			}
			return true;
		} else {
			return false;
		}
	}
}
?>