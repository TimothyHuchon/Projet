
$(document).ready(function(){

    //alert("Coucou");

/* Modifier / ajouter titre */


    $('#editer_ajouter3').text('Mettre à jour ou Nouvel album');

    $('#idtitre').blur(function(){
        var id = $(this).val();
        //alert("idtitre: "+id);
        if(id != ''){
            var parametre ="idtitre=" +id;
            $.ajax({
                type: 'GET',
                data: parametre,
                dataType: 'json',
                url: './lib/php/ajax/ajaxRechercheTitre.php',
                success: function (data) {
                    console.log(data);
                    $('#nomtitre').val(data[0].nomtitre);
                    if($('#nomtitre').val()!=''){
                        $('#editer_ajouter3').text('Mettre à jour');
                        $('#action3').attr('value','editer');
                    } else {
                        $('#editer_ajouter3').text('Insérer'); // bouton -> insérer
                        $('#action3').attr('value','inserer');
                    }
                    $('#datetitre').val(data[0].datetitre);
                    $('#mp3titre').val(data[0].mp3titre);
                    $('#idgenre_choix').val(data[0].idgenre);
                    $('#idalbum_choix').val(data[0].idalbum);
                    $('#idplaylist_choix').val(data[0].idplaylist);
                    $('#idinterprete_choix').val(data[0].idinterprete);
                   /* var recupgenre= $('#idgenre_choix').val(); $('#recupgenre').val(recupgenre);
                    var recupalbum= $('#idalbum_choix').val(); $('#recupalbum').val(recupalbum);
                    var recupplaylist= $('#idplaylist_choix').val(); $('#recupplaylist').val(recupplaylist);
                    var recupinterprete= $('#idinterprete_choix').val(); $('#recupinterprete').val(recupinterprete);*/


                }
            });
            $('#idtitre').click(function () {
                $('#idtitre').val('');
                $('#nomtitre').val('');
                $('#datetitre').val('');
                $('#mp3titre').val('');
                $('#idgenre_choix').val('');
                $('#idalbum_choix').val('');
                $('#idplaylist_choix').val('');
                $('#idinterprete_choix').val('');

            });
        }
    });

    /*$('#idinterprete_choix').blur(function (){
        var recupinterprete= $('#idinterprete_choix').val();
        $('#recupinterprete').val(recupinterprete);
    });*/

   /* $('#recupgenre').blur(function (){
        var recupgenre = $(this).val(); //val = récupération des valeurs dans un formulaire
        alert(recupgenre);
    });

    $('#recupalbum').blur(function (){
        var recupalbum = $(this).val(); //val = récupération des valeurs dans un formulaire
        alert(recupalbum);
    });

    $('#recupplaylist').blur(function (){
        var recupplaylist = $(this).val(); //val = récupération des valeurs dans un formulaire
        alert(recupplaylist);
    });

    $('#recupinterprete').blur(function (){
        var recupinterprete = $(this).val(); //val = récupération des valeurs dans un formulaire
        alert(recupinterprete);
    });*/

/* modifier / ajouter  interprete */

    $('#editer_ajouter2').text('Mettre à jour ou Nouvel album');

    $('#idinterprete').blur(function(){
        var id = $(this).val();
        //alert("idinterprete: "+id);
        if(id != ''){
            var parametre ="idinterprete=" +id;
            $.ajax({
                type: 'GET',
                data: parametre,
                dataType: 'json',
                url: './lib/php/ajax/ajaxRechercheInterprete.php',
                success: function (data) {
                    console.log(data);
                    $('#nominterprete').val(data[0].nominterprete);
                    if($('#nominterprete').val()!=''){
                        $('#editer_ajouter2').text('Mettre à jour');
                        $('#action2').attr('value','editer');
                    } else {
                        $('#editer_ajouter2').text('Insérer'); // bouton -> insérer
                        $('#action2').attr('value','inserer');
                    }
                    $('#prenominterprete').val(data[0].prenominterprete);
                    $('#dateinterprete').val(data[0].dateinterprete);
                }
            });
            $('#idinterprete').click(function () {
                $('#idinterprete').val('');
                $('#nominterprete').val('');
                $('#prenominterprete').val('');
                $('#dateinterprete').val('');
            });
        }
    });




    /* modifier / ajouter album */
    $('#editer_ajouter').text('Mettre à jour ou Nouvel album');

    $('#idalbum').blur(function(){
        var id = $(this).val();
       //alert("idalbum: "+id);
        if(id != ''){
            var parametre ="idalbum=" + id;
            $.ajax({
                type: 'GET',
                data: parametre,
                dataType: 'json',
                url: './lib/php/ajax/ajaxRechercheAlbum.php',
                success: function (data) {
                    console.log(data);
                    $('#nomalbum').val(data[0].nomalbum);
                    if($('#nomalbum').val()!=''){
                        $('#editer_ajouter').text('Mettre à jour');
                        $('#action').attr('value','editer');
                    } else {
                        $('#editer_ajouter').text('Insérer'); // bouton -> insérer
                        $('#action').attr('value','inserer');
                    }
                    $('#datealbum').val(data[0].datealbum);
                    $('#imagealbum').val(data[0].imagealbum);
                }
            });
            $('#idalbum').click(function () {
                $('#idalbum').val('');
                $('#nomalbum').val('');
                $('#datealbum').val('');
                $('#imagealbum').val('');
            });
        }
    });


/* Modifier playlist */



    $('#idplaylist').blur(function(){
        var id = $(this).val();
        alert("idplaylist: "+id);
        if(id != ''){
            var parametre ="idplaylist=" + id;
            $.ajax({
                type: 'GET',
                data: parametre,
                dataType: 'json',
                url: './lib/php/ajax/ajaxRecherchePlaylist.php',
                success: function (data) {
                    console.log(data);
                    $('#nomplaylist').val(data[0].nomplaylist);
                    if($('#nomplaylist').val()==''){
                        $('#editer_playlist').hide(); // bouton -> insérer
                    }
                    $('#descriptionplaylist').val(data[0].descriptionplaylist);
                    $('#imageplaylist').val(data[0].imageplaylist);
                }
            });
            $('#idalbum').click(function () {
                $('#idplaylist').val('');
                $('#nomplaylist').val('');
                $('#descriptionplaylist').val('');
                $('#imageplaylist').val('');
            });
        }
    });






     $('#submit_id').remove();

     $('#id').blur(function(){
         var id = $(this).val();
        // alert("id : "+id);
         var parametre = "idtitre="+id;
         $.ajax({
             type:'GET',
             data: parametre,
             dataType: 'json',
             url:'./admin/lib/php/ajax/ajaxDetailTitre.php',
             success: function (data){
                // console.data(data);
                 $('#idtitre').html("<br><br>"+data[0].nomtitre+"<br><br>"+data[0].nominterprete);
                 $('#mp3titre').html('<source src="./admin/images/fichierMusique/'+data[0].mp3titre+'"type="audio/mp3">');
                 $('#imagealbum').html('<img class="container" src="admin/images/pochette/'+data[0].imagealbum+'" alt="Illustration">');
             }
         });
     });



    $('#choix_titre').change(function ()
    {
        var attribut = $(this).attr('name');
        var id = $(this).val();
        var parametre = "idtitre="+id;
         $.ajax({
             type:'GET',
             data: parametre,
             dataType:'json',
             url: './admin/lib/php/ajax/ajaxDetailTitre.php',
             success: function (data){
                 //console.data(data);
                 $('#idtitre').html("<br><br>"+data[0].nomtitre+"<br><br>"+data[0].nominterprete);
                 $('#mp3titre').html('<source src="./admin/images/fichierMusique/'+data[0].mp3titre+'"type="audio/mp3">');
                 $('#imagealbum').html('<img class="container" src="admin/images/pochette/'+data[0].imagealbum+'" alt="Illustration">');
             }
         });

     });



    });

