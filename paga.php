<?php

session_start();
require("include/dbms.inc.php");
require("include/template2.inc.php");
require ("include/varie.php");



$pagamento = new Template("pagamento.html");
if(isset($_GET['id'])){
$idSpedizione = $_GET['id'];
$pagamento->setContent("id",$idSpedizione);

}

$main->setContent("menu",$menu->get());
$main->setContent("body",$pagamento->get());

$main->close();


 ?>
