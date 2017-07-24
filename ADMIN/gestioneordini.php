<?php

require("../include/dbms.inc.php");
require("../include/template2.inc.php");
require("../include/auth.inc.php");


$main = new Template("index.html");
$ordini = new Template("gestioneordini.html");



$db->query("select * from ordini");

$result = $db->getResult();
if($result!= null){

  foreach ($result as $key) {

      $username = $key['username'];
      $data = $key['data_ordine'];
      $prezzo = $key['prezzoTotale'];
      $idOrdine = $key['id_ordine'];



      $ordini->setContent("id",$idOrdine);
      $ordini->setContent("prezzototale",$prezzo);
      $ordini->setContent("data",$data);
      $ordini->setContent("username",$username);

  }



}


$main->setContent("content",$ordini->get());
$main->close();


 ?>
