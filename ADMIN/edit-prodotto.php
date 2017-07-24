<?php
require("../include/dbms.inc.php");
require("../include/template2.inc.php");
require("../include/auth.inc.php");
if (isset($_POST['submit'])) {
$id = $_POST['id_prodotto'];
$titolo =$_POST['titolo'];
$durata =$_POST['durata'];
$tipo =$_POST['tipologia'];
$prez =$_POST['prezzo'];
$quant =$_POST['quantity'];
$desc =$_POST['descrizione'];
$s1 =$_POST['imm'];
$dat =$_POST['data'];
$time = strtotime($dat);
$new_date = date('Y-m-d', $time);
$db->query("UPDATE prodotti
            SET
             titolo='{$titolo}',
             durata = {$durata},
             tipologia='{$tipo}',
             prezzo = {$prez},
             quantità_disponibile = {$quant},
             descrizione = '{$desc}',
             id_immaginePrincipale ='{$s1}',
             data = '{$new_date}'
            WHERE id_prodotto = '{$id}'
            ");
/*
UPDATE `prodotti`
    SET `id_prodotto`=[value-1],`titolo`=[value-2],`durata`=[value-3],
        `tipologia`=[value-4],`prezzo`=[value-5],`quantity`=[value-6],`descrizione`=[value-7],`id_immaginePrincipale`=[value-8],
        `id_categoria`=[value-9],`data`=[value-10],`contvisualizzazioni`=[value-11]
            WHERE 1
*/
}
$main = new Template("index.html");
$categoria = new Template("edit-prodotto.html");
$db->query("SELECT * FROM prodotti");
         $row = $db->getResult();
                 foreach($row as $rows) {
                    $categoria->setContent($rows);
                 }
$main->setContent("content",$categoria->get());
$main->close();
?>
