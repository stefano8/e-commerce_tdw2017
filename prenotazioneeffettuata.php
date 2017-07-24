<?php

session_start();

require("include/dbms.inc.php");
require("include/template2.inc.php");
require("include/varie.php");


$prenotazione = new Template("prenotazioneeffettuata.html");

if(isset( $_SESSION['auth'])){

  if(isset($_POST['idProdotto']) && isset( $_POST['quantity'])){
$idProdotto = $_POST['idProdotto'];
$num = $_POST['quantity'];
$db->query("SELECT prodotti.* FROM prodotti where id_prodotto = $idProdotto ");

$result = $db->getResult();
foreach ($result as $key ) {

  $prezzo = $key['prezzo'];

}


$username = $_SESSION['auth']['username'];
$db->query("insert into prenotazioni value ($idProdotto,'$username',$prezzo,$num)");


$main->setContent("menu",$menu->get());
$main->setContent("body",$prenotazione->get());
$main->close();
}else{

    Header("Location: error.php");

}

}else{
  Header("Location: login.php");
}
?>
