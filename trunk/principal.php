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
<h3>P�gina de Acompanhamento do Candidato</h3>
<h4>Ol� <?php echo $nome; ?>!</h4>
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
				echo '<li>Voc� est� participando do processo seletivo da AIESEC Santa Maria como <u>Membro</u>.</li>';
			} else if ($tipo == "intercambista") {
				echo '<li>Voc� est� participando do processo seletivo da AIESEC Santa Maria como <u>Intercambista</u>.</li>'; 
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
<li>Instru��es
	<ul>
	<li>Para preencher a sua inscri��o clique em "Preencher dados" para participar da palestra de apresenta��o 
	sobre a AIESEC.</li>
	<li>Voc� pode possuir tr�s status: bloqueado/em espera/liberado. O status bloqueado indica que os dados iniciais para a 
	participa��o da palestra de apresenta��o ainda n�o foram preenchidos. O status "em espera" indica que voc� j� preencheu 
	os dados mas ainda n�o pagou a taxa de inscri��o e o status liberado indica que voc� j� fez os passos anteriores e est� 
	esperando para marcar a entrevista ou o resultado do processo.</li>
	<li>Ap�s a palestra apresenta��o, caso voc� deseje continuar participando do processo seletivo, � necess�rio
	pagar a taxa de inscri��o no valor de R$ 5,00 (cinco reais). Ent�o voc� poder� marcar a entrevista no hor�rio 
	que lhe melhor convier 	dentre os dispon�veis pelo sistema. Para isso, clique em "Marcar entrevista". O bot�o 
	marcar entrevista estar� liberado assim que for registrado o pagamento da taxa de inscri��o.</li>
	<li>No dia da entrevista o candidato dever� levar o curr�culo impresso (o bot�o "Imprimir curr�culo" estar� 
	dispon�vel assim que todos os dados estiverem preenchidos. N�o esque�a de levar uma foto 3x4 ou digitalizada.</li>
	<li>Caso tenha quaisquer d�vidas, entrar em contato atrav�s do email <a href="mailto:aiesecsmpsel@gmail.com">
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