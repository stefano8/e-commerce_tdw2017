<?php

//session_start();

require("../include/dbms.inc.php");
require("../include/template2.inc.php");
require("../include/auth.inc.php");

$x = $_POST['nomeuser'];

$db->query("SELECT nome, cognome, città, indirizzo, cap, stato, cellulare, username, password, email 
            FROM utenti     
            WHERE username = '{$x}' ");

/*SELECT `nome`, `cognome`, `città`, `indirizzo`, `cap`, `stato`, `cellulare`, `username`, `password`, `email` FROM `utenti` WHERE 1*/
    
$row = $db->getResult();

if($row!=false){
    echo json_encode($row[0]);  //per restituire al js la riga restiuita dalla query
}

?>