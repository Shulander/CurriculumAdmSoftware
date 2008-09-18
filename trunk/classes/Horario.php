<?php
class Horario
{
	private $id;
	private $idLogin;
	private $idPessoa;
	private $tipo;
	private $data;
	private $hora;
	private $area;
	private $disponivel;
	private $conexaoBD;
	
	function Horario ($id=0, $idLogin=0, $idPessoa=0, $area="", $tipo="", $data="", $hora="", $disponivel="sim", $conexaoBD=false)
	{
		$this->id = $id + 0;
		$this->idPessoa = $idPessoa + 0;
		$this->area = strip_tags (htmlspecialchars ($area, ENT_QUOTES));
		$this->tipo = strip_tags (htmlspecialchars ($tipo, ENT_QUOTES));
		$this->data = strip_tags (htmlspecialchars ($data, ENT_QUOTES));
		$this->hora = strip_tags (htmlspecialchars ($hora, ENT_QUOTES));
		$this->disponivel = $disponivel;
		$this->idLogin = $idLogin + 0;
		$this->conexaoBD = $conexaoBD;
	}
	
	function getId ()
	{
		return $this->id;
	}

	function setId ($id)
	{
		$this->id = $id;
	}
	
	
	function getIdPessoa ()
	{
		return $this->idPessoa;
	}
	
	function setIdPessoa ($idPessoa)
	{
		$this->idPessoa = $idPessoa;
	}

	function getArea()
	{
		return $this->area;
	}
	
	function setArea ($area)
	{
		$this->area = $area;
	}
	
	function getData ()
	{
		return $this->data;
	}

	function setData ($data)
	{
		$this->data = $data;
	}
	
	function getHora ()
	{
		return $this->hora;
	}
	
	function setHora ($hora)
	{
		$this->hora = $hora;
	}
	
	function getTipo ()
	{
		return $this->tipo;
	}
	
	function setTipo ($tipo)
	{
		$this->tipo = $tipo;
	}

	function getDisponivel ()
	{
		return $this->disponivel;
	}
	
	function setDisponivel ($disponivel)
	{
		$this->disponivel = $disponivel;
	}
	
	function getDataConvertida ()
	{
		return $this->converteData ();
	}
		
	/*Recebe uma data em formato aaaa-mm-dd e converte em uma data no formato dd/mm/aaaa*/
	function converteData()
	{
		$data = explode("-", $this->data);
		return $data[2]."/".$data[1]."/".$data[0];	
	}

	function marcaEntrevista ()
	{
		$sql = "UPDATE horario SET idPessoa='".$this->idPessoa."', disponivel='".$this->disponivel.
		"' WHERE id=".$this->id;
		$result = mysql_query($sql, $this->conexaoBD->getLink()); 
		if (!$result) {
    		return "Erro ao marcar a entrevista!".mysql_error();
		} else {
			return "sucesso";
		}
	}
	
	
	/*Verifica se existe entrevista relacionada a pessoa*/
	function buscaPorIdPessoa ()
	{
		if ($this->idPessoa == 0) {
			return;
		}
		$sql = "SELECT * FROM horario WHERE idPessoa=".$this->idPessoa;
		$resultado = mysql_query($sql, $this->conexaoBD->getLink());
		$numLinhas = mysql_num_rows ($resultado);
		if ($numLinhas != 0) {
			while ($dados  = mysql_fetch_array ($resultado)) {
				$this->area = $dados['area'];
				$this->tipo = $dados['tipo'];
				$this->data = $dados['data'];
				$this->hora = $dados['hora'];
				$this->disponivel = $dados['disponivel'];
				$this->id = $dados['id'];
			}
			return true;
		} else {
			return false;	
		}
	}
	
	/*Retorna o id da entrevista*/
	function buscaPorEntrevista ()
	{
		if ($this->idPessoa == 0) {
			return;
		}
		$sql = "SELECT id FROM horario WHERE data='".$this->data."' AND hora='".$this->hora."' AND area='".$this->area;
		echo $sql;
		exit ();
		$resultado = mysql_query($sql, $this->conexaoBD->getLink());
		$numLinhas = mysql_num_rows ($resultado);
		if ($numLinhas != 0) {
			while ($dados  = mysql_fetch_array ($resultado)) {
				$this->tipo = $dados['tipo'];
				$this->id = $dados['id'];
			}
			return true;
		} else {
			return false;	
		}
	}
}
?>