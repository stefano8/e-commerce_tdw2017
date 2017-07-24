/*
//funzioni js per validare campi vuoti
function validateFormCategoria(){
        var y = document.forms["myForm"]["nome"].value;

    if (y == "") {
        alert("Attenzione, ci sono dei campi vuoti oppure i dati inseriri non rispettano i tipi assegnati!");
        return false;
    }
}

function validateFormGroup(){
        var x = document.forms["myForm"]["id_gruppo"].value;
        var y = document.forms["myForm"]["nome"].value;
        var z = document.forms["myForm"]["descrizione"].value;

    if (x == "" || y == "" || z == "") {
        alert("Attenzione, ci sono dei campi vuoti oppure i dati inseriri non rispettano i tipi assegnati!");
        return false;
    }
}

function validateFormServizio(){
        var x = document.forms["myForm"]["id_servizio"].value;
        var y = document.forms["myForm"]["script"].value;
        var z = document.forms["myForm"]["descrizione"].value;

    if (x == "" || y == "" || z == "") {
        alert("Attenzione, ci sono dei campi vuoti oppure i dati inseriri non rispettano i tipi assegnati!");
        return false;
    }
}

function validateFormUser(){
        var y = document.forms["myForm"]["user"].value;
        var z = document.forms["myForm"]["password"].value;
        var w = document.forms["myForm"]["email"].value;

    if (y == "" || z == "" || w == "") {
        alert("Attenzione, ci sono dei campi vuoti oppure i dati inseriri non rispettano i tipi assegnati!");
        return false;
    }
}

function validateFormNews(){
        var x = document.forms["myForm"]["id_news"].value;
        var y = document.forms["myForm"]["data_news"].value;
        var z = document.forms["myForm"]["titolo"].value;
      //  var w = document.forms["myForm"]["id_prodotto"].value;

    if (x == "" || y == "" || z == "" ) {
        alert("Attenzione, ci sono dei campi vuoti oppure i dati inseriri non rispettano i tipi assegnati!");
        return false;
    }
}

 function validateFormProdotti(){
        var x = document.forms["myForm"]["id_prodotto"].value;
        var y = document.forms["myForm"]["nome"].value;
        var p = document.forms["myForm"]["durata"].value;
        var r = document.forms["myForm"]["tipologia"].value;
        var w = document.forms["myForm"]["prezzo"].value;
        var z = document.forms["myForm"]["quantita_disp"].value;
        var s = document.forms["myForm"]["id_categoria"].value;
        var t = document.forms["myForm"]["data_uscita"].value;


    if (x == "" || y == "" || p == "" || r == "" || w == "" || z == "" || s == "" || t == "" ) {
        alert("Attenzione, ci sono dei campi vuoti oppure i dati inseriri non rispettano i tipi assegnati!");
        return false;
    }
}


*/


//funzioni jquery per la modifica di elementi



function editcategoria(){
        //e.preventDefault(); //blocca il submit

        var nomecategoria = $("#nomecategoria option:selected").text(); //recupera testo dentro l'opzione selezionata
        var nomecategoria = $.trim(nomecategoria); //rimuove spazi prima e dopo
        $.ajax({

            type:"POST",
            url:"edit-categoria-click.php",
            data:{ nomecategoria:nomecategoria },
            success: function(response){
                var result = JSON.parse(response);  //recuperare ciò che restituisce il php e interpretarlo
                //alert(result.id_categoria);  //accedi al campo desiderato
                $('#id').val(result.id_categoria);
                $('#noome').val(result.nome); //sx: id input dx: nome database
                $('#desc').val(result.descrizione);
                $(".mod").css({'visibility':'visible'});
            },
            error: function(response){
                alert(response);
            }

        });
}



function editnews(){
        //e.preventDefault(); //blocca il submit

        var nomenews = $("#nomenews option:selected").text(); //recupera testo dentro l'opzione selezionata
        var nomenews = $.trim(nomenews); //rimuove spazi prima e dopo
        $.ajax({

            type:"POST",
            url:"edit-news-click.php",
            data:{ nomenews:nomenews }, //se sono più dati, separati da virgole (sx=php, dx=js)
            success: function(response){
                var result = JSON.parse(response);  //recuperare ciò che restituisce il php e interpretarlo
                //alert(result.id_categoria);  //accedi al campo desiderato
                $('#id').val(result.id_news);
                $('#daata').val(result.data_news); //sx: id input dx: nome database
                $('#immaagine').val(result.immagine);
                $('#titoolo').val(result.titolo);
                $('#coorpo').val(result.corpo);
                $('#id_prodotto').val(result.id_prodotto);
                $(".mod").css({'visibility':'visible'});
            },
            error: function(response){
              //  alert(response);
            }

        });
}


function editprodotto(){

        var nomeprodotto = $("#nomeprodotto option:selected").text();

        var nomeprodotto = $.trim(nomeprodotto);

        $.ajax({

            type:"POST",
            url:"edit-prodotto-click.php",
            data:{ nomeprodotto:nomeprodotto }, //se sono più dati, separati da virgole (sx=php, dx=js)
            success: function(response){
                var result = JSON.parse(response);
                  //recuperare ciò che restituisce il php e interpretarlo
                  //accedi al campo desiderato
                $('#id').val(result.id_prodotto);
                $('#titoloo').val(result.titolo);
                $('#durataa').val(result.durata);
                $('#tipoo').val(result.tipologia);
                $('#prezzoo').val(result.prezzo);
                $('#imm').val(result.id_immaginePrincipale);
                $('#quant').val(result.quantity);
                $('#desc').val(result.descrizione);
                $('#dataa').val(result.data);
                $(".mod").css({'visibility':'visible'});
            },
            error: function(response){


                alert(response);
            }

        });
}

function editgruppo(){
        //e.preventDefault(); //blocca il submit

        var nomegruppo = $("#nomegruppo option:selected").text(); //recupera testo dentro l'opzione selezionata
        var nomegruppo = $.trim(nomegruppo); //rimuove spazi prima e dopo
        $.ajax({

            type:"POST",
            url:"edit-group-click.php",
            data:{ nomegruppo:nomegruppo }, //se sono più dati, separati da virgole (sx=php, dx=js)
            success: function(response){
                var result = JSON.parse(response);  //recuperare ciò che restituisce il php e interpretarlo
                //alert(result.id_categoria);  //accedi al campo desiderato
                $('#id').val(result.id_gruppo);
                $('#noome').val(result.nome); //sx: id input dx: nome database
                $('#desc').val(result.descrizione);
                $(".mod").css({'visibility':'visible'});
            },
            error: function(response){
                alert(response);
            }

        });
}

function editservizio(){

        var nomeservizio = $("#nomeservizio option:selected").text();
        var nomeservizio = $.trim(nomeservizio);
        $.ajax({
            type:"POST",
            url:"edit-servizio-click.php",
            data:{ nomeservizio:nomeservizio },
            success: function(response){
                var result = JSON.parse(response);
                $('#id').val(result.id_servizio);
                $('#scriipt').val(result.script);
                $('#desc').val(result.descrizione);
                $(".mod").css({'visibility':'visible'});
            },
            error: function(response){
                alert(response);
            }
        });
}



function editimmagini(){

        var nomeimmagini = $("#nomeimmagini option:selected").text();
        var nomeimmagini = $.trim(nomeimmagini);
        $.ajax({
            type:"POST",
            url:"edit-immagini-click.php",
            data:{ nomeimmagini:nomeimmagini }, //se sono più dati, separati da virgole (sx=php, dx=js)
            success: function(response){
                var result = JSON.parse(response);  //recuperare ciò che restituisce il php e interpretarlo
                //alert(result.id_categoria);  //accedi al campo desiderato
                $('#id').val(result.id_immagine);
                $('#pathh').val(result.path); //sx: id input dx: nome database
                $('#altt').val(result.alt);
                $(".mod").css({'visibility':'visible'});
            },
            error: function(response){
                alert(response);
            }

        });
}

function editslider(){

        var nomeslider = $("#nomeslider option:selected").text();
        var nomeslider = $.trim(nomeslider);
        $.ajax({
            type:"POST",
            url:"edit-slider-click.php",
            data:{ nomeslider:nomeslider }, //se sono più dati, separati da virgole (sx=php, dx=js)
            success: function(response){
                var result = JSON.parse(response);  //recuperare ciò che restituisce il php e interpretarlo
                //alert(result.id_categoria);  //accedi al campo desiderato
                $('#id').val(result.id_immagine);
                $('#positionid').val(result.id_position); //sx: id input dx: nome database
                $(".mod").css({'visibility':'visible'});
            },
            error: function(response){
                alert(response);
            }

        });
}

function editcoupon(){

        var nomecoupon = $("#nomecoupon option:selected").text();
        var nomecoupon = $.trim(nomecoupon);
        $.ajax({
            type:"POST",
            url:"edit-coupon-click.php",
            data:{ nomecoupon:nomecoupon }, //se sono più dati, separati da virgole (sx=php, dx=js)
            success: function(response){
                var result = JSON.parse(response);  //recuperare ciò che restituisce il php e interpretarlo
                //alert(result.id_categoria);  //accedi al campo desiderato
                $('#id').val(result.id_coupon);
                $('#codicee').val(result.codice_coupon); //sx: id input dx: nome database
                $('#val').val(result.validità); //sx: id input dx: nome database
                $('#scontoo').val(result.sconto); //sx: id input dx: nome database
                $(".mod").css({'visibility':'visible'});
            },
            error: function(response){
                alert(response);
            }

        });
}

function edituser(){
        var nomeuser = $("#nomeuser option:selected").text(); //recupera testo dentro l'opzione selezionata
        var nomeuser = $.trim(nomeuser); //rimuove spazi prima e dopo
        $.ajax({
            type:"POST",
            url:"edit-user-click.php",
            data:{ nomeuser:nomeuser }, //se sono più dati, separati da virgole (sx=php, dx=js)
            success: function(response){
                var result = JSON.parse(response);
                $('#id').val(result.username);
                $('#noome').val(result.nome);
                $('#cognoome').val(result.cognome);
                $('#cittàà').val(result.città);
                $('#indirizzoo').val(result.indirizzo);
                $('#capp').val(result.cap);
                $('#statoo').val(result.stato);
                $('#cellularee').val(result.cellulare);
                $('#useeer').val(result.username);
                $('#pass').val(result.password);
                $('#eemail').val(result.email);
                $(".mod").css({'visibility':'visible'});
            },
            error: function(response){
                alert(response);
            }

        });
}






function myFunction(aaa) {
      aaa.parentNode.style.visibility = "hidden";;
  }


/*
function editgruppouser(){
     var nomegruppouser = $("#nomegruppouser option:selected").text(); //recupera testo dentro l'opzione selezionata
        var nomegruppouser = $.trim(nomegruppouser); //rimuove spazi prima e dopo
        $.ajax({
            type:"POST",
            url:"edit-gruppo-user-click.php",
            data:{ nomegruppouser:nomegruppouser }, //se sono più dati, separati da virgole (sx=php, dx=js)
            success: function(response){
               // alert("qui");
                var result = JSON.parse(response);  //recuperare ciò che restituisce il php e interpretarlo
                //alert(result.id_categoria);  //accedi al campo desiderato
                $('#id_utente').val(result.id_utente);
                $('#id_gruppo').val(result.id_gruppo); //sx: id input dx: nome database
                $(".mod").css({'visibility':'visible'});
            },
            error: function(response){
                alert(response);
            }

        });
}
*/
