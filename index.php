<?php

require_once("config.php");

$sql = new SQL();

$usuarios = $sql->select("SELECT * FROM tb_usuarios");

foreach ($usuarios as $row) {
    foreach($row as $index => $value){
        echo "<b>$index</b>: $value<br>";
    }
    echo "========================<br>";
}




