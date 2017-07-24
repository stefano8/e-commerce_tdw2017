<?php
require("../include/dbms.inc.php");
require("../include/template2.inc.php");
require("../include/auth.inc.php");
$x = $_POST['nomeimmagini'];
$db->query("SELECT *
            FROM immagini WHERE alt = '{$x}' ");
$row = $db->getResult();
if($row!=false){
    echo json_encode($row[0]);
}
?>
