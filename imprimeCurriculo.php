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
	} else {
		if (isset($idLogin)) {			
			$usuario = new Usuario ($nome, "", $tipo, $conexaoBD, $idLogin);
			$resultado = $usuario->busca();
			if ($resultado == false) {
				echo '<ul class="erro"><li>Erro de sistema (2)! Contate o administrador do sistema!</li></ul>';
			} else {
				if (!$usuario->getEmail() == "lianecafarate@gmail.com") {
					echo '<ul class="erro"><li>Você não pode acessar essa página!</li></ul>';	
				} else {
					//busca nomes de quem marcou a entrevista
					$sql1 = "select pessoa.nome from pessoa, login where login.id=pessoa.idLogin and login.entrevistaMarcada=1";
					$consulta1 = mysql_query($sql1, $conexaoBD->getLink());
					$numLinhas1 = mysql_num_rows ($consulta1);
					if ($numLinhas1 != 0) {
						while ($dados1  = mysql_fetch_array ($consulta1,MYSQL_ASSOC)) {
							echo $dados1['nome']."<br>";
						}
					} else {
						echo '<ul class="erro"><li>Ninguém marcou entrevista!</li></ul>';
					}
					echo "<hr><br>";
					//busca todos que marcaram entrevista com dados completos
					$sql = "SELECT p.id, p.nome, p.nacionalidade, p.dataNascimento, p.sexo, p.estadoCivil,
					p.endereco, p.numero, p.complemento, p.bairro, p.cep, p.cidade, p.estado,
					p.telResidencial, p.celular, p.ingles, p.espanhol, p.italiano,
					p.frances, p.alemao, p.outro1Nivel, p.outro2Nivel, p.outro1,p.outro2,
					p.office, p.webdesign, p.editorImagem, p.pergunta1, p.pergunta2, p.pergunta3,
					p.pergunta4, p.pergunta5, p.pergunta6, p.recomendador, p.contabilidade, p.administracao,
					p.economia, p.financas, p.recursosHumanos, p.tecnologiaInformacao, p.marketing, p.outrosEstudos ,l.email FROM login as l JOIN pessoa as p ON l.id=p.idLogin WHERE l.entrevistaMarcada=1";
					$consulta = mysql_query($sql, $conexaoBD->getLink());
					$numLinhas = mysql_num_rows ($consulta);
					if ($numLinhas != 0) {
						while ($dados  = mysql_fetch_array ($consulta,MYSQL_ASSOC)) {
							/*echo "<pre>";
							var_dump ($dados);
							echo "</pre>";*/
							$idPessoa = $dados['id'];
							echo "<b>Dados Pessoais</b><br/>";
							echo "<ul>";
							echo "<li><u>Código</u>: ".$dados['id']."</li>";
							echo "<li><u>Nome</u>: ".$dados['nome']."</li>";
							echo "<li><u>E-mail</u>: ".$dados['email']."</li>";
							echo "<li><u>Nacionalidade</u>: ".$dados['nacionalidade']."</li>";
							echo "<li><u>Sexo</u>: ".$dados['sexo']."</li>";
							echo "<li><u>Estado Civil</u>: ".$dados['estadoCivil']."</li>";
							echo "<li><u>Tipo</u>: ".$dados['tipo']."</li>";
							echo "<li><u>Endereço</u>: ".$dados['endereco']."</li>";
							echo "<li><u>Número</u>: ".$dados['numero']."</li>";
							echo "<li><u>Complemento</u>: ".$dados['complemento']."</li>";
							echo "<li><u>Bairro</u>: ".$dados['bairro']."</li>";
							echo "<li><u>CEP</u>: ".$dados['cep']."</li>";
							echo "<li><u>Cidade</u>: ".$dados['cidade']."</li>";
							echo "<li><u>Estado</u>: ".$dados['estado']."</li>";
							echo "<li><u>Telefone Residencial</u>: ".$dados['telResidencial']."</li>";
							echo "<li><u>Celular</u>: ".$dados['celular']."</li>";
							echo "</ul>";
							echo "<br/>";
							echo "<b>Habilidades</b><br/>";
							echo "<ul>";
							echo "<li><u>Inglês</u>: ".$dados['ingles']."</li>";
							echo "<li><u>Espanhol</u>: ".$dados['espanhol']."</li>";
							echo "<li><u>Italiano</u>: ".$dados['italiano']."</li>";
							echo "<li><u>Francês</u>: ".$dados['frances']."</li>";
							echo "<li><u>Alemão</u>: ".$dados['alemao']."</li>";
							if (!empty ($dados['outro1'])) {
							echo "<li><u>".$dados['outro1']."</u>: ".$dados['outro1Nivel']."</li>";
							}
							if (!empty ($dados['outro2'])) {
							echo "<li><u>".$dados['outro2']."</u>: ".$dados['outro2Nivel']."</li>";
							}
							echo "<li><u>Pacote Office</u>: ".$dados['office']."</li>";
							echo "<li><u>Webdesign</u>: ".$dados['webdesign']."</li>";
							echo "<li><u>Editor de Imagem</u>: ".$dados['editorImagem']."</li>";
							echo "<li><u>Contabilidade</u>: ".$dados['contabilidade']."</li>";
							echo "<li><u>Administração</u>: ".$dados['administracao']."</li>";
							echo "<li><u>Economia</u>: ".$dados['economia']."</li>";
							echo "<li><u>Finanças</u>: ".$dados['financas']."</li>";
							echo "<li><u>Recursos Humanos</u>: ".$dados['recursosHumanos']."</li>";
							echo "<li><u>Marketing</u>: ".$dados['marketing']."</li>";
							echo "<li><u>Tecnologia da Informação</u>: ".$dados['tecnologiaInformacao']."</li>";
							echo "<li><u>Outros Estudos</u>: ".$dados['outrosEstudos']."</li>";
							echo "</ul>";
							echo "<br/>";
							echo "<b>Pesquisa de Imagem</b><br/>";
							echo "<ul>";
							echo "<li><u>Você conhecia a AIESEC antes do processo seletivo?</u>: ".$dados['pergunta1']."</li>";
							echo "<li><u>Você pretende realizar intercâmbio pela AIESEC?</u>: ".$dados['pergunta2']."</li>";
							echo "<li><u>Já teve experiência internacional?</u>: ".$dados['pergunta3']."</li>";
							echo "<li><u>Qual?</u>: ".$dados['pergunta4']."</li>";
							echo "<li><u>Por que você está se inscrevendo para o processo seletivo da AIESEC? </u>: ".$dados['pergunta5']."</li>";
							echo "<li><u>Como ficou sabendo sobre a AIESEC?</u>: ".$dados['pergunta6']."</li>";
							if (!empty($dados['recomendador'])) {
								echo "<li><u>Recomendador</u>: ".$dados['recomendador']."</li>";
							}
							echo "</ul>";
							echo "<br/>";
							//mostrar experiencia academica
							$sql2 = "SELECT * FROM expacademica WHERE idPessoa=".$idPessoa;
							$consulta2 = mysql_query($sql2, $conexaoBD->getLink());
							$numLinhas2 = mysql_num_rows ($consulta2);
							if ($numLinhas2 != 0) {
								$i = 0;
								while ($dados2  = mysql_fetch_array ($consulta2, MYSQL_ASSOC)) {
									echo "<b>Formação Acadêmica ".($i+1)."</b><br/>";
									echo "<ul>";
									echo "<li><u>Instituição</u>: ".$dados2['instituicao']."</li>";
									echo "<li><u>Curso</u>: ".$dados2['curso']."</li>";
									echo "<li><u>Tipo</u>: ".$dados2['tipo']."</li>";
									echo "<li><u>Turno</u>: ".$dados2['turno']."</li>";
									echo "<li><u>Semestre</u>: ".$dados2['semestre']."</li>";
									echo "<li><u>Data de ingresso</u>: ".$dados2['dataIngresso']."</li>";
									echo "<li><u>Data de Conclusão</u>: ".$dados2['dataConclusao']."</li>";
									echo "</ul>";
									echo "<br/>";
									$i++;
								}
							} else {
								echo "<b>Formação Acadêmica</b><br/>";
								echo '<ul><li>Não há experiências acadêmicas vinculadas a esse candidato!</li></ul>';	
							}
							//mostrar experiencia profissional
							$sql3 = "SELECT * FROM expprofissional WHERE idPessoa=".$idPessoa;
							$consulta3 = mysql_query($sql3, $conexaoBD->getLink());
							$numLinhas3 = mysql_num_rows ($consulta3);
							if ($numLinhas3 != 0) {
								$j = 0;
								while ($dados3  = mysql_fetch_array ($consulta3, MYSQL_ASSOC)) {
									echo "<b>Experiência Profissional ".($j+1)."</b><br/>";
									echo "<ul>";
									echo "<li><u>Empresa</u>: ".$dados3['empresa']."</li>";
									echo "<li><u>Tipo</u>: ".$dados3['tipo']."</li>";
									echo "<li><u>Atividade</u>: ".$dados3['atividade']."</li>";								
									echo "<li><u>Data de Início</u>: ".$dados3['dataInicio']."</li>";
									echo "<li><u>Data de Conclusão</u>: ".$dados3['dataConclusao']."</li>";
									echo "</ul>";
									echo "<br/>";
									$j++;
								}
							} else {
								echo "<b>Experiência Profissional</b><br/>";
								echo '<ul><li>Não há experiências profissionais vinculadas a esse candidato!</li></ul>';	
							}
							echo "<hr><br>";						
						}
					} else {
						echo '<ul class="erro"><li>Ninguém marcou entrevista!</li></ul>';
					}			
				}
			}
		}
	}
					
					
/*				}
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
							}
						}
					} else {
						echo '<ul class="erro"><li>Erro de sistema (6)! Contate o administrador do sistema!</li></ul>';	
					}
			
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
					}
				}
			}
		} else {
			echo '<ul class="erro"><li>Erro de sistema (3)! Contate o administrador do sistema!</li></ul>';
		}
	}*/
	
	echo "<br/>";
	include ("rodape.php");
?>