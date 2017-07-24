<?php

session_start();

require("include/dbms.inc.php");
require("include/template2.inc.php");
require("include/varie.php");


$body = new Template("shopFilm.html");


// Creo una variabile dove imposto il numero di record da mostrare in ogni pagina
$x_pag = 8;

// Recupero il numero di pagina corrente.
$pag = isset($_GET['pag']) ? $_GET['pag'] : 1;

// Controllo se $pag è valorizzato e se è numerico ...in caso contrario gli assegno valore 1
if (!$pag || !is_numeric($pag)) $pag = 1;


// Uso mysql_num_rows per contare il totale delle righe presenti all'interno della tabella prodotti
$varquery = $db->query("SELECT id_prodotto FROM prodotti WHERE tipologia='film' ");
$all_rows =  $db->getNumRows($varquery);


// Tramite una semplice operazione matematica definisco il numero totale di pagine
$all_pages = ceil($all_rows / $x_pag);

// Calcolo da quale record iniziare
$first = ($pag - 1) * $x_pag;


// Recupero i record per la pagina corrente...utilizzando LIMIT per partire da $first e contare fino a $x_pag
$rs = $db->query("SELECT prodotti.*, immagini.path 
                           FROM prodotti left join immagini on prodotti.id_immaginePrincipale= immagini.id_immagine 
                               WHERE tipologia = 'film' LIMIT $first, $x_pag");
$nr = $db->getNumRows($rs);


$row1 = $db->getResult();

foreach($row1 as $rows) {

    $body->setContent($rows);

} //end foreach


/*
if ($all_pages > 1){ //funziona
    if ($pag > 1){
        echo "<a href=\"" . $_SERVER['PHP_SELF'] . "?pag=" . ($pag - 1) . "\">";
        echo "Pagina Indietro</a>&nbsp;";
    }
    // faccio un ciclo di tutte le pagine
    for ($p=1; $p<=$all_pages; $p++) {
        echo "<a href=\"" . $_SERVER['PHP_SELF'] . "?pag=" . $p . "\">";
        echo $p . "</a>&nbsp;";
    }
    if ($all_pages > $pag){
        echo "<a href=\"" . $_SERVER['PHP_SELF'] . "?pag=" . ($pag + 1) . "\">";
        echo "Pagina Avanti</a>";
    }
}

*/



$main->setContent("menu",$menu->get());
$main->setContent("body",$body->get());
$main->close();


?>