<?php
	require_once ("utils/sessao.php"); 
	include ("cabecalho.php");
	include ("menu.php");
	require_once ("utils/sessao.php");
	require_once ("utils/BancoDados.php");
	require_once ("classes/Pessoa.php");	
	restritoUsuario ();	
	$idLogin = $_SESSION['idLogin'];
	//testa se a variavel aviso existe
	if(isset($_GET['aviso'])) {
		$aviso = $_GET['aviso'];	
	} else {
		$aviso = "";
	}
	//titulo
	echo '<h3><u>Passo 4:</u> Experi�ncia Profissional</h3>';
	if(!empty($aviso)) {
		if ($aviso == "sucesso") {
			echo '<ul class="sucesso"><li>Passo 3 conclu�do com sucesso!</li></ul>';
		} else if ($aviso == "sucesso1") {
			echo '<ul class="sucesso"><li>Experi�ncia profissional inserida com sucesso!</li></ul>';
		} else if ($aviso == "sucesso2") {
			echo '<ul class="sucesso"><li>Experi�ncia profissional editada com sucesso!</li></ul>';
		} else {
			echo '<ul class="erro"><li>'.$aviso.'</li></ul>';	
		}				
	}
	$conexaoBD = new BancoDados ();
	if (!$conexaoBD->conecta()) {
		echo '<ul class="erro"><li>Erro de sistema! Contate o administrador do sistema!</li></ul>';
	} else {
		if (isset($idLogin)) {
			$pessoa = new Pessoa ($idLogin, "", "", "", "", "", "", 0, "", "", 0, "", "", "", "", "", "", 0, $conexaoBD);
			$resultado = $pessoa->buscaPorIdUsuario ();
			if ($resultado == true) { //se pessoa foi cadastrada
				echo '<ul><li>Clique na op��o desejada (� obrigat�rio inserir uma experi�ncia profissional ou informar que n�o tem nenhuma):';
				echo '<ul>';
				echo '<li><a href="dadosProfissionaisInsere.php">Inserir experi�ncia profissional</a></li>';
				echo '<li><a href="dadosProfissionaisEdita.php">Editar experi�ncia profissional existente</a></li>';
				echo '<li><a href="dadosProfissionaisAusente.php">N�o tenho experi�ncia profissional</a></li>';
				echo '</ul>';
				echo '</li></ul>';
				echo '<center><form action="dadosExtras.php"><input type="submit" value="Ir para o pr�ximo passo"></form></center>';
				echo '<br />';
			} else { //pessoa ainda nao foi cadastrada
				echo '<ul class="aviso"><li>Para inserir ou editar uma experi�ncia, � necess�rio cadastrar seus
				dados pessoais. Clique <a href="dadosPessoais.php">aqui</a>.</li></ul>';	
			}
		} else {
			echo '<ul class="erro"><li>Erro de sistema! Contate o administrador do sistema!</li></ul>';
		}
	} 
	include ("rodape.php"); 
?>