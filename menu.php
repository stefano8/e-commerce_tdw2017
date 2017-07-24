<?php
/**
 * Created by PhpStorm.
 * User: stefanocorsetti
 * Date: 16/06/17
 * Time: 12:41
 */

//session_start();

require("include/dbms.inc.php");
require("include/template2.inc.php");
//require("include/auth.inc.php");


$main = new Template("frame-public.html");
$menu = new Template("menu.html");


$db->query("SELECT prodotti.*, immagini.path FROM prodotti left join immagini on prodotti.id_immaginePrincipale= immagini.id_immagine");

$row = $db->getResult();

foreach($row as $rows) {

    $body->setContent($rows);

} //end foreach

$main->setContent("menu",$menu->get());
$main->setContent("body",$body->get());
$main->close();

?>