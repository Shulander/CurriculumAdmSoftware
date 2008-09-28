<?php
	require_once ("utils/sessao.php");	
	restritoUsuario ();	
	include ("cabecalho.php");
	require_once ("utils/BancoDados.php");
	require_once ("classes/Usuario.php");
	require_once ("classes/Pessoa.php");
	require_once ("classes/Horario.php");		
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
<h3>Marcar Entrevista</h3>
<h4>Ol� <?php echo $nome; ?>!</h4>
<ul>
<?php 
	if(!empty($aviso)) {
		if ($aviso == "sucesso") {
			echo '<ul class="sucesso"><li>Sua entrevista foi marcada com sucesso!</li></ul><br/>';
		} else {
			echo '<ul class="erro"><li>'.$aviso.'</li></ul><br />';										
		}
	}
	if (!$conexaoBD->conecta()) {
		echo '<ul class="erro"><li>Erro de sistema (1)! Contate o administrador do sistema!</li></ul>';
		echo '<br><center><form action="principal.php"><input type="submit" value="Voltar"></form></center>';
	} else {
		if (isset($idLogin)) {
			$usuario = new Usuario ($nome, "", $tipo, $conexaoBD, $idLogin);
			$resultado = $usuario->busca();
			if ($resultado == false) {
				echo '<ul class="erro"><li>Erro de sistema (2)! Contate o administrador do sistema!</li></ul>';
			} else { //mostrar horarios das entrevistas
				if ($usuario->isPago()) {
					//checa se o usuario ja marcou sua entrevista
					if ($usuario->isEntrevistaMarcada()) { //entrevista ja foi marcada
						//mostra o horario da pessoa
						//pega o id da pessoa
						$pessoa = new Pessoa ($idLogin, "", "", "", "", "", "", "", "", "", "", "", "", "", "", 0, $conexaoBD);
						$retorno = $pessoa->busca ();
						if ($retorno == false) {
							echo '<ul class="erro"><li>Erro de sistema (3)! Contate o administrador do sistema!</li></ul>';
						} else {								
							$idPessoa = $pessoa->getId();
							//pega o horario referente a pessoa								
							$horarioPessoa = new Horario (0, $idLogin, $idPessoa, "", "", "", "", "", $conexaoBD);
							$result = $horarioPessoa->buscaPorIdPessoa();
							if ($result == false) {
								echo '<ul class="erro"><li>Erro de sistema (4)! Contate o administrador do sistema!</li></ul>';	
							} else {
								$area = $horarioPessoa->getArea ();
								$hora = $horarioPessoa->getHora ();
								$data = $horarioPessoa->getDataConvertida();
								echo '<ul class="ajuda"><li>Sua entrevista est� marcada para o
								dia '.$data.' �s '.$hora.' para a �rea: '.$area.'. O n�o comparecimento
								implica na elimina��o do candidato do processo seletivo!</li></ul><br/>';
								echo '<center><a href="principal.php">Voltar para a p�gina principal</a></center>';
							}
						}
					} else {
						//busca todos os horarios disponiveis
						$entrevistas = buscaTodosHorariosDisponiveis($conexaoBD, $usuario->getTipo(), $idLogin);
						if ($entrevistas == 0) {
							echo '<ul class="aviso"><li>N�o h� mais hor�rios dispon�veis!</li></ul>';
							echo '<center><a href="principal.php">Voltar para a p�gina anterior</a></center>';	
						} else {
							$ultimaData = $entrevistas[0]->getDataConvertida();
							$nDias = 1;
							//tabela de formatacao horizontal
							echo '<table>';
							echo '<tr><td class="hora" style="border:none;">';
							echo '<table class="horario">'; 
							echo '<tr><td class="hora" colspan="2"><b>'.$entrevistas[0]->getDataConvertida().'</b></td></tr>';
							echo '<tr><td class="hora"><b>Hor�rio</b></td><td class="hora"><b>�rea</b></td></tr>';
							echo '<form action="marcarEntrevistaBD.php" method="POST">';
							foreach ($entrevistas as $indice => $horario) {
								if($ultimaData!=$horario->getDataConvertida()) {
									echo '</table>';
									// responsavel pela tabela do posicionamento horizontal
									// cria uma nova linha, ap�s 3 elementos sendo mostrados
									echo '</td>';
									if (($nDias++ % 3) ==0) echo '</tr><tr>'; 
									echo '<td class="hora" style="border:none;">';								
									$ultimaData = $horario->getDataConvertida();
									echo '<table class="horario">';
									echo '<tr><td class="hora" colspan="2"><b>'.$horario->getDataConvertida().'</b></td></tr>';
									echo '<tr><td class="hora"><b>Hor�rio</b></td><td class="hora"><b>�rea</b></td></tr>';							
								}
								$data = $horario->getData();
								$hora = $horario->getHora();
								$area = $horario->getArea();
								$entrevista = $hora.'_'.$data.'_'.$area;
								echo '<tr><td class="hora"><input type="radio" id="entrevista" name="entrevista" value="'.$entrevista.'">'.$horario->getHora().'</td><td class="hora">'.$horario->getArea ().'</td></tr>';	
							}
							echo '</table>';
							//tabela de formatacao horizontal
							echo '</td></tr>';
							echo '</table>';
							echo '<br><center><input type="submit" value="Marcar entrevista"></form></center>';
							echo '<br><center><form action="principal.php"><input type="submit" value="Voltar"></form></center>';
						}
					}
				} else {
					echo '<ul class="aviso"><li>Para marcar sua entrevista � necess�rio ter preenchido 
					todos os seus dados e pago a taxa de inscri��o!</li></ul>';
					echo '<br><center><form action="principal.php"><input type="submit" value="Voltar"></form></center>';
				}
			}
		}
	}
?>
<br />
<!-- Rodape -->
<?php 
	include ("rodape.php");

	/*Busca todos os horario de entrevistas disponiveis cadastrados no BD*/
	function buscaTodosHorariosDisponiveis ($conexaoBD, $tipo, $idLogin)
	{
		$sql = "SELECT * FROM horario WHERE disponivel='sim' AND tipo='".$tipo."' ORDER BY data, hora";
		$resultado = mysql_query($sql, $conexaoBD->getLink());
		$numLinhas = mysql_num_rows ($resultado);
		$horarios = array ();
		if ($numLinhas != 0) {
			while ($dados  = mysql_fetch_array ($resultado)) {
				$horario = new Horario (0, $idLogin, 0, "", "", "", "", $conexaoBD);
				$horario->setId ($dados['id']);
				$horario->setTipo ($dados['tipo']);
				$horario->setArea ($dados['area']);
				$horario->setData ($dados['data']);
				$horario->setHora ($dados['hora']);
				$horario->setDisponivel ($dados['disponivel']);
				$horarios[] = $horario;
			}
			return $horarios;
		} else {
			return 0;
		}
	}
	
	
	
?>