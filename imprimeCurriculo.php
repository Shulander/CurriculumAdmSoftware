<?php
	require_once ("utils/sessao.php");	
	restritoUsuario ();	
	include ("cabecalho.php");
	require_once ("utils/BancoDados.php");
	require_once ("classes/Usuario.php");
	require_once ("classes/Pessoa.php");
	require_once ("classes/Curriculo.php");
	require_once ("classes/ExpAcademica.php");
	require_once ("classes/ExpProfissional.php");					
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
	$conexaoBD = new BancoDados ();
?>
<h3>Currículo</h3>
<h4>Olá <?php echo $nome; ?>!</h4>
<ul>
<?php 
	if (!$conexaoBD->conecta()) {
		echo '<ul class="erro"><li>Erro de sistema (1)! Contate o administrador do sistema!</li></ul>';
		echo '<br><center><form action="principal.php"><input type="submit" value="Voltar"></form></center>';
	} else {
		if (isset($idLogin)) {
			$usuario = new Usuario ($nome, "", $tipo, $conexaoBD, $idLogin);
			$resultado = $usuario->busca();
			if ($resultado == false) {
				echo '<ul class="erro"><li>Erro de sistema (2)! Contate o administrador do sistema!</li></ul>';
				echo '<br><center><form action="principal.php"><input type="submit" value="Voltar"></form></center>';
			} else {
				$pessoa = new Pessoa ($idLogin, "", "", "", "", "", "", "", "", "", "", "", "", "", "", 0, $conexaoBD);
				$retorno = $pessoa->busca ();
				if ($retorno == false) {
					echo '<ul class="erro"><li>Erro de sistema (4)! Contate o administrador do sistema!</li></ul>';
					echo '<br><center><form action="principal.php"><input type="submit" value="Voltar"></form></center>';
				} else {
					$idPessoa = $pessoa->getId();
					$expAcademicas = new ExpAcademica  (0, $idLogin, 0, "", "", "", "", "", "", "", $conexaoBD);
					$result = $expAcademicas->busca();//retorna array de ids de experiencias academicas
					if ($result == 0) {
						echo '<ul class="aviso"><li>Não há experiências acadêmicas cadastradas.</li></ul>';
						echo '<br><center><form action="principal.php"><input type="submit" value="Voltar"></form></center>';							
					} else if (is_array($result)) {
						$numExpAcademicas = count($result);
						for ($i = 0; $i < $numExpAcademicas; $i++) {
							$idExpAcad = $result[$i];
							$expAcademica = new ExpAcademica ($result[$i], $idLogin, 0, "", "", "", "", "", "", "", $conexaoBD);
							$result2 = $expAcademica->buscaPorIdPessoa();
							if ($result2 != true) {
								echo '<ul class="erro"><li>Erro de sistema(5)! Contate o administrador do sistema!</li></ul>';
							} else {
								//busca expprofissional
								$expProfissionais = new ExpProfissional (0, $idLogin, 0, "", "", "", "", "", $conexaoBD);
								$result3 = $expProfissionais->busca();//retorna array de ids de experiencias profissionais
								if ($result3 == 0) {
									echo '<ul class="aviso"><li>Não há experiências profissionais cadastradas.</li></ul>';	
								} else if (is_array($result3)) {
									$numExpProfissionais = count($result3);
									for ($i = 0; $i < $numExpProfissionais; $i++) {
										$idExpProf = $result3[$i];
										$expProf = new ExpProfissional ($result3[$i], $idLogin, 0, "", "", "", "", "", $conexaoBD);
										$result4 = $expProf->buscaPorIdPessoa();
										if ($result4 == true) {
										}
									}
								} else {
										
								}
							}
						}
					} else {
						echo '<ul class="erro"><li>Erro de sistema (6)! Contate o administrador do sistema!</li></ul>';
						echo '<br><center><form action="principal.php"><input type="submit" value="Voltar"></form></center>';	
					}
				}
			}
		} else {
			echo '<ul class="erro"><li>Erro de sistema (3)! Contate o administrador do sistema!</li></ul>';
			echo '<br><center><form action="principal.php"><input type="submit" value="Voltar"></form></center>';
		}
	}
	
	echo "<br/>";
	include ("rodape.php");
?>