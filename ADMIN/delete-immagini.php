<?php

require("../include/dbms.inc.php");
require("../include/template2.inc.php");
require("../include/auth.inc.php");



$main = new Template("index.html");
$categoria = new Template("delete-immagini.html");





if (isset($_POST['sub'])) {
$x =$_POST['selezione'];
        $db->query("DELETE FROM immagini WHERE path = '{$x}'  ");

        $categoria->setContent ("aggiunto","aggiunto");

}

$db->query("SELECT * FROM immagini");

$row = $db->getResult();

foreach($row as $rows) {

    $categoria->setContent($rows);

} //end foreach


$main->setContent("content",$categoria->get());
$main->close();


?>
