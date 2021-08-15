


<?php
$prod = new TitreBD($cnx);
$liste = $prod->getAllTitre();
$nbr = count($liste);

?>

<form action="<?php print $_SERVER['PHP_SELF']; ?>" method="get">
    <label for="id">Identifiant : </label>
    <input type="text" id="id" name="id">&nbsp;
    <input type="submit" name="submit_id" value="Chercher" id="submit_id">
    &nbsp;&nbsp;

</form>


<div class="card-group" >
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title"></h5>
            <div id="idtitre"></div>
            <div id="mp3titre"></div>
        </div>
    </div>
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title"></h5>
            <div id="imagealbum"></div>
        </div>
    </div>
</div>


