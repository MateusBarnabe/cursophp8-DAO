<?php

require_once("config.php");

//$root = new usuario();
//$root->loadById(5);
//echo $root;
//$lista = usuario::getList();
//echo json_encode($lista);

//$search = usuario::search("ba");
//echo json_encode($search);

$cadas = new usuario();
$cadas->login("jose", "asdf1234");
echo $cadas;




