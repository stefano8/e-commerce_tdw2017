<?php

session_start();
require("include/dbms.inc.php");
require("include/template2.inc.php");
require ("include/varie.php");






if(isset($_GET['modifica'])){

    $nome = $_GET['nome'];
    $cognome = $_GET['cognome'];
    $città  = $_GET['citta'];
    $indirizzo = $_GET['indirizzo'];
    $cap = $_GET['cap'];
    $stato = $_GET['stato'];
    $cell = $_GET['cellulare'];
    $password = $_GET['password'];
    $email = $_GET['email'];

    $db->query("update utenti set nome = '$nome',cognome = '$cognome',citta = '$città', indirizzo = '$indirizzo',cap = $cap,stato = '$stato',
                cellulare = $cell, username = '$username', password = '$password' , email= '$email' where username = '$username' ");

                Header("Location: anagrafica.php");


}else{

  $modificaprofilo = new Template("modificaanagrafica.html");

              $db->query("select * from utenti where username = '$username' ");
              $result = $db->getResult();

              foreach ($result as $user) {
                $nome = $user['nome'];
                $cognome = $user['cognome'];
                $città  = $user['citta'];
                $indirizzo = $user['indirizzo'];
                $cap = $user['cap'];
                $stato = $user['stato'];
                $cell = $user['cellulare'];
                $password = $user['password'];
                $email = $user['email'];

                $modificaprofilo->setContent("username", $username);
                $modificaprofilo->setContent("email", $email);
                $modificaprofilo->setContent("password", $password);
                $modificaprofilo->setContent("nome", $nome);
                $modificaprofilo->setContent("cognome", $cognome);
                $modificaprofilo->setContent("citta", $città);
                $modificaprofilo->setContent("indirizzo", $indirizzo);
                $modificaprofilo->setContent("cap", $cap);
                $modificaprofilo->setContent("stato", $stato);
                $modificaprofilo->setContent("cellulare", $cell);


              }


              $main->setContent("body",$modificaprofilo->get());
              $main->setContent("menu",$menu->get());
              $main->close();

}


?>
