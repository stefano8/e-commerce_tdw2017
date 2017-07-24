<?php

session_start();

require("../include/dbms.inc.php");
require("../include/template2.inc.php");
require("../include/auth.inc.php");

$x = $_POST['nomegruppouser'];

if($db->isConnected()){

$db->query("SELECT id_utente, id_gruppo FROM utentigruppi WHERE id_utente = '{$x}' ");

//SELECT `id_utente`, `id_gruppo` FROM `utentigruppi` WHERE 1
}
$row = $db->getResult();

if($row!=false){
    echo json_encode($row[0]);  //per restituire al js la riga restiuita dalla query
}

?>
