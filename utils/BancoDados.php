<?php
class BancoDados 
{
 	private $host;
 	private $usuario;
 	private $senha;
 	private $database;
 	private $link;
 	private $idLogin;
 	private $tipo;
 	private $nome;

 	function BancoDados ($usuario='root', $senha='vampire1942')
 	{ 		
 		$this->host = 'localhost';
 		$this->usuario = $usuario;
 		$this->senha = $senha;
 		$this->database = 'aiesec_psel';
 		$this->link = false;
 	}

	//conecta ao banco de dados
 	public function conecta ()
 	{
 		//entao ja esta conectado
 		if($this->link != false) {
 			return true;
		}	
		$this->link = mysql_connect ($this->host, $this->usuario, $this->senha) or die ("Erro de conexão ao banco de dados!". mysql_error ());
	 	if (!$this->link) {
	       	echo "Erro de conexão ao banco de dados!" . mysql_error ();
			return false;
	   	}
		mysql_select_db ($this->database, $this->link);
		return true;
	}

	//desconecta do banco de dados
 	public function desconecta ()
 	{
		if($this->link == false) {
 			return true;
 		}
 		mysql_close ($this->link);
 	}
 	
 	public function setIdLogin ($idLogin)
 	{
 		$this->idLogin = $idLogin;
 	}

 	public function setTipo ($tipo)
 	{
 		$this->tipo = $tipo;
 	}

 	public function getTipo ()
 	{
 		return $this->tipo;
 	}
 	
 	public function setUsuario ($usuario)
 	{
 		$this->usuario = $usuario;
 	}
 		 	
	public function setNome ($nome)
 	{
 		$this->nome = $nome;
 	}	 		 	
 	
 	public function getLink ()
 	{
 		return $this->link;
 	}
 	
 	public function setSession() 
 	{  
 		$_SESSION['idLogin'] = $this->idLogin;  
 		$_SESSION['usuario']  = $this->usuario;  
 		$_SESSION['senha'] = $this->senha;
		$_SESSION['nome'] = $this->nome;
		$_SESSION['tipo'] = $this->tipo;	 		
	}  
	
	public function killSession() 
	{  
		unset($_SESSION['idLogin']);  
		unset($_SESSION['usuario']);  
		unset($_SESSION['senha']);
		unset($_SESSION['nome']);
		unset($_SESSION['tipo']);
	}
}
?>