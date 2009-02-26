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
	echo '<h3><u>Passo 2:</u> Formação Acadêmica</h3>';
	if(!empty($aviso)) {
		if ($aviso == "sucesso") {
			echo '<ul class="sucesso"><li>Passo 1 concluído com sucesso!</li></ul>';
		} else if ($aviso == "sucesso1") {
			echo '<ul class="sucesso"><li>Formação acadêmica inserida com sucesso!</li></ul>';
		} else if ($aviso == "sucesso2") {
			echo '<ul class="sucesso"><li>Formação acadêmica editada com sucesso!</li></ul>';
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
				echo '<ul><li>Clique na opção desejada (é necessário inserir pelo menos uma experiência acadêmica):';
				echo '<ul>';
				echo '<li><a href="dadosEducacionaisInsere.php">Inserir experiência acadêmica</a></li>';
				echo '<li><a href="dadosEducacionaisEdita.php">Editar experiência acadêmica existente</a></li>';
				echo '</ul>';
				echo '</li></ul>';
				echo '<center><form action="habilidades.php"><input type="submit" value="Ir para o próximo passo"></form></center>';
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