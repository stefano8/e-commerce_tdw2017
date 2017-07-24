<?php

require("../include/dbms.inc.php");
require("../include/template2.inc.php");
require("../include/auth.inc.php");


$main = new Template("index.html");
$ordini = new Template("dettagliordineBO.html");


if(isset($_GET['id'])){


    $id = $_GET['id'] ;



    /*
    ##################################
    #                                #
    #      DETTAGLI ORDINE           #
    #                                #
    ##################################
    */

    $db->query(" select prodotti.titolo, prodotti.prezzo,dettagliordini.quantity from ordini
                    left join dettagliordini on ordini.id_ordine = dettagliordini.id_ordine
                    left join prodotti on dettagliordini.id_prodotto = prodotti.id_prodotto
                    where ordini.id_ordine = $id     ");

$result = $db->getResult();

if($result!= null){


    foreach ($result as $key) {


      $titolo = $key['titolo'];
      $quantità = $key['quantity'];
      $prezzo = $key['prezzo'];

      $totaleprodotto = $quantità * $prezzo ;
      $ordini->setContent("titolo",$titolo);
      $ordini->setContent("quantità",$quantità);
      $ordini->setContent("prezzo",$prezzo);
      $ordini->setContent("totaleprodotto",$totaleprodotto);

    }



}




/*
##################################
#                                #
#           UTENTE               #
#           ORDINE               #
#        E INDIRIZZO             #
##################################
*/
                $db->query("select * from utenti left join ordini on utenti.username = ordini.username where ordini.id_ordine = $id");

                  $result = $db->getResult();

                  if($result!= null){

                    foreach ($result as $key ) {
                        $prezzoTOTOrdine = $key['prezzoTotale'];
                        $nome = $key['nome'];
                        $cognome = $key['cognome'];
                        $cellulare = $key['cellulare'];
                        $email = $key['email'];
                        $idIndirizzo = $key['idIndirizzo'];


                        $ordini->setContent("nome",$nome);
                        $ordini->setContent("cognome",$cognome);
                        $ordini->setContent("cellulare",$cellulare);
                        $ordini->setContent("email",$email);
                        $ordini->setContent("prezzoTOTOrdine",$prezzoTOTOrdine);

                        if($idIndirizzo > 0 ){//indirizzo scelto diverso da quello in anagrafica

                          $db->query("select * from indirizzi where id = $idIndirizzo");
                          $result = $db->getResult();

                          if($result != null){

                              foreach ($result as $key) {

                              $indirizzo = $key['indirizzo'];
                              $citta     = $key['citta'];
                              $cap       = $key['cap'];
                              $stato     = $key['stato'];


                                $ordini->setContent("indirizzo",$indirizzo);
                                $ordini->setContent("citta",$citta);
                                $ordini->setContent("cap",$cap);
                                $ordini->setContent("stato",$stato);
                            }
                          }

                        }else{

                          // indirizzo di anagrafica

                          $indirizzo = $key['indirizzo'];
                          $citta     = $key['citta'];
                          $cap       = $key['cap'];
                          $stato     = $key['stato'];

                          $ordini->setContent("indirizzo",$indirizzo);
                          $ordini->setContent("citta",$citta);
                          $ordini->setContent("cap",$cap);
                          $ordini->setContent("stato",$stato);

                        }

                    }



                  }



}
else{

    Header("Location: gestioneordini.php");

}


$main->setContent("content",$ordini->get());
$main->close();







 ?>
