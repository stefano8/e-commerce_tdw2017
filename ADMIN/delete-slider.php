<?php

require("../include/dbms.inc.php");
require("../include/template2.inc.php");
require("../include/auth.inc.php");



$main = new Template("index.html");
$categoria = new Template("delete-slider.html");


if (isset($_POST['sub'])) {
    $x = $_POST['selezione'];
$db->query("DELETE FROM slider WHERE id_immagine = {$x}  ");

    $categoria->setContent ("aggiunto","aggiunto");

}

$db->query(" select slider.*,immagini.* from slider left join immagini on slider.id_immagine = immagini.id_immagine"); //foreach per selectbox immagini

    $rowimm = $db->getResult();

    foreach($rowimm as $rowsimm) {

        $categoria->setContent($rowsimm);

    } //end foreach


$main->setContent("content",$categoria->get());
$main->close();

?>
