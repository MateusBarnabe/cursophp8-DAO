<?php

require_once("config.php");

$root = new usuario();

$root->loadById(5);

echo $root;
//echo $root;




