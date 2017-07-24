<?php

require("../include/dbms.inc.php");
require("../include/template2.inc.php");
require("../include/auth.inc.php");

$x = $_POST['selezione'];


$main = new Template("index.html");
$categoria = new Template("delete-user.html");


$db->query("SELECT * FROM utenti");

$row = $db->getResult();

foreach($row as $rows) {

    $categoria->setContent($rows);

} //end foreach



if (isset($_POST['sub'])) {
    
$var = $db->query("DELETE FROM utenti WHERE username = '{$x}'  ");

    $categoria->setContent ("aggiunto","aggiunto");


}



$main->setContent("content",$categoria->get());
$main->close();


?>