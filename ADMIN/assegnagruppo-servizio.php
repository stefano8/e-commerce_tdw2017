<?php


require("../include/dbms.inc.php");
require("../include/template2.inc.php");
require("../include/auth.inc.php");

/* CON CHECKBOX importante
$checkboxservizi = isset($_POST['checkboxgruppi'])?$_POST['checkboxgruppi'] : array();
$checkboxgruppi = isset($_POST['checkboxgruppi'])?$_POST['checkboxgruppi'] : array();

foreach($checkboxservizi as $stef){
    echo $stef ;
}
foreach($checkboxgruppi as $stefano){
    echo $stefano ;
}

*/

$servizio = isset($_POST['selezione1']) ? $_POST['selezione1'] : false;
$gruppo = isset($_POST['selezione2']) ? $_POST['selezione2'] : false;

$main = new Template("index.html");
$categoria = new Template("assegnagruppo-servizio.html");



$db->query("SELECT * FROM servizi");

$row = $db->getResult();

foreach($row as $rows) {

    $categoria->setContent($rows);
    // $categoria->setContent("nometag", $variabiledaassegnare);

} //end foreach


$db->query("SELECT * FROM gruppi");

$row = $db->getResult();

foreach($row as $rows) {

    $categoria->setContent($rows);

} //end foreach


if (isset($_POST['sub'])) {
    
$db->query("INSERT INTO gruppiservizi (id_servizio, id_gruppo) VALUES ( 
              '{$servizio}',
              '{$gruppo}' )"
              );

    $categoria->setContent ("aggiunto","aggiunto");

}




$main->setContent("content",$categoria->get());
$main->close();


?>