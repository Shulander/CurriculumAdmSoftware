<?php
/*
 * Criado com a bibliteca http://www.fpdf.org/
 */

// para descobrir qual � a pasta tempor�ria
$tmpfile = tempnam("dummy","");
$temporaryFolder = dirname($tmpfile);
unlink($tmpfile);
require_once ("../utils/sessao.php");
require_once ("../utils/BancoDados.php");
require_once ("../classes/Usuario.php");
require_once ("../classes/Pessoa.php");
require_once ("../classes/Curriculo.php");
require_once ("../classes/ExpAcademica.php");
require_once ("../classes/ExpProfissional.php");

require_once("fpdf/fpdf.php");

$idLogin = @$_GET['id']+0;
$conexaoBD = new BancoDados ();
$conexaoBD->conecta();
//busca todos que marcaram entrevista com dados completos
$sql = "SELECT p.id, p.nome, p.nacionalidade, p.dataNascimento, p.sexo, p.estadoCivil,
p.endereco, p.numero, p.complemento, p.bairro, p.cep, p.cidade, p.estado,
p.telResidencial, p.celular, p.ingles, p.espanhol, p.italiano,
p.frances, p.alemao, p.outro1Nivel, p.outro2Nivel, p.outro1,p.outro2,
p.office, p.webdesign, p.editorImagem, p.pergunta1, p.pergunta2, p.pergunta3,
p.pergunta4, p.pergunta5, p.pergunta6, p.recomendador, p.contabilidade, p.administracao,
p.economia, p.financas, p.recursosHumanos, p.tecnologiaInformacao, p.marketing, p.outrosEstudos ,l.email FROM login as l JOIN pessoa as p ON l.id=p.idLogin WHERE idLogin=".$idLogin;
$consulta = mysql_query($sql, $conexaoBD->getLink());
$numLinhas = mysql_num_rows ($consulta);
if ($numLinhas != 0) {
	$dados  = mysql_fetch_array ($consulta,MYSQL_ASSOC);
	$idPessoa = $dados['id'];
	$nomePessoa = $dados['nome'];
	$dadosPessoais = "<b>Dados Pessoais</b><br />";
	
	$dadosPessoais .= "<b>C�digo</b>: ".$dados['id']."<br />";
	$dadosPessoais .= "<b>Nome</b>: ".$dados['nome']."<br />";
	$dadosPessoais .= "<b>E-mail</b>: ".$dados['email']."<br />";
	$dadosPessoais .= "<b>Nacionalidade</b>: ".$dados['nacionalidade']."<br />";
	$dadosPessoais .= "<b>Sexo</b>: ".$dados['sexo']."<br />";
	$dadosPessoais .= "<b>Estado Civil</b>: ".$dados['estadoCivil']."<br />";
//	$dadosPessoais .= "<b>Tipo</b>: ".$dados['tipo']."<br />"; // tipo nao existe
	$dadosPessoais .= "<b>Endere�o</b>: ".$dados['endereco']."<br />";
	$dadosPessoais .= "<b>N�mero</b>: ".$dados['numero']."<br />";
	$dadosPessoais .= "<b>Complemento</b>: ".$dados['complemento']."<br />";
	$dadosPessoais .= "<b>Bairro</b>: ".$dados['bairro']."<br />";
	$dadosPessoais .= "<b>CEP</b>: ".$dados['cep']."<br />";
	$dadosPessoais .= "<b>Cidade</b>: ".$dados['cidade']."<br />";
	$dadosPessoais .= "<b>Estado</b>: ".$dados['estado']."<br />";
	$dadosPessoais .= "<b>Telefone Residencial</b>: ".$dados['telResidencial']."<br />";
	$dadosPessoais .= "<b>Celular</b>: ".$dados['celular']."<br />";
	
	$outrosDados = "<br />";
	$outrosDados .= "<b>Habilidades</b><br />";
	
	$outrosDados .= "<b>Ingl�s</b>: ".$dados['ingles']."<br />";
	$outrosDados .= "<b>Espanhol</b>: ".$dados['espanhol']."<br />";
	$outrosDados .= "<b>Italiano</b>: ".$dados['italiano']."<br />";
	$outrosDados .= "<b>Franc�s</b>: ".$dados['frances']."<br />";
	$outrosDados .= "<b>Alem�o</b>: ".$dados['alemao']."<br />";
	if (!empty ($dados['outro1'])) {
		$outrosDados .= "<b>".$dados['outro1']."</b>: ".$dados['outro1Nivel']."<br />";
	}
	if (!empty ($dados['outro2'])) {
		$outrosDados .= "<b>".$dados['outro2']."</b>: ".$dados['outro2Nivel']."<br />";
	}
	$outrosDados .= "<b>Pacote Office</b>: ".$dados['office']."<br />";
	$outrosDados .= "<b>Webdesign</b>: ".$dados['webdesign']."<br />";
	$outrosDados .= "<b>Editor de Imagem</b>: ".$dados['editorImagem']."<br />";
	$outrosDados .= "<b>Contabilidade</b>: ".$dados['contabilidade']."<br />";
	$outrosDados .= "<b>Administra��o</b>: ".$dados['administracao']."<br />";
	$outrosDados .= "<b>Economia</b>: ".$dados['economia']."<br />";
	$outrosDados .= "<b>Finan�as</b>: ".$dados['financas']."<br />";
	$outrosDados .= "<b>Recursos Humanos</b>: ".$dados['recursosHumanos']."<br />";
	$outrosDados .= "<b>Marketing</b>: ".$dados['marketing']."<br />";
	$outrosDados .= "<b>Tecnologia da Informa��o</b>: ".$dados['tecnologiaInformacao']."<br />";
	$outrosDados .= "<b>Outros Estudos</b>: ".$dados['outrosEstudos']."<br />";
	
	$outrosDados .= "<br />";
	$outrosDados .= "<b>Pesquisa de Imagem</b><br />";
	
	$outrosDados .= "<b>Voc� conhecia a AIESEC antes do processo seletivo?</b>: ".$dados['pergunta1']."<br />";
	$outrosDados .= "<b>Voc� pretende realizar interc�mbio pela AIESEC?</b>: ".$dados['pergunta2']."<br />";
	$outrosDados .= "<b>J� teve experi�ncia internacional?</b>: ".$dados['pergunta3']."<br />";
	$outrosDados .= "<b>Qual?</b>: ".$dados['pergunta4']."<br />";
	$outrosDados .= "<b>Por que voc� est� se inscrevendo para o processo seletivo da AIESEC? </b>: ".$dados['pergunta5']."<br />";
	$outrosDados .= "<b>Como ficou sabendo sobre a AIESEC?</b>: ".$dados['pergunta6']."<br />";
	if (!empty($dados['recomendador'])) {
		$outrosDados .= "<b>Recomendador</b>: ".$dados['recomendador']."<br />";
	}
	
	$outrosDados .= "<br />";
	//mostrar experiencia academica
	$sql2 = "SELECT * FROM expacademica WHERE idPessoa=".$idPessoa;
	$consulta2 = mysql_query($sql2, $conexaoBD->getLink());
	$numLinhas2 = mysql_num_rows ($consulta2);
	if ($numLinhas2 != 0) {
		$i = 0;
		while ($dados2  = mysql_fetch_array ($consulta2, MYSQL_ASSOC)) {
			$outrosDados .= "<b>Forma��o Acad�mica ".($i+1)."</b><br />";
			
			$outrosDados .= "<b>Institui��o</b>: ".$dados2['instituicao']."<br />";
			$outrosDados .= "<b>Curso</b>: ".$dados2['curso']."<br />";
			$outrosDados .= "<b>Tipo</b>: ".$dados2['tipo']."<br />";
			$outrosDados .= "<b>Turno</b>: ".$dados2['turno']."<br />";
			$outrosDados .= "<b>Semestre</b>: ".$dados2['semestre']."<br />";
			$outrosDados .= "<b>Data de ingresso</b>: ".$dados2['dataIngresso']."<br />";
			$outrosDados .= "<b>Data de Conclus�o</b>: ".$dados2['dataConclusao']."<br />";
			
			$outrosDados .= "<br />";
			$i++;
		}
	} else {
		$outrosDados .= "<b>Forma��o Acad�mica</b><br />";
		$outrosDados .= 'N�o h� experi�ncias acad�micas vinculadas a esse candidato!<br />';
	}
	//mostrar experiencia profissional
	$sql3 = "SELECT * FROM expprofissional WHERE idPessoa=".$idPessoa;
	$consulta3 = mysql_query($sql3, $conexaoBD->getLink());
	$numLinhas3 = mysql_num_rows ($consulta3);
	if ($numLinhas3 != 0) {
		$j = 0;
		while ($dados3  = mysql_fetch_array ($consulta3, MYSQL_ASSOC)) {
			$outrosDados .= "<b>Experi�ncia Profissional ".($j+1)."</b><br />";
			
			$outrosDados .= "<b>Empresa</b>: ".$dados3['empresa']."<br />";
			$outrosDados .= "<b>Tipo</b>: ".$dados3['tipo']."<br />";
			$outrosDados .= "<b>Atividade</b>: ".$dados3['atividade']."<br />";
			$outrosDados .= "<b>Data de In�cio</b>: ".$dados3['dataInicio']."<br />";
			$outrosDados .= "<b>Data de Conclus�o</b>: ".$dados3['dataConclusao']."<br />";
			
			$outrosDados .= "<br />";
			$j++;
		}
	} else {
		$outrosDados .= "<b>Experi�ncia Profissional</b><br />";
		$outrosDados .= 'N�o h� experi�ncias profissionais vinculadas a esse candidato!<br />';
	}
	
	$outrosDados .= "<hr><br />";
	
	$query = "SELECT name, type, size, content " .
	         "FROM fotos WHERE fk_login = $idLogin";
	
	$result = mysql_query($query) or die('Error, query failed '.mysql_error());
	if(mysql_num_rows($result)==1) {
		list($name, $type, $size, $content) = mysql_fetch_array($result);
		
		$fileHandle = fopen($temporaryFolder."/".$idLogin.".jpg", 'w');
		fwrite( $fileHandle, $content, $size );
		fclose($fileHandle);
	}
} else {
//	echo 'c$outrosDados .= 'erro">Ningu�m marcou entrevista!<br />';
}

class PDF extends FPDF
{
	var $B;
	var $I;
	var $U;
	var $HREF;

	//Page header
	function Header()
	{
		//Logo
		$this->Image('./imgs/header_aiesec.jpg',10,8,150);
		//Arial bold 15
		$this->SetFont('Arial','B',15);
		//Move to the right
		//    $this->Cell(80);
		//Title
		//    $this->Cell(30,10,'Title',1,0,'C');
		//Line break
		$this->Ln(20);
	}

	//Page footer
	function Footer()
	{
		//Position at 1.5 cm from bottom
		$this->SetY(-15);
		//Arial italic 8
		$this->SetFont('Arial','I',8);
		//Page number
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}


	function PDF($orientation='P',$unit='mm',$format='A4')
	{
		//Call parent constructor
		$this->FPDF($orientation,$unit,$format);
		//Initialization
		$this->B=0;
		$this->I=0;
		$this->U=0;
		$this->HREF='';
	}

	function WriteHTML($html)
	{
		//HTML parser
		$html=str_replace("\n",' ',$html);
		$a=preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
		foreach($a as $i=>$e)
		{
			if($i%2==0)
			{
				//Text
				if($this->HREF)
				$this->PutLink($this->HREF,$e);
				else
				$this->Write(5,$e);
			}
			else
			{
				//Tag
				if($e[0]=='/')
				$this->CloseTag(strtoupper(substr($e,1)));
				else
				{
					//Extract attributes
					$a2=explode(' ',$e);
					$tag=strtoupper(array_shift($a2));
					$attr=array();
					foreach($a2 as $v)
					{
						if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
						$attr[strtoupper($a3[1])]=$a3[2];
					}
					$this->OpenTag($tag,$attr);
				}
			}
		}
	}

	function OpenTag($tag,$attr)
	{
		//Opening tag
		if($tag=='B' || $tag=='I' || $tag=='U')
		$this->SetStyle($tag,true);
		if($tag=='A')
		$this->HREF=$attr['HREF'];
		if($tag=='BR')
		$this->Ln(5);
	}

	function CloseTag($tag)
	{
		//Closing tag
		if($tag=='B' || $tag=='I' || $tag=='U')
		$this->SetStyle($tag,false);
		if($tag=='A')
		$this->HREF='';
	}

	function SetStyle($tag,$enable)
	{
		//Modify style and select corresponding font
		$this->$tag+=($enable ? 1 : -1);
		$style='';
		foreach(array('B','I','U') as $s)
		{
			if($this->$s>0)
			$style.=$s;
		}
		$this->SetFont('',$style);
	}

	function PutLink($URL,$txt)
	{
		//Put a hyperlink
		$this->SetTextColor(0,0,255);
		$this->SetStyle('U',true);
		$this->Write(5,$txt,$URL);
		$this->SetStyle('U',false);
		$this->SetTextColor(0);
	}
}


$pdf=new PDF();
$pdf->AliasNbPages();

//First page
$pdf->AddPage();
$pdf->SetFont('Arial','',20);
if(file_exists  ($temporaryFolder."/".$idLogin.".jpg")) {
	$pdf->Image($temporaryFolder."/".$idLogin.".jpg",140,40,50,0);
} else {	
	$pdf->Image("./imgs/magical_trevor.jpg",140,40,50,0);
}
$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(70);
$pdf->Cell(30,10,'Curriculum Vitae',0,1);

$pdf->SetFontSize(13);
$pdf->WriteHTML($dadosPessoais);
$pdf->SetRightMargin(10);
$pdf->WriteHTML($outrosDados);
$pdf->Output('@SM_Curriculum_'.str_replace(" ", "_", $nomePessoa).'.pdf', 'I');
?>
