function $(nomeElemento) 
{
	return document.getElementById(nomeElemento);
}

function $$(theNomeElemento) {
	return window.opener.document.getElementById(theNomeElemento);
}

function verificaCampoVazio (campo) 
{
	if (campo=='') {
		return true;
	} else {
		return false;
	}
}

function verificaFormulario (nome, id) 
{
	var retorno = true;
	if (id.value == 0) {
		alert ('É necessário selecionar um campo!');
		retorno = false;
	} else if (verificaCampoVazio(nome.value)) {
		alert ('É necessário preencher o campo nome!');
		nome.focus ();
		retorno = false;
	}
	return retorno;
}

function verificaFormularioUsuario (login, nome, senha) 
{
	var retorno = true;
	if (verificaCampoVazio(nome.value)) {
		alert ('É necessário preencher o campo nome!');
		nome.focus ();
		retorno = false;
	} else if (verificaCampoVazio(login.value)) {
		alert ('É necessário preencher o campo login!');		
		login.focus ();
		retorno = false;
	} else if (verificaCampoVazio(senha.value)) {
		alert ('É necessário preencher o campo senha!');
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
