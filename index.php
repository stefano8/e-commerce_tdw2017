<?php
session_start();


require("include/dbms.inc.php");
require("include/template2.inc.php");
require ("include/varie.php");
//require("include/auth.inc.php");

$body = new Template("index.html");


$db->query(" SELECT slider.id_position, immagini.path 
                    FROM slider left join immagini on slider.id_immagine = immagini.id_immagine ORDER BY id_position"); //div per slider

$rowimm = $db->getResult();

foreach($rowimm as $rowsimm) {
    $varid1 = $rowsimm['path'];
    $varid2 = $rowsimm['id_position'];

    $body->setContent("id_immaginee",$varid1);
    $body->setContent("id_position",$varid2);

} //end foreach



$db->query("SELECT prodotti.*, immagini.path 
                    FROM prodotti left join immagini on prodotti.id_immaginePrincipale = immagini.id_immagine LIMIT 20"); //per div alcuni dei nostri prodotti

$row = $db->getResult();

foreach($row as $rows) {

    $body->setContent($rows);

} //end foreach

$db->query("SELECT prodotti.*, immagini.path
                    FROM prodotti left join immagini on prodotti.id_immaginePrincipale= immagini.id_immagine WHERE prezzo <= 20.00 LIMIT 3"); //div a prezzi bassi

$row1 = $db->getResult();

foreach($row1 as $rows1) {
    $varid = $rows1['id_prodotto'];
    $varnome = $rows1['titolo'];
    $varprezzo = $rows1['prezzo'];
    $varpath = $rows1['path'];

    $body->setContent("id_prodotto1",$varid);
    $body->setContent("offertanome",$varnome);
    $body->setContent("offertaprezzo",$varprezzo);
    $body->setContent("offertapath",$varpath);

} //end foreach

$db->query("SELECT id_news, immagine, titolo, data_news FROM news ORDER BY data_news DESC LIMIT 3"); //div news

$row3 = $db->getResult();

foreach($row3 as $rows3) {

    $varnews = $rows3['id_news'];
    $varpath3 = $rows3['immagine'];
    $vartitolo3 = $rows3['titolo'];
    $vardata3 = $rows3['data_news'];


    $body->setContent("id_news",$varnews);
    $body->setContent("immagine",$varpath3);
    $body->setContent("titoloo",$vartitolo3);
    $body->setContent("dataaaaaaaaa",$vardata3);

} //end foreach

$db->query("SELECT prodotti.id_prodotto, prodotti.prezzo, prodotti.titolo, prodotti.data, prodotti.id_immaginePrincipale,immagini.path FROM prodotti left join immagini on prodotti.id_immaginePrincipale= immagini.id_immagine ORDER BY data DESC LIMIT 3"); //div ultimi usciti

$row2 = $db->getResult();

foreach($row2 as $rows2) {
    $varid2 = $rows2['id_prodotto'];
    $varnome2 = $rows2['titolo'];
    $vardata2 = $rows2['data'];
    $varprezzo2 = $rows2['prezzo'];
    $varpath2 = $rows2['path'];

    $body->setContent("id_prodotto2",$varid2);
    $body->setContent("newsnome",$varnome2);
    $body->setContent("newsdata",$vardata2);
    $body->setContent("newsprezzo",$varprezzo2);
    $body->setContent("newspath",$varpath2);

} //end foreach






$main->setContent("menu",$menu->get());
$main->setContent("body",$body->get());
$main->close();


?>
