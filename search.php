<?php

session_start();

require("include/dbms.inc.php");
require("include/template2.inc.php");
require ("include/varie.php");

$menu = new Template("menu.html");
$body = new Template("search.html");


//prendo il nome inserito nella form
$search = $_GET['search'];

//seleziono tutti i campi "nome" di prodotti con
$db->query("SELECT prodotti.*, immagini.path
                    FROM prodotti left join immagini on prodotti.id_immaginePrincipale= immagini.id_immagine
                    WHERE titolo LIKE '%$search%'");

         $row = $db->getResult();
              if($row != null) {
                 foreach($row as $rows) {

                    $body->setContent($rows);

                 } //end foreach


}else{

$body = new Template("searchNOresult.html");

}
$main->setContent("menu",$menu->get());
$main->setContent("body",$body->get());
$main->close();


?>
