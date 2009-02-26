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
	echo '<h3><u>Passo 4:</u> Experiência Profissional</h3>';
	if(!empty($aviso)) {
		if ($aviso == "sucesso") {
			echo '<ul class="sucesso"><li>Passo 3 concluído com sucesso!</li></ul>';
		} else if ($aviso == "sucesso1") {
			echo '<ul class="sucesso"><li>Experiência profissional inserida com sucesso!</li></ul>';
		} else if ($aviso == "sucesso2") {
			echo '<ul class="sucesso"><li>Experiência profissional editada com sucesso!</li></ul>';
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
				echo '<ul><li>Clique na opção desejada (é obrigatório inserir uma experiência profissional ou informar que não tem nenhuma):';
				echo '<ul>';
				echo '<li><a href="dadosProfissionaisInsere.php">Inserir experiência profissional</a></li>';
				echo '<li><a href="dadosProfissionaisEdita.php">Editar experiência profissional existente</a></li>';
				echo '<li><a href="dadosProfissionaisAusente.php">Não tenho experiência profissional</a></li>';
				echo '</ul>';
				echo '</li></ul>';
				echo '<center><form action="dadosExtras.php"><input type="submit" value="Ir para o próximo passo"></form></center>';
				echo '<br />';
			} else { //pessoa ainda nao foi cadastrada
				echo '<ul class="aviso"><li>Para inserir ou editar uma experiência, é necessário cadastrar seus
				dados pessoais. Clique <a href="dadosPessoais.php">aqui</a>.</li></ul>';	
			}
		} else {
			echo '<ul class="erro"><li>Erro de sistema! Contate o administrador do sistema!</li></ul>';
		}
	} 
	include ("rodape.php"); 
?>