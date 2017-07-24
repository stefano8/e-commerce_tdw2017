<?php

$main = new Template("frame-public.html");
$barra = new Template("barra-login.html");
$loginButton = new Template("LoginButton.html");
$carr = new Template("carrello.html");
$dashButton = new Template("dashButton.html");
$menu = new Template("menu.html");


$db->query("SELECT * FROM categorie"); //per menu film

$roww = $db->getResult();

foreach($roww as $rowsw) {
    $var1 = $rowsw['nome'];
    $var2 = $rowsw['id_categoria'];



    $menu->setContent("id_categoria", $var2);
    $menu->setContent("id_categoria1", $var2);
    $menu->setContent("nome",$var1);
    $menu->setContent("nomeserie",$var1);
} //end foreach



if(!isset($_SESSION['auth'])){

    $main->setContent("loginButton", $loginButton->get());
}

else{


    $username=  $_SESSION['auth']['username'];


    $db->query("select * from carrello WHERE username= '{$username}'");
    $result = $db->getResult();
    if($result!=null){
        $numeroProdotti=0;
        foreach ($result as $tupl) {
            $numeroProdotti++;
        }
        $carr->setContent("numeroProdotti", $numeroProdotti);
    }

    if($_SESSION['auth']['nome']=="admin"){
       
        $barra->setContent("dashButton", $dashButton->get());


    }
    $main->setContent("barra", $barra->get());


    $main->setContent("carrello", $carr->get());
}

?>
