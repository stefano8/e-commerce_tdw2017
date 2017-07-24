<?php
/**
 * Created by PhpStorm.
 * User: stefanocorsetti
 * Date: 16/06/17
 * Time: 11:20
 */

function usaCarrello()
{
    $carrello = $_SESSION['carrello'];
    if (!$carrello)
    {
        return 'Il carrello è vuoto.<br>';
    }else{
        $prodotti = @explode(',',$carrello);
        return 'Ci sono <a href="carrello.php">'.
            @count($prodotti). ' prodotti nel carrello.</a><br>';
    }
}

function mostraCarrello()
{
    global $db;
    $carrello = $_SESSION['carrello'];
    $somma = 0;
    if ($carrello)
    {
        $prodotti = @explode(',',$carrello);
        $acquisti = array();
        foreach ($prodotti as $prodotto)
        {
            $acquisti[$prodotto] = (@isset($acquisti[$prodotto])) ? $acquisti[$prodotto] + 1 : 1;
        }
        $result[] = '<form action="carrello.php?action=aggiorna" method="post" id="cart">';
        $result[] = '<table>';

        foreach ($acquisti as $id=>$quantita)
        {
            $sql = 'SELECT * FROM prodotti WHERE id = '.$id;
            $res = $db->query($sql);
            $f = $res->fetch();
            @extract($f);
            $result[] = '<tr>';
            $result[] = '<td><a href="carrello.php?action=cancella&id='.$id.'">Cancella</a></td>';
            $result[] = '<td>'.$nome.' by '.$marca.'</td>';
            $result[] = '<td>&euro;'.$prezzo.'</td>';
            $result[] = '<td><input type="text" name="quantita'.$id.'" value="'.$quantita.'" size="3"></td>';
            $result[] = '<td>&euro;'.($prezzo * $quantita).'</td>';
            $somma += $prezzo * $quantita;
            $result[] = '</tr>';
        }

        $result[] = '</table>';
        $result[] = 'Totale: <b>&euro;'.$somma.'</b></br>';
        $result[] = '<button type="submit">Aggiorna il carrello</button>';
        $result[] = '</form>';
    }else{
        $result[] = 'Il carrello è vuoto.<br>';
    }
    return @join('',$result);
}
?>