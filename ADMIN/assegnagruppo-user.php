<?php

require("../include/dbms.inc.php");
require("../include/template2.inc.php");
require("../include/auth.inc.php");


$main = new Template("index.html");
$categoria = new Template("assegnagruppo-user.html");



if(isset($_POST['sub']))
{

  $user = $_POST['selezione1'];
  $gruppo = $_POST['selezione2'] ;
  $db->query("update utentigruppi set id_gruppo = {$gruppo}  where username ='{$user}'");

}





$db->query("SELECT username FROM utenti");

$rows = $db->getResult();

foreach($rows as $row)
{

    $categoria->setContent($row);

} //end foreach

$db->query("SELECT * FROM gruppi");

$rows = $db->getResult();

foreach($rows as $row) {
    $varnome = $row['nome'];
    $idgruppo = $row['id_gruppo'];
    $categoria->setContent("nome",$varnome);
    $categoria->setContent("idgruppo",$idgruppo);
} //end foreach


$main->setContent("content",$categoria->get());
$main->close();


?>
