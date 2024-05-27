<?php

require_once("config.php");

//$root = new usuario();
//$root->loadById(5);
//echo $root;

//$lista = usuario::getList();
//echo json_encode($lista);

//$search = usuario::search("ba");
//echo json_encode($search);

//$cadas = new usuario();
//$cadas->login("jose", "asdf1234");
//echo $cadas;

/*$adicionar = new usuario("Barnabé", "nucleo");
$adicionar->insert();
echo $adicionar;*/

//$aluno = new usuario;
//$aluno->mostrar();

$upar = new usuario();
$upar->loadById(2);
echo $upar;
$upar->update("bebezinho do tercio", "dinao");
echo $upar;





