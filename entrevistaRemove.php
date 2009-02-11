<?php
	require_once ("utils/sessao.php");
	include ("cabecalho.php");
	require_once ("utils/BancoDados.php");
	require_once ("classes/Horario.php");	
	restritoUsuario ();	
	$idLogin = $_SESSION['idLogin'];
	/*-------------Testa variaveis------------------*/
	//testa se a variavel aviso existe
	if(isset($_GET['aviso'])) {
		$aviso = $_GET['aviso'];	
	} else {
		$aviso = "";
	}
	echo "<h3>Remover horário de entrevista</h3>";
	if(!empty($aviso)) {
		if ($aviso == "sucesso") {
			echo '<ul class="sucesso"><li>Horário removido com sucesso!</li></ul>';		
		} else {
			echo '<ul class="erro"><li>'.$aviso.'</li></ul>';	
		}
	}
	$conexaoBD = new BancoDados ();
	if (!$conexaoBD->conecta()) {
		echo '<ul class="erro"><li>Erro de sistema (1)! Contate o administrador do sistema!</li></ul>';
		echo '<br><center><form action="entrevistaRemoveBD.php"><input type="submit" value="Voltar"></form></center>';
	} else {
		//busca todos os horarios cadastrados no bd
		$entrevistas = buscaTodosHorariosEntrevistas($conexaoBD);
		if ($entrevistas == 0) {
			echo '<ul class="aviso"><li>Não há horários cadastrados!</li></ul>';
			echo '<center><a href="entrevistas.php">Voltar para a página anterior</a></center>';	
		} else {
			$ultimaData = $entrevistas[0]->getDataConvertida();
			$nDias = 1;
			//tabela de formatacao horizontal
			echo '<center><table>';
			echo '<tr><td class="hora" style="border:none;">';
			echo '<table class="horario">'; 
			echo '<tr><td class="hora" colspan="3"><b>'.$entrevistas[0]->getDataConvertida().'</b></td></tr>';
			echo '<tr><td class="hora"><b>Horário</b></td><td class="hora"><b>Área</b></td><td class="hora"><b>Tipo</b></td></tr>';
			echo '<form action="entrevistaRemoveBD.php" method="POST">';
			foreach ($entrevistas as $indice => $horario) {
				if($ultimaData!=$horario->getDataConvertida()) {
					echo '</table>';
					// responsavel pela tabela do posicionamento horizontal
					// cria uma nova linha, após 3 elementos sendo mostrados
					echo '</td>';
					if (($nDias++ % 2) ==0) echo '</tr><tr>'; 
					echo '<td class="hora" style="border:none;">';								
					$ultimaData = $horario->getDataConvertida();
					echo '<table class="horario">';
					echo '<tr><td class="hora" colspan="3"><b>'.$horario->getDataConvertida().'</b></td></tr>';
					echo '<tr><td class="hora"><b>Horário</b></td><td class="hora"><b>Área</b></td><td class="hora"><b>Tipo</b></td></tr>';							
				}
				$id = $horario->getId();
				$data = $horario->getData();
				$hora = $horario->getHora();
				$area = $horario->getArea();
				$tipo = $horario->getTipo();
				echo '<tr><td class="hora"><input type="radio" id="id" name="id" value="'.$id.'">'.$horario->getHora().'</td><td class="hora">'.$horario->getArea ().'</td><td class="hora">'.$horario->getTipo ().'</td></tr>';	
			}
			echo '</table>';
			//tabela de formatacao horizontal
			echo '</td></tr>';
			echo '</table></table>';
			echo '<br><center><input type="submit" value="Excluir"></form></center>';
			echo '<br/><center><a href="entrevistas.php">Voltar para a página anterior</a></center>';				}
		}
?>
<br />
<!-- Rodape -->
<?php 
	include ("rodape.php");

	/*Busca todos os horario de entrevistas cadastrados no BD*/
	function buscaTodosHorariosEntrevistas ($conexaoBD)
	{
		$sql = "SELECT * FROM horario ORDER BY data, hora";
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