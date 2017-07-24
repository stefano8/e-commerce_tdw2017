<?php

require("../include/dbms.inc.php");
require("../include/template2.inc.php");
require("../include/auth.inc.php");

$main = new Template("index.html");
$categoria = new Template("add-coupon.html");

    
if (isset($_POST['sub'])) {
    
$db->query("SELECT codice_coupon FROM coupon WHERE codice_coupon='{$_POST['codice']}'");
    
    $duplicate = $db->getResult();
    
    $duplicate1 = $db->getNumRows();
    
    if($duplicate1 == 1){

        $categoria->setContent ("aggiuntoErrore","aggiuntoErrore");
    }
    
    else {
        
        $var = $db->query("INSERT INTO coupon (codice_coupon, validità, sconto) 
                                  VALUES ({$_POST['codice']},
                                          '{$_POST['validità']}',
                                          {$_POST['sconto']} )" 
                         );

        $categoria->setContent ("aggiunto","aggiunto");
    }
    

}   


$main->setContent("content",$categoria->get());
$main->close();


?>




