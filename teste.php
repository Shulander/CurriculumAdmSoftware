
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Processo Seletivo AIESEC Vit�ria</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<script>
function MascaraData(vFormulario,vCampoRecebido,vTextoRecebido){
	var vData='';
	vData=vData+vTextoRecebido;
	var c = vData.charAt((vData.length-1));
        if (((c < "0") || (c > "9"))){
		document.forms[vFormulario].elements[vCampoRecebido].value=vData.substring(0,(vData.length-1));
	}else{ 
          switch(vData.length){
	  case 2: case 5:
		vData=vData+'/';
		document.forms[vFormulario].elements[vCampoRecebido].value=vData;
		break;
	  }
        }
}

function checaNumero(vFormulario,vCampoRecebido,vTextoRecebido){
	var vData='';
	vData=vData+vTextoRecebido;
	var c = vData.charAt((vData.length-1));
        if (((c < "0") || (c > "9"))){
		document.forms[vFormulario].elements[vCampoRecebido].value=vData.substring(0,(vData.length-1));
	}
}

function checaNumeroInter(vFormulario,vCampoRecebido,vTextoRecebido,x,y){
	var vData='';
	vData=vData+vTextoRecebido;
	var cx, cy;
	if (x==0){cx="0";}
	if (x==1){cx="1";}
	if (x==2){cx="2";}
	if (x==3){cx="3";}
	if (x==4){cx="4";}
	if (x==5){cx="5";}
	if (x==6){cx="6";}
	if (x==7){cx="7";}
	if (x==8){cx="8";}
	if (x==9){cx="9";}
	if (y==0){cy="0";}
	if (y==1){cy="1";}
	if (y==2){cy="2";}
	if (y==3){cy="3";}
	if (y==4){cy="4";}
	if (y==5){cy="5";}
	if (y==6){cy="6";}
	if (y==7){cy="7";}
	if (y==8){cy="8";}
	if (y==9){cy="9";}

	var c = vData.charAt((vData.length-1));
        if (((c < cx) || (c > cy))){
		document.forms[vFormulario].elements[vCampoRecebido].value=vData.substring(0,(vData.length-1));
	}
}


function isInteger(s){
  var i;
  for (i = 0; i < s.length; i++){   
    // Check that current character is number.
    var c = s.charAt(i);
    if (((c < "0") || (c > "9"))) return false;
  }
  // All characters are numbers.
  return true;
}

function textoBranco(str){ 
	for(var i=0; i<str.length;i++){ 
		var char = str.charAt(i) 
		// checa espa�o, tab e enter
		if((char!=" ") && (char!="\t") &&(char!="\n")){ 
			return false 
		} 
	} 
	return true 
} 

function valida()
{
	//var camposVazios = 0; 
	//f=document.getElementById("form");
	//for(var nElemento=0;nElemento<f.elements.length;nElemento++){ 
	//	var elemento = f.elements[nElemento]; 
	//	if(elemento.type == "text"){ 
	//		if(elemento.value==null || elemento.value=="" || textoBranco(elemento.value)){
	//			camposVazios++; 
	//		}
	//       }
        //} 
	//if(camposVazios){ 
	//	alert("Todos os campos s�o obrigat�rios!");
	//}else if(validaCPF(form.cpf)){
	if(validaCPF(form.cpf)){
		document.form1.submit();
	}
}

function validaCPF(cpf)   
{  
  erro = new String;  
  
  if (cpf.value.length == 11)  
    {     
             var nonNumbers = /\D/;  
       
             if (nonNumbers.test(cpf.value))   
             {  
                     erro = "O CPF deve ter apenas n�meros!";   
             }  
             else  
             {  
                     if (cpf.value == "00000000000" ||   
                             cpf.value == "11111111111" ||   
                             cpf.value == "22222222222" ||   
                             cpf.value == "33333333333" ||   
                             cpf.value == "44444444444" ||   
                             cpf.value == "55555555555" ||   
                             cpf.value == "66666666666" ||   
                             cpf.value == "77777777777" ||   
                             cpf.value == "88888888888" ||   
                             cpf.value == "99999999999") {  
                               
                             erro = "N�mero de CPF inv�lido!"  
                     }  
       
                     var a = [];  
                     var b = new Number;  
                     var c = 11;  
   
                     for (i=0; i<11; i++){  
                             a[i] = cpf.value.charAt(i);  
                             if (i < 9) b += (a[i] * --c);  
                     }  
       
                     if ((x = b % 11) < 2) { a[9] = 0 } else { a[9] = 11-x }  
                     b = 0;  
                     c = 11;  
       
                     for (y=0; y<10; y++) b += (a[y] * c--);   
       
                     if ((x = b % 11) < 2) { a[10] = 0; } else { a[10] = 11-x; }  
       
                     if ((cpf.value.charAt(9) != a[9]) || (cpf.value.charAt(10) != a[10])) {  
                         erro = "N�mero de CPF inv�lido.";  
                     }  
             }  
     }  
     else  
     {  
         if(cpf.value.length == 0)  
             return false  
         else  
             erro = "N�mero de CPF inv�lido.";  
     }  
     if (erro.length > 0) {  
             alert(erro);  
             cpf.focus();  
             return false;  
     }     
     return true;      
}  
</script>

</head>
<body bgcolor="#FBFBFB">

<table border=1 cellpadding=2 width="670">
<Tr><td width="670" align="center" bordercolor="#000000"> <font color="#FF0000"><b>LEIA COM ATEN��O</b></font></TD>
</TR>
<tr><td width="670"  bordercolor="#000000"> 
  <p align="justify">1)  Preencha 
  os seus dados corretamente e com aten��o; n�o se esque�a de marcar nenhum 
  campo pois todas as informa��es s�o utilizadas<br>
  no processo seletivo. </p>
  <p align="justify">
  2)Use sempre uma conta de e-mail v�lida para que possa receber informa��es 
  sobre o andamento do processo seletivo, de prefer�ncia uma conta que voc� 
  acessa com frequ�ncia. Procure deixar pelo menos um telefone de contato para 
  que possamos entrar em contato em situa��es que podem ser de seu interesse.</p>
  <p align="justify">3)Voc� pode atualizar a qualquer momento esta ficha. Assim, se n�o 
  tiver tempo de preencher todos os campos no primeiro instante, poder�<br>
  enviar apenas as informa��es j� preenchidas (clique no bot�o enviar no fim da 
  p�gina) que elas ser�o salvas, permitindo 
  recome�ar de onde parou. CUIDADO: isso s� ser� poss�vel at� o ultimo de inscri��o 
  (05/09/2008). Ap�s essa data n�o ser� poss�vel realizar nenhuma altera��o.</p>
  <p align="justify">4)Os dados que ser�o relevantes para a din�mica ser�o os dados que estar�o 
  na ficha de inscri��o impressa que voc� dever� levar no dia da din�mica 
  (clicar em &quot;imprimir ficha de inscri��o&quot; na sua p�gina de usu�rio). Portanto 
  s� imprima quando tiver preenchido toda a ficha.</p>
  </td></tr>
</table>
<br><br>

<table width="670">
    <form id="form" method="post" action="grava_candidato.php" name="form1">


<!--sess�o de informa��es pessoais -->
      <tr> <td width="%25"><td width="%75" align="left" ><h2> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;INFORMA��ES PESSOAIS</h2> </td></td></tr>
      <tr>      
        <td width="25%"><div align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Nome completo:</font></b></div></td>
        <td width="75%"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><input name="nome" type="text" value="" class="border" size="60" maxlength="100"></font></td>
      </tr>
      <tr>      
        <td width="25%"><div align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Email:</font></b></div></td>
        <td width="75%"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><input name="email" type="text" class="border" size="60" maxlength="50" value="lianecafarate@gmail.com"></font></td>
      </tr>
       <tr>      
        <td width="25%"><div align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Confirmar email:</font></b></div></td>
        <td width="75%"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><input name="cemail" type="text" class="border" size="60" maxlength="50" value="lianecafarate@gmail.com"></font></td>
      </tr>
      <tr>      
        <td width="25%"><div align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">CPF (s� n�meros):</font></b></div></td>
                 <td width="75%"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><input name="cpf" type="text" value="" class="border" size="15" maxlength="11" onkeyup="javascript: checaNumero('form1',this.name,this.value)"></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Sexo:</b><input   type="radio" value="m" name="sexo" />&nbsp;Masculino<input type="radio" value="f" checked name="sexo" />&nbsp;Feminino</font></td>
      </tr>
      <tr>      
        <td width="25%"><div align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Data de Nascimento:</font></b></div></td>
        <td width="75%"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><input name="nascimento" type="text" value="" class="border" size="15" maxlength="10" onkeyup="javascript: MascaraData('form1',this.name,this.value)"></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;<font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Naturalidade:</b><input name="naturalidade" type="text" value="" class="border" size="15" maxlength="30"></font></td>
      </tr>
              <tr>
        <td width="25%"><div align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Estado Civil:</font></b></div></td>
	<td width="75%"> &nbsp; <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
    <input checked type="radio" value="so" name="ecivil" />&nbsp;Solteiro<input  type="radio"  value="ca" name="ecivil" />&nbsp;Casado</font> <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
    <input  type="radio" value="vi" name="ecivil" />&nbsp;Vi�vo<input  type="radio" value="se" name="ecivil" />&nbsp;Separado<input  type="radio" value="di" name="ecivil" />&nbsp;Divorciado</font></td>
      </tr>

      <tr>      
        <td width="25%"><div align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Endere�o:</font></b></div></td>
        <td width="75%"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><input name="endereco" type="text" value="" class="border" size="60" maxlength="50"></font></td>
      </tr>

      <tr>      
        <td width="25%"><div align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">N�mero:</font></b></div></td>
        <td width="75%"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><input name="numero" type="text" value="" class="border" size="15" maxlength="10" ></font></td>
      </tr>

      <tr>      
        <td width="25%"><div align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Complemento:</font></b></div></td>
        <td width="75%"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><input name="complemento" type="text" value="" class="border" size="60" maxlength="50"></font></td>
      </tr>

      <tr>      
        <td width="25%"><div align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Bairro:</font></b></div></td>
        <td width="75%"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><input name="bairro" type="text" value="" class="border" size="60" maxlength="50"></font></td>
      </tr>

      <tr>      
        <td width="25%"><div align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Cidade:</font></b></div></td>
        <td width="75%"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><input name="cidade" type="text" value="" class="border" size="60" maxlength="50"></font></td>
      </tr>



      <tr>
        <td width="25%"><div align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">UF:</font></b></div></td>
        <td width="75%"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><input name="uf" type="text" value="" class="border" size="2" maxlength="2"></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Pa�s:</b><input name="pais" type="text" value="" class="border" size="30" maxlength="30"></font></td>
      </tr>


      <tr>      
        <td width="25%"><div align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Telefone Residencial:</font></b></div></td>
        <td width="75%"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><input name="telr" type="text" value="" class="border" size="15" maxlength="10" onkeyup="javascript: checaNumero('form1',this.name,this.value)"></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;<font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Telefone celular:</b></font><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><input name="telc" type="text" value="" class="border" size="15" maxlength="10" onkeyup="javascript: checaNumero('form1',this.name,this.value)"></font></td>
      </tr>



<!-- SESS�O DE INFORMA�OES ACADEMICAS -->
<tr><td>&nbsp;&nbsp;</td></tr>
 
<tr> <td width="%25"><td width="%75" align="left" ><h2> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;INFORMA��ES ACAD�MICAS</h2> </td></td></tr>
      
      <tr>      
        <td width="25%"><div align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Forma��o N� 1</font></b></div></td>
	    <td width="75%"> &nbsp;&nbsp; <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
        <input checked type="radio" value="grad" name="formacao1" />&nbsp;Gradua��o<input  type="radio" value="pos" name="formacao1" />&nbsp;P�s-graduacao</font> <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
        <input  type="radio" value="outro" name="formacao1" />&nbsp;Outro<input name="formOutra1" type="text" value="" class="border" size="11" maxlength="50"></font></td>
      </tr>
      <tr>      
        <td width="25%"><div align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Nome da Institui��o:</font></b></div></td>
        <td width="75%"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><input name="nomeInst1" type="text" value="" class="border" size="61" maxlength="50"></font></td>
      </tr>
      <tr>      
        <td width="25%"><div align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Curso:</font></b></div></td>
        <td width="75%"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><input name="curso1" type="text" value="" class="border" size="18" maxlength="50"></font>&nbsp;&nbsp;
       <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Data de ingresso:</b><input name="datain1" type="text" value="" class="border" size="17" maxlength="10" onkeyup="javascript: MascaraData('form1',this.name,this.value)"></font></td>
      </tr>
      <tr>      
        <td width="25%"><div align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Semestre atual:</font></b></div></td>
        <td width="75%"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><input name="semestre1" type="text" value="" class="border" size="10" maxlength="10"> <b>Previs�o de conclus�o:</b><input name="prev1" type="text" value="" class="border" size="15" maxlength="6">&nbsp;(aaaa/p)</td>
      </tr>
      
      
      <tr>
        <td width="25%"><div align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Turno:</font></b></div></td>
	    <td width="75%"> &nbsp; <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
        <input checked type="radio" value="mat" name="turno1" />&nbsp;Matutino<input  type="radio" value="vesp" name="turno1" />&nbsp;Vespertino</font> <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
        <input  type="radio" value="notu" name="turno1" />&nbsp;Noturno<input  type="radio" value="inte" name="turno1" />&nbsp;Integral</font></td>
      </tr>

	  <tr><td><b>&nbsp;&nbsp;</b></td></tr>
	  <tr><td><b>&nbsp;&nbsp;</b></td></tr>

       <tr>      
        <td width="25%"><div align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Forma��o N� 2</font></b></div></td>
	    <td width="75%"> &nbsp;&nbsp;  <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
        <input checked type="radio" value="grad" name="formacao2" />&nbsp;Gradua��o<input  type="radio" value="pos" name="formacao2" />&nbsp;P�s-graduacao</font> <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
        <input  type="radio" value="outro" name="formacao2" />&nbsp;Outro<input name="formOutra2" type="text" value="" class="border" size="11" maxlength="50"></font></td>
      </tr>
      <tr>      
        <td width="25%"><div align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Nome da Institui��o:</font></b></div></td>
        <td width="75%"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><input name="nomeInst2" type="text" value="" class="border" size="61" maxlength="50"></font></td>
      </tr>
      <tr>      
        <td width="25%"><div align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Curso:</font></b></div></td>
        <td width="75%"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><input name="curso2" type="text" value="" class="border" size="18" maxlength="50"></font>&nbsp;&nbsp;
       <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Data de ingresso:</b><input name="datain2" type="text" value="" class="border" size="17" maxlength="10" onkeyup="javascript: MascaraData('form1',this.name,this.value)"></font></td>
      </tr>
      <tr>      
        <td width="25%"><div align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Semestre atual:</font></b></div></td>
        <td width="75%"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><input name="semestre2" type="text" value="" class="border" size="10" maxlength="10"> <b>Previs�o de conclus�o:</b><input name="prev2" type="text" value="" class="border" size="15" maxlength="6">&nbsp;(aaaa/p)</td>
      </tr>

      
      <tr>
        <td width="25%"><div align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Turno:</font></b></div></td>
	    <td width="75%"> &nbsp; <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><input checked type="radio" value="mat" name="turno2" />&nbsp;Matutino</font><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="radio"  value="vesp" name="turno2" />&nbsp;Vespertino</font> <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="radio"  value="notu" name="turno2" />&nbsp;Noturno</font><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="radio"  value="inte" name="turno2" />&nbsp;Integral</td>
      </tr>

  <!--  SESS�O IDIOMAS -->
  
  
    

	  <tr><td>&nbsp;&nbsp;</td></tr>
	<tr> <td width="%25"><td width="%75" align="left" ><h2> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;IDIOMAS</h2> </td></td></tr>
	  
	  <tr>
        <td width="25%"><div align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Ingl�s:</font></b></div></td>
	    <td width="75%"> &nbsp; <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
        <input checked type="radio" value="n" name="ingles" />&nbsp;Nenhum<input  type="radio" value="b" name="ingles" />&nbsp;B�sico</font> <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
        <input  type="radio" value="i" name="ingles" />&nbsp;Intermedi�rio<input  type="radio" value="a" name="ingles" />&nbsp;Avan�ado
        <input  type="radio" value="f" name="ingles" />&nbsp;Fluente</font></td>
      </tr>
	  <tr>
        <td width="25%"><div align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Espanhol:</font></b></div></td>
	    <td width="75%"> &nbsp; <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
        <input checked type="radio" value="n" name="espanhol" />&nbsp;Nenhum<input  type="radio" value="b" name="espanhol" />&nbsp;B�sico</font> <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
        <input  type="radio" value="i" name="espanhol" />&nbsp;Intermedi�rio<input  type="radio" value="a" name="espanhol" />&nbsp;Avan�ado
        <input  type="radio" value="f" name="espanhol" />&nbsp;Fluente</font></td>
      </tr>
	  <tr>
        <td width="25%">
        <p align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
        Outro:</font></b></td>
	    <td width="75%"> <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
        <input name="nomeOL1" type="text" value="" class="border" size="10" maxlength="50"><input checked type="radio" value="n" name="outroL1" />&nbsp;Nenhum<input  type="radio" value="b" name="outroL1" />&nbsp;B�sico</font> <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
        <input  type="radio" value="i" name="outroL1" />&nbsp;Intermedi�rio<input  type="radio" value="a" name="outroL1" />&nbsp;Avan�ado
        <input  type="radio" value="f" name="outroL1" />&nbsp;Fluente</font></td>
      </tr>

<tr>
        <td width="25%">
        <p align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
        Outro:</font></b></td>
	    <td width="75%"> <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
        <input name="nomeOL2" type="text" value="" class="border" size="10" maxlength="50"><input checked type="radio" value="n" name="outroL2" />&nbsp;Nenhum<input  type="radio" value="b" name="outroL2" />&nbsp;B�sico</font> <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
        <input  type="radio" value="i" name="outroL2" />&nbsp;Intermedi�rio<input  type="radio" value="a" name="outroL2" />&nbsp;Avan�ado
        <input  type="radio" value="f" name="outroL2" />&nbsp;Fluente</font></td>
      </tr>
<tr>
        <td width="25%">
        <p align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
        Outro:</font></b></td>
	    <td width="75%"> <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
        <input name="nomeOL3" type="text" value="" class="border" size="10" maxlength="50"><input checked  type="radio" value="n" name="outroL3" />&nbsp;Nenhum<input  type="radio" value="b" name="outroL3" />&nbsp;B�sico</font> <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
        <input  type="radio" value="i" name="outroL3" />&nbsp;Intermedi�rio<input  type="radio" value="a" name="outroL3" />&nbsp;Avan�ado
        <input  type="radio" value="f" name="outroL3" />&nbsp;Fluente</font></td>
      </tr>
	  <tr>
        <td width="25%">&nbsp;</td>
	    <td width="75%">&nbsp; </td>
      </tr>

	  <tr>
        <td width="25%">&nbsp;</td>
	    <td width="75%"> &nbsp; <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"></fonte></td>
      </tr>

<!-- SESS�O INFORMA��ES PROFISSIONAIS -->

	  <tr><td>&nbsp;&nbsp;</td></tr>
      <tr> <td align="center" colspan="2"><h2> INFORMA��ES PROFISSIONAIS</h2> </td></td></tr>

      <tr>      
        <td width="25%"><div align="right">
          <p><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Experi�ncia Profissional</font></b></p>
          <p><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">(SIGA O <a href=" " onClick="javascript:modelo=window.open('modelo.php', 'modelo', 'toolbar=no, location=no, directories=no, status=no, menubar=yes, scrollbars=yes, resizable=yes, width=650, height=400');return false;">MODELO</a>) </font></b></p>
        </div></td>
        <td width="75%"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
        	<textarea name="expProff" rows="10" cols="60">Junior Achievement
Posi��o: Diretor de marketing 	 Janeiro de 2008 - Presente

Atividades Principais: Planejamento estrat�gico e operacional da �rea, relacionamento com clientes externos, manuten��o e expans�o do programa de parcerias.


Insight-os Comunica��o � Ag�ncia de publicidade	   Setembro de 2007 � Dezembro de  2007

Atividades Principais: prospectar novos clientes, assist�ncia no gerenciamento de contas. </textarea>
	</font></td>
      </tr>
      <tr>      
        <td width="25%"><div align="right">
          <p><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Atividades Extra-Curriculares</font></b></p>
          <p><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">(SIGA O <a href=" " onClick="javascript:modelo=window.open('modelo.php', 'modelo', 'toolbar=no, location=no, directories=no, status=no, menubar=yes, scrollbars=yes, resizable=yes, width=650, height=400');return false;">MODELO</a>) </font></b></p>
        </div></td>
        <td width="75%"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
        	<textarea name="ativExt" rows="5" cols="60">Curso avan�ado de fotografia � conclu�do em 2007

Curso de manuten��o de computadores - CEFETES - concluido em janeiro de 2002</textarea>
		</font></td>
      </tr>
      <tr><td><td>&nbsp;</td></td>
      
	  <tr>      
        <td width="25%" rowspan="3"><div align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Conhecimentos de Inform�tica:<br>
          </font></b></div></td>
        <td width="75%" bgcolor="#E4E4E4" align="center" cellpadding="0" cellspacing="0"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif" align="center">(1) Nenhum (2) Muito pouco (3) B�sico 
        (4) Usu�rio (5) Avan�ado</font></td></tr>
        <tr><td width="75%" bgcolor="#E4E4E4" align="center" cellpadding="0" cellspacing="0"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><input name="cWin" type="text" value="" class="border" size="1" maxlength="1" onkeyup="javascript: checaNumeroInter('form1',this.name,this.value,1,5)">Windows&nbsp;&nbsp; <input name="cWord" type="text" value="" class="border" size="1" maxlength="1" onkeyup="javascript: checaNumeroInter('form1',this.name,this.value,1,5)">Word&nbsp;&nbsp; <input name="cExcel" type="text" value="" class="border" size="1" maxlength="1" onkeyup="javascript: checaNumeroInter('form1',this.name,this.value,1,5)">Excel</td></tr>
        <tr><td width="75%" bgcolor="#E4E4E4" align="center" cellpadding="0" cellspacing="0"><input name="cPP" type="text" value="" class="border" size="1" maxlength="1" onkeyup="javascript: checaNumeroInter('form1',this.name,this.value,1,5)">Power Point&nbsp;<input name="cInter" type="text" value="" class="border" size="1" maxlength="1" onkeyup="javascript: checaNumeroInter('form1',this.name,this.value,1,5)">Internet&nbsp;<input name="cLinux" type="text" value="" class="border" size="1" maxlength="1" onkeyup="javascript: checaNumeroInter('form1',this.name,this.value,1,5)">Linux</font></td>
		</font></tr>
		<tr><td><td>&nbsp;</td></td>
      </tr>
      
            
        <tr>
        <td width="25%"><div align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
          Voc� trabalha?</font></b></div></td>
	    <td width="75%" bgcolor="#E4E4E4" align="center"> <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
        <input  type="radio" value="s" name="trabalha" />&nbsp;Sim<input checked type="radio" value="n" name="trabalha" />&nbsp;N�o</font> 


	    &nbsp;&nbsp;&nbsp;&nbsp;<b>Hor�rio:</b> <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
        <input  type="checkbox" value="s" name="horaTrab:manha" />&nbsp;Manh�<input  type="checkbox" value="s" name="horaTrab:tarde" />&nbsp;Tarde<input  type="checkbox" value="s" name="horaTrab:noite" />&nbsp;Noite</font>
	    </td>
      </tr>

<!-- PESQUISA DE IMAGEM -->
</table>
<BR><BR>




<table width="845"> 
	  <tr> <td width="239"><td width="596" align="left" ><h2> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PESQUISA DE IMAGEM</h2> </td></td></tr>

      
	  <tr>
        <td width="239"><div align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Conhecia a AIESEC
          antes do processo seletivo?</font></b></div></td>
	    <td width="596" bgcolor="E4E4E4"> &nbsp;<p>&nbsp; <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><input  type="radio" value="sim" name="conheciaA" />&nbsp;Sim<input checked type="radio" value="nao" name="conheciaA" />&nbsp;N�o</font>
        </p>
        <p></td>
      </tr>
      
   	  <tr>
        <td width="239"><div align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Voc� pretende realizar interc�mbio pela AIESEC?</font></b></div></td>
	    <td width="596" bgcolor="E4E4E4"> &nbsp;<p>&nbsp; <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><input  type="radio" value="seisM" name="interca" />&nbsp;em at� 6 meses<input  type="radio" value="umA" name="interca" />&nbsp;em at� 1 ano<input  type="radio" value="futu" name="interca" />&nbsp;futuramente</font> <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><input checked type="radio" value="nao" name="interca" />&nbsp;N�o pretendo</font></p>
        <p></td>
      </tr>
      
         
	  <tr>
        <td width="239"><div align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
          J� teve experi�ncia internacional?</font></b></div></td>
	    <td width="596" bgcolor="E4E4E4"> &nbsp;<p>&nbsp; <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><input  type="radio" value="sim" name="expInter" />&nbsp;Sim<input checked type="radio" value="nao" name="expInter" />&nbsp;N�o</font>
        </p>
        <p></td>
      </tr>
		  <tr>
        <td width="239"><div align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
          Qual?</font></b></div></td>
	    <td width="596" bgcolor="E4E4E4"> &nbsp;<p>&nbsp; <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><input  type="checkbox" value="s" name="tipoExp:intercambio" />&nbsp;Interc�mbio<input  type="checkbox" value="s" name="tipoExp:turismo" />&nbsp;Turismo<input  type="checkbox" value="s" name="tipoExp:morouExt" />&nbsp;J� morei no exterior<input  type="checkbox" value="s" name="tipoExp:outra" />&nbsp;Outra<input name="outraExp" type="text" value="" class="border" size="10" maxlength="50"></font></p>
        <p></td>
      </tr>
	 
		  
	  <tr>
        <td width="239"><div align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
          Voc� hospedaria um estrangeiro em sua casa?</font></b></div></td>
	    <td width="596" bgcolor="E4E4E4"> &nbsp;<p>&nbsp; <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><input  type="radio" value="sim" name="hospE" />&nbsp;Hospedaria<input  type="radio" value="simN" name="hospE" />&nbsp;Hospedaria mas n�o agora<input  type="radio" value="simJ" name="hospE" />&nbsp;Sim, j� hospedei e quero novamente</font></p>
        <p>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#333333">&nbsp;<input checked type="radio" value="nao" name="hospE" />&nbsp;N�o</font><p>
        </td>
      </tr>
      <tr>      
        <td width="239"><div align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Por que est� se inscrevendo para o Processo Seletivo da AIESEC?</font></b></div></td>
        <td width="596" bgcolor="E4E4E4">&nbsp;<p><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;
        <b><u>Assinale no m�ximo 3 op��es</u>, enumerando de 1 a 3, sendo 1 o principal 
        motivo para a inscri��o</b></font></p>
        <p>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#333333">&nbsp; <input name="desenvP" type="text" value="" class="border" size="1" maxlength="1" onkeyup="javascript: checaNumeroInter('form1',this.name,this.value,1,3)">&nbsp;Desenvolvimento pessoal e profissional&nbsp;&nbsp;&nbsp; <input name="interProf" type="text" value="" class="border" size="1" maxlength="1"onkeyup="javascript: checaNumeroInter('form1',this.name,this.value,1,3)">&nbsp;Interc�mbio profissional</font></p>
        <p><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp; <input name="desenvLider" type="text" value="" class="border" size="1" maxlength="1" onkeyup="javascript: checaNumeroInter('form1',this.name,this.value,1,3)">&nbsp;Desenvolvimento de lideran�a&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input name="networking" type="text" value="" class="border" size="1" maxlength="1" onkeyup="javascript: checaNumeroInter('form1',this.name,this.value,1,3)">&nbsp;Networking internacional<br>&nbsp; <input name="conheCult" type="text" value="" class="border" size="1" maxlength="1" onkeyup="javascript: checaNumeroInter('form1',this.name,this.value,1,3)">&nbsp;Conhecimento sobre outras culturas&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></p>
        <p>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#333333">&nbsp;&nbsp;<input name="desenvSoci" type="text" value="" class="border" size="1" maxlength="1" onkeyup="javascript: checaNumeroInter('form1',this.name,this.value,1,3)">Contribuir com o desenvolvimento social&nbsp;&nbsp; <input name="ContatoPessOrg" type="text" value="" class="border" size="1" maxlength="1" onkeyup="javascript: checaNumeroInter('form1',this.name,this.value,1,3)">&nbsp;Contato 
        com pessoas e organiza��es</font></p>
        <p>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#333333">&nbsp; <input name="outroMotiv" type="text" value="" class="border" size="1" maxlength="1" onkeyup="javascript: checaNumeroInter('form1',this.name,this.value,1,3)">Outro(descreva)<input name="nomeOutroMotiv" type="text" value="" class="border" size="20" maxlength="50" onkeyup="javascript: checaNumeroInter('form1',this.name,this.value,1,3)"></font></p>
        <p>&nbsp;
        </p>
        </td>
		</font></td>

	
      </tr>
        <td width="239"><div align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Voc� teria interesse em assumir um cargo de lideran�a na AIESEC?</font></b></div></td>
	    <td width="596" bgcolor="E4E4E4"> &nbsp;<p>&nbsp; <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><input checked type="radio" value="nao" name="interCargoL" />&nbsp;N�o pretendo<input   type="radio" value="rap" name="interCargoL" />&nbsp;O mais r�pido poss�vel<input   type="radio" value="aposI" name="interCargoL" />&nbsp;Ap�s um interc�mbio<input  type="radio" value="seism" name="interCargoL" />&nbsp;Em at� seis&nbsp;&nbsp; meses<input   type="radio" value="umAm" name="interCargoL" />&nbsp;Em at� um ano ou mais <input  type="radio" value="simNQ" name="interCargoL" />&nbsp;Tenho interesse mas n�o sei quando</font></p>
        <p></td>
      </tr>
      
      <tr>
        <td width="239"><div align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">De qual forma voc� enxerga que pode exercer seu papel na sociedade?</font></b></div></td>
	    <td width="596" bgcolor="E4E4E4"> &nbsp;<p>&nbsp; <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><input  type="checkbox" value="s" name="enxSoc:cumpL" />&nbsp;Cumprindo as leis&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input  type="checkbox" value="s" name="enxSoc:partV" />&nbsp;Participando de atividades volunt�rias</font></p>
        <p>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#333333">&nbsp; <input  type="checkbox" value="s" name="enxSoc:votC" />&nbsp;Votando Conscientemente&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" value="s"  name="enxSoc:procS" />&nbsp;Atrav�s de projetos sociais</font></p>
        <p>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#333333">&nbsp; <input  type="checkbox" value="s" name="enxSoc:engC" />&nbsp;Engajando-se em comunidades <input type="checkbox" value="s"  name="enxSoc:agiS" />&nbsp;Agindo sustent�velmente</font><p>
        </td>
      </tr>
      
      <tr>
        <td width="239"><div align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Quais s�o suas �reas de interesse?</font></b></div></td>
	    <td width="596" bgcolor="E4E4E4"> &nbsp;<p>&nbsp; <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="checkbox" value="s"  name="areasInt:com" />Comunica��o<input type="checkbox" value="s"  name="areasInt:vendas" />Vendas/Empresarial&nbsp; <input type="checkbox" value="s"  name="areasInt:fin" />&nbsp;Finan�as<input type="checkbox" value="s"  name="areasInt:jur" />&nbsp;Jur�dica<input type="checkbox" value="s"  name="areasInt:ener" />&nbsp;Energia</font></p>
        <p>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#333333">&nbsp; <input type="checkbox" value="s"  name="areasInt:interc" />Intercambio&nbsp; <input type="checkbox" value="s"  name="areasInt:empreend" />Empreendorismo&nbsp; <input type="checkbox" value="s"  name="areasInt:rh" />Recursos Humanos&nbsp; <input type="checkbox" value="s"  name="areasInt:saude" />Sa�de&nbsp; <input type="checkbox" value="s"  name="areasInt:edu" />&nbsp;Educa��o
        </font></p>
        <p>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#333333">&nbsp; <input type="checkbox" value="s"  name="areasInt:ti" />Gest�o da Informa��o&nbsp;&nbsp; <input type="checkbox" value="s"  name="areasInt:mark" />Marketing&nbsp;&nbsp; <input type="checkbox" value="s"  name="areasInt:respSC" />Responsabilidade Social Corporativa</font><p>
        </td>
      </tr>
      
      <tr>
        <td width="239"><div align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Qual a import�ncia de uma experi�ncia internacional em seu planejamento de vida?</font></b></div></td>
	    <td width="596" bgcolor="E4E4E4"> &nbsp;<p>&nbsp; <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="checkbox" value="s"  name="importExpInt:vivD" />&nbsp;Viver uma cultura diferente&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" value="s"  name="importExpInt:trabEI" />&nbsp;Trabalhar em uma empresa internacional</font></p>
        <p>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#333333">&nbsp; <input type="checkbox" value="s"  name="importExpInt:nem" />&nbsp;Nenhuma&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" value="s"  name="importExpInt:outra" />&nbsp;Outra<input type="text" value="" name="importExpInt:nomeO" class="border" size="13" maxlength="50">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" value="s"  name="importExpInt:novoI" />&nbsp;Aprender um novo Idioma
        </font><p>
        </td>
      </tr>

	  <tr>
        <td width="239"><div align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Quais s�o as principais caracter�sticas de um l�der?</font></b></div></td>
	    <td width="596" bgcolor="E4E4E4"> &nbsp;<p>&nbsp; <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="checkbox" value="s"  name="caracL:compr" />Comprometimento&nbsp;&nbsp; <input type="checkbox" value="s"  name="caracL:empat" />Empatia&nbsp;&nbsp; <input type="checkbox" value="s"  name="caracL:flexP" />Flexibilidade de pensamento</font></p>
        <p>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#333333">&nbsp; <input type="checkbox" value="s"  name="caracL:comE" />Comunica��o eficiente&nbsp; <input type="checkbox" value="s"  name="caracL:trabP" />Saber trabalhar sobre press�o&nbsp; <input type="checkbox" value="s"  name="caracL:foco" />Foco em resultado</font></p>
        <p>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#333333">&nbsp; <input type="checkbox" value="s"  name="caracL:desenvP" />Saber desenvolver pessoas&nbsp; <input type="checkbox" value="s"  name="caracL:visE" />&nbsp;Vis�o estrat�gica&nbsp; <input type="checkbox" value="s"  name="caracL:plan" />&nbsp;Planejamento</font></p>
        <p>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#333333">&nbsp; <input type="checkbox" value="s"  name="caracL:outra" />&nbsp;Outra<input name="caracL:nomeO" type="text" value="" class="border" size="25" maxlength="50"></font><p>
        </td>
      </tr>
      
       <tr>      
        <td width="239"><div align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Classifique suas habilidades</font></b></div><div align="right">
        <b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">e compet�ncias <Br>&nbsp;</font></b></div></td>
        <td width="596" bgcolor="E4E4E4"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;&nbsp;</font><p>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#333333">&nbsp;
        <b>(1)N�o desenvolvida (2)Pouco desenvolvida (3)Desenvolvida (4)Muito 
        Desenvolvida</b></font></p>
        <p>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#333333">&nbsp;&nbsp; <input name="habComp:proa" type="text" value="" class="border" size="1" maxlength="1" onkeyup="javascript: checaNumeroInter('form1',this.name,this.value,1,4)">Pr�-atividade&nbsp; <input name="habComp:criat" type="text" value="" class="border" size="1" maxlength="1" onkeyup="javascript: checaNumeroInter('form1',this.name,this.value,1,4)">Criatividade&nbsp; <input name="habComp:compr" type="text" value="" class="border" size="1" maxlength="1" onkeyup="javascript: checaNumeroInter('form1',this.name,this.value,1,4)">Comprometimento&nbsp;&nbsp; <input name="habComp:nego" type="text" value="" class="border" size="1" maxlength="1" onkeyup="javascript: checaNumeroInter('form1',this.name,this.value,1,4)">Negocia��o</font></p>
        <p><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;&nbsp; <input name="habComp:orgplan" type="text" value="" class="border" size="1" maxlength="1" onkeyup="javascript: checaNumeroInter('form1',this.name,this.value,1,4)">Organiza��o e planejamento&nbsp; <input name="habComp:autoM" type="text" value="" class="border" size="1" maxlength="1" onkeyup="javascript: checaNumeroInter('form1',this.name,this.value,1,4)">Automotiva��o&nbsp; <input name="habComp:trabE" type="text" value="" class="border" size="1" maxlength="1" onkeyup="javascript: checaNumeroInter('form1',this.name,this.value,1,4)">Trabalho em equipe&nbsp;</font></p>
        <p>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#333333">&nbsp;&nbsp; <input name="habComp:lider" type="text" value="" class="border" size="1" maxlength="1" onkeyup="javascript: checaNumeroInter('form1',this.name,this.value,1,4)">Lideran�a&nbsp; <input name="habComp:adap" type="text" value="" class="border" size="1" maxlength="1" onkeyup="javascript: checaNumeroInter('form1',this.name,this.value,1,4)">Adptabilidade&nbsp; <input name="habComp:resp" type="text" value="" class="border" size="1" maxlength="1" onkeyup="javascript: checaNumeroInter('form1',this.name,this.value,1,4)">Respeito&nbsp; <input name="habComp:emp" type="text" value="" class="border" size="1" maxlength="1" onkeyup="javascript: checaNumeroInter('form1',this.name,this.value,1,4)">Empatia&nbsp;
		<input name="habComp:autoConf" type="text" value="" class="border" size="1" maxlength="1" onkeyup="javascript: checaNumeroInter('form1',this.name,this.value,1,4)">Autoconfian�a&nbsp;</font></p>
        <p>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#333333">&nbsp;&nbsp; <input name="habComp:integr" type="text" value="" class="border" size="1" maxlength="1" onkeyup="javascript: checaNumeroInter('form1',this.name,this.value,1,4)">Integridade&nbsp; <input name="habComp:autoConh" type="text" value="" class="border" size="1" maxlength="1" onkeyup="javascript: checaNumeroInter('form1',this.name,this.value,1,4)">Autoconhecimento&nbsp; <input name="habComp:com" type="text" value="" class="border" size="1" maxlength="1" onkeyup="javascript: checaNumeroInter('form1',this.name,this.value,1,4)">Comunica��o&nbsp; <input name="habComp:prest" type="text" value="" class="border" size="1" maxlength="1" onkeyup="javascript: checaNumeroInter('form1',this.name,this.value,1,4)">Presta��o de contas</font><p>
        </td>
		</font></td>
      </tr>
      <tr>
        <td width="239"><div align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Como voc� acredita que a AIESEC poder� contribuir para uma boa experi�ncia internacional?</font></b></div></td>
	    <td width="596" bgcolor="E4E4E4"> &nbsp;<p>&nbsp; <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="checkbox" value="s"  name="comoAcontr:oferT" />Oferecendo oportunidades de trainee</font></p>
        <p>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#333333">&nbsp; <input type="checkbox" value="s"  name="comoAcontr:desenvC" />&nbsp;Desenvolvendo minhas compet�ncias e habilidades</font></p>
        <p>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#333333">&nbsp; <input type="checkbox" value="s"  name="comoAcontr:suportExt" />&nbsp;Dando suporte no pa�s em que estiver e para a viagem</font></p>
        <p>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#333333">&nbsp; <input type="checkbox" value="s"  name="comoAcontr:outra" />&nbsp;Outra maneira:<input name="comoAcontr:nomeO" type="text" value="" class="border" size="27" maxlength="50"></font><p>
        </td>
      </tr>

	  <tr>
        <td width="239"><div align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Como ficou sabendo sobre a AIESEC? (Assinale no m�ximo 3 op��es)</font></b></div></td>
	    <td width="596" bgcolor="E4E4E4"> &nbsp;<p>&nbsp; <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="checkbox" value="s"  name="comoCA:recP" />Amigo na AIESEC(quem?)<input name="comoCA:quemI" type="text" value="" class="border" size="14" maxlength="50">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" value="s"  name="comoCA:recO" />&nbsp;Recomenda��o de outros</font></p>
        <p>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#333333">&nbsp; <input type="checkbox" value="s"  name="comoCA:webA" />Website da AIESEC&nbsp; <input type="checkbox" value="s"  name="comoCA:pan" />Panfleto/Flyer&nbsp; <input type="checkbox" value="s"  name="comoCA:cart" />Cartaz/ P�ster/ Painel eletr�nico</font></p>
        <p>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#333333">&nbsp; <input type="checkbox" value="s"  name="comoCA:faix" />Faixas/Banners&nbsp; <input type="checkbox" value="s"  name="comoCA:news" />Newsletter/Mala direta&nbsp; <input type="checkbox" value="s"  name="comoCA:inter" />Internet (google, blog, websites ...)</font></p>
        <p>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#333333">&nbsp; <input type="checkbox" value="s"  name="comoCA:eventA" />Evento promovido pela AIESEC&nbsp; <input type="checkbox" value="s"  name="comoCA:tv" />Televis�o&nbsp; <input type="checkbox" value="s"  name="comoCA:rev" />Revista&nbsp; <input type="checkbox" value="s"  name="comoCA:jorn" />Jornal&nbsp; <input type="checkbox" value="s"  name="comoCA:rad" />&nbsp;R�dio</font></p>
        <p>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#333333">&nbsp; <input type="checkbox" value="s"  name="comoCA:sala" />Divulga��o em sala de aula&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" value="s"  name="comoCA:outro" />Outra<input name="comoCA:nomeO" type="text" value="" class="border" size="24" maxlength="50"></font><p>
        </td>
      </tr>

	  <tr>
        <td width="239"><div align="right"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Voc� acessa a internet: </font>
          </b></div><div align="right">&nbsp;</div><div align="right">&nbsp;</div></td>
	    <td width="596" bgcolor="E4E4E4"> &nbsp;<p><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;<input type="checkbox" value="s"  name="acessaInt:casa" />&nbsp;Em casa<input type="checkbox" value="s"  name="acessaInt:trab" />&nbsp;No trabalho<input type="checkbox" value="s"  name="acessaInt:facul" />&nbsp;Na faculdade<input type="checkbox" value="s"  name="acessaInt:nao" />&nbsp;N�o acessa a Internet</font></p>
        <p></td>
      </tr>

</table>
<br><br>

  <font face="Verdana" size="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>&nbsp;&nbsp;

Indique em quais dias da semana e per�odos voc� pode dedicar-se ao trabalho na AIESEC<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (n�o ocupa necessariamente o per�odo todo):
  </b>
  </font>

<table width="510">

	  <tr>
        <td width="171">&nbsp;
        </td>
        <td width="91" bgcolor="#E4E4E4">
        <p align="right"><b>Dia&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b></td>
	    <td width="238" bgcolor="#E4E4E4"><div align="left"> 
          <b>
          <font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#333333">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
          Turno</font></b></div></td>
      </tr>
      
      <tr>
        <td width="171">&nbsp;</td>
        <td width="91" bgcolor="#E4E4E4"><div align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Segunda: </font></div></td>
	    <td width="238" bgcolor="#E4E4E4"> &nbsp; <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="checkbox" value="s"  name="segunda:manha" />&nbsp;Manh�<input type="checkbox" value="s"  name="segunda:tarde" />&nbsp;Tarde<input type="checkbox" value="s"  name="segunda:noite" />&nbsp;Noite</font></td>
      </tr>
      <tr>
        <td width="171">&nbsp;</td>
        <td width="91" bgcolor="#E4E4E4"><div align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Ter�a: </font></div></td>
	    <td width="238" bgcolor="#E4E4E4"> &nbsp; <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="checkbox" value="s"  name="terca:manha" />&nbsp;Manh�<input type="checkbox" value="s"  name="terca:tarde" />&nbsp;Tarde<input type="checkbox" value="s"  name="terca:noite" />&nbsp;Noite</font></td>
      </tr>
      <tr>
        <td width="171">&nbsp;</td>
        <td width="91" bgcolor="#E4E4E4"><div align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Quarta: </font></div></td>
	    <td width="238" bgcolor="#E4E4E4"> &nbsp; <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="checkbox" value="s"  name="quarta:manha" />&nbsp;Manh�<input type="checkbox" value="s"  name="quarta:tarde" />&nbsp;Tarde<input type="checkbox" value="s"  name="quarta:noite" />&nbsp;Noite</font></td>
      </tr>
      <tr>
        <td width="171">&nbsp;</td>
        <td width="91" bgcolor="#E4E4E4"><div align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Quinta: </font></div></td>
	    <td width="238" bgcolor="#E4E4E4"> &nbsp; <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="checkbox" value="s"  name="quinta:manha" />&nbsp;Manh�<input type="checkbox" value="s"  name="quinta:tarde" />&nbsp;Tarde<input type="checkbox" value="s"  name="quinta:noite" />&nbsp;Noite</font></td>
      </tr>
      <tr>
        <td width="171">&nbsp;</td>
        <td width="91" bgcolor="#E4E4E4"><div align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Sexta: </font></div></td>
	    <td width="238" bgcolor="#E4E4E4"> &nbsp; <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="checkbox" value="s"  name="sexta:manha" />&nbsp;Manh�<input type="checkbox" value="s"  name="sexta:tarde" />&nbsp;Tarde<input type="checkbox" value="s"  name="sexta:noite" />&nbsp;Noite</font></td>
      </tr>

</table>
<br><br>
<table width="511">
      <tr>
        <td width="165">&nbsp;</td>
        <td width="336" bgcolor="#E4E4E4"><p align="center"><b>&nbsp; <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Possui 
        disponibilidade de trabalho nos finais de semana, caso necessite?</font></b></p>
        </td>
      </tr>
      
            
      <tr>
        <td width="165">&nbsp;</td>
        <td width="336" bgcolor="#E4E4E4">
        <p align="center"> <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"> <input checked type="radio" value="s" name="disFds" />&nbsp;Sim<input  type="radio" value="n" name="disFds" />&nbsp;N�o</font></td>
      </tr>
      <tr>
        <td width="165">&nbsp;</td>
        <td width="336">&nbsp;</td>
      </tr>
      <tr>
        <td width="165">&nbsp;</td>
        <td width="336" bgcolor="#E4E4E4">
        <p align="center"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Voc� gostaria de receber emails sobre eventos da AIESEC?</font></b></td>
      </tr>
      
            
      <tr>
        <td width="165">&nbsp;</td>
        <td width="336" bgcolor="#E4E4E4">
        <p align="center"> <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"> <input checked type="radio" value="s" name="gostRE" />&nbsp;Sim<input  type="radio" value="n" name="gostRE" />&nbsp;N�o</font></td>
      </tr>
      <tr>
        <td width="165">&nbsp;</td>
        <td width="336">&nbsp;</td>
      </tr>
      <tr>
        <td width="165">&nbsp;</td>
        <td width="336" bgcolor="#E4E4E4">
        <p align="center"><b><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Voc� gostaria de compartilhar suas informa��es com parceiros da AIESEC 
          vit�ria (empresas que podem estar procurando algu�m com o seu perfil)?</font></b></td>
      </tr>
      
            
      <tr>
        <td width="165">&nbsp;</td>
        <td width="336" bgcolor="#E4E4E4">
        <p align="center"> <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"> <input checked type="radio" value="s" name="gostComp" />&nbsp;Sim<input  type="radio" value="n" name="gostComp" />&nbsp;N�o</font></td>
      </tr>
      
</table>

&nbsp;<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <b> 
  <font face="Verdana" size="2">Quais hor�rios voc� estar� livre para realizar a etapa da entrevista, caso 
  passe pela <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; etapa din�mica (entrevistas duram de 30 minutos a 1 hora)
  </font></b></p>

<table width="836">
     
       <tr>
        <td width="10">&nbsp;</td>
        <td width="50" bgcolor="#A8A8A8"><div align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
          Hor�rio</font></div></td>
	    <td width="591" bgcolor="#A8A8A8"> <b>Quarta (17/09/2008)  &nbsp; Quinta (18/09/2008) &nbsp; Sexta (19/09/2008) &nbsp Segunda (22/09/2008)</b></td>
      </tr>
       <tr>
        <td width="10">&nbsp;</td>
        <td width="50" bgcolor="#A8A8A8"><div align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 8-9;</font></div></td>
	    <td width="591" bgcolor="#E4E4E4"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="checkbox" value="s"  name="eQuarta8" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="checkbox" value="s"  name="eQuinta8" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="checkbox" value="s"  name="eSexta8" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="checkbox" value="s"  name="eSegunda8" /></font>  </td>
      </tr>
       <tr>
        <td width="10">&nbsp;</td>
        <td width="50" bgcolor="#A8A8A8"><div align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 9-10;</font></div></td>
	    <td width="591" bgcolor="#E4E4E4"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="checkbox" value="s"  name="eQuarta9" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="checkbox" value="s"  name="eQuinta9" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="checkbox" value="s"  name="eSexta9" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="checkbox" value="s"  name="eSegunda9" /></font>  </td>
      </tr>
      <tr>
        <td width="10">&nbsp;</td>
        <td width="50" bgcolor="#A8A8A8"><div align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 10-11;</font></div></td>
	    <td width="591" bgcolor="#E4E4E4"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="checkbox" value="s"  name="eQuarta10" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="checkbox" value="s"  name="eQuinta10" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="checkbox" value="s"  name="eSexta10" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="checkbox" value="s"  name="eSegunda10" /></font>  </td>
      </tr>
      <tr>
        <td width="10">&nbsp;</td>
        <td width="50" bgcolor="#A8A8A8"><div align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 11-12;</font></div></td>
	    <td width="591" bgcolor="#E4E4E4"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="checkbox" value="s"  name="eQuarta11" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="checkbox" value="s"  name="eQuinta11" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="checkbox" value="s"  name="eSexta11" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="checkbox" value="s"  name="eSegunda11" /></font>  </td>
      </tr>
	  <tr>
        <td width="10">&nbsp;</td>
        <td width="50" bgcolor="#A8A8A8"><div align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 12-13;</font></div></td>
	    <td width="591" bgcolor="#E4E4E4"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="checkbox" value="s"  name="eQuarta12" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="checkbox" value="s"  name="eQuinta12" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="checkbox" value="s"  name="eSexta12" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="checkbox" value="s"  name="eSegunda12" /></font>  </td>
      </tr>
	  <tr>
        <td width="10">&nbsp;</td>
        <td width="50" bgcolor="#A8A8A8"><div align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 13-14;</font></div></td>
	    <td width="591" bgcolor="#E4E4E4"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="checkbox" value="s"  name="eQuarta13" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="checkbox" value="s"  name="eQuinta13" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="checkbox" value="s"  name="eSexta13" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="checkbox" value="s"  name="eSegunda13" /></font>  </td>
      </tr>
	  <tr>
        <td width="10">&nbsp;</td>
        <td width="50" bgcolor="#A8A8A8"><div align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 14-15;</font></div></td>
	    <td width="591" bgcolor="#E4E4E4"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="checkbox" value="s"  name="eQuarta14" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="checkbox" value="s"  name="eQuinta14" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="checkbox" value="s"  name="eSexta14" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="checkbox" value="s"  name="eSegunda14" /></font>  </td>
      </tr>
	  <tr>
        <td width="10">&nbsp;</td>
        <td width="50" bgcolor="#A8A8A8"><div align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 15-16;</font></div></td>
	    <td width="591" bgcolor="#E4E4E4"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="checkbox" value="s"  name="eQuarta15" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="checkbox" value="s"  name="eQuinta15" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="checkbox" value="s"  name="eSexta15" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="checkbox" value="s"  name="eSegunda15" /></font>  </td>
      </tr>
	  <tr>
        <td width="10">&nbsp;</td>
        <td width="50" bgcolor="#A8A8A8"><div align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 16-17;</font></div></td>
	    <td width="591" bgcolor="#E4E4E4"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="checkbox" value="s"  name="eQuarta16" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="checkbox" value="s"  name="eQuinta16" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="checkbox" value="s"  name="eSexta16" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input disabled type="checkbox" value="s"  name="eSegunda16" />
	    </font> (n&atilde;o haver&aacute;) </td>
      </tr>
	  <tr>
        <td width="10">&nbsp;</td>
        <td width="50" bgcolor="#A8A8A8"><div align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 17-18;</font></div></td>
	    <td width="591" bgcolor="#E4E4E4"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="checkbox" value="s"  name="eQuarta17" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
	    <input type="checkbox" value="s"  name="eQuinta17" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="checkbox" value="s"  name="eSexta17" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input disabled type="checkbox" value="s"  name="eSegunda17" /></font>  (n&atilde;o haver&aacute;)</td>
      </tr>
      <tr>
        <td width="10">&nbsp;</td>
        <td width="50" bgcolor="#A8A8A8"><div align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 18-19;</font></div></td>
	    <td width="591" bgcolor="#E4E4E4"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="checkbox" value="s"  name="eQuarta18" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
	    <input type="checkbox" value="s"  name="eQuinta18" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="checkbox" value="s"  name="eSexta18" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input disabled type="checkbox" value="s"  name="eSegunda18" /></font>  (n&atilde;o haver&aacute;)</td>
      </tr>
	  <tr>
        <td width="10">&nbsp;</td>
        <td width="50" bgcolor="#A8A8A8"><div align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 19-20;</font></div></td>
	    <td width="591" bgcolor="#E4E4E4"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="checkbox" value="s"  name="eQuarta19" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="checkbox" value="s"  name="eQuinta19" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="checkbox" value="s"  name="eSexta19" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input disabled type="checkbox" value="s"  name="eSegunda19" /></font>  (n&atilde;o haver&aacute;)</td>
      </tr>


      
 </table>
 <br> <br> <br> <br>
 <table>

 <!--ENVIAR DADOS -->

     <tr>      
        <td colspan="2" align="center" width="830"><input type="button" onclick="valida();" class="form" value="Enviar" />  <input type="reset" value="Desfazer mudan�as" /></td>
      </tr>
    </table>
    <br>
  </form>








</body>
</html>
