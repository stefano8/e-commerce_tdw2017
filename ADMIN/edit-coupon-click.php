<?php

//session_start();

require("../include/dbms.inc.php");
require("../include/template2.inc.php");
//require("../include/auth.inc.php");

$x = $_POST['nomecoupon'];

$db->query("SELECT *  
            FROM coupon WHERE id_coupon = '{$x}' ");

$row = $db->getResult();

if($row!=false){
    echo json_encode($row[0]);  
}

?>