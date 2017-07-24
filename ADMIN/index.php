<?php

require("../include/dbms.inc.php");
require("../include/template2.inc.php");
//require("../include/auth.inc.php");


$main = new Template("index.html");
$categoria = new Template("home.html");


$main->setContent("content",$categoria->get());
$main->close();


?>