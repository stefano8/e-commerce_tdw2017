<?php

session_start();

//require ("include/auth.inc.php");
require("include/dbms.inc.php");
require("include/template2.inc.php");
require ("include/varie.php");


$body = new Template("single-news.html");

$var = $_GET['id_news'];


$db->query("SELECT * FROM news WHERE id_news='$var'");

$row1 = $db->getResult();
foreach($row1 as $row) {

    $body->setContent("id_news", $row['id_news']);
    $body->setContent("data_news", $row['data_news']);
    $body->setContent("immagine", $row['immagine']);
    $body->setContent("titolo", $row['titolo']);
    $body->setContent("corpo", $row['corpo']);

}



$main->setContent("menu",$menu->get());
$main->setContent("body",$body->get());
$main->close();


?>