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
	echo '<h3>Forma��o Acad�mica</h3>';
	$conexaoBD = new BancoDados ();
	if (!$conexaoBD->conecta()) {
		echo '<ul class="erro"><li>Erro de sistema! Contate o administrador do sistema!</li></ul>';
	} else {
		if (isset($idLogin)) {
			$pessoa = new Pessoa ($idLogin, "", "", "", "", "", "", "", "", "", "", "", "", "", "", 0, $conexaoBD); 
			$resultado = $pessoa->buscaPorIdUsuario ();
			if ($resultado == true) { //se pessoa foi cadastrada
				echo '<ul><li>Clique na op��o desejada:';
				echo '<ul>';
				echo '<li><a href="dadosEducacionaisInsere.php">Inserir nova experi�ncia acad�mica</a></li>';
				echo '<li><a href="dadosEducacionaisEdita.php">Editar experi�ncia acad�mica existente</a></li>';
				echo '<li><a href="habilidades.php">Ir para o pr�ximo passo</a></li>';
				echo '</ul>';
				echo '</li></ul>';
				echo '<center><form action="principal.php"><input type="submit" value="Voltar"></form></center>';
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