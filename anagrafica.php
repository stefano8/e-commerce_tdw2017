<?php
session_start();
require("include/dbms.inc.php");
require("include/template2.inc.php");
require ("include/varie.php");
$profilo = new Template("anagrafica.html");
if(isset($_SESSION['auth'])){
    $username = $_SESSION['auth']['username'];
    $db->query("select * from utenti where username = '$username' ");

    $result = $db->getResult();

    if($result != null){

         foreach($result as $user) {

             $nome = $user['nome'];
             $cognome = $user['cognome'];
             $città  = $user['citta'];
             $indirizzo = $user['indirizzo'];
             $cap = $user['cap'];
             $stato = $user['stato'];
             $cell = $user['cellulare'];



             $profilo->setContent("nome", $nome);
             $profilo->setContent("cognome", $cognome);
             $profilo->setContent("città", $città);
             $profilo->setContent("indirizzo", $indirizzo);
             $profilo->setContent("cap", $cap);
             $profilo->setContent("stato", $stato);
             $profilo->setContent("telefono", $cell);

         }


    }
}
$main->setContent("body",$profilo->get());
$main->setContent("menu",$menu->get());
$main->close();
?>
