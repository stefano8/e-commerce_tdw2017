<?php

require("../include/dbms.inc.php");
require("../include/template2.inc.php");
require("../include/auth.inc.php");



//echo $x ;

if (isset($_POST['submit'])) {

    $x = $_POST['selezione'];
    $z = $_POST['nome'];
    $r = $_POST['descrizione'];

    $db->query("UPDATE categorie SET nome='{$z}', descrizione= '{$r}' WHERE nome = '{$x}' ");

}

$main = new Template("index.html");
$categoria = new Template("edit-categoria.html");

$db->query("SELECT nome AS nome FROM categorie");

         $row = $db->getResult();

                 foreach($row as $rows) {

                    $categoria->setContent($rows);

                 }



$main->setContent("content",$categoria->get());
$main->close();


?>
