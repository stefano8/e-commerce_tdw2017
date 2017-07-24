<?php
session_start();
require("include/dbms.inc.php");
require("include/template2.inc.php");
require ("include/varie.php");




if(isset($_GET['rem'])){
    
    $idpro = $_GET['rem'];
    $db->query("delete from carrello where id_prodotto = {$idpro}");

}

Header("location: cart.php");

?>