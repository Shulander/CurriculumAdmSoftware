<?php
/*
 * Criado com a bibliteca http://www.fpdf.org/
 */

require_once ("../utils/sessao.php");
require_once ("../utils/BancoDados.php");
require_once ("../classes/Usuario.php");
require_once ("../classes/Pessoa.php");
require_once ("../classes/Curriculo.php");
require_once ("../classes/ExpAcademica.php");
require_once ("../classes/ExpProfissional.php");

require_once("fpdf/fpdf.php");
require_once('fpdf/bmp_funcoes.php');

// para descobrir qual é a pasta temporária
$temporaryFolder = getTempDir();

$idLogin = @$_GET['id']+0;
$conexaoBD = new BancoDados ();
$conexaoBD->conecta();
//busca todos que marcaram entrevista com dados completos
$sql = "SELECT p.id, p.nome, p.msn, p.dataNascimento, p.sexo, p.orkut,
p.cidade, p.estado,
p.telResidencial, p.celular, p.ingles, p.espanhol, p.italiano,
p.frances, p.alemao, p.outro1Nivel, p.outro2Nivel, p.outro1,p.outro2,
p.office, p.webdesign, p.editorImagem, p.pergunta1, p.pergunta2, p.pergunta3,
p.pergunta4, p.pergunta5, p.pergunta6, p.recomendador, p.contabilidade, p.administracao,
p.economia, p.financas, p.recursosHumanos, p.tecnologiaInformacao, p.marketing, p.outrosEstudos ,l.email FROM login as l JOIN pessoa as p ON l.id=p.idLogin WHERE idLogin=".$idLogin;
$consulta = mysql_query($sql, $conexaoBD->getLink());
$numLinhas = mysql_num_rows ($consulta);
$tipo = '';
if ($numLinhas != 0) {
	$dados  = mysql_fetch_array ($consulta,MYSQL_ASSOC);
	$idPessoa = $dados['id'];
	$nomePessoa = $dados['nome'];
	$dadosPessoais = "<b>Dados Pessoais</b><br />";
	
	$dadosPessoais .= "<b>Código</b>: ".$dados['id']."<br />";
	$dadosPessoais .= "<b>Nome</b>: ".$dados['nome']."<br />";
	$dataBD = explode("-", $dados2['dataNascimento']);
	$data = $dataBD[2]."/".$dataBD[1]."/".$dataBD[0];	
	$dadosPessoais .= "<b>Data de Nascimento</b>: ".$data."<br />";
	$dadosPessoais .= "<b>E-mail</b>: ".$dados['email']."<br />";
	$dadosPessoais .= "<b>Sexo</b>: ".$dados['sexo']."<br />";
	$dadosPessoais .= "<b>Cidade</b>: ".$dados['cidade']."<br />";
	$dadosPessoais .= "<b>Estado</b>: ".$dados['estado']."<br />";
	$dadosPessoais .= "<b>Telefone Residencial</b>: ".$dados['telResidencial']."<br />";
	$dadosPessoais .= "<b>Celular</b>: ".$dados['celular']."<br />";
	$dadosPessoais .= "<b>MSN</b>: ".$dados['msn']."<br />";
	$dadosPessoais .= "<b>Orkut</b>: ".$dados['orkut']."<br />";
	$outrosDados = "<br />";
	$outrosDados .= "<b>Habilidades</b><br />";
	if ($dados['ingles'] == "basico") {
		$outrosDados .= "<b>Inglês</b>: Nível Básico<br />";
	} else if ($dados['ingles'] == "intermediario") {
		$outrosDados .= "<b>Inglês</b>: Nível Intermediário<br />";
	} else if ($dados['ingles'] == "avancado") {
		$outrosDados .= "<b>Inglês</b>: Nível Avançado<br />";
	} else if ($dados['ingles'] == "fluente") {
		$outrosDados .= "<b>Inglês</b>: Fluente<br />";
	}
	if ($dados['espanhol'] == "basico") {
		$outrosDados .= "<b>Espanhol</b>: Nível Básico<br />";
	} else if ($dados['espanhol'] == "intermediario") {
		$outrosDados .= "<b>Espanhol</b>: Nível Intermediário<br />";
	} else if ($dados['espanhol'] == "avancado") {
		$outrosDados .= "<b>Espanhol</b>: Nível Avançado<br />";
	} else if ($dados['espanhol'] == "fluente") {
		$outrosDados .= "<b>Espanhol</b>: Fluente<br />";
	}
	if ($dados['espanhol'] == "basico") {
		$outrosDados .= "<b>Espanhol</b>: Nível Básico<br />";
	} else if ($dados['espanhol'] == "intermediario") {
		$outrosDados .= "<b>Espanhol</b>: Nível Intermediário<br />";
	} else if ($dados['espanhol'] == "avancado") {
		$outrosDados .= "<b>Espanhol</b>: Nível Avançado<br />";
	} else if ($dados['espanhol'] == "fluente") {
		$outrosDados .= "<b>Espanhol</b>: Fluente<br />";
	}
	if ($dados['italiano'] == "basico") {
		$outrosDados .= "<b>Italiano</b>: Nível Básico<br />";
	} else if ($dados['italiano'] == "intermediario") {
		$outrosDados .= "<b>Italiano</b>: Nível Intermediário<br />";
	} else if ($dados['italiano'] == "avancado") {
		$outrosDados .= "<b>Italiano</b>: Nível Avançado<br />";
	} else if ($dados['italiano'] == "fluente") {
		$outrosDados .= "<b>Italiano</b>: Fluente<br />";
	}
	if ($dados['alemao'] == "basico") {
		$outrosDados .= "<b>Alemão</b>: Nível Básico<br />";
	} else if ($dados['alemao'] == "intermediario") {
		$outrosDados .= "<b>Alemão</b>: Nível Intermediário<br />";
	} else if ($dados['alemao'] == "avancado") {
		$outrosDados .= "<b>Alemão</b>: Nível Avançado<br />";
	} else if ($dados['alemao'] == "fluente") {
		$outrosDados .= "<b>Alemão</b>: Fluente<br />";
	}
	if ($dados['frances'] == "basico") {
		$outrosDados .= "<b>Francês</b>: Nível Básico<br />";
	} else if ($dados['frances'] == "intermediario") {
		$outrosDados .= "<b>Francês</b>: Nível Intermediário<br />";
	} else if ($dados['frances'] == "avancado") {
		$outrosDados .= "<b>Francês</b>: Nível Avançado<br />";
	} else if ($dados['frances'] == "fluente") {
		$outrosDados .= "<b>Francês</b>: Fluente<br />";
	}
	if (!empty ($dados['outro1'])) {
		$outrosDados .= "<b>".$dados['outro1']."</b>: ".$dados['outro1Nivel']."<br />";
	}
	if (!empty ($dados['outro2'])) {
		$outrosDados .= "<b>".$dados['outro2']."</b>: ".$dados['outro2Nivel']."<br />";
	}
	if (!empty ($dados['office'])) {
		if ($dados['office'] == "basico") {
			$outrosDados .= "<b>Pacote Office</b>: Nível Básico<br />";
		} else if ($dados['office'] == "intermediario") {
			$outrosDados .= "<b>Pacote Office</b>: Nível Intermediário<br />";
		} else if ($dados['office'] == "avancado") {
			$outrosDados .= "<b>Pacote Office</b>: Nível Avançado<br />";
		} else if ($dados['office'] == "expert") {
			$outrosDados .= "<b>Pacote Office</b>: Expert<br />";
		} else {
			$outrosDados .= "<b>Pacote Office</b>: Nenhum conhecimento<br />";
		}
	}
	if (!empty ($dados['webdesign'])) {
		if ($dados['webdesign'] == "basico") {
			$outrosDados .= "<b>Webdesign</b>: Nível Básico<br />";
		} else if ($dados['webdesign'] == "intermediario") {
			$outrosDados .= "<b>Webdesign</b>: Nível Intermediário<br />";
		} else if ($dados['webdesign'] == "avancado") {
			$outrosDados .= "<b>Webdesign</b>: Nível Avançado<br />";
		} else if ($dados['webdesign'] == "expert") {
			$outrosDados .= "<b>Webdesign</b>: Expert<br />";
		} else {
			$outrosDados .= "<b>Webdesign</b>: Nenhum conhecimento<br />";
		}
	}
	if (!empty ($dados['editorImagem'])) {
		if ($dados['editorImagem'] == "basico") {
			$outrosDados .= "<b>Editor de Imagem</b>: Nível Básico<br />";
		} else if ($dados['editorImagem'] == "intermediario") {
			$outrosDados .= "<b>Editor de Imagem</b>: Nível Intermediário<br />";
		} else if ($dados['editorImagem'] == "avancado") {
			$outrosDados .= "<b>Editor de Imagem</b>: Nível Avançado<br />";
		} else if ($dados['editorImagem'] == "expert") {
			$outrosDados .= "<b>Editor de Imagem</b>: Expert<br />";
		} else {
			$outrosDados .= "<b>Editor de Imagem</b>: Nenhum conhecimento<br />";
		}
	}
	if (!empty ($dados['contabilidade'])) {
		$outrosDados .= "<b>Contabilidade</b>: ".$dados['contabilidade']."<br />";
	}
	if (!empty ($dados['administracao'])) {
		$outrosDados .= "<b>Administração</b>: ".$dados['administracao']."<br />";
	}
	if (!empty ($dados['economia'])) {
		$outrosDados .= "<b>Economia</b>: ".$dados['economia']."<br />";
	}
	if (!empty ($dados['financas'])) {
		$outrosDados .= "<b>Finanças</b>: ".$dados['financas']."<br />";
	}
	if (!empty ($dados['recursosHumanos'])) {
		$outrosDados .= "<b>Recursos Humanos</b>: ".$dados['recursosHumanos']."<br />";
	}
	if (!empty ($dados['marketing'])) {
		$outrosDados .= "<b>Marketing</b>: ".$dados['marketing']."<br />";
	}
	if (!empty ($dados['tecnologiaInformacao'])) {
		$outrosDados .= "<b>Tecnologia da Informação</b>: ".$dados['tecnologiaInformacao']."<br />";
	}
	if (!empty ($dados['outrosEstudos'])) {
		$outrosDados .= "<b>Outros Estudos</b>: ".$dados['outrosEstudos']."<br />";
	}
	$outrosDados .= "<br />";
	$outrosDados .= "<b>Pesquisa de Imagem</b><br />";	
	$outrosDados .= "<b>Você conhecia a AIESEC antes do processo seletivo?</b>: ".$dados['pergunta1']."<br />";
	$outrosDados .= "<b>Você pretende realizar intercâmbio pela AIESEC?</b>: ".$dados['pergunta2']."<br />";
	$outrosDados .= "<b>Já teve experiência internacional?</b>: ".$dados['pergunta3']."<br />";
	$outrosDados .= "<b>Qual?</b>: ".$dados['pergunta4']."<br />";
	$outrosDados .= "<b>Por que você está se inscrevendo para o processo seletivo da AIESEC? </b>: ".$dados['pergunta5']."<br />";
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
			$outrosDados .= "<b>Formação Acadêmica ".($i+1)."</b><br />";
			
			$outrosDados .= "<b>Instituição</b>: ".$dados2['instituicao']."<br />";
			$outrosDados .= "<b>Curso</b>: ".$dados2['curso']."<br />";
			$outrosDados .= "<b>Tipo</b>: ".$dados2['tipo']."<br />";
			$outrosDados .= "<b>Turno</b>: ".$dados2['turno']."<br />";
			$outrosDados .= "<b>Semestre</b>: ".$dados2['semestre']."<br />";
			$dataBD = explode("-", $dados2['dataIngresso']);
			$data = $dataBD[2]."/".$dataBD[1]."/".$dataBD[0];	
			$outrosDados .= "<b>Data de ingresso</b>: ".$data."<br />";
			unset ($dataBD);
			unset ($data);
			$dataBD = explode("-", $dados2['dataConclusao']);
			$data = $dataBD[2]."/".$dataBD[1]."/".$dataBD[0];	
			$outrosDados .= "<b>Data de Conclusão</b>: ".$data."<br />";
			$outrosDados .= "<br />";
			$i++;
		}
	}
	//mostrar experiencia profissional
	$sql3 = "SELECT * FROM expprofissional WHERE idPessoa=".$idPessoa;
	$consulta3 = mysql_query($sql3, $conexaoBD->getLink());
	$numLinhas3 = mysql_num_rows ($consulta3);
	if ($numLinhas3 != 0) {
		$j = 0;
		while ($dados3  = mysql_fetch_array ($consulta3, MYSQL_ASSOC)) {
			$outrosDados .= "<b>Experiência Profissional ".($j+1)."</b><br />";
			
			$outrosDados .= "<b>Empresa</b>: ".$dados3['empresa']."<br />";
			$outrosDados .= "<b>Tipo</b>: ".$dados3['tipo']."<br />";
			$outrosDados .= "<b>Atividade</b>: ".$dados3['atividade']."<br />";
			$dataBD = explode("-", $dados3['dataInicio']);
			$data = $dataBD[2]."/".$dataBD[1]."/".$dataBD[0];	
			$outrosDados .= "<b>Data de Início</b>: ".$data."<br />";
			unset ($dataBD);
			unset ($data);
			$dataBD = explode("-", $dados3['dataConclusao']);
			$data = $dataBD[2]."/".$dataBD[1]."/".$dataBD[0];
			$outrosDados .= "<b>Data de Conclusão</b>: ".$data."<br />";
			
			$outrosDados .= "<br />";
			$j++;
		}
	}
	
	$outrosDados .= "<hr><br />";
	
	$query = "SELECT name, type, size, content " .
	         "FROM fotos WHERE fk_login = $idLogin";
	
	$result = mysql_query($query) or die('Error, query failed '.mysql_error());
	if(mysql_num_rows($result)==1) {
		list($name, $type, $size, $content) = mysql_fetch_array($result);
		switch($type) {
			case 'image/jpeg':
			case 'image/pjpeg':
				$tipo = '.jpg';
				break;
			case 'image/gif':
				$tipo = '.gif';
				break;
			case 'image/png':
			case 'image/x-png':
				$tipo = '.png';
				break;
			case 'image/bmp':
				$tipo = '.bmp';
				break;
			default:
				$tipo = '.jpg';
		}
		
//array('image/jpeg' => 1,'image/gif' => 1,'image/png' => 1,'image/bmp' => 1, 'image/pjpeg' => 1, 'image/x-png' => 1);		
		$fileHandle = fopen($temporaryFolder."/".$idLogin.$tipo, 'w');
		fwrite( $fileHandle, $content, $size );
		fclose($fileHandle);
		if($tipo == '.bmp') {			
			/*** read in the BMP image ***/
			$img = ImageCreateFromBmp($temporaryFolder."/".$idLogin.$tipo);
			/*** write the new jpeg image ***/
			imagejpeg($img, $temporaryFolder."/".$idLogin.'.jpg');
			$tipo = '.jpg';
		}
	}
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
if(file_exists  ($temporaryFolder."/".$idLogin.$tipo)) {
	$pdf->Image($temporaryFolder."/".$idLogin.$tipo,140,40,50,0);
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
$pdf->Output('@SM_Curriculum_'.str_replace(" ", "_", $nomePessoa).'.pdf', 'D');
?>
