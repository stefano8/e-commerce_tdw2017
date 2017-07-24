<?php

session_start();

require("include/dbms.inc.php");
require("include/template2.inc.php");
require ("include/varie.php");


$body = new Template("single-product.html");
$rec = new Template("insertRecensione.html");

if(isset($_GET['id'])){
    $var = $_GET['id']; //per riportare con get l'id del prodotto (PER DIV ALCUNI PRODOTTI)


    if(isset($_GET['rec'])){

    if(isset($_GET['titolo'])&& isset($_GET['testo'])){
        $titolo = $_GET['titolo'];
        $testo = $_GET['testo'];
         $db->query("insert into recensioni (`titolo`,`testo`,`username`,`id_prodotto`) VALUE ('$titolo','$testo','{$username}', $var) ");
        }

    }


    $db->query("SELECT prodotti.*, immagini.path
                          FROM prodotti  join immagini on prodotti.id_immaginePrincipale= immagini.id_immagine
                              WHERE id_prodotto= $var ");


    $row2 = $db->getResult();
    if($row2!=null){
        foreach($row2 as $rows2) {
            $varpath1 = $rows2['path'];
            $varnome1 = $rows2['titolo'];
            $varprezzo1 = $rows2['prezzo'];
            $vardesc1 = $rows2['descrizione'];
            $quantità_disponibile = $rows2['quantity'];

            if($quantità_disponibile > 0 ){

                $body->setContent("num",$quantità_disponibile);

                $cart = new Template("aggiungiProdottoCarrello.html");
                $cart->setContent("num",$quantità_disponibile);
                $cart->setContent("id_prodotto",$var);
                $body->setContent("disponibile",$cart->get());
            }else{
              $body->setContent("num","prodotto momentaneamente non disponibile");
              $cart = new Template("prenotaProdotto.html");
              $cart->setContent("id_prodotto",$var);
              $body->setContent("disponibile",$cart->get());
            }

            $body->setContent("id_prodotto",$var);//campo hidden per carrello
            $body->setContent("pathc",$varpath1);
            $body->setContent("nomec",$varnome1);
            $body->setContent("prezzoc",$varprezzo1);
            $body->setContent("descrizionec",$vardesc1);

        } //end foreach
    }

    $db->query("SELECT immagini.* FROM immagini left join immaginiprodotto on immagini.id_immagine = immaginiprodotto.id_immagine WHERE immaginiprodotto.id_prodotto =$var");

    $row3 = $db->getResult();

    if($row3!= null){
        foreach($row3 as $rows3) {
            $varpath2 = $rows3['path'];

            $body->setContent("piupath",$varpath2);

        } //end foreach
    }




    $db->query("SELECT * FROM recensioni WHERE id_prodotto= $var");

    $row4 = $db->getResult();

    if($row4!=null){
        foreach($row4 as $rows4) {

            $varusernameR = $rows4['username'];
            $vartitoloR = $rows4['titolo'];
            $vartestoR = $rows4['testo'];
            $vardataR = $rows4['data_inserimento'];


            $body->setContent("usernameR",$varusernameR);
            $body->setContent("titoloR",$vartitoloR);
            $body->setContent("testoR",$vartestoR);
            $body->setContent("dataR",$vardataR);

        } //end foreach
    }

   }




    if(isset($_SESSION['auth'])){
        $rec->setContent("id_prodotto",$var);
        $body->setContent("formrecensione",$rec->get());

    }
// else ritornare errore
$main->setContent("menu",$menu->get());
$main->setContent("body",$body->get());
$main->close();


?>
