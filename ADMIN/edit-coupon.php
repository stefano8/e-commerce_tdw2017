<?php

require("../include/dbms.inc.php");
require("../include/template2.inc.php");
require("../include/auth.inc.php");


if ($db->isConnected()) {
   
$x =$_POST['selezione'];   
$id =$_POST['id_coupon'];
$u =$_POST['codice'];
$p =$_POST['validità'];
$e =$_POST['sconto'];
    
   
$db->query("UPDATE coupon 
            SET id_coupon = '{$id}', codice_coupon='{$u}', validità = '{$p}', sconto = '{$e}' 
            WHERE id_coupon = '{$x}' ");
    
}

$main = new Template("index.html");
$categoria = new Template("edit-coupon.html");


$db->query("SELECT * FROM coupon");
             
        $row = $db->getResult();
                               
                 foreach($row as $rows) {
                     $varid = $rows['id_coupon'];
                     $varcod = $rows['codice_coupon'];

                     
                    $categoria->setContent("id_coupon",$varid);
                    $categoria->setContent("codice",$varcod);
                     
                 } //end foreach

 
$main->setContent("content",$categoria->get());
$main->close();

?>