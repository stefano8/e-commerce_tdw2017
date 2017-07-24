<?php
Class Login {

    function Login() {
        session_start();
        global $db, $data;
        if (isset($_SESSION['auth']));
        else {
            if(isset($_POST['Username'] ) && ($_POST['Username'] != "")   && isset($_POST['Password'])&& ($_POST['Password'] != "")){
                $db->query("SELECT * FROM utenti 
                            WHERE username = '{$_POST['Username']}' AND password = '{$_POST['Password']}' ");
                if (!$db->isError()) {
                    if ($db->getNumRows() == 1) {
                        $data =  $db->getResult();
                        $_SESSION['auth'] = $data[0];
                        $db->query("SELECT utenti.username,
                                               gruppi.nome,
                                               servizi.script
                                          FROM utenti
                                     LEFT JOIN utentigruppi
                                            ON utenti.username = utentigruppi.username
                                     LEFT JOIN gruppi
                                            ON utentigruppi.id_gruppo = gruppi.id_gruppo
                                     LEFT JOIN gruppiservizi
                                            ON gruppi.id_gruppo = gruppiservizi.id_gruppo
                                     LEFT JOIN servizi
                                            ON gruppiservizi.id_servizio = servizi.id_servizio
                                         WHERE utenti.username = '{$_POST['Username']}'");
                        $services = $db->getResult();

                        $_SESSION['auth']['nome']= $services[0]['nome'];

                        foreach ($services as $service) {

                            $_SESSION['auth']['servizi'][$service['script']] = true;
                        }
                    }else  {Header("Location: login.html");exit;
                        //credenziali non corrette
                    }
                }else {Header("Location: error.php?error=system");exit;}
            }else {Header("Location: login.html");exit;}
        }

        if (!isset($_SESSION['auth']['servizi'][basename($_SERVER['SCRIPT_NAME'])])) {
            Header("Location: error.php?error=permission");
            exit;
        }
    }//end construct
}//end class



new Login();

?>
