<?php
class Usuario
{
	private $id;
	private $email;
	private $senha;
	private $tipo;
	private $conexaoBD;
	private $pago;
	private $dadosPreenchidos;
	
	function Usuario ($email, $senha, $tipo, $conexaoBD=false, $id=0)
	{
		$this->id = $id;	
		$this->email = $email;
		$this->tipo = $tipo;
		$this->senha = $senha;
		$this->conexaoBD = $conexaoBD;
	}

	public function setEmail ($email)
	{
		$this->email = email;		
	}
	
	public function getEmail ()
	{
		return $this->email;
	}

	public function setSenha ($senha)
	{
		$this->senha = $senha;		
	}
	
	public function getSenha ()
	{
		return $this->senha;
	}

	public function setTipo ($tipo)
	{
		$this->tipo = tipo;		
	}
	
	public function getTipo ()
	{
		return $this->tipo;
	}
	
	public function setId ($id)
	{
		$this->id = $id;
	}
	
	public function getId ()
	{
		return $this->id;
	}

	public function setPago ($pago)
	{
		$this->pago = $pago;
	}
	
	public function getPago ()
	{
		return $this->pago;
	}
	
	function isMembro ()
	{
		if ($this->tipo == "membro") {
			return true;
		} else {
			return false;
		}		
	}
	
	/* Insere um novo usuario no sistema */
	public function insere ()
	{
		//checa campos string para ver se nao existem caracteres anormais
		$this->email = strip_tags(htmlspecialchars($this->email, ENT_QUOTES));
		$this->senha = strip_tags(htmlspecialchars($this->senha, ENT_QUOTES));
		//verifica se o campo email esta preenchido
		if(empty($this->email)) {
			return "Щ necessсrio preencher o campo email!";			
		}
		//verifica se o campo senha esta preenchido
		if(empty($this->senha)) {
			return "Щ necessсrio preencher o campo senha!";			
		}		
		//verifica se existe conexao do banco de dados
		if($this->conexaoBD == false) {
			return "Erro de sistema! Contate o administrador do sistema!";	
		}
		$sql = "INSERT INTO login (email, senha, tipo) VALUES ('".$this->email."', '".md5($this->senha)."', '".$this->tipo."');";
		mysql_query($sql, $this->conexaoBD->getLink());
		$result = mysql_affected_rows();
		if ($result == 1) {
			return "sucesso";
		} else {
			if (mysql_errno() == 1062) {
				return "Erro! Esse usuсrio jс estс cadastrado no sistema!";	
			} else {
				return "Erro no cadastro de usuсrio!";
			}		
		}
	}
	
	public function alteraSenha ()
	{
		//checa campos string para ver se nao existem caracteres anormais
		$this->senha = strip_tags(htmlspecialchars($this->senha, ENT_QUOTES));
		//verifica se o campo senha esta preenchido
		if(empty($this->senha)) {
			return "Щ necessсrio preencher o campo senha!";			
		}
		//verifica se existe conexao do banco de dados
		if($this->conexaoBD == false) {
			return "Erro de sistema! Contate o administrador do sistema!";	
		}
		$sql = "UPDATE login SET senha='".md5($this->senha)."' WHERE id=".$this->id;
		mysql_query($sql, $this->conexaoBD->getLink());
		$result = mysql_affected_rows();
		if ($result == 1) {
			return "sucesso";
		} else {
			return "Erro na alteraчуo da senha do usuсrio!";		
		}
	}
	
	public function setPagoBD ()
	{
		//verifica se o campo id esta preenchido
		if(empty($this->id)) {
			return "Щ necessсrio preencher o campo id!";			
		}
		//verifica se existe conexao do banco de dados
		if($this->conexaoBD == false) {
			return "Erro de sistema! Contate o administrador do sistema!";	
		}
		$sql = "UPDATE login SET pago='".$this->pago."' WHERE id=".$this->id;
		mysql_query($sql, $this->conexaoBD->getLink());
		$result = mysql_affected_rows();
		if ($result == 1) {
			return "sucesso";
		} else {
			return "Erro ao setar o pagamento do inscrito!";		
		}
	}

	function buscaPorEmail ()
	{
		if (empty($this->email)) {
			return false;
		}
		$sql = "SELECT id FROM login WHERE email='".$this->email."'";
		$resultado = mysql_query($sql, $this->conexaoBD->getLink());
		$numLinhas = mysql_num_rows ($resultado);
		if ($resultado != 0) {
			while ($dados  = mysql_fetch_array ($resultado)) {
				$id = $dados['id'];
			}
			return $id;
		} else {
			return 0;
		}
	}
	
	function isPago ()
	{
		if (empty($this->id)) {
			return false;
		}
		$sql = "SELECT pago FROM login WHERE id=".$this->id;
		$resultado = mysql_query($sql, $this->conexaoBD->getLink());
		$numLinhas = mysql_num_rows ($resultado);
		if ($resultado != 0) {
			while ($dados  = mysql_fetch_array ($resultado)) {
				$pago = $dados['pago'];
				if ($pago == 1) {
					$this->pago = 1;
					return true;
				} else {
					return false;
				}
			}
			return true;
		} else {
			return false;
		}
	}
	
	function isDadosPreenchidos ()
	{
		if (empty($this->id)) {
			return false;
		}
		$sql = "SELECT dadosPreenchidos FROM login WHERE id=".$this->id;
		$resultado = mysql_query($sql, $this->conexaoBD->getLink());
		$numLinhas = mysql_num_rows ($resultado);
		if ($numLinhas != 0) {
			while ($dados  = mysql_fetch_array ($resultado)) {
				$dadosPreenchidos = $dados['dadosPreenchidos'];
				if ($dadosPreenchidos == 1) {
					$this->dadosPreenchidos = 1;
					return true;
				} else {
					return false;
				}
			}
			return true;
		} else {
			return false;
		}
	}
	
	function setDadosPreenchidos ($valor)
	{		
		//verifica se existe conexao do banco de dados
		if($this->conexaoBD == false) {
			return "Erro de sistema! Contate o administrador do sistema!";	
		}
		$sql = "UPDATE login SET dadosPreenchidos=".$valor." WHERE id=".$this->id;
		mysql_query($sql, $this->conexaoBD->getLink());
		$result = mysql_affected_rows();
		if ($result == 1) {
			return "sucesso";
		} else {
			return "Erro na alteraчуo dos dados preenchidos!";		
		}
	}

	function busca ()
	{
		if (empty($this->id)) {
			return false;
		}
		$sql = "SELECT * FROM login WHERE id=".$this->id;
		$resultado = mysql_query($sql, $this->conexaoBD->getLink());
		$numLinhas = mysql_num_rows ($resultado);
		if ($resultado != 0) {
			while ($dados  = mysql_fetch_array ($resultado)) {
				$this->dadosPreenchidos = $dados['dadosPreenchidos'];
				$this->email = $dados['email'];
				$this->senha = $dados['senha'];
				$this->pago = $dados['pago'];
				$this->tipo = $dados['tipo'];
			}
			return true;
		} else {
			return false;
		}
	}
	
	function isEntrevistaMarcada ()
	{
		if (empty($this->id)) {
			return false;
		}
		$sql = "SELECT entrevistaMarcada FROM login WHERE id=".$this->id;
		$resultado = mysql_query($sql, $this->conexaoBD->getLink());
		$numLinhas = mysql_num_rows ($resultado);
		if ($numLinhas != 0) {
			while ($dados  = mysql_fetch_array ($resultado)) {
				$entrevistaMarcada = $dados['entrevistaMarcada'];
				if ($entrevistaMarcada == 1) {
					$this->entrevistaMarcada = 1;
					return true;
				} else {
					return false;
				}
			}
			return true;
		} else {
			return false;
		}		
	}
	
	function setEntrevistaMarcada ()
	{
		//verifica se existe conexao do banco de dados
		if($this->conexaoBD == false) {
			return "Erro de sistema! Contate o administrador do sistema!";	
		}
		$sql = "UPDATE login SET entrevistaMarcada=1 WHERE id=".$this->id;
		mysql_query($sql, $this->conexaoBD->getLink());
		$result = mysql_affected_rows();
		if ($result == 1) {
			return "sucesso";
		} else {
			return "Erro ao setar entrevista como marcada!";		
		}		
	}
}
?>