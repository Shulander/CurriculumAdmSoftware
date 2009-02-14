<?php
	require_once ("utils/sessao.php");
	include ("cabecalho.php");
	require_once ("utils/BancoDados.php");
	restritoUsuario ();	
	$idLogin = $_SESSION['idLogin'];
	//testa se a variavel aviso existe
	if(isset($_GET['aviso'])) {
		$aviso = $_GET['aviso'];	
	} else {
		$aviso = "";
	}
	echo "<h3>Remover pagamento de inscrito</h3>";
	if(!empty($aviso)) {
		if ($aviso == "sucesso") {
			echo '<ul class="sucesso"><li>Pagamento removido com sucesso!</li></ul>';		
		} else {
			echo '<ul class="erro"><li>'.$aviso.'</li></ul>';	
		}
	}
	$conexaoBD = new BancoDados ();
	//verifica se a conexao ao banco de dados ocorreu corretamente
	if (!$conexaoBD->conecta()) {
		$aviso = "Erro de sistema! Contate o administrador do sistema!";
		header("Location:pagamentos.php?aviso=".$aviso);
		exit();
	}
	$sql = "SELECT login.id, pessoa.nome FROM pessoa,login WHERE login.id=pessoa.idLogin AND login.tipo<>'admin' AND login.pago=1 ORDER BY nome ASC";
	$resultado = mysql_query($sql, $conexaoBD->getLink());
	$numLinhas = mysql_num_rows ($resultado);
	echo '<form action="pagamentoRemoveBD.php" method="POST">';
	if ($resultado != 0) {
		echo '<center><select id="id" name="id">';
		echo '<option value="0"> -- Selecione um inscrito -- </option>';
		while ($dados  = mysql_fetch_array ($resultado)) {
			echo '<option value="'.$dados['id'].'" >'.$dados['nome'].'</option>';
		}
		echo "</select></center>";
		echo '<br/>';
		echo '<center><input type=Submit value="Remover" /></form></center>';
	} else {
		$aviso = "Não há nenhum inscrito no sistema!";
		header("Location:pagamentos.php?aviso=".$aviso);
		exit();
	}
	$conexaoBD->desconecta ();
	echo "<br/>";
	echo '<center><a href="pagamentos.php">Voltar para a página anterior</a></center>';
	//Rodape
	include ("rodape.php");
?>