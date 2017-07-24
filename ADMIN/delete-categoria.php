<?php

require("../include/dbms.inc.php");
require("../include/template2.inc.php");
require("../include/auth.inc.php");





$main = new Template("index.html");
$categoria = new Template("delete-categoria.html");



if (isset($_POST['sub'])) {


  if(isset($_POST['selezione']) && !empty($_POST['selezione'])){
    $x =$_POST['selezione'];
$db->query("DELETE FROM categorie WHERE nome = '{$x}'  ");

    $categoria->setContent ("aggiunto","aggiunto");

}
}

$db->query("SELECT nome AS nome FROM categorie");

$Result = $db->getResult();

if($Result != null){
foreach($Result as $rows) {

    $categoria->setContent($rows);
  }
}



$main->setContent("content",$categoria->get());
$main->close();

?>
