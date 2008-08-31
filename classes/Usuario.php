<?php
class Usuario
{
	private $id;
	private $usuario;
	private $senha;
	private $conexaoBD;
	
	function Usuario ($usuario, $senha, $conexaoBD=false, $id=0)
	{
		$this->id = $id;	
		$this->usuario = $usuario;
		$this->senha = $senha;
		$this->conexaoBD = $conexaoBD;
	}

	public function setUsuario ($usuario)
	{
		$this->usuario = usuario;		
	}
	
	public function getUsuario ()
	{
		return $this->usuario;
	}

	public function setSenha ($senha)
	{
		$this->senha = senha;		
	}
	
	public function getSenha ()
	{
		return $this->senha;
	}
	
	public function setId ($id)
	{
		$this->id = $id;
	}
	
	public function getId ()
	{
		return $this->id;
	}
	
	/* Insere um novo usuario no sistema */
	public function insere ()
	{
		//checa campos string para ver se nao existem caracteres anormais
		$this->usuario = strip_tags(htmlspecialchars($this->usuario, ENT_QUOTES));
		$this->senha = strip_tags(htmlspecialchars($this->senha, ENT_QUOTES));
		//verifica se o campo usuario esta preenchido
		if(empty($this->usuario)) {
			return "É necessário preencher o campo usuario!";			
		}
		//verifica se o campo senha esta preenchido
		if(empty($this->senha)) {
			return "É necessário preencher o campo senha!";			
		}		
		//verifica se existe conexao do banco de dados
		if($this->conexaoBD == false) {
			return "Erro de sistema! Contate o administrador do sistema!";	
		}
		$sql = "INSERT INTO login (usuario, senha) VALUES ('".$this->usuario."', '".md5($this->senha)."');";
		mysql_query($sql, $this->conexaoBD->getLink());
		$result = mysql_affected_rows();
		if ($result == 1) {
			return "sucesso";
		} else {
			if (mysql_errno() == 1062) {
				return "Erro! Esse usuário já está cadastrado no sistema!";	
			} else {
				return "Erro no cadastro de usuário!";
			}		
		}
	}
}
?>