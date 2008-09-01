function $(nomeElemento) 
{
	return document.getElementById(nomeElemento);
}

function $$(theNomeElemento) {
	return window.opener.document.getElementById(theNomeElemento);
}

function verificaCampoVazio (campo) 
{
	if (campo == '') {
		return true;
	} else {
		return false;
	}
}

function verificaFormDadosPessoais (nome, nacionalidade, nacionalidadeEstrangeira, dataNascimento, sexo, 
estadoCivil, endereco, numero, cep, cidade, cidadeOutra, estado, estadoOutro, celular, email)
{
	var retorno = true;
	if (verificaCampoVazio(nome.value)) {
		alert ('É necessário preencher o campo "Nome"!');
		nome.focus ();
		retorno = false;
	} else if (nacionalidade.value == 0) {
		alert ('É necessário selecionar uma nacionalidade!');
		nacionalidade.focus ();
		retorno = false;
	} else if (nacionalidade.value == "estrangeira") {		   
		if (verificaCampoVazio(nacionalidadeEstrangeira.value)) { 
			alert ('É necessário preencher a nacionalidade estrangeira!');
			nacionalidadeEstrangeira.focus ();
			retorno = false;
		}
	} else if (verificaCampoVazio(dataNascimento.value)) {
		alert ('É necessário preencher o campo "Data de Nascimento"!');
		dataNascimento.focus ();
		retorno = false;
	} else if (sexo.value == 0) {
		alert ('É necessário selecionar um sexo!');
		sexo.focus ();
		retorno = false;
	} else if (estadoCivil.value == 0) {
		alert ('É necessário selecionar um estado civil!');
		estadoCivil.focus ();
		retorno = false;
	} else if (verificaCampoVazio(endereco.value)) {
		alert ('É necessário preencher o campo "Endereço"!');
		endereco.focus ();
		retorno = false;
	} else if (verificaCampoVazio(numero.value)) {
		alert ('É necessário preencher o campo "Número"!');
		numero.focus ();
		retorno = false;
	} else if (verificaCampoVazio(cep.value)) {
		alert ('É necessário preencher o campo "CEP"!');
		cep.focus ();
		retorno = false;
	} else if (cidade.value == "outra") {
		if (verificaCampoVazio(cidadeOutra.value)) { 
			alert ('É necessário preencher o nome da cidade!');
			cidadeOutra.focus ();
			retorno = false;
		}
	} else if (estado.value == "outro") {
		if (verificaCampoVazio(estadoOutro.value)) { 
			alert ('É necessário preencher o nome do estado!');
			estadoOutro.focus ();
			retorno = false;
		}
	} else if (verificaCampoVazio(celular.value)) {
		alert ('É necessário preencher o campo "Celular"!');
		celular.focus ();
		retorno = false;
	} else if (verificaCampoVazio(email.value)) {
		alert ('É necessário preencher o campo "E-mail"!');
		email.focus ();
		retorno = false;
	} else if (!isEmailValido (email.value)) {
		alert("Por favor digite um endereço de email válido!");
		email.focus();
		retorno = false;
	}
	return retorno;
}

function verificaFormDadosEducacionais (curso, tipo, instituicao, dataIngresso)
{
	var retorno = true;
	if (curso.value == 0) {
		alert ('É necessário preencher o campo "Curso"!');
		curso.focus ();
		retorno = false;
	} else if (tipo.value == 0) {
		alert ('É necessário selecionar um tipo!');
		tipo.focus ();
		retorno = false;
	} else if (instituicao.value == 0) {
		alert ('É necessário selecionar uma instituição!');
		instituicao.focus ();
		retorno = false;
	} else if (verificaCampoVazio(dataIngresso.value)) {
		alert ('É necessário preencher o campo "Data de ingresso"!');
		dataIngresso.focus ();
		retorno = false;
	} else if (verificaCampoVazio(dataConclusao.value)) {
		alert ('É necessário preencher o campo "Data de conclusão"!');
		dataConclusao.focus ();
		retorno = false;
	}
	return retorno;
}


//checa se um email eh valido (nao vazio, tem @ e .)
function isEmailValido(email) 
{
	var retorno = true;
	//testa se eh vazio
	if (verificaCampoVazio(email.value)) {
		retorno = false;
	}
	if (retorno == true) {
		var tempstr = new String(email.value);
		var aindex = tempstr.indexOf ("@");
		if (aindex > 0) {
			var pindex = tempstr.indexOf(".",aindex);
			if ((pindex > aindex+1) &&(tempstr.length > pindex+1)) {
				retorno = true;
			} else {
				retorno = false;
			}
		}
	}
	return retorno;
}

function verificaFormularioUsuario (usuario, senha) 
{
	var retorno = true;
	if (verificaCampoVazio(usuario.value)) {
		alert ('É necessário preencher o campo Usuário!');		
		usuario.focus ();
		retorno = false;
	} else if (verificaCampoVazio(senha.value)) {
		alert ('É necessário preencher o campo Senha!');
		senha.focus ();
		retorno = false;
	}
	return retorno;
}

function confirmaExclusao ()
{
	if (confirm('Você tem certeza que deseja excluir esse dado?')) {
		return true;
	} else {
		return false;
	}
}

/*
* Abre todos os blocos
*/
function blocoAbreTodos(prefixo, n_elementos)
{
	for (var  i = 1; i <= n_elementos; i++) {
		var texto = document.getElementById(prefixo + i);
		if(texto != null){
			blocoAbre(texto);
		}
	}
}

/*
* Fecha todos os blocos
*/
function blocoFechaTodos(prefixo, n_elementos)
{
	for (var i = 1; i <= n_elementos; i++) {
		var texto = document.getElementById(prefixo + i);
		if(texto != null){
			blocoFecha(texto);
		} else {
			alert('entrei aqui '+n_elementos+' '+prefixo + i);
		}
	}
}

/*
* Mostra bloco fechando os demais
*/
function blocoExibe(prefixo, id, n_elementos) 
{
	blocoFechaTodos(prefixo, n_elementos);
	var resposta = document.getElementById(prefixo + id);
	blocoAbre(resposta);
}
/*
* Algerna o status de visibilidade do elemento
*/
function alternaEstado(elemento) 
{
	if (elemento.style.display == 'none') {
		blocoAbre(elemento);
	} else {
		blocoFecha(elemento) ;
	}
}

function blocoAbre(elemento) 
{
	elemento.style.display = 'inline';
}

function blocoFecha(elemento) 
{
	elemento.style.display = 'none';
}
