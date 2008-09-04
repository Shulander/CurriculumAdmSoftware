<?php
	require_once ("utils/sessao.php");	
	restritoUsuario ();	
	include ("cabecalho.php");
	//Variavel usuario	
	$nome = $_SESSION['nome'];
	//testa se a variavel status existe
	if(isset($_REQUEST['status'])) {
		$status = $_REQUEST['status'];	
	} else {
		$status = false;
	}
	//testa se a variavel pago existe
	if(isset($_REQUEST['pago'])) {
		$pago = $_REQUEST['pago'];	
	} else {
		$pago = false;
	}
?>
<h3>P�gina de Acompanhamento do Candidato</h3>
<h4>Ol� <?php echo $nome; ?>!</h4>
<ul>
<li>Instru��es
	<ul>
	<li>Para preencher a sua inscri��o clique em "Preencher dados" para preencher os dados para participar da
	palestra informativa sobre a AIESEC.</li>
	<li>Voc� pode possuir dois status: bloqueado/liberado. O status bloqueado indica que os dados iniciais para a 
	participa��o da palestra informativa ainda n�o foram preenchidos. Assim que o candidato preencher os dados o status
	estar� liberado.</li>
	<li>Ap�s a palestra informativa, caso voc� deseje continuar participando do processo seletivo, � necess�rio
	pagar a taxa de inscri��o no valor de R$ 5,00 (cinco reais). Ent�o voc� poder� marcar a entrevista no hor�rio 
	que lhe melhor convier 	dentre os dispon�veis pelo sistema. Para isso, clique em "Marcar entrevista". O bot�o 
	marcar entrevista estar� liberado assim que for registrado o pagamento da taxa de inscri��o.</li>
	<li>No dia da entrevista o candidato deve levar o curr�culo impresso (o bot�o "Imprimir curr�culo" estar� 
	dispon�vel assim que todos os dados estiverem preenchidos. N�o esque�a de levar uma foto 3x4 ou digitalizada.</li>
	</ul>
</li>
</ul>
<br/>
<hr>
<p>
Status: <?php if ($status == true) { echo "<font class='sucesso'>Liberado</font>"; } 
else { echo "<font class='erro'>Bloqueado</font>"; } ?><br/>
</p>
<center>
<table cellspacing="10">
<tr><td><form action="dadosPessoais.php"><input type="submit" value="Preencher dados"></form></td><td><input type="button" <?php if ($status == false) { echo "disabled='disabled'"; } ?>value="Imprimir curr�culo"></td></tr>
</table>
</center>
<center><input type="button" <?php if ($pago == false) {  echo "disabled='disabled'"; } ?> value="Marcar entrevista"></center>
<!-- Rodape -->
<?php include ("rodape.php"); ?>