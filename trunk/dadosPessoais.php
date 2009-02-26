<?php 
	require_once ("utils/sessao.php");
	require_once ("utils/BancoDados.php");	
	include ("cabecalho.php");
	include ("menu.php");
	require_once ("classes/Pessoa.php");	
	restritoUsuario ();	 
	$idLogin = $_SESSION['idLogin'];
	/*-------------Testa variaveis------------------*/
	//testa se a variavel aviso existe
	if(isset($_GET['aviso'])) {
		$aviso = $_GET['aviso'];	
	} else {
		$aviso = "";
	}
	//testa se a variavel nome existe
	if(isset($_REQUEST['nome'])) {
		$nome = $_REQUEST['nome'];	
	} else {
		$nome = "";
	}
	//testa se a variavel dataNascimento existe
	if(isset($_REQUEST['dataNascimento'])) {
		$dataNascimento = $_REQUEST['dataNascimento'];	
	} else {
		$dataNascimento = "";
	}
	//testa se a variavel sexo existe
	if(isset($_REQUEST['sexo'])) {
		$sexo = $_REQUEST['sexo'];	
	} else {
		$sexo = "";
	}
	//testa se a variavel cidade existe
	if(isset($_REQUEST['cidade'])) {
		$cidade = $_REQUEST['cidade'];	
	} else {
		$cidade = "Santa Maria";
	}
	//testa se a variavel cidadeOutra existe
	if(isset($_REQUEST['cidadeOutra'])) {
		$cidadeOutra = $_REQUEST['cidadeOutra'];	
	} else {
		$cidadeOutra = "";
	}
	//testa se a variavel estado existe
	if(isset($_REQUEST['estado'])) {
		$estado = $_REQUEST['estado'];	
	} else {
		$estado = "RS";
	}
	//testa se a variavel estadoOutro existe
	if(isset($_REQUEST['estadoOutro'])) {
		$estadoOutro = $_REQUEST['estadoOutro'];	
	} else {
		$estadoOutro = "";
	}
	//testa se a variavel telResidencial existe
	if(isset($_REQUEST['telResidencial'])) {
		$telResidencial = $_REQUEST['telResidencial'];	
	} else {
		$telResidencial = "";
	}
	//testa se a variavel celular existe
	if(isset($_REQUEST['celular'])) {
		$celular = $_REQUEST['celular'];	
	} else {
		$celular = "";
	}
	//testa se a variavel email existe
	if(isset($_REQUEST['email'])) {
		$email = $_REQUEST['email'];	
	} else {
		$email = "";
	}
	//testa se a variavel msn existe
	if(isset($_REQUEST['msn'])) {
		$msn = $_REQUEST['msn'];	
	} else {
		$msn = "";
	}
	//testa se a variavel orkut existe
	if(isset($_REQUEST['orkut'])) {
		$orkut = $_REQUEST['orkut'];	
	} else {
		$orkut = "";
	}
	//testa se a variavel email existe
	if(isset($_REQUEST['email'])) {
		$email = $_REQUEST['email'];	
	} else {
		$email = "";
	}
	//testa se a variavel tipo existe
	if(isset($_REQUEST['tipo'])) {
		$tipo = $_REQUEST['tipo'];	
	} else {
		$tipo = "";
	}
?>
<!-- Sub-titulo -->
<h3><u>Passo 1:</u> Dados Pessoais</h3>
<?php
if(!empty($aviso)) {
	echo '<ul class="erro"><li>'.$aviso.'</li></ul>';	
}

$conexaoBD = new BancoDados ();
//verifica se a conexao ao banco de dados ocorreu corretamente
if (!$conexaoBD->conecta()) {
	echo '<ul class="erro"><li>Erro de sistema (1)! Contate o administrador do sistema!</li></ul>';
} else {
	if (isset($idLogin)) {
		$pessoa = new Pessoa ($idLogin, "", "", "", "", "", "", 0, "", "", 0, "", "", "", "", "", "", 0, $conexaoBD);
		$resultado = $pessoa->buscaPorIdUsuario ();
		if ($resultado == true) {
			$result = $pessoa->busca();
			if ($result == true) {
				if (empty ($aviso)) {
					$nome = $pessoa->getNome ();				
					$dataNascimento = $pessoa->converteDataNascimento();
					$sexo = $pessoa->getSexo();
					$cidade = $pessoa->getCidade ();
					if ($cidade == "Outra") {
						$cidadeOutra = $pessoa->getCidade(); 
					}
					$estado = $pessoa->getEstado(); 
					if ($estado == "Outro") {
						$estadoOutro = $pessoa->getEstado(); 
					}
					$telResidencial = $pessoa->getTelResidencial();
					$celular = $pessoa->getCelular();
					$msn = $pessoa->getMsn();
					$orkut = $pessoa->getOrkut();
				} else {
					echo '<ul class="erro"><li>Erro de sistema (2)! Contate o administrador do sistema!</li></ul>';
				}
			} else {
					echo '<ul class="erro"><li>Erro de sistema (3)! Contate o administrador do sistema!</li></ul>';
			}
		}
	} else {
		echo '<ul class="erro"><li>Erro de sistema (4)! Contate o administrador do sistema!</li></ul>';
	}
}

echo '<form action="dadosPessoaisBD.php" method="POST" enctype="multipart/form-data">';
echo '<table class="tabela">';
//-------------Nome---------------
echo '<tr><td>Nome:<font class="erro">*</font></td>';
echo '<td><input type="text" id="nome" name="nome" value="'.$nome.'" size="50" maxlength="50"></td></tr>';
//----------Data de Nascimento---------
echo '<tr><td><a href="#" class="dica">Data de Nascimento:<span>Esse campo deve ter o formato dd/mm/aaaa!</span>
</a><font class="erro">*</font>&nbsp;&nbsp;</td>';
echo '<td><input type="text" value="'.$dataNascimento.'" readonly id="dataNascimento" name="dataNascimento" size="10" maxlength="10">
<input type="button" value="Calendário" onClick=displayCalendar(document.forms[0].dataNascimento,"dd/mm/yyyy",this)>';
echo '</td></tr>';
echo '<tr></tr>';
//----------Sexo----------------------
echo '<tr><td>Sexo:<font class="erro">*</font></td>';
echo '<td><select id="sexo" name="sexo">';
echo '<option value="0"> -- Selecione -- </option>';
echo '<option value="Feminino" '.($sexo == "Feminino"?'selected="selected"':"").'>Feminino</option>';
echo '<option value="Masculino" '.($sexo == "Masculino"?'selected="selected"':"").'>Masculino</option>';
echo '</select></td></tr>';
//--------------------------Cidade------------------------------
echo '<tr><td>Cidade: <font class="erro">*</font></td>';
echo '<td><select id="cidade" name="cidade" onchange="
if(this.options[this.selectedIndex].value==\'Outra\') { 
	blocoAbre($(\'blocoOutra\')); 
} else { blocoFecha($(\'blocoOutra\')); }
">';
echo '<option value="Santa Maria" '.($cidade == "Santa Maria"?'selected="selected"':"").'>Santa Maria</option>';
echo '<option value="Outra" '.($cidade == "Outra"?'selected="selected"':"").'>Outra</option>';
echo '</select><span id="blocoOutra" '.($cidade == "Outra"?'':'style="display:none"').'>
&nbsp;&nbsp;<input type="text" name="cidadeOutra" id="cidadeOutra" 
value="'.$cidadeOutra.'" size="30" maxlength="30"/></span></td></tr>';
echo '</td></tr>';
//------------------------Estado---------------------------------
echo '<tr><td>Estado: <font class="erro">*</font></td>';
echo '<td><select id="estado" name="estado" onchange="
if(this.options[this.selectedIndex].value==\'Outro\') { 
	blocoAbre($(\'blocoOutro\')); 
} else { blocoFecha($(\'blocoOutro\')); }
">';
echo '<option value="RS" '.($estado == "RS"?'selected="selected"':"").'>Rio Grande do Sul</option>
<option value="Outro" '.($estado == "Outro"?'selected="selected"':"").'>Outro</option>
</select><span id="blocoOutro" '.($estado == "Outro"?'':'style="display:none"').'>
<input type="text" name="estadoOutro" id="estadoOutro" 
value="'.$estadoOutro.'" size="27" maxlength="50"/></span></td></tr>';
//---------------------Telefone Residencial-------------------------
echo '<tr><td><a href="#" class="dica">Telefone Residencial:<span>Esse campo deve ter o formato(prefixo) 
dddd-dddd, onde prefixo é o número do prefixo e d é um dígito(número)!</span></a></td>';
echo '<td><input type="text" id="telResidencial" value="'.$telResidencial.'" NAME="telResidencial" 
size="20" maxlength="16"></td></tr>';
//----------------------------Celular---------------------------------
echo '<tr><td><a href="#" class="dica">Celular: <span>Esse campo deve ter o formato (prefixo)dddd-dddd, 
onde prefixo é o número do prefixo e d é um dígito(número)!</span></a><font class="erro">*</font></td>';
echo '<td><input type="text" id="celular" name="celular" value="'.$celular.'" size="20" 
maxlength="16"></td></tr>';
//-----------------------------Foto-------------------------------------
echo '<tr><td><a href="#" class="dica">Foto de rosto: <span>Esse campo só aceita arquivos no formato jpg, png, gif e bmp. A foto a ser anexada <u>deve ser obrigatoriamente</u> uma foto de <b>rosto</b>!</span></a><font class="erro">*</font></td>';
echo '<input type="hidden" name="MAX_FILE_SIZE" value="2000000">';
echo '<td><input type="file" name="foto"></td></tr>';
echo '<tr><td colspan="2"><center><img src="foto.php?id='.$_SESSION['idLogin'].'" width="100" height="120"></center></td></tr>';
//------------------------------MSN-------------------------------------
echo '<tr><td><a href="#" class="dica">MSN:<span>Esse campo deve ser preenchido com um e-mail válido!</span> </a><font class="erro">*</font></td>';
echo '<td><input name="msn" id="msn" value="'.$msn.'" type="text" size="30" maxlength="30" /></td></tr>';
//------------------------------ORKUT-------------------------------------
echo '<tr><td><a href="#" class="dica">Perfil do orkut:<span>Esse campo deve ser preenchido com um link válido!</span></a></td>';
echo '<td><input name="orkut" id="orkut" value="'.$orkut.'" type="text" size="50" maxlength="200" /></td></tr>';
//--------
echo '</table><br />';
echo '<center>';
echo '<table cellpadding="15">';
echo '<tr><td><input type=Submit value="Ir para o próximo passo" /></form></td>';
echo '</table>';
echo '</center>';
echo '<ul class="ajuda"><li>Os campos marcados com asterisco (<font class="erro">*</font>) são obrigatórios!</li></ul>';
//---------------Rodape-------------------
include ("rodape.php"); 
?>