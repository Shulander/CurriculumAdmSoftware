<?php
class Curriculo
{
	var $idLogin;
	var $idPessoa;
	var $pessoa;
	var $expAcademica;
	var $expProfissional;
	var $entrevista;
	var $conexaoBD;
	
	function Curriculo ($idLogin=0, $idPessoa=0, $pessoa="", $expAcademica="", $expProfissional="", $entrevista="", $conexaoBD=false)
	{
		$this->idLogin = $idLogin;
		$this->idPessoa = $idPessoa;
		$this->pessoa = $pessoa;
		$this->expAcademica = $expAcademica;
		$this->expProfissional = expProfissional;
		$this->entrevista = entrevista;
		$this->conexaoBD = $conexaoBD;
	}
	
	function getNumeroExpAcademica ()
	{
		$sql = "SELECT COUNT(*) AS numero FROM expacademica WHERE idPessoa=".$this->idPessoa;
		$resultado = mysql_query($sql, $this->conexaoBD->getLink());
		$numLinhas = mysql_num_rows ($resultado);
		if ($numLinhas != 0) {
			while ($dados  = mysql_fetch_array ($resultado)) {
				$numeroExpAcademica = $dados['numero'];
			}
			return $numeroExpAcademica;
		} else {
			return -1;
		}
	}
	
	function getNumeroExpProfissional ()
	{
		$sql = "SELECT COUNT(*) AS numero FROM expprofissional WHERE idPessoa=".$this->idPessoa;
		$resultado = mysql_query($sql, $this->conexaoBD->getLink());
		$numLinhas = mysql_num_rows ($resultado);
		if ($numLinhas != 0) {
			while ($dados  = mysql_fetch_array ($resultado)) {
				$numeroExpProfissional = $dados['numero'];
			}
			return $numeroExpProfissional;
		} else {
			return -1;
		}
	}
	
	function imprimeCurriculo ()
	{
		//FORMACAO ACADEMICA
		$expAcademicas = $this->imprimeFormacaoAcademica();
		if ($expAcademicas == "erro") {
			return "Erro ao imprimir formação acadêmica!";
		} else if ($expAcademicas == "vazio") {
			$experienciasAcademicas = "Não há formações acadêmicas cadastradas no sistema!";
		} else {
			$numExpAcademicas = count ($this->imprimeFormacaoAcademica());
			if ($numExpAcademicas == 0) {
				$experienciasAcademicas = "Não há formações acadêmicas cadastradas no sistema!";		
			} else {
				for ($i = 0; $i < $numExpAcademicas; $i++) {
					$experienciasAcademicas.= $expAcademicas[$i];
				}				
			}
		}
		//EXPERIENCIA PROFISSIONAL
		$expProfissionais = $this->imprimeExperienciaProfissional();
		if ($expProfissionais == "erro") {
			return "Erro ao imprimir experiência profissional!";
		} else if ($expProfissionais == "vazio") {
			$experienciasProfissionais = "Não há experiências profissionais cadastradas no sistema!";
		} else {
			$numExpProfissionais = count ($this->imprimeExperienciaProfissional());
			if ($numExpProfissionais == 0) {
				$experienciasProfissionais = "Não há experiências profissionais cadastradas no sistema!";		
			} else {
				for ($i = 0; $i < $numExpProfissionais; $i++) {
					$experienciasProfissionais.= $expProfissionais[$i];
				}				
			}
		}
		return $this->imprimeDadosPessoais().$experienciasAcademicas.$experienciasProfissionais.
		$this->imprimeHabilidades().$this->imprimePesquisaImagem();
	}
	
	function imprimeDadosPessoais ()
	{
		return 
		"<h2>Dados Pessoais</h2><br/>
		<ul>
		<li>Nome: ".$this->pessoa->getNome()."</li>
		<li>Nacionalidade: ".$this->pessoa->getNacionalidade()."</li>
		<li>Data de Nascimento: ".$this->pessoa->getDataNascimento()."</li>
		<li>Sexo: ".$this->pessoa->getSexo()."</li>
		<li>Estado civil: ".$this->pessoa->getEstadoCivil()."</li>
		<li>Endereço: ".$this->pessoa->getEndereco()."</li>
		<li>Número: ".$this->pessoa->getNumero()."</li>
		<li>Complemento: ".$this->pessoa->getComplemento()."</li>
		<li>Bairro: ".$this->pessoa->getBairro()."</li>
		<li>CEP: ".$this->pessoa->getCEP()."</li>
		<li>Cidade: ".$this->pessoa->getCidade()."</li>
		<li>Estado: ".$this->pessoa->getEstado()."</li>
		<li>Telefone Residencial: ".$this->pessoa->getTelefoneResidencial()."</li>
		<li>Celular: ".$this->pessoa->getCelular()."</li>
		</ul><br/>";
	}
	
	function imprimeFormacaoAcademica ()
	{
		$numExpAcademica = $this->getNumeroExpAcademica();
		if ($numExpAcademica == -1) {
			return "erro";
		} else if ($numExpAcademica == 0) {
			return "vazio"; 
		} else {			
			$texto = array ();
			for ($i = 0; $i < $numExpAcademica; $i++) {
				$texto[] = "<h2>Formação Acadêmica ".($i+1)."</h2><br/>
				<ul>
				<li>Instituição: ".$this->expAcademica->getInstituicao()."</li>
				<li>Curso: ".$this->expAcademica->getCurso()."</li>
				<li>Tipo: ".$this->expAcademica->getTipo()."</li>
				<li>Turno: ".$this->expAcademica->getTurno()."</li>
				<li>Semestre: ".$this->expAcademica->getSemestre()."</li>
				<li>Data de Ingresso: ".$this->expAcademica->getDataIngresso()."</li>
				<li>Data de Conclusão: ".$this->expAcademica->getDataConclusao()."</li>
				</ul><br/>";	
			}
			return $texto;
		}
	}
	
	function imprimeExperienciaProfissional ()
	{
		$numExpProfissional = $this->getNumeroExpProfissional();
		if ($numExpProfissional == -1) {
			return "erro";
		} else if ($numExpProfissional == 0) {
			return "vazio"; 
		} else {			
			$texto = array ();
			for ($i = 0; $i < $numExpProfissional; $i++) {
				$texto[] = "<h2>Experiência Profissional ".($i+1)."</h2><br/>
				<ul>
				<li>Empresa: ".$this->expProfissional->getEmpresa()."</li>
				<li>Tipo: ".$this->expProfissional->getTipo()."</li>
				<li>Data de Início: ".$this->expProfissional->getDataIngresso()."</li>
				<li>Data de Conclusão: ".$this->expProfissional->getDataConclusao()."</li>
				<li>Atividade: ".$this->expProfissional->getAtividade()."</li>
				</ul><br/>";	
			}
			return $texto;
		}
	}
	
	function imprimeIdiomas ()
	{
		if (!empty ($this->pessoa->getOutro1())) {
			$outro1 = "<li>".$this->pessoa->getOutro1().": ".$this->pessoa->getOutro1Nivel()." </li>"; 
		} else {
			$outro1 = "";
		}
		if (!empty ($this->pessoa->getOutro2())) {
			$outro2 = "<li>".$this->pessoa->getOutro2().": ".$this->pessoa->getOutro2Nivel()." </li>"; 
		} else {
			$outro2 = "";
		}
		return "<h2>Idiomas</h2><br/>
		<ul>
		<li>Inglês: ".$this->pessoa->getIngles()." </li>
		<li>Espanhol: ".$this->pessoa->getEspanhol()." </li>
		<li>Italiano: ".$this->pessoa->getItaliano()." </li>
		<li>Alemão: ".$this->pessoa->getAlemao()." </li>
		<li>Francês: ".$this->pessoa->getFrances()." </li> "
		.$outro1.$outro2."</ul><br/>";
	}
	
	function imprimeInformatica ()
	{
		return "<h2>Conhecimentos em Informática</h2><br/>
		<ul>
		<li>Pacote Office: ".$this->pessoa->getOffice()." </li>
		<li>Webdesign: ".$this->pessoa->getWebdesign()." </li>
		<li>Editores de Imagem: ".$this->pessoa->getEditorImagem()." </li></ul><br/>";
	}
	
	function imprimeOutrasHabilidades ()
	{
		return "<h2>Outras Habilidades</h2><br/>
		<ul>
		<li>Contabilidade: ".$this->pessoa->getContabilidade()." </li>
		<li>Administração: ".$this->pessoa->getAdministracao()." </li>
		<li>Economia: ".$this->pessoa->getEconomia()." </li>
		<li>Finanças: ".$this->pessoa->getFinancas()." </li>
		<li>Recursos Humanos: ".$this->pessoa->getRecursosHumanos()." </li>
		<li>Tecnologia da Informação: ".$this->pessoa->getTecnologiaDaInformacao()." </li>
		<li>Marketing: ".$this->pessoa->getMarketing()." </li>
		<li>Outros Estudos: ".$this->pessoa->getOutrosEstudos()." </li>
		</ul><br/>";
	}
	
	function imprimeHabilidades ()
	{
		return $this->imprimeIdiomas().$this->imprimeInformatica().$this->imprimeOutrasHabilidades();
	}
	
	function imprimePesquisaImagem ()
	{
		if (!empty($this->pessoa->getRecomendador())) {
			$recomendador = $this->pessoa->getRecomendador();
		} else {
			$recomendador = "";
		}
		return "<h2>Pesquisa de Imagem</h2><br/>
		<ol>
		<li>Você conhecia a AIESEC antes do processo seletivo?
			<ul><li>".$this->pessoa->getPergunta1()." </li></ul>
		</li>
		<li>Você pretende realizar intercâmbio pela AIESEC?
			<ul><li>".$this->pessoa->getPergunta2()." </li></ul>
		</li>
		<li>Já teve experiência internacional?
			<ul><li>".$this->pessoa->getPergunta3()." </li></ul>
		</li>
		<li>Já teve experiência internacional?
			<ul><li>".$this->pessoa->getPergunta3()." </li></ul>
		</li>
		<li>Qual?
			<ul><li>".$this->pessoa->getPergunta4()." </li></ul>
		</li>
		<li>Por que você está se inscrevendo para o processo seletivo da AIESEC?
			<ul><li>".$this->pessoa->getPergunta5()." </li></ul>
		</li>
		<li>Como ficou sabendo sobre a AIESEC?
			<ul><li>".$this->pessoa->getPergunta6()." ".$recomendador."</li></ul>
		</li>
		</ol><br/>";
	}
	
}
?>