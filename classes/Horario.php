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
	

	function removeEntrevista ()
	{
		$sql = "DELETE FROM horario WHERE id=".$this->id;
		$result = mysql_query($sql, $this->conexaoBD->getLink()); 
		if (!$result) {
    		return "Erro ao remover a entrevista!".mysql_error();
		} else {
			return "sucesso";
		}
	}
	

	function insereEntrevista ()
	{
		$sql = "INSERT INTO horario (data, hora, area, tipo) VALUES ('".$this->data."','".$this->hora."','".$this->area."','".$this->tipo."')";
		$result = mysql_query($sql, $this->conexaoBD->getLink()); 
		if (!$result) {
    		return "Erro ao inserir a entrevista!".mysql_error();
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
		if (empty ($this->data)) {
			return;
		}
		if (empty ($this->hora)) {
			return;
		}
		if (empty($this->area)) {
			return;
		}
		$sql = "SELECT id,tipo FROM horario WHERE data='".$this->data."' AND hora='".$this->hora."' AND area='".$this->area."' AND tipo='".$this->tipo."'"  ;
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


	/*Busca todos os horario de entrevistas marcados*/
	function buscaHorariosEntrevistasMarcados ()
	{
		$sql = "SELECT * FROM horario WHERE disponivel='nao' ORDER BY data, hora";
		$resultado = mysql_query($sql, $this->conexaoBD->getLink());
		$numLinhas = mysql_num_rows ($resultado);
		$horarios = array ();
		if ($numLinhas != 0) {
			while ($dados  = mysql_fetch_array ($resultado)) {
				$horario = new Horario (0, $idLogin, 0, "", "", "", "", $conexaoBD);
				$horario->setId ($dados['id']);
				$horario->setTipo ($dados['tipo']);
				$horario->setArea ($dados['area']);
				$horario->setData ($dados['data']);
				$horario->setHora ($dados['hora']);
				$horario->setDisponivel ($dados['disponivel']);
				$horarios[] = $horario;
			}
			return $horarios;
		} else {
			return 0;
		}
	}
}
?>