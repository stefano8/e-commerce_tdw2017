<?php

require("../include/dbms.inc.php");
require("../include/template2.inc.php");
require("../include/auth.inc.php");

$x =$_POST['nomecategoria'];

$db->query("SELECT id_categoria, nome, descrizione FROM categorie WHERE nome = '{$x}' ");

$row = $db->getResult();

if($row!=false){

    echo json_encode($row[0]);  //per restituire al js la riga restiuita dalla query

}

?>
