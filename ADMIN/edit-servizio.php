<?php
require("../include/dbms.inc.php");
require("../include/template2.inc.php");
require("../include/auth.inc.php");
if (isset($_POST['submit'])) {

$x = $_POST['selezione'];
$id = $_POST['id_servizio'];
$scr = $_POST['script'];
$desc = $_POST['descrizione'];


$db->query("UPDATE servizi
            SET id_servizio = {$id}, script='{$scr}', descrizione = '{$desc}' WHERE script = '{$x}' ");

}
$main = new Template("index.html");
$categoria = new Template("edit-servizio.html");
$db->query("SELECT  script AS script FROM servizi");

         $row = $db->getResult();

                 foreach($row as $rows) {
                     //$varid = $rows['id_servizio'];
                     $varscript = $rows['script'];
                   // $categoria->setContent("id_servizio", $varid);
                    $categoria->setContent("script", $varscript);

                 } //end foreach

$main->setContent("content",$categoria->get());
$main->close();
?>
