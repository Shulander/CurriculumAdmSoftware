<?php
	require_once ("utils/BancoDados.php");
	require_once ("utils/sessao.php");
	require_once ("classes/Usuario.php");
	include ("classes/Pessoa.php");
	include ("classes/Horario.php");
	include ("utils/Validador.php");
	restritoUsuario();
	$idLogin = $_SESSION['idLogin'] + 0;
	$entrevista = $_POST['entrevista'];
	if (empty($entrevista)) {
		$aviso = "É necessário selecionar um horário!";
		header("Location:marcarEntrevista.php?aviso=".$aviso);
		exit ();
	}
	$dados = explode("_", $entrevista);
	$hora = $dados[0];
	$data = $dados[1];
	$area = $dados[2];
	//conexaoBD
	$conexaoBD = new BancoDados ();
	if (!$conexaoBD->conecta()) {
		$aviso = "Erro de sistema (8)! Contate o administrador do sistema!";
		header("Location:marcarEntrevista.php?aviso=".$aviso);
		exit ();
	}
	//pessoa - getIdPessoa
	$pessoa = new Pessoa ($idLogin, "", "", "", "", "", "", "", "", "", "", "", "", "", "", 0, $conexaoBD); 
	$resultado = $pessoa->busca ();
	if ($resultado == false) {
		$aviso = "Erro de sistema (5)! Contate o administrador do sistema!";
		header("Location:marcarEntrevista.php?aviso=".$aviso);
		exit ();
	}
	$idPessoa = $pessoa->getId();
	//busca id da entrevista
	$horario = new Horario (0, $idLogin, $idPessoa, $area, "", $data, $hora, "nao", $conexaoBD);
	$result = $horario->buscaPorEntrevista ();
	if ($result == false) {
		$aviso = "Erro de sistema (6)! Contate o administrador do sistema!";
		header("Location:marcarEntrevista.php?aviso=".$aviso);
		exit ();
	}
	//atualiza entrevista com o id da pessoa
	$aviso = $horario->marcaEntrevista ();
	if ($aviso == false) {
		$aviso = "Erro de sistema (7)! Contate o administrador do sistema!";
		header("Location:marcarEntrevista.php?aviso=".$aviso);
		exit ();
	}
	//seta tabela login com entrevista marcada
	$usuario = new Usuario ("", "", "", $conexaoBD, $idLogin);
	$usuario->busca(); //busca dados do usuario, principalmente email para mandar o horario da entrevista
	$aviso = $usuario->setEntrevistaMarcada();
	//envia email informando sobre a entrevista
	enviaEmailEntrevista($usuario->getEmail(), $horario);
	header("Location:marcarEntrevista.php?aviso=".$aviso);
	exit ();
	
	
	function enviaEmailEntrevista($email, $horario)
	{
		$remetente = "non-reply@aiesecsm.org";
		$assunto = "Processo Seletivo AIESEC";
		$contato = "<a href='mailto:aiesecsmpsel@gmail.com'>aiesecsmpsel@gmail.com</a>";
		$mensagem= "<b>Caro candidato,</b><br />
		
		
		Sua entrevista foi marcada com sucesso! A área escolhida foi <b>".$horario->getArea ()."</b>.
		Ela ocorrerá na data <b>".$horario->getDataConvertida ()."</b>, às <b>".$horario->getHora ()."</b><br/> 
		na sede da AIESEC Santa Maria<br/> 
		(Endereço: Rua Mal. Floriano Peixoto, 1184, 8° andar - CCSH UFSM - Centro).<br/>
		Para alterar seus dados ou conferir o andamento do processo favor acessar o endereço 
		<a href='http://www.aiesecsm.org/psel2008_2/'>http://www.aiesecsm.org/psel2008_2/</a>.<br/>
		Qualquer dúvida favor entrar em contato no telefone abaixo ou através do email ".$contato."<br/> 
		<br/>
		Atenciosamente, <br/>
		AIESEC em Santa Maria<br/>
		Rua Floriano Peixoto, 1184, 8° andar do CCSH - Centro<br/>
		Tel: 3220 9209<br/>
		Santa Maria - RS - Brasil<br/>
		<a href='http://www.aiesec.org.br/santamaria'>http://www.aiesec.org.br/santamaria</a><br/>";
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "From: AIESEC Santa Maria <".$remetente."> \r\n";
		
		$retorno = mail($email, $assunto, $mensagem, $headers);
		return $retorno;
	}
?>