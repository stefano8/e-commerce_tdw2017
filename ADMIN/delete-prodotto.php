<?php

require("../include/dbms.inc.php");
require("../include/template2.inc.php");
require("../include/auth.inc.php");




$main = new Template("index.html");
$categoria = new Template("delete-prodotto.html");





if (isset($_POST['sub'])) {
$x = $_POST['selezione'];
$db->query("DELETE FROM prodotti WHERE titolo = '{$x}'  ");

    $categoria->setContent ("aggiunto","aggiunto");

}


$db->query("SELECT * FROM prodotti");

$row = $db->getResult();
if($row != null){
foreach($row as $rows) {

    $categoria->setContent($rows);

} //end foreach
}

$main->setContent("content",$categoria->get());
$main->close();


?>
