<?php
session_start();
require("include/dbms.inc.php");
require("include/template2.inc.php");
require ("include/varie.php");




$idProduct = $_GET['id_prodotto'];
$quantity = $_GET['quantity'];
$username=  $_SESSION['auth']['username'];


function actionBase(){

    global $db,$username,$idProduct,$quantity;

    $db->query("SELECT * FROM carrello WHERE username = '{$username}' AND id_prodotto = {$idProduct} " ) ;
    $results= $db->getResult();
    return $results;
}



function actionUpdate($result){

    global $db,$username,$idProduct,$quantity;

    foreach ($result as $key) {
        $oldQuantity= $key['quantity'];
        $quantity+= $oldQuantity;

    }

    $db->query("UPDATE carrello  set quantity = $quantity WHERE username='{$username}'and id_prodotto = $idProduct " ) ;
    $db->query("UPDATE prodotti  set quantity = quantity - $quantity WHERE  id_prodotto = $idProduct " ) ;
}


function actionInsert($result){

    global $db,$username,$idProduct,$quantity;


    $db->query("INSERT INTO carrello VALUES ({$idProduct}, {$quantity}, '{$username}')" ) ;
    $db->query("UPDATE prodotti  set quantity = quantity - $quantity WHERE  id_prodotto = $idProduct " ) ;
}



$result= actionBase();

if($result!= null){

    actionUpdate($result);
}
else {
    actionInsert($result);
}


//oppure in sessione
/*
$_SESSION['carrello'][$idProduct ]= array('id' => $idProduct,
                                          'quantity' =>$quantity);
*/




Header("Location: index.php");


?>
