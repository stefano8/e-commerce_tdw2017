<?php
session_start();
require("include/dbms.inc.php");
require("include/template2.inc.php");
require ("include/varie.php");



$listaindirizzi = new Template("listaindirizzi.html");

if(isset($_SESSION['auth'])){


  $username = $_SESSION['auth']['username'];
  $db->query("select * from indirizzi where username = '{$username}' ");

$result= $db->getResult();

if($db->getNumRows()==0){
  Header("Location: modificaindirizzo.php?");

}
if($result != null){

foreach ($result as $key ) {

        $id = $key['id'];
        $indirizzo = $key['indirizzo'];
        $citta = $key['citta'];
        $cap = $key['cap'];
        $stato = $key['stato'];

        $listaindirizzi->setContent("id", $id);
        $listaindirizzi->setContent("città", $citta);
        $listaindirizzi->setContent("indirizzo", $indirizzo);
        $listaindirizzi->setContent("cap", $cap);
        $listaindirizzi->setContent("stato", $stato);
}


}

  $main->setContent("body",$listaindirizzi->get());
  $main->setContent("menu",$menu->get());
  $main->close();


}else{

    Header("Location: login.php?");
}
 ?>
