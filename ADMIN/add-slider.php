<?php


require("../include/dbms.inc.php");
require("../include/template2.inc.php");
require("../include/auth.inc.php");


    $main = new Template("index.html");
    $categoria = new Template("add-slider.html");


    $db->query("SELECT * FROM immagini"); //foreach per selectbox immagini

    $rowimm = $db->getResult();

    foreach($rowimm as $rowsimm) {

        $categoria->setContent($rowsimm);

    } //end foreach



if (isset($_POST['sub'])) {
$nome1 = $_POST['selezione1'];
$posizione = $_POST['posizione'];

$db->query("select * from slider where id_immagine = $nome1");

$result = $db->getResult();

if($result != null){
$categoria->setContent ("aggiuntoErrore","aggiuntoErrore");
    }
    else{
      $var = $db->query ( "INSERT INTO slider(id_immagine, id_position)
                               VALUES ('$nome1', $posizione)"
                          );

              $categoria->setContent ("aggiunto","aggiunto");
    }

    }





$main->setContent("content",$categoria->get());
$main->close();


?>
