<?php

require("include/dbms.inc.php");
require("include/template2.inc.php");


$main = new Template("error.html");

$err = "Impossibile accedere alla pagina : ";

if( $_GET['error'] == "login" ){
    echo "1";
   $err .= "Per favore esegui il login per accedere alla pagina!";
   $err .= "<br>Premere <a href=\"login.php\">qui</a> per eseguire il login.";

}


if($_GET['error'] == "permission"){

   $err .= "Non hai i permessi necessari per accedere a questa pagina!";
   $err .= "<br>Premere <a href=\"index.php\">qui</a> per tornare alla home.";
echo $err;
}

$main->setContent("errore", $err);
$main->close();


?>
