<?php

session_start();


require("include/dbms.inc.php");
require("include/template2.inc.php");
require ("include/varie.php");


$body = new Template("myordini.html");


$db->query("select * from ordini where username= '$username'");

$result = $db->getResult();

if($result != null){

    foreach ($result as $key) {

            $data_ordine = $key['data_ordine'];
            $id_ordine = $key['id_ordine'];
            $prezzoTotale = $key['prezzoTotale'];
            $body->setContent("data_ordine",$data_ordine);

            $body->setContent("prezzoTotale",$prezzoTotale);

            $db->query("select * from dettagliordini where id_ordine = $id_ordine");
            $risultatoDO = $db->getResult();

            foreach ( $risultatoDO as $key ) {
                $id_prodotto = $key['id_prodotto'];

                $db->query("SELECT prodotti.titolo, immagini.path FROM prodotti  join immagini on prodotti.id_immaginePrincipale= immagini.id_immagine   WHERE id_prodotto= $id_prodotto ");

                    $risultatoProdotto = $db->getResult();
                foreach ( $risultatoProdotto as $key ) {

                    $path = $key['path'];
                    $nome = $key['titolo'];

                      $body->setContent("path",$path);
                      $body->setContent("titolo",$nome);
                    }
      }



}



}


$main->setContent("menu",$menu->get());
$main->setContent("body",$body->get());
$main->close();



?>
