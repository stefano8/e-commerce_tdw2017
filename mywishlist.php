<?php
session_start();

require("include/dbms.inc.php");
require("include/template2.inc.php");
require ("include/varie.php");




$body = new Template("mywishlist.html");

$db->query("SELECT prodotti.*,immagini.path from prodotti
                  left join wishlist on  prodotti.id_prodotto  = wishlist.id_prodotto
                  left join immagini on prodotti.id_immaginePrincipale = immagini.id_immagine
                  where wishlist.username = '{$username}'");



         $result = $db->getResult();
if($result != null){

  $body = new Template("mywishlist.html");
                 foreach($result as $row) {

                    $path= $row['path'];
                    $titolo = $row['titolo'];
                    $idProdotto = $row['id_prodotto'];
                    $quantiMAX = $row['quantity'];
                    $body->setContent("titolo",$titolo);
                    $body->setContent("path",$path);
                    $body->setContent("num",$quantiMAX);
                    $body->setContent("id_prodotto",$idProdotto);

                 } //end foreach


}else {

$body = new Template("nomywishlist.html");

echo "asdasd";
}



$main->setContent("menu",$menu->get());
$main->setContent("body",$body->get());
$main->close();


 ?>
