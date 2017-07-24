<?php

require ("../include/auth.inc.php");
require("../include/dbms.inc.php");
require("../include/template2.inc.php");


$main = new Template("index.html");
$categoria = new Template("add-user.html");


if (isset($_POST['sub'])) {


$db->query("SELECT username FROM utenti WHERE username='{$_POST['username']}'");

    $duplicate = $db->getResult();

    $duplicate1 = $db->getNumRows();

    if($duplicate1 == 1){

        $categoria->setContent ("aggiuntoErrore","aggiuntoErrore");

    }

    else {

        $var = $db->query("INSERT INTO utenti(nome, cognome, città, indirizzo, cap, stato, cellulare, username, password, email) 
             VALUES ('{$_POST['nome']}', 
                     '{$_POST['cognome']}', 
                     '{$_POST['città']}', 
                     '{$_POST['indirizzo']}', 
                      {$_POST['cap']}, 
                     '{$_POST['stato']}', 
                      {$_POST['cellulare']}, 
                     '{$_POST['username']}', 
                     '{$_POST['password']}',
                     '{$_POST['email']}' )"
        );

        $categoria->setContent ("aggiunto","aggiunto");

        /*INSERT INTO `utenti`(`nome`, `cognome`, `città`, `indirizzo`, `cap`, `stato`, `cellulare`, `username`, `password`, `email`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10])*/
    }

}
$main->setContent("content",$categoria->get());
$main->close();

?>