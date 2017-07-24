<?php

require("../include/dbms.inc.php");
require("../include/template2.inc.php");
require("../include/auth.inc.php");


$main = new Template("index.html");
$categoria = new Template("edit-gruppo-user.html");


$db->query("SELECT * FROM utenti");

$row = $db->getResult();

foreach($row as $rows) {

    $categoria->setContent($rows);

}

$db->query("SELECT * FROM gruppi");

$row = $db->getResult();

foreach($row as $rows) {

    $categoria->setContent($rows);

}

if ($db->isConnected()) {
    
$x =$_POST['selezione1'];
//$idu =$_POST['id_utente'];
//$idg =$_POST['id_gruppo'];
$y =$_POST['selezione2'];

    
$db->query("UPDATE utentigruppi SET id_utente='{$x}', id_gruppo = '{$y}' WHERE id_utente = '{$x}' ");
   
//UPDATE `utentigruppi` SET `id_utente`=[value-1],`id_gruppo`=[value-2] WHERE 1
}




$main->setContent("content",$categoria->get());
$main->close();


?>