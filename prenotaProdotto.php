<?php

session_start();

require("include/dbms.inc.php");
require("include/template2.inc.php");
require("include/varie.php");


$prenotazione = new Template("prenotazione.html");
$idProdotto = $_GET['id_prodotto'];

$db->query("SELECT prodotti.*, immagini.path FROM prodotti left join immagini on prodotti.id_immaginePrincipale= immagini.id_immagine WHERE id_prodotto={$idProdotto}");

$result = $db->getResult();
//per ogni prodotto aggiungo elemento alla table del template
foreach($result as $row) {

    $nome = $row['titolo'];

    $prezzo = $row['prezzo'];

    $path = $row['path'];

}

    $prenotazione->setContent("id_prodotto",$idProdotto);
    $prenotazione->setContent("nome",$nome);
    $prenotazione->setContent("prezzo",$prezzo);
    $prenotazione->setContent("immagine",$path);




$main->setContent("menu",$menu->get());
$main->setContent("body",$prenotazione->get());
$main->close();




 ?>
