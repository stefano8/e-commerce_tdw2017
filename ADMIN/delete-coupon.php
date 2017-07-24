<?php

require("../include/dbms.inc.php");
require("../include/template2.inc.php");
require("../include/auth.inc.php");

$x = $_POST['selezione'];



$main = new Template("index.html");
$categoria = new Template("delete-coupon.html");


$db->query("SELECT id_coupon, codice_coupon FROM coupon");
             
         $row = $db->getResult();
                               
                 foreach($row as $rows) {
                     $varid = $rows['id_coupon'];
                     $varcod = $rows['codice_coupon'];

                     
                    $categoria->setContent("id_coupon",$varid);
                    $categoria->setContent("codice",$varcod);
                     
                 } //end foreach


    if (isset($_POST['sub'])) {

        $db->query("DELETE FROM coupon WHERE id_coupon = '{$x}'  ");

        $categoria->setContent ("aggiunto","aggiunto");



    }

 
$main->setContent("content",$categoria->get());
$main->close();

?>