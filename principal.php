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
	<li>Para iniciar sua inscrição para o processo seletivo 2009 clique em "INSCREVA-SE  AQUI". A primeira etapa do processo consiste em uma palestra de apresentação sobre a AIESEC.</li>
	<li>ATENÇÃO: No dia da palestra de apresentação NÃO é necessário levar o currículo impresso!!</li>
	<li>Caso tenha quaisquer dúvidas, entrar em contato através do email <a href="mailto:aiesecsmpsel@gmail.com">
	aiesecsmpsel@gmail.com</a>.</li>
	</ul>
</li>
</ul>
<br/>
<center><form action="dadosPessoais.php">
<?php
	if ($dadosPreenchidos == 0) {
		echo '<input type="submit" value="Inscreva-se aqui">';
	} else {
		echo '<input type="submit" value="Editar dados">';
	}
?>
</form></center><br />
<center><form action="marcarEntrevista.php"><input type="submit" <?php if ($pago == 0) {  echo "disabled='disabled'"; } ?> value="Marcar entrevista"></form></center>
<!-- Rodape -->
<?php include ("rodape.php"); ?>