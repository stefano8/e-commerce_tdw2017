<?php
session_start();
require("include/dbms.inc.php");
require("include/template2.inc.php");
require ("include/varie.php");



$profile = new Template("myprofile.html");
$main->setContent("menu",$menu->get());
$main->setContent("body",$profile->get());
$main->close();

 ?>
