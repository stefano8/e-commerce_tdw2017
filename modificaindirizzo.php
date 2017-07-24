<?php

    session_start();

    require("include/dbms.inc.php");
    require("include/template2.inc.php");
    require ("include/varie.php");



   if(isset($_SESSION['auth'])){

$username = $_SESSION['auth']['username'];

        if(isset($_GET['nuovoindirizzo'])){

            if(isset($_GET['indirizzo']) && $_GET['città'] && $_GET['stato'] && $_GET['cap'] ){
            $indirizzo = $_GET['indirizzo'];
            $citta = $_GET['città'];
            $stato = $_GET['stato'];
            $cap = $_GET['cap'];



            $db->query ("INSERT into indirizzi (username , indirizzo ,citta , cap , stato) VALUE ( '{$username}' , '{$indirizzo}' , '{$citta}' , $cap , '{$stato}' )");


              $db->query ("select id from indirizzi where username = '{$username}' and indirizzo = '{$indirizzo}' and stato = '{$stato}' ");
              $result = $db->getResult();
              if($result!= null){
               foreach($result as $idQ) {
              $id = $idQ['id'];


             Header("Location: checkout.php?id=$id");
                }
              }
            }else {
              //errore inserimento


          }

        }
        else{

          $formindirizzo = new Template("modificaindirizzo.html");
          $main->setContent("menu",$menu->get());
          $main->setContent("body",$formindirizzo->get());
          $main->close();

        }
      }else{
//non in sessione

      }





?>
