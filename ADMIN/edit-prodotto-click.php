<?php
require("../include/dbms.inc.php");
require("../include/template2.inc.php");
require("../include/auth.inc.php");
$x = $_POST['nomeprodotto'];
$db->query("SELECT * FROM prodotti WHERE titolo = '{$x}' ");
$row = $db->getResult();
if($row!=false){
  echo json_encode($row[0]);  //per restituire al js la riga restiuita dalla query
}
?>
