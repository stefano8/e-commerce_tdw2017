<?php

session_start();

require("include/dbms.inc.php");
require("include/template2.inc.php");
require ("include/varie.php");


$body = new Template("shopSerie.html");

//paginazione
$x_pag = 8;

$pag = isset($_GET['pag']) ? $_GET['pag'] : 1;

if (!$pag || !is_numeric($pag)) $pag = 1;


$varquery = $db->query("SELECT id_prodotto FROM prodotti WHERE tipologia='serie' ");
$all_rows =  $db->getNumRows($varquery);


$all_pages = ceil($all_rows / $x_pag);

$first = ($pag - 1) * $x_pag;


$rs = $db->query("SELECT prodotti.*, immagini.path 
                           FROM prodotti left join immagini on prodotti.id_immaginePrincipale= immagini.id_immagine 
                               WHERE tipologia = 'serie' LIMIT $first, $x_pag");

$nr = $db->getNumRows($rs);


$row1 = $db->getResult();

foreach($row1 as $rows) {

    $body->setContent($rows);

} //end foreach




$main->setContent("menu",$menu->get());
$main->setContent("body",$body->get());
$main->close();


?>