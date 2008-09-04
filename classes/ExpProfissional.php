<?php
require_once("Usuario.php");
class ExpProfissional
{
	private $id;
	private $idLogin;
	private $idPessoa;
	private $empresa;
	private $tipo;
	private $atividade;
	private $dataInicio;
	private $dataConclusao;
	private $conexaoBD;
	
	function ExpProfissional($id=0, $idLogin=0, $idPessoa=0, $empresa="", $tipo="", $atividade="", 
	$dataInicio="", $dataConclusao="", $conexaoBD=false)
	{
		$this->id = $id + 0;
		$this->idPessoa = $idPessoa + 0;
		$this->empresa = strip_tags (htmlspecialchars ($empresa, ENT_QUOTES));
		$this->tipo = strip_tags (htmlspecialchars ($tipo, ENT_QUOTES));
		$this->atividade = strip_tags (htmlspecialchars ($atividade, ENT_QUOTES));
		$this->dataInicio = strip_tags (htmlspecialchars ($dataInicio, ENT_QUOTES));
		$this->dataConclusao = strip_tags (htmlspecialchars ($dataConclusao, ENT_QUOTES));
		$this->idLogin = $idLogin + 0;
		$this->conexaoBD = $conexaoBD;
	}
	
	function getId ()
	{
		return $this->id;
	}
	
	function getIdPessoa ()
	{
		return $this->idPessoa;
	}

	function getEmpresa()
	{
		return $this->empresa;
	}
	
	function getDataInicio ()
	{
		return $this->dataInicio;
	}

	function getDataConclusao ()
	{
		return $this->dataConclusao;
	}
	function getTipo ()
	{
		return $this->tipo;
	}

	function getAtividade ()
	{
		return $this->atividade;
	}
		
	/*Recebe uma data em formato aaaa-mm-dd e converte em uma data no formato dd/mm/aaaa*/
	function converteDataInicio()
	{
		$data = explode("-", $this->dataInicio);
		return $data[2]."/".$data[1]."/".$data[0];	
	}

	/*Recebe uma data em formato aaaa-mm-dd e converte em uma data no formato dd/mm/aaaa*/
	function converteDataConclusao ()
	{
		$data = explode("-", $this->dataConclusao);
		return $data[2]."/".$data[1]."/".$data[0];	
	}
	
	
	function insere ()
	{
		$sql = "INSERT INTO expprofissional (empresa, tipo, atividade, dataInicio, dataConclusao, 
		idPessoa) VALUES ('".$this->empresa."', '".$this->tipo."', '".$this->atividade."',
		'".$this->dataInicio."', '".$this->dataConclusao."', ".$this->idPessoa.")";
		mysql_query($sql, $this->conexaoBD->getLink());
		$result = mysql_affected_rows();
		if ($result == 1) {
			return "sucesso";
		} else {
			return "Erro no cadastro de experiъncia profissional!".mysql_error();		
		}
	}
	
	function edita ()
	{		
		$sql = "UPDATE expprofissional SET empresa='".$this->empresa."', tipo='".$this->tipo."', 
		atividade='".$this->atividade."', dataInicio='".$this->dataInicio."', 
		dataConclusao=".$this->dataConclusao.", idPessoa='".$this->idPessoa."' 
		WHERE id=".$this->id;
		$result = mysql_query($sql, $this->conexaoBD->getLink()); 
		if (!$result) {
    		return "Erro no alteraчуo dos dados profissionais!".mysql_error();
		} else {
			return "sucesso";
		}
	}
	
	/*Verifica se existe experiencia profisisonal relacionada a pessoa*/
	function buscaPorIdPessoa ()
	{
		$sql = "SELECT * FROM expprofissional WHERE id=".$this->id;
		$resultado = mysql_query($sql, $this->conexaoBD->getLink());
		$numLinhas = mysql_num_rows ($resultado);
		if ($numLinhas != 0) {
			while ($dados  = mysql_fetch_array ($resultado)) {
				$this->empresa = $dados['empresa'];
				$this->tipo = $dados['tipo'];
				$this->atividade = $dados['atividade'];
				$this->dataInicio = $dados['dataInicio'];
				$this->dataConclusao = $dados['dataConclusao'];
				$this->idPessoa = $dados['idPessoa'];
			}
			return true;
		} else {
			return false;	
		}
	}
	
	/*Busca experiencias profissionais relacionadas a uma pessoa cadastradas no BD. 
		Retorna 0 se nao existe expprofissional cadastrada relacionada ao idPessoa*/
	function busca ()
	{
		if ($this->idLogin == 0) {
			return;
		}
		$sql = "SELECT id FROM pessoa WHERE idLogin=".$this->idLogin;
		$resultado = mysql_query($sql, $this->conexaoBD->getLink());
		$numLinhas = mysql_num_rows ($resultado);
		if ($numLinhas != 0) {
			while ($dados  = mysql_fetch_array ($resultado)) {
				$this->idPessoa = $dados['id'];
			}
		}
		mysql_free_result($resultado);
		$sql2 = "SELECT id FROM expprofissional WHERE idPessoa=".$this->idPessoa;
		$resultado2 = mysql_query($sql2, $this->conexaoBD->getLink());
		$numLinhas2 = mysql_num_rows ($resultado2);
		if ($numLinhas2 != 0) {
			$idsExpProfissionais = array ();
			while ($dados2  = mysql_fetch_array ($resultado2)) {
				$idsExpProfissionais[] = $dados2['id'];
			}
			return $idsExpProfissionais;
		} else {
			return 0;
		}
	}
}
?>