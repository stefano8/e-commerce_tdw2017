<?php

require("../include/dbms.inc.php");
require("../include/template2.inc.php");
require("../include/auth.inc.php");


if ($db->isConnected()) {
   
        $x = $_POST['selezione'];   
        $x2 = $_POST['nome'];
        $x3 = $_POST['cognome'];
        $x4 = $_POST['città'];
        $x5 = $_POST['indirizzo'];
        $x6 = $_POST['cap'];
        $x7 = $_POST['stato'];
        $x8 = $_POST['cellulare'];
        $x9 = $_POST['username'];
        $y = $_POST['password'];
        $y2 = $_POST['email'];

   
$db->query("UPDATE utenti 
            SET nome = '{$x2}', 
                cognome = '{$x3}', 
                città = '{$x4}', 
                indirizzo = '{$x5}', 
                cap = {$x6}, 
                stato = '{$x7}', 
                cellulare = {$x8}, 
                username = '{$x9}', 
                password = '{$y}', 
                email = '{$y2}' 
            WHERE username = '{$x}' "
          );
    
    /*UPDATE `utenti` SET `nome`=[value-1],`cognome`=[value-2],`città`=[value-3],`indirizzo`=[value-4],`cap`=[value-5],`stato`=[value-6],`cellulare`=[value-7],`username`=[value-8],`password`=[value-9],`email`=[value-10] WHERE 1*/
    
}

$main = new Template("index.html");
$categoria = new Template("edit-user.html");


$db->query("SELECT * FROM utenti");
             
         $row = $db->getResult();
                               
                 foreach($row as $rows) {
                    $varuser = $rows['username'];

                    $categoria->setContent("username",$varuser);
                
                 } //end foreach

 
$main->setContent("content",$categoria->get());
$main->close();

?>