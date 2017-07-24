<?php
require("../include/dbms.inc.php");
require("../include/template2.inc.php");
require("../include/auth.inc.php");
if (isset($_POST['submit'])) {
$selezione = $_POST['selezione'];
$dat = $_POST['data'];
$imm = $_POST['immagine'];
$titolo = $_POST['titolo'];
$corpo = $_POST['corpo'];
$db->query("UPDATE news
                    SET  data_news='{$dat}', immagine='{$imm}', titolo='{$titolo}', corpo='{$corpo}'
                        WHERE data_news='{$selezione}' ");
//UPDATE `news` SET `id_news`=[value-1],`data_news`=[value-2],`immagine`=[value-3],`titolo`=[value-4],`corpo`=[value-5] WHERE 1
}
$main = new Template("index.html");
$categoria = new Template("edit-news.html");
$db->query("SELECT * FROM news");

         $row = $db->getResult();

                 foreach($row as $rows) {
                    $categoria->setContent($rows);

                 }
$main->setContent("content",$categoria->get());
$main->close();
?>
