<?php
	require_once ("utils/sessao.php");	
	restritoUsuario ();	
	include ("cabecalho.php");
	require_once ("utils/BancoDados.php");
	require_once ("classes/Usuario.php");	
	//Variavel usuario	
	$nome = $_SESSION['nome'];
	$idLogin = $_SESSION['idLogin'];
	$tipo = $_SESSION['tipo'];
	//testa se a variavel aviso existe
	if(isset($_GET['aviso'])) {
		$aviso = $_GET['aviso'];	
	} else {
		$aviso = "";
	}
	//testa se a variavel mensagem existe
	if(isset($_GET['mensagem'])) {
		$mensagem = $_GET['mensagem'];	
	} else {
		$mensagem = "";
	}
	$pago = 0;
	$dadosPreenchidos = 0;
	$conexaoBD = new BancoDados ();
?>
<h3>Página de Acompanhamento do Candidato</h3>
<h4>Olá <?php echo $nome; ?>!</h4>
<ul>
<?php 
	if(!empty($aviso)) {
		if ($aviso == "sucesso") {
			echo '<ul class="sucesso"><li>'.$mensagem.'</li></ul>';
		} else {
			echo '<ul class="erro"><li>'.$aviso.'</li></ul>';										
		}
	}
	if (!$conexaoBD->conecta()) {
		echo '<ul class="erro"><li>Erro de sistema! Contate o administrador do sistema!</li></ul>';
	} else {
		if (isset($idLogin)) {
			if ($tipo == "membro") {
				echo '<li>Você está participando do processo seletivo da AIESEC Santa Maria como <u>Membro</u>.</li>';
			} else if ($tipo == "intercambista") {
				echo '<li>Você está participando do processo seletivo da AIESEC Santa Maria como <u>Intercambista</u>.</li>'; 
			} else {
				echo '<ul class="erro"><li>Erro de sistema! Contate o administrador do sistema!</li></ul>';
				//nao pode entrar nessa pagina, se for admin tem q ir pra controle.php				
			}
			$usuario = new Usuario ($nome, "", $tipo, $conexaoBD, $idLogin);
			$pago = $usuario->isPago();
			$dadosPreenchidos = $usuario->isDadosPreenchidos();
			if ($dadosPreenchidos == true) {
				$dadosPreenchidos = 1;
			} else {
				$dadosPreenchidos = 0;
			}
		}
	}
?>
<li>Instruções
	<ul>
	<li>Para preencher a sua inscrição clique em "Preencher dados" para participar da palestra de apresentação 
	sobre a AIESEC.</li>
	<li>Você pode possuir três status: bloqueado/em espera/liberado. O status bloqueado indica que os dados iniciais para a 
	participação da palestra de apresentação ainda não foram preenchidos. O status "em espera" indica que você já preencheu 
	os dados mas ainda não pagou a taxa de inscrição e o status liberado indica que você já fez os passos anteriores e está 
	esperando para marcar a entrevista ou o resultado do processo.</li>
	<li>Após a palestra apresentação, caso você deseje continuar participando do processo seletivo, é necessário
	pagar a taxa de inscrição no valor de R$ 5,00 (cinco reais). Então você poderá marcar a entrevista no horário 
	que lhe melhor convier 	dentre os disponíveis pelo sistema. Para isso, clique em "Marcar entrevista". O botão 
	marcar entrevista estará liberado assim que for registrado o pagamento da taxa de inscrição.</li>
	<li>No dia da entrevista o candidato deverá levar o currículo impresso (o botão "Imprimir currículo" estará 
	disponível assim que todos os dados estiverem preenchidos. Não esqueça de levar uma foto 3x4 ou digitalizada.</li>
	<li>Caso tenha quaisquer dúvidas, entrar em contato através do email <a href="mailto:aiesecsmpsel@gmail.com">
	aiesecsmpsel@gmail.com</a>.</li>
	</ul>
</li>
</ul>
<br/>
<hr>
<p>
Status: 
<?php
	if ($pago == 1 && $dadosPreenchidos == 1) { 
		echo "<font class='sucesso'>Liberado</font>"; 
	} else if ($dadosPreenchidos == 1) { 
		echo "<font class='aviso'>Em espera</font>"; 
	} else { 
		echo "<font class='erro'>Bloqueado</font>"; 
	}
?>
<br/>
</p>
<center><form action="dadosPessoais.php"><input type="submit" value="Preencher dados"></form></center><br />
<center><input type="button" <?php if ($pago == 0) {  echo "disabled='disabled'"; } ?> value="Marcar entrevista"></center>
<!-- Rodape -->
<?php include ("rodape.php"); ?>