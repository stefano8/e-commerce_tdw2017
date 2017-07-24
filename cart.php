<?php
session_start();
require("include/dbms.inc.php");
require("include/template2.inc.php");
require ("include/varie.php");
//require("include/auth.inc.php");

$carrello = new Template("cart.html");

$carrVuoto = new Template("noProduct.html");

$username=  $_SESSION['auth']['username'];


$db->query("select * from carrello WHERE username= '{$username}'");
$productCarr = $db->getResult();
if($productCarr!=null){
    $numeroArticoli=0;
    $totalprice = 0;
    foreach ($productCarr as $prodotto) {
        $numeroArticoli++;
        $id  = $prodotto['id_prodotto'];
        $nums = $prodotto['quantity'];
        
        $carrello->setContent("numero",$nums);   
        $carrello->setContent("idpro",$id);   
        
        $db->query("SELECT prodotti.*, immagini.path FROM prodotti left join immagini on prodotti.id_immaginePrincipale= immagini.id_immagine WHERE id_prodotto={$id}");

        $row = $db->getResult();
        //per ogni prodotto aggiungo elemento alla table del template
        foreach($row as $rows2) {
            
            $varnome2 = $rows2['titolo'];

            $varprezzo2 = $rows2['prezzo'];
            
            $varpath2 = $rows2['path'];
            $prezzoPerprodotti= $varprezzo2 * $nums ;
            $totalprice+= $prezzoPerprodotti;

                    
            $carrello->setContent("nome",$varnome2);
            $carrello->setContent("prezzo",$varprezzo2);
            $carrello->setContent("immagine",$varpath2);
            $carrello->setContent("prezzoQuan",$prezzoPerprodotti);
        }
    }
    $carr->setContent("numeroProdotti", $numeroArticoli);
    $carrello->setContent("prezzototale",$totalprice);
    $main->setContent("body",$carrello->get());
}
else {

    $main->setContent("body",$carrVuoto->get());

}



$main->setContent("menu",$menu->get());

$main->close();


/*

//con sessione
//controllo se nel carrello ci sono prodotti
if(isset($_SESSION['carrello'])){
$totalprice = 0;
//query al db per recuperare ogni prodotto nel carrello
foreach ($_SESSION['carrello'] as $prodotto) {


$id=  $prodotto['id'];

$quantity=  $prodotto['quantity'];

$carrello->setContent("numero",$quantity);

$db->query("SELECT id_prodotto, prezzo, nome, path FROM prodotti WHERE id_prodotto='$id'"); //div ultimi usciti

$row = $db->getResult();
//per ogni prodotto aggiungo elemento alla table del template
foreach($row as $rows2) {

$varnome2 = $rows2['nome'];

$varprezzo2 = $rows2['prezzo'];
$varpath2 = $rows2['path'];
$prezzoPerprodotti= $varprezzo2 ;
$totalprice+= $prezzoPerprodotti;

$carrello->setContent("nome",$varnome2);
$carrello->setContent("prezzo",$varprezzo2);
$carrello->setContent("immagine",$varpath2);

} //end foreach


}//end prodotti nel carrello
$carrello->setContent("prezzototale",$totalprice);
$main->setContent("body",$carrello->get());
}
else {

$main->setContent("body",$carrVuoto->get());

}



$main->setContent("menu",$menu->get());

$main->close();



?>
*/


?>








