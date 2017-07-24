<?php


require ("../include/auth.inc.php");
require("../include/dbms.inc.php");
require("../include/template2.inc.php");


$main = new Template("index.html");
$categoria = new Template("add-categoria.html");


if (isset($_POST['sub'])) {


    $db->query("SELECT nome FROM categorie WHERE nome='{$_POST['nome']}'");

    $duplicate = $db->getResult();

    $duplicate1 = $db->getNumRows();

    if($duplicate1 == 1){

        $categoria->setContent ("aggiuntoErrore","aggiuntoErrore");

    }

    else {

        $var = $db->query("INSERT INTO categorie (nome, descrizione) 
             VALUES ('{$_POST['nome']}', 
                     '{$_POST['descrizione']}' )" 
                         );

        $categoria->setContent ("aggiunto","aggiunto");

    }

}
$main->setContent("content",$categoria->get());
$main->close();

?>

