<?php
require("../include/dbms.inc.php");
require("../include/template2.inc.php");
require("../include/auth.inc.php");
$x = $_POST['nomeservizio'];
$db->query("SELECT id_servizio, script, descrizione
            FROM servizi WHERE script = '{$x}' ");
$row = $db->getResult();
if($row!=false){
    echo json_encode($row[0]);  //per restituire al js la riga restiuita dalla query
}
?>
