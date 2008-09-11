<?php 
	require_once ("utils/sessao.php");
	include ("cabecalho.php");
	include ("menu.php");
	require_once ("utils/sessao.php");
	require_once ("utils/BancoDados.php");
	require_once ("classes/Pessoa.php");	
	restritoUsuario ();	
	$idLogin = $_SESSION['idLogin'];
	//titulo
	echo '<h3>Formação Acadêmica</h3>';
	$conexaoBD = new BancoDados ();
	if (!$conexaoBD->conecta()) {
		echo '<ul class="erro"><li>Erro de sistema! Contate o administrador do sistema!</li></ul>';
	} else {
		if (isset($idLogin)) {
			$pessoa = new Pessoa ($idLogin, "", "", "", "", "", "", "", "", "", "", "", "", "", "", 0, $conexaoBD); 
			$resultado = $pessoa->buscaPorIdUsuario ();
			if ($resultado == true) { //se pessoa foi cadastrada
				echo '<ul><li>Clique na opção desejada:';
				echo '<ul>';
				echo '<li><a href="dadosEducacionaisInsere.php">Inserir nova experiência acadêmica</a></li>';
				echo '<li><a href="dadosEducacionaisEdita.php">Editar experiência acadêmica existente</a></li>';
				echo '<li><a href="habilidades.php">Ir para o próximo passo</a></li>';
				echo '</ul>';
				echo '</li></ul>';
				echo '<center><form action="principal.php"><input type="submit" value="Voltar"></form></center>';
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