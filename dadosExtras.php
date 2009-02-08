<?php 
	require_once ("utils/sessao.php");
	include ("cabecalho.php");
	include ("menu.php");
	require_once ("utils/BancoDados.php");
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
	//testa se a variavel pergunta1 existe
	if(isset($_REQUEST['pergunta1'])) {
		$pergunta1 = $_REQUEST['pergunta1'];	
	} else {
		$pergunta1 = "nao";
	}
	//testa se a variavel pergunta2 existe
	if(isset($_REQUEST['pergunta2'])) {
		$pergunta2 = $_REQUEST['pergunta2'];	
	} else {
		$pergunta2 = "N�o pretendo";
	}
	//testa se a variavel pergunta3 existe
	if(isset($_REQUEST['pergunta3'])) {
		$pergunta3 = $_REQUEST['pergunta3'];	
	} else {
		$pergunta3 = "nao";
	}
	//testa se a variavel pergunta4 existe
	if(isset($_REQUEST['pergunta4'])) {
		$pergunta4 = $_REQUEST['pergunta4'];	
	} else {
		$pergunta4 = "";
	}	
	//testa se a variavel outro1 existe
	if(isset($_REQUEST['outro1'])) {
		$outro1 = $_REQUEST['outro1'];	
	} else {
		$outro1 = "";
	}	
	//testa se a variavel pergunta5 existe
	if(isset($_REQUEST['pergunta5'])) {
		$pergunta5 = unserialize($_REQUEST['pergunta5']);	
	} else {
		$pergunta5 = array();	
	}	
	//testa se a variavel outro2 existe
	if(isset($_REQUEST['outro2'])) {
		$outro2 = $_REQUEST['outro2'];	
	} else {
		$outro2 = "";
	}
	//testa se a variavel pergunta6 existe
	if(isset($_REQUEST['pergunta6'])) {
		$pergunta6 = $_REQUEST['pergunta6'];	
	} else {
		$pergunta6 = "";
	}
	//testa se a variavel outro3 existe
	if(isset($_REQUEST['outro3'])) {
		$outro3 = $_REQUEST['outro3'];	
	} else {
		$outro3 = "";
	}
	//testa se a variavel recomendador existe
	if(isset($_REQUEST['recomendador'])) {
		$recomendador = $_REQUEST['recomendador'];	
	} else {
		$recomendador = "";
	}				
?>
<!-- Sub-titulo -->
<h3>Pesquisa de Imagem</h3>
<?php
if(!empty($aviso)) {
	if ($aviso == "sucesso") {
		echo '<ul class="sucesso"><li>Pesquisa de imagem cadastrada com sucesso!</li></ul>';
	} else {
		echo '<ul class="erro"><li>'.$aviso.'</li></ul>';	
	}						
}
$conexaoBD = new BancoDados ();
if (!$conexaoBD->conecta()) {
	echo '<ul class="erro"><li>Erro de sistema! Contate o administrador do sistema!</li></ul>';
} else {
	if (isset($idLogin)) {
		$pessoa = new Pessoa ($idLogin, "", "", "", "", "", "", "", "", "", "", "", "", "", "", 0, $conexaoBD); 
		$resultado = $pessoa->buscaPorIdUsuario ();
		if ($resultado == true) { //se pessoa foi cadastrada
			echo '<ul class="ajuda"><li>Seus dados j� foram cadastrados. Para edit�-los, modifique o formul�rio abaixo.</li></ul> '; 
				//editar dados pessoais
				$result = $pessoa->busca();
				if ($result == true) {
					$pesquisa = $pessoa->buscaPesquisa();
					if ($pesquisa == false) {
						echo '<ul class="erro"><li>Erro de sistema! Contate o administrador do sistema!</li></ul>';
					} else {
						$pergunta1 = ($pergunta1=='nao'?$pessoa->getPergunta1():$pergunta1);
						$pergunta2 = ($pergunta2=='N�o pretendo'?$pessoa->getPergunta2():$pergunta2);						
						$pergunta3 = ($pergunta3=='nao'?$pessoa->getPergunta3():$pergunta3);
						$pergunta4 = (empty($pergunta4)?$pessoa->getPergunta4():$pergunta4);
						$pergunta5 = (empty($pergunta5)?array_flip(explode(",", $pessoa->getPergunta5())):$pergunta5);
						$pergunta6 = (empty($pergunta6)?$pessoa->getPergunta6():$pergunta6);
						$recomendador = (empty($recomendador)?$pessoa->getRecomendador():$recomendador);
						echo '<form action="dadosExtrasBD.php" method="POST">';
						//-------------Pergunta 1---------------
						echo '<ol class="normal">';
						echo '<li>Voc� conhecia a AIESEC antes do processo seletivo?<font class="erro">*</font>';
							echo '<ul class="none">';
							echo '<li><input type="radio" id="pergunta1" name="pergunta1" value="sim" '.($pergunta1 == "sim"?'CHECKED"':"").'>Sim</li>';
							echo '<li><input type="radio" id="pergunta1" name="pergunta1" value="nao" '.($pergunta1 == "nao"?'CHECKED"':"").'>N�o</li>';
							echo '</ul>';
						echo '</li>';
						echo '<br/>'; 
						//-------------Pergunta 2---------------
						echo '<li>Voc� pretende realizar interc�mbio pela AIESEC?<font class="erro">*</font>';
							echo '<ul class="none">';
							echo '<li><input type="radio" id="pergunta2" name="pergunta2" value="Em at� seis meses" '.($pergunta2 == "Em at� seis meses"?'CHECKED"':"").'>Em at� seis meses</li>';
							echo '<li><input type="radio" id="pergunta2" name="pergunta2" value="Em at� 1 ano" '.($pergunta2 == "Em at� 1 ano"?'CHECKED"':"").'>Em at� 1 ano</li>';
							echo '<li><input type="radio" id="pergunta2" name="pergunta2" value="Futuramente" '.($pergunta2 == "Futuramente"?'CHECKED"':"").'>Futuramente</li>';
							echo '<li><input type="radio" id="pergunta2" name="pergunta2" value="N�o pretendo" '.($pergunta2 == "N�o pretendo"?'CHECKED"':"").'>N�o pretendo</li>';
							echo '</ul>';
						echo '</li>';
						echo '<br/>';
						//-------------Pergunta 3---------------
						echo '<li>J� teve experi�ncia internacional?<font class="erro">*</font>';
							echo '<ul class="none">';
							echo '<li><input type="radio" id="pergunta3" name="pergunta3" value="sim" '.($pergunta3 == "sim"?'CHECKED"':"").'>Sim</li>';
							echo '<li><input type="radio" id="pergunta3" name="pergunta3" value="nao" '.($pergunta3 == "nao"?'CHECKED"':"").'>N�o</li>';
							echo '</ul>';
						echo '</li>';
						echo '<br/>';
						//-------------Pergunta 4---------------
						echo '<li>Qual?';
							echo '<ul class="none">';
							echo '<li><input type="radio" id="pergunta4" name="pergunta4" value="Interc�mbio" '.($pergunta4 == "Interc�mbio"?'CHECKED"':"").'>Interc�mbio</li>';
							echo '<li><input type="radio" id="pergunta4" name="pergunta4" value="Turismo" '.($pergunta4 == "Turismo"?'CHECKED"':"").'>Turismo</li>';
							echo '<li><input type="radio" id="pergunta4" name="pergunta4" value="J� morei no exterior" '.($pergunta4 == "J� morei no exterior"?'CHECKED"':"").'>J� morei no exterior</li>';
							echo '<li><input type="radio" id="pergunta4" name="pergunta4" value="Outro" '.($pergunta4 == "Outro"?'CHECKED"':"").'>Outro&nbsp;&nbsp;<input type="text" value="'.$outro1.'" id="outro1" name="outro1" size="50" maxlength="50"></li>';
							echo '</ul>';
						echo '</li>';
						echo '<br/>';
						//-------------Pergunta 5---------------
						echo '<li><a href="#" class="dica">Por que voc� est� se inscrevendo para o processo seletivo da AIESEC? <span>Assinale no m�ximo 3 op��es, enumerando de 1 a 3, sendo 1 o principal motivo para a inscri��o.</span></a> <font class="erro">*</font>';
							echo '<ul class="none">';
							echo '<li><input type="radio" id="pergunta5_1" name="pergunta5_1" value="Desenvolvimento profissional e pessoal">1
									<input type="radio" id="pergunta5_2" name="pergunta5_2" value="Desenvolvimento profissional e pessoal">2
									<input type="radio" id="pergunta5_3" name="pergunta5_3" value="Desenvolvimento profissional e pessoal">3 &nbsp;&nbsp;&nbsp;Desenvolvimento profissional e pessoal</li>';
							echo '<li><input type="radio" id="pergunta5_1" name="pergunta5_1" value="Conhecimento sobre outras culturas">1
									<input type="radio" id="pergunta5_2" name="pergunta5_2" value="Conhecimento sobre outras culturas">2
									<input type="radio" id="pergunta5_3" name="pergunta5_3" value="Conhecimento sobre outras culturas">3 &nbsp;&nbsp;&nbsp;Conhecimento sobre outras culturas</li>';							
							echo '<li><input type="radio" id="pergunta5_1" name="pergunta5_1" value="Interc�mbio profissional">1
									<input type="radio" id="pergunta5_2" name="pergunta5_2" value="Interc�mbio profissional">2
									<input type="radio" id="pergunta5_3" name="pergunta5_3" value="Interc�mbio profissional">3 &nbsp;&nbsp;&nbsp;Interc�mbio profissional</li>';							
							echo '<li><input type="radio" id="pergunta5_1" name="pergunta5_1" value="Contribuir com o desenvolvimento social">1
									<input type="radio" id="pergunta5_2" name="pergunta5_2" value="Contribuir com o desenvolvimento social">2
									<input type="radio" id="pergunta5_3" name="pergunta5_3" value="Contribuir com o desenvolvimento social">3 &nbsp;&nbsp;&nbsp;Contribuir com o desenvolvimento social</li>';							
							echo '<li><input type="radio" id="pergunta5_1" name="pergunta5_1" value="Desenvolvimento de lideran�a">1
									<input type="radio" id="pergunta5_2" name="pergunta5_2" value="Desenvolvimento de lideran�a">2
									<input type="radio" id="pergunta5_3" name="pergunta5_3" value="Desenvolvimento de lideran�a">3 &nbsp;&nbsp;&nbsp;Desenvolvimento de lideran�a</li>';											
							echo '<li><input type="radio" id="pergunta5_1" name="pergunta5_1" value="Contato com pessoas e organiza��es">1
									<input type="radio" id="pergunta5_2" name="pergunta5_2" value="Contato com pessoas e organiza��es">2
									<input type="radio" id="pergunta5_3" name="pergunta5_3" value="Contato com pessoas e organiza��es">3 &nbsp;&nbsp;&nbsp;Contato com pessoas e organiza��es</li>';
							echo '<li><input type="radio" id="pergunta5_1" name="pergunta5_1" value="Networking profisional">1
									<input type="radio" id="pergunta5_2" name="pergunta5_2" value="Networking profisional">2
									<input type="radio" id="pergunta5_3" name="pergunta5_3" value="Networking profisional">3 &nbsp;&nbsp;&nbsp;Networking profisional</li>';	
							echo '<li><input type="radio" id="pergunta5_1" name="pergunta5_1" value="Outro">1
									<input type="radio" id="pergunta5_2" name="pergunta5_2" value="Outro">2
									<input type="radio" id="pergunta5_3" name="pergunta5_3" value="Networking profisional">3 &nbsp;&nbsp;&nbsp;Outro&nbsp;&nbsp;<input type="text" value="'.$outro2.'" id="outro2" name="outro2" size="50" maxlength="50"></li>';	
							echo '</ul>';
						echo '</li>';
						echo '<br/>';
						//-------------Pergunta 6---------------
						echo '<li>Como ficou sabendo sobre a AIESEC?<font class="erro">*</font>';
							echo '<ul class="none">';


							echo '<li><input type="checkbox" id="pergunta5" name="pergunta5[]" value="Outro" '.(isset($pergunta5["Outro"])?'CHECKED="CHECKED"':"").'>Outro&nbsp;&nbsp;<input type="text" value="'.$outro2.'" id="outro2" name="outro2" size="50" maxlength="50"></li>';


							echo '<li><input type="checkbox" id="pergunta6" name="pergunta6[]" value="membro_alumnus" 
							'.(isset($pergunta6["membro_alumnus"])?'CHECKED="CHECKED"':"").'>
							'.($pergunta6 == "membro_alumnus"?'CHECKED"':"").'>Recomenda��o de pessoa que faz (ou j� fez) parte da AIESEC
							<ul><li>Nome: <input type="text" value="'.$recomendador.'" id="recomendador" name="recomendador" size="40" maxlength="40"></li></ul></li>';
							echo '<li><input type="radio" id="pergunta6" name="pergunta6" value="recomendacao_outros" '.($pergunta6 == "recomendacao_outros"?'CHECKED"':"").'>Recomenda��o de outros</li>';
							echo '<li><input type="radio" id="pergunta6" name="pergunta6" value="website" '.($pergunta6 == "website"?'CHECKED"':"").'>Website da AIESEC</li>';
							echo '<li><input type="radio" id="pergunta6" name="pergunta6" value="panfleto_flyer" '.($pergunta6 == "panfleto_flyer"?'CHECKED"':"").'>Panfleto/Flyer</li>';
							echo '<li><input type="radio" id="pergunta6" name="pergunta6" value="cartaz_poster_painelEletronico" '.($pergunta6 == "cartaz_poster_painelEletronico"?'CHECKED"':"").'>Cartaz/p�ster/Painel Eletr�nico</li>';
							echo '<li><input type="radio" id="pergunta6" name="pergunta6" value="faixa_banner" '.($pergunta6 == "faixa_banner"?'CHECKED"':"").'>Faixa/Banners</li>';
							echo '<li><input type="radio" id="pergunta6" name="pergunta6" value="newsletter_malaDireta" '.($pergunta6 == "newsletter_malaDireta"?'CHECKED"':"").'>Newsletter/Mala direta</li>';
							echo '<li><input type="radio" id="pergunta6" name="pergunta6" value="internet" '.($pergunta6 == "internet"?'CHECKED"':"").'>Internet (google, blogs, websites...)</li>';
							echo '<li><input type="radio" id="pergunta6" name="pergunta6" value="evento" '.($pergunta6 == "evento"?'CHECKED"':"").'>Evento promovido pela AIESEC</li>';
							echo '<li><input type="radio" id="pergunta6" name="pergunta6" value="TV" '.($pergunta6 == "TV"?'CHECKED"':"").'>Televis�o</li>';
							echo '<li><input type="radio" id="pergunta6" name="pergunta6" value="revista" '.($pergunta6 == "revista"?'CHECKED"':"").'>Revista</li>';
							echo '<li><input type="radio" id="pergunta6" name="pergunta6" value="jornal" '.($pergunta6 == "jornal"?'CHECKED"':"").'>Jornal</li>';
							echo '<li><input type="radio" id="pergunta6" name="pergunta6" value="radio" '.($pergunta6 == "radio"?'CHECKED"':"").'>R�dio</li>';
							echo '<li><input type="radio" id="pergunta6" name="pergunta6" value="sala_de_aula" '.($pergunta6 == "sala_de_aula"?'CHECKED"':"").'>Divulga��o em sala de aula</li>';
							echo '<li><input type="radio" id="pergunta6" name="pergunta6" value="revista" '.($pergunta6 == "revista"?'CHECKED"':"").'>Revista</li>';		
							echo '<li><input type="radio" id="pergunta6" name="pergunta6" value="Outro" '.($pergunta6 == "Outro"?'CHECKED"':"").'>Outro&nbsp;&nbsp;<input type="text" value="'.$outro3.'" id="outro3" name="outro3" size="50" maxlength="50"></li>';
							echo '</ul>';
						echo '</li>';
						echo '</ol>';
						//--------------
						echo '<center>';
						echo '<table cellpadding="15">';
						echo '<tr><td><input type=Submit value="Salvar" /></form></td>';
						echo '<td><form action="principal.php"><input type="submit" value="Voltar"></form></td></tr>';
						echo '</table>';
						echo '</center>';
						echo '<ul class="ajuda"><li>Os campos marcados com asterisco (<font class="erro">*</font>) s�o obrigat�rios!</li></ul>';						
					}
				} else {
					echo '<ul class="erro"><li>Erro de sistema! Contate o administrador do sistema!</li></ul>';
				}
		} else { //pessoa ainda nao foi cadastrada
			echo '<ul class="aviso"><li>Para inserir ou editar uma experi�ncia, � necess�rio cadastrar seus
			dados pessoais. Clique <a href="dadosPessoais.php">aqui</a>.</li></ul>';	
		}
	} else {
		echo '<ul class="erro"><li>Erro de sistema! Contate o administrador do sistema!</li></ul>';
	}
} 
		
//---------------Rodape-------------------
include ("rodape.php"); 
?>