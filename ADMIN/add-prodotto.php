<?php

//session_start();

require("../include/dbms.inc.php");
require("../include/template2.inc.php");
require("../include/auth.inc.php");


$nome1 = isset($_POST['selezione1'])?$_POST['selezione1'] : false;
$nome2 = isset($_POST['selezione2'])?$_POST['selezione2'] : false;


    $main = new Template("index.html");
    $categoria = new Template("add-prodotto.html");


    $db->query("SELECT * FROM categorie"); //foreach per selectbox categorie

    $row = $db->getResult();

    foreach($row as $rows) {

        $categoria->setContent($rows);

    } //end foreach

    $db->query("SELECT * FROM immagini"); //foreach per selectbox immagini

    $rowimm = $db->getResult();

    foreach($rowimm as $rowsimm) {

        $categoria->setContent($rowsimm);

    } //end foreach



if (isset($_POST['sub'])) {

$db->query("SELECT titolo FROM prodotti WHERE titolo='{$_POST['titolo']}'");

    $duplicate = $db->getResult();

    $duplicate1 = $db->getNumRows();

    if($duplicate1 == 1){

        $categoria->setContent ("aggiuntoErrore","aggiuntoErrore");
    }

    else {

        $var = $db->query ( "INSERT INTO prodotti (titolo, durata, tipologia, prezzo, quantity, descrizione, id_immaginePrincipale, id_categoria, data)
        VALUES
        (
        '{$_POST['titolo']}',
         {$_POST['durata']},
        '{$_POST['tipologia']}',
         {$_POST['prezzo']},
         {$_POST['quantita_disponibile']},
        '{$_POST['descrizione']}',
        '{$_POST['selezione1']}',
        '{$_POST['selezione2']}',
         {$_POST['data_uscita']}
        )"
        );

        $categoria->setContent ("aggiunto","aggiunto");
    }

    /* INSERT INTO `prodotti`(`id_prodotto`, `titolo`, `durata`, `tipologia`, `prezzo`, `quantità_disponibile`, `descrizione`, `id_immaginePrincipale`, `id_categoria`, `data`, `contvisualizzazioni`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11]) */

}



$main->setContent("content",$categoria->get());
$main->close();


?>
