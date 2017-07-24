<?php
require("../include/dbms.inc.php");
require("../include/template2.inc.php");
require("../include/auth.inc.php");
$x =$_POST['nomeslider'];
$db->query(" select slider.*,immagini.*
             from slider left join immagini on slider.id_immagine = immagini.id_immagine");
$row = $db->getResult();
if($row!=false){
    echo json_encode($row[0]);  //per restituire al js la riga restiuita dalla query
}
?>
