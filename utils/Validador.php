<?php
class Validador
{	
	private $erro = null;
	
	function getErro ()
	{
		return $this->erro;
	}
	
	function setErro ($erro)
	{
		$this->erro = $erro;		
	}
	
	/* 	Verifica se um campo esta preenchido. 	 
	*/
	function isPreenchido ($campo)
	{
		if ($campo == null) {
			return false;
		} else if(empty ($campo)) {
			return false; 
		} else {
			return true;
		}
	}
	
	function isSelecionado ($campo)
	{		
		if (is_numeric($campo)) {
			if($campo == 0) {
				return false;
			}
		} else {
			return true;
		}
	}

	function isEmail ($campo)
	{
		$email = trim($campo);
		if (ereg('^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$', $email)) {
			return true;
		}	else {			
			return false;
		}
		
	}
	
	function comprimento ($campo, $valor)
	{
		$tamCampo = count ($campo);
		if ($tamCampo <= $valor) {
			return true;
		} else {
			return true;
		}
	}
	
	function isNumero ($campo)
	{
		if(is_numeric($campo)) {
			return true;
		} else {
			return false;
		}
	}
	
	function isAlfaNumerico ($campo)
	{
		if(ctype_alnum($campo)) {
			return true;
		} else {
			return false;
		}
	}
	
	function isLetra ($campo)
	{
		if(ctype_alpha($campo)) {
			return true;
		} else {
			return false;
		}
	}
	
	//Sempre deve ser chamada apos "isData($data)"
	function converteData ($data)
	{
		$data = explode("/", $data);
		return $data[2]."-".$data[1]."-".$data[0];
	}
	
	//Data valida: dd/mm/aaaa
	function isData ($campo)
	{
		$this->setErro (null);
		/*----------Erros--------------*/
		$erroFormatoData = "A data deve possuir o formato 'dd/mm/aaaa'!";
		$erroDataMaior = "A data de nascimento deve ser anterior a data atual";
		/*------------------------------*/
		$tamCampo = strlen ($campo);
		//testa se o campo data tem 10 caracteres
		if ($tamCampo != 10) {
			$this->setErro ($erroFormatoData);
			return false;
		}
		//determina o numero de '/' na variavel campo
		$numBarras = substr_count ($campo, "/");
		if ($numBarras != 2) {
			$this->setErro ($erroFormatoData);
			return false;
		}
		$data = explode("/", $campo);
		if (is_array ($data)) {
			$tamanhoArrayData = count($data);
		} else {
			$this->setErro ($erroFormatoData);
			return false;
		}
		if ($tamanhoArrayData != 3) {
			$this->setErro ($erroFormatoData);
			return false;
		} 
		$dia = $data[0];
		$mes = $data[1];
		$ano = $data[2];
		if (!is_numeric ($dia)) { 
			$this->setErro ("O valor do dia deve ser numérico!");
			return false;
		}
		if (!is_numeric($mes)) {
			$this->setErro ("O valor do mês deve ser numérico!");
			return false;
		}
		if (!is_numeric($ano)) {
			$this->setErro ("O valor do ano deve ser numérico!");
			return false;
		}
		if (!checkdate($mes, $dia, $ano)) {
			$this->setErro ("Data inválida!");
			return false;
		}
		if ($ano < 1900) {
			$this->setErro ("Ano inválido!");
			return false;
		}
		$hoje = getdate();
		$diaAtual = $hoje['mday'];
		$mesAtual = $hoje['mon'];
		$anoAtual = $hoje['year'];
		if ($anoAtual < $ano) {
			$this->setErro ($erroDataMaior);
			return false;
		} else if ($anoAtual == $ano) {
			if ($mesAtual < $mes) {
				$this->setErro ($erroDataMaior);
				return false;
			} else if ($mesAtual == $mes) {
				if ($diaAtual < $dia) {
					$this->setErro ($erroDataMaior);
					return false;
				}
			}
		}
		return true;
	}
	
	//formato: +dd(dd)dddd-dddd	
	function isTelefone ($campo)
	{
		$erroFormatoInvalido = "O campo 'Telefone' deve possuir o formato '+dd(dd)dddd-dddd' ou '(dd)dddd-dddd'!"; 
		$tamCampo = count ($campo);
		//testa se o campo data tem no maximo 16 caracteres
		if ($tamCampo > 16) {
			return "O campo 'Telefone' deve possuir no máximo 16 caracteres!";
		}
		//determina o numero de '+' na variavel campo
		$numSoma = substr_count ($campo, "+");
		if ($numSoma == 1) {
			if ($tamCampo != 16) {
				return $erroFormatoInvalido;
			}	
		} else {
			$numAbreParenteses = substr_count ($campo, "(");
			$numFechaParenteses = substr_count ($campo, ")");
			if ($numAbreParenteses != 1 && $numFechaParenteses != 1) {
				return $erroFormatoInvalido;
			}
		}
		
	}

	
}
?>