<?php

require("../include/dbms.inc.php");
require("../include/template2.inc.php");
require("../include/auth.inc.php");

$main = new Template("index.html");
$categoria = new Template("add-servizio.html");



if (isset($_POST['sub'])) {
    
$db->query("SELECT * FROM servizi WHERE script='{$_POST['script']}'");
    
    $duplicate = $db->getResult();
    
    $duplicate1 = $db->getNumRows();
    
    if($duplicate1 == 1){

        $categoria->setContent ("aggiuntoErrore","aggiuntoErrore");
    }
    
    else {
        
        $db->query("INSERT INTO servizi (script, descrizione) 
             VALUES ('{$_POST['script']}', 
                     '{$_POST['descrizione']}' )" );

        $categoria->setContent ("aggiunto","aggiunto");
    }
    

}   


$main->setContent("content",$categoria->get());
$main->close();


?>