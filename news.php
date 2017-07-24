<?php

session_start();

require("include/dbms.inc.php");
require("include/template2.inc.php");
require ("include/varie.php");


$body = new Template("news.html");



$db->query("SELECT id_news, data_news, immagine, titolo, corpo FROM news ORDER BY data_news DESC LIMIT 5 ");
        
        $row1 = $db->getResult();
                               
                 foreach($row1 as $rows1) {
                     $varid = $rows1['id_news'];
                     $vardata = $rows1['data_news'];
                     $varnome = $rows1['immagine'];
                     $varprezzo = $rows1['titolo'];
                     $varpath = $rows1['corpo'];


                     $body->setContent("id_news",$varid);
                     $body->setContent("data_news",$vardata);
                     $body->setContent("immagine",$varnome);
                     $body->setContent("titolo",$varprezzo);
                     $body->setContent("corpo",$varpath);
                
                 } //end foreach



$main->setContent("menu",$menu->get());
$main->setContent("body",$body->get());
$main->close();


?>