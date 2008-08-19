<?php
	require_once("Validator.php");
	$validator = new Validator($_REQUEST);
	//checa se o campo nome esta preenchido
	$validator->filledIn("nome");
	//checa se o campo nome tem comprimento  < 51 caracteres
	$validator->length("nome", "<", 51);
	//checa se a data de nascimento foi preenchida
	$validator->filledIn("dataNascimento");
	//checa se a data de nascimento eh uma data valida
	$validator->date("dataNascimento", "dd/mm/yyyy");
	
	$validator->email("email");
$validator->compare("pass1", "pass2");
$validator->lengthBetween("color", 3, 15);
$validator->punctuation($sentence);
$validator->value("age", ">", 18);
$validator->valueBetween("number", 11, 16, true);
$validator->alpha("car");
$validator->alphaNumeric("monitor");


	
}
	

?>