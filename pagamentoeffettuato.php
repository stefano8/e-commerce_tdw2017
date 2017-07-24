<?php

session_start();

require("include/dbms.inc.php");
require("include/template2.inc.php");



$indirizzospedizione;
$pagamento = new Template("pagamentoeffettuato.html");
if(isset( $_SESSION['auth'])){
$username = $_SESSION['auth']['username'];
  if(isset($_GET['id'])){
    $id= $_GET['id'];
    if($id>0){
    $indirizzospedizione=$_GET['id'];
  }else{

    $indirizzospedizione = 0;
  }
}
$db->query(" select prodotti.prezzo, carrello.quantity from carrello join prodotti on carrello.id_prodotto = prodotti.id_prodotto where carrello.username='${username}'");
$prez = $db->getResult();
$prezzoTotale = 0;
foreach ($prez as $key ) {
  $prezzo= $key['prezzo'] ;
  $quantityuu = $key['quantity'];
  $prezzoTotale += $prezzo * $quantityuu ;

}



$db->query("insert into ordini(prezzoTotale,username,idIndirizzo) value ($prezzoTotale,'$username',$indirizzospedizione)");
$db->query("select id_ordine from ordini where prezzoTotale=$prezzoTotale and username='$username' order by data_ordine desc  limit 1");

$result = $db->getResult();


$idOrdine;
foreach ($result as $key ) {
$idOrdine =   $key['id_ordine'];
}
  $db->query(" select carrello.* from carrello join prodotti on carrello.id_prodotto = prodotti.id_prodotto where carrello.username='${username}'");

$result = $db->getResult();


foreach ($result as $key ) {
  $id_prodotto= $key['id_prodotto'];
  $quantity = $key['quantity'];
  $db->query("insert into dettagliordini value ($idOrdine,$id_prodotto,$quantity)");
}


$db->query("delete from carrello where username ='{$username}'");
//non spostare il require ("include/varie.php"); altrimenti non azzera il numero prodotti nel carrello
require ("include/varie.php");
$main->setContent("menu",$menu->get());
$main->setContent("body",$pagamento->get());
$main->close();
}
else{

    Header("Location: login.php?");
}
 ?>
