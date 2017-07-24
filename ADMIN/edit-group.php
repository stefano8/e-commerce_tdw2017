<?php
require("../include/dbms.inc.php");
require("../include/template2.inc.php");
require("../include/auth.inc.php");
if (isset($_POST['submit'])) {

$x =$_POST['selezione'];
$id =$_POST['id_gruppo'];
$nome =$_POST['nome'];
$desc =$_POST['descrizione'];


$db->query("UPDATE gruppi
            SET id_gruppo = '{$id}', nome='{$nome}', descrizione = '{$desc}' WHERE nome = '{$x}' ");

   // UPDATE `prodotti` SET `id_prodotto`=[value-1],`nome`=[value-2],`durata`=[value-3],`distribuzione`=[value-4],`formato`=[value-5],`tipologia`=[value-6],`regista`=[value-7],`prezzo`=[value-8],`quantita_disponibile`=[value-9],`data_uscita`=[value-10],`descrizione`=[value-11],`id_categoria`=[value-12] WHERE 1

}
$main = new Template("index.html");
$categoria = new Template("edit-group.html");
$db->query("SELECT * FROM gruppi");

         $row = $db->getResult();

                 foreach($row as $rows) {
                    $categoria->setContent($rows);

                 } //end foreach

$main->setContent("content",$categoria->get());
$main->close();
?>
