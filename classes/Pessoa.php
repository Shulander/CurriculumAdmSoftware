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
	var $conexaoBD;
	
	//Habilidades
	var $ingles;
	var $espanhol;
	var $frances;
	var $italiano;
	var $alemao;
	var $outro1;
	var $outro1Nivel;
	var $outro2;
	var $outro2Nivel;
	var $office;
	var $webdesign;
	var $editorImagem;
	var $contabilidade;
	var $administracao;
	var $economia;
	var $financas;
	var $recursosHumanos;
	var $tecnologiaDaInformacao;
	var $marketing;
	var $outrosEstudos;
	
	//pesquisa
	var $pergunta1;
	var $pergunta2;
	var $pergunta3;
	var $pergunta4;
	var $pergunta5;
	var $pergunta6;
	var $outro1P;
	var $outro2P;
	var $outro3P;
	var $recomendador;
	
	function Pessoa ($idLogin=0, $nome="", $nacionalidade="", $dataNascimento="", $sexo="", $estadoCivil="",
	$endereco="", $numero="", $complemento="", $bairro="", $cep="", $cidade="", $estado="", $telResidencial="",
	$celular="", $id=0, $conexaoBD=false)
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
		$this->idLogin = $idLogin + 0;
		$this->conexaoBD = $conexaoBD;
	}
	function getId ()
	{
		return $this->id;
	}

	function getIdLogin ()
	{
		return $this->idLogin;
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
	
	//Habilidades
	function getIngles()
	{ 
		return $this->ingles;
	}
	
	function getEspanhol()
	{ 
		return $this->espanhol;
	}
	
	function getFrances()
	{ 
		return $this->frances;
	}
	
	function getItaliano()
	{ 
		return $this->italiano;
	}
	
	function getAlemao()
	{ 
		return $this->alemao;
	}
	
	function getOutro1()
	{ 
		return $this->outro1;
	}
	
	function getOutro1Nivel()
	{ 
		return $this->outro1Nivel;
	}
	
	function getOutro2()
	{ 
		return $this->outro2;
	}
	
	function getOutro2Nivel()
	{ 
		return $this->outro2Nivel;
	}
	
	function getOffice()
	{ 
		return $this->office;
	}
	
	function getWebdesign()
	{ 
		return $this->webdesign;
	}
	
	function getEditorImagem()
	{ 
		return $this->editorImagem;
	}

	function getContabilidade()
	{ 
		return $this->contabilidade;
	}

	function getAdministracao()
	{ 
		return $this->administracao;
	}

	function getEconomia()
	{ 
		return $this->economia;
	}
	
	function getFinancas()
	{ 
		return $this->financas;
	}
	
	function getRecursosHumanos()
	{ 
		return $this->recursosHumanos;
	}
	
	function getTecnologiaDaInformacao()
	{ 
		return $this->tecnologiaDaInformacao;
	}
	
	function getMarketing()
	{ 
		return $this->marketing;
	}
	
	function getOutrosEstudos()
	{ 
		return $this->outrosEstudos;
	}

	//Pesquisa
	function getPergunta1()
	{ 
		return $this->pergunta1;
	}
	
	function getPergunta2()
	{ 
		return $this->pergunta2;
	}

	function getPergunta3()
	{ 
		return $this->pergunta3;
	}

	function getPergunta4()
	{ 
		return $this->pergunta4;
	}

	function getPergunta5()
	{ 
		return $this->pergunta5;
	}

	function getPergunta6()
	{ 
		return $this->pergunta6;
	}
	
	function getRecomendador()
	{ 
		return $this->recomendador;
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
		complemento, bairro, cep, cidade, estado, telResidencial, celular, idLogin) VALUES ('".$this->nome."', 
		'".$this->nacionalidade."', '".$this->dataNascimento."', '".$this->sexo."', '".$this->estadoCivil."', 
		'".$this->endereco."', ".$this->numero.", '".$this->complemento."', '".$this->bairro."', ".$this->cep.", 
		'".$this->cidade."', '".$this->estado."', '".$this->telResidencial."', '".$this->celular."', 
		".$this->idLogin.")";
		mysql_query($sql, $this->conexaoBD->getLink());
		$result = mysql_affected_rows();
		if ($result == 1) {
			return "sucesso";
		} else {
			if (mysql_errno() == 1062) {
				return "Erro! Essa pessoa já está cadastrado no sistema!";	
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
		telResidencial='".$this->telResidencial."', celular='".$this->celular."' WHERE idLogin=".$this->idLogin;
		$result = mysql_query($sql, $this->conexaoBD->getLink()); 
		if (!$result) {
    		return "Erro no alteração dos dados pessoais!".mysql_error();
		} else {
			return "sucesso";
		}
	}
	
	function alteraDadosPessoaisBD ($dadosPessoais)
	{
		$sql = "UPDATE pessoa SET dadosPessoais=".$dadosPessoais;
		$result = mysql_query($sql, $this->conexaoBD->getLink()); 
		if (!$result) {
    		return "Erro no alteração dos dados pessoais!".mysql_error();
		} else {
			return "sucesso";
		}
	}

	function alteraDadosEducacionaisBD ($dadosEducacionais)
	{
		$sql = "UPDATE pessoa SET dadosEducacionais=".$dadosEducacionais;
		$result = mysql_query($sql, $this->conexaoBD->getLink()); 
		if (!$result) {
    		return "Erro no alteração dos dados educacionais!".mysql_error();
		} else {
			return "sucesso";
		}
	}

	function alteraDadosProfissionaisBD ($dadosProfissionais)
	{
		$sql = "UPDATE pessoa SET dadosProfissionais=".$dadosProfissionais;
		$result = mysql_query($sql, $this->conexaoBD->getLink()); 
		if (!$result) {
    		return "Erro no alteração dos dados profissionais!".mysql_error();
		} else {
			return "sucesso";
		}
	}
	
	function alteraHabilidadesBD ($habilidades)
	{
		$sql = "UPDATE pessoa SET habilidades=".$habilidades;
		$result = mysql_query($sql, $this->conexaoBD->getLink()); 
		if (!$result) {
    		return "Erro no alteração das habilidades!".mysql_error();
		} else {
			return "sucesso";
		}
	}

	function alteraPesquisaBD ($pesquisa)
	{
		$sql = "UPDATE pessoa SET pesquisa=".$pesquisa;
		$result = mysql_query($sql, $this->conexaoBD->getLink()); 
		if (!$result) {
    		return "Erro no alteração da pesquisa!".mysql_error();
		} else {
			return "sucesso";
		}
	}
	
	/*Verifica se existe uma pessoa relacionada ao usuario que esta utilizando o sistema ja cadastrada*/
	function buscaPorIdUsuario ()
	{
		$sql = "SELECT COUNT(*) AS resultado FROM pessoa as p join login as l on p.idLogin=l.id WHERE l.id=".$this->idLogin;
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
				$this->id = $dados['id'];
			}
			return true;
		} else {
			return false;
		}
	}
	
	/*Busca dados de habilidades da pessoa no BD. Retorna false se nao existe pessoa cadastrada relacionada ao id do usuario*/
	function buscaHabilidades ()
	{
		$sql = "SELECT * FROM pessoa WHERE id=".$this->id;
		$resultado = mysql_query($sql, $this->conexaoBD->getLink());
		$numLinhas = mysql_num_rows ($resultado);
		if ($resultado != 0) {
			while ($dados  = mysql_fetch_array ($resultado)) {
				$this->ingles = $dados['ingles'];
				$this->espanhol = $dados['espanhol'];
				$this->italiano = $dados['italiano'];
				$this->frances = $dados['frances'];
				$this->alemao = $dados['alemao'];
				$this->outro1 = $dados['outro1'];
				$this->outro2 = $dados['outro2'];
				$this->outro1Nivel = $dados['outro1Nivel'];
				$this->outro2Nivel = $dados['outro2Nivel'];
				$this->office = $dados['office'];
				$this->webdesign = $dados['webdesign'];
				$this->editorImagem = $dados['editorImagem'];
				$this->contabilidade = $dados['contabilidade'];
				$this->administracao = $dados['administracao'];
				$this->economia = $dados['economia'];
				$this->financas = $dados['financas'];
				$this->recursosHumanos = $dados['recursosHumanos'];
				$this->tecnologiaInformacao = $dados['tecnologiaInformacao'];
				$this->marketing = $dados['marketing'];
				$this->outrosEstudos = $dados['outrosEstudos'];
			}
			return true;
		} else {
			return false;
		}
	}
	
	/*Busca dados de pesquisa da pessoa no BD. Retorna false se nao existe pessoa cadastrada relacionada ao id do usuario*/
	function buscaPesquisa ()
	{
		$sql = "SELECT * FROM pessoa WHERE id=".$this->id;
		$resultado = mysql_query($sql, $this->conexaoBD->getLink());
		$numLinhas = mysql_num_rows ($resultado);
		if ($resultado != 0) {
			while ($dados  = mysql_fetch_array ($resultado)) {
				$this->pergunta1 = $dados['pergunta1'];
				$this->pergunta2 = $dados['pergunta2'];
				$this->pergunta3 = $dados['pergunta3'];
				$this->pergunta4 = $dados['pergunta4'];
				$this->pergunta5 = $dados['pergunta5'];
				$this->pergunta6 = $dados['pergunta6'];
				$this->recomendador = $dados['recomendador'];
			}
			return true;
		} else {
			return false;
		}
	}
	
	/*Verifica se todos os dados foram preenchidos*/
	function isDadosPreenchidos ()
	{
		$sql = "SELECT * FROM pessoa WHERE idLogin=".$this->idLogin;
		$resultado = mysql_query($sql, $this->conexaoBD->getLink());
		$numLinhas = mysql_num_rows ($resultado);
		if ($resultado != 0) {
			while ($dados  = mysql_fetch_array ($resultado)) {
				$dadosPessoais = $dados['dadosPessoais'];
				$dadosEducacionais = $dados['dadosEducacionais'];
				$dadosProfissionais = $dados['dadosProfissionais'];
				$habilidades = $dados['habilidades'];
				$pesquisa = $dados['pesquisa'];
			}
			if ($dadosPessoais == 1 && $dadosEducacionais == 1 && $dadosProfissionais == 1 
			&& $habilidades == 1 && $pesquisa == 1) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}
?>
