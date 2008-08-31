<?php
include ("Usuario.php");
class ExpAcademica
{
	private $id;
	private $idLogin;
	private $idPessoa;
	private $curso;
	private $tipo;
	private $intituicao;
	private $turno;
	private $semestre;
	private $dataIngresso;
	private $dataConclusao;
	private $conexaoBD;
	
	function ExpAcademica ($id=0, $idLogin=0, $idPessoa=0, $curso="", $tipo="", $instituicao="", $turno="",
	$semestre="", $dataIngresso="", $dataConclusao="", $conexaoBD=false)
	{
		$this->id = $id + 0;
		$this->idPessoa = $idPessoa + 0;
		$this->curso = strip_tags (htmlspecialchars ($curso, ENT_QUOTES));
		$this->tipo = strip_tags (htmlspecialchars ($tipo, ENT_QUOTES));
		$this->instituicao = strip_tags (htmlspecialchars ($instituicao, ENT_QUOTES));
		$this->turno = strip_tags (htmlspecialchars ($turno, ENT_QUOTES));
		$this->semestre = strip_tags (htmlspecialchars ($semestre, ENT_QUOTES));
		$this->dataIngresso = strip_tags (htmlspecialchars ($dataIngresso, ENT_QUOTES));
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

	function getCurso()
	{
		return $this->curso;
	}
	
	function getDataIngresso ()
	{
		return $this->dataIngresso;
	}

	function getDataConclusao ()
	{
		return $this->dataConclusao;
	}
	function getTipo ()
	{
		return $this->tipo;
	}

	function getInstituicao ()
	{
		return $this->instituicao;
	}

	function getSemestre()
	{
		return $this->semestre;
	}

	function getTurno ()
	{
		return $this->turno;
	}
		
	/*Recebe uma data em formato aaaa-mm-dd e converte em uma data no formato dd/mm/aaaa*/
	function converteDataIngresso ()
	{
		$data = explode("-", $this->dataIngresso);
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
		$sql = "INSERT INTO expacademica (curso, tipo, instituicao, turno, semestre, dataIngresso, dataConclusao, 
		idPessoa) VALUES ('".$this->curso."', '".$this->tipo."', '".$this->instituicao."', '".$this->turno."', 
		'".$this->semestre."', '".$this-dataIngresso."', ".$this->dataConclusao.", ".$this->idPessoa.")";
		mysql_query($sql, $this->conexaoBD->getLink());
		$result = mysql_affected_rows();
		if ($result == 1) {
			return "sucesso";
		} else {
			return "Erro no cadastro de experiъncia acadъmica!".mysql_error();		
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
	
	/*Verifica se existe experiencia academica relacionada a pessoa*/
	function buscaPorIdPessoa ()
	{
		$sql = "SELECT * FROM expacademica WHERE id=".$this->id;
		$resultado = mysql_query($sql, $this->conexaoBD->getLink());
		$numLinhas = mysql_num_rows ($resultado);
		if ($numLinhas != 0) {
			while ($dados  = mysql_fetch_array ($resultado)) {
				$this->curso = $dados['curso'];
				$this->tipo = $dados['tipo'];
				$this->instituicao = $dados['instituicao'];
				$this->turno = $dados['turno'];
				$this->semestre = $dados['semestre'];
				$this->dataIngresso = $dados['dataIngresso'];
				$this->dataConclusao = $dados['dataConclusao'];
				$this->idPessoa = $dados['idPessoa'];
			}
			return true;
		} else {
			return false;	
		}
	}
	
	/*Busca experiencias academicas relacionadas a uma pessoa cadastradas no BD. 
		Retorna 0 se nao existe expacademica cadastrada relacionada ao idPessoa*/
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
		$sql2 = "SELECT id FROM expacademica WHERE idPessoa=".$this->idPessoa;
		$resultado2 = mysql_query($sql2, $this->conexaoBD->getLink());
		$numLinhas2 = mysql_num_rows ($resultado2);
		if ($resultado2 != 0) {
			$idsExpAcademica = array ();
			while ($dados2  = mysql_fetch_array ($resultado2)) {
				$idsExpAcademicas[] = $dados2['id'];
			}
			return $idsExpAcademicas;
		} else {
			return 0;
		}
	}
}
?>