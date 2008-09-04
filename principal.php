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
<h3>Página de Acompanhamento do Candidato</h3>
<h4>Olá <?php echo $nome; ?>!</h4>
<ul>
<li>Instruções
	<ul>
	<li>Para preencher a sua inscrição clique em "Preencher dados" para preencher os dados para participar da
	palestra informativa sobre a AIESEC.</li>
	<li>Você pode possuir dois status: bloqueado/liberado. O status bloqueado indica que os dados iniciais para a 
	participação da palestra informativa ainda não foram preenchidos. Assim que o candidato preencher os dados o status
	estará liberado.</li>
	<li>Após a palestra informativa, caso você deseje continuar participando do processo seletivo, é necessário
	pagar a taxa de inscrição no valor de R$ 5,00 (cinco reais). Então você poderá marcar a entrevista no horário 
	que lhe melhor convier 	dentre os disponíveis pelo sistema. Para isso, clique em "Marcar entrevista". O botão 
	marcar entrevista estará liberado assim que for registrado o pagamento da taxa de inscrição.</li>
	<li>No dia da entrevista o candidato deve levar o currículo impresso (o botão "Imprimir currículo" estará 
	disponível assim que todos os dados estiverem preenchidos. Não esqueça de levar uma foto 3x4 ou digitalizada.</li>
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
<tr><td><form action="dadosPessoais.php"><input type="submit" value="Preencher dados"></form></td><td><input type="button" <?php if ($status == false) { echo "disabled='disabled'"; } ?>value="Imprimir currículo"></td></tr>
</table>
</center>
<center><input type="button" <?php if ($pago == false) {  echo "disabled='disabled'"; } ?> value="Marcar entrevista"></center>
<!-- Rodape -->
<?php include ("rodape.php"); ?>