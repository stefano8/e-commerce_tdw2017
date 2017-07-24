<?php
require("../include/dbms.inc.php");

require("../include/auth.inc.php");

require("../include/template2.inc.php");

$main = new Template("index.html");
$marketing = new Template("marketing.html");

$db->query("select distinct marketingforspecificuser.contvisualizzazioni,marketingforspecificuser.id_prodotto , prodotti.titolo,immagini.path from marketingforspecificuser
                          left join prodotti on marketingforspecificuser.id_prodotto = prodotti.id_prodotto
                          left join immagini on prodotti.id_immaginePrincipale = immagini.id_immagine
                          order by marketingforspecificuser.contvisualizzazioni limit 10");


$result = $db->getResult();
$num = $db->getNumRows();

if($num>0){

  foreach ($result as $key ) {

    $id_prodotto  = $key['id_prodotto'];
    $contvisualizzazioni = $key['contvisualizzazioni'];
    $titolo = $key['titolo'];

    $marketing->setContent("id_prodotto",$id_prodotto);
    $marketing->setContent("contvisualizzazioni",$contvisualizzazioni);
    $marketing->setContent("titolo",$titolo);

  }


}




$main->setContent("content",$marketing->get());
$main->close();


?>
