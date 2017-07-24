<?php

require("../include/dbms.inc.php");
require("../include/template2.inc.php");
require("../include/auth.inc.php");




$main = new Template("index.html");
$addnews = new Template("add-news.html");


if (isset($_POST['sub'])) {

$db->query("SELECT titolo FROM news WHERE titolo='{$_POST['titolo']}'");

    $duplicate = $db->getResult();

    $duplicate1 = $db->getNumRows();

    if($duplicate1 == 1){

        $addnews->setContent ("aggiuntoErrore","aggiuntoErrore");
    }

    else {

      $data = $_POST['data_news'];
      $time = strtotime($data);
      $new_date = date('Y-m-d', $time);
       $var =  $db->query("INSERT INTO news (data_news , immagine, titolo, corpo)
             VALUES (

                      '{$new_date}',
                     '{$_POST['immagine']}',
                     '{$_POST['titolo']}',
                     '{$_POST['corpo']}'
                     )"

                         );

        $addnews->setContent ("aggiunto","aggiunto");
    }


}

$db->query("SELECT * FROM immagini");
$result = $db->getResult();

if($result != null){


foreach ($result as $key) {

  $path  = $key['path'];
  $imm  = $key['alt'];
  $addnews->setContent ("imm","$imm");
    $addnews->setContent ("path","$path");
}


}


$main->setContent("content",$addnews->get());
$main->close();

?>
