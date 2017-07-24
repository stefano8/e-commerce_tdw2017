<?php
session_start();

require("include/dbms.inc.php");
require("include/template2.inc.php");
require ("include/varie.php");

if(isset($_SESSION['auth'])){


$username = $_SESSION['auth']['username'];
      if(isset($_GET['id_prodotto'])){

        $idProdotto = $_GET['id_prodotto'];

        $db->query("INSERT into wishlist value ($idProdotto,'{$username}')");
        Header("Location: index.php?");

      }else{

      Header("Location: error.php?");

      }
}else{

    Header("Location: login.php?");

}


 ?>
