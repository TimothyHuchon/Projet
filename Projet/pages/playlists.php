
<?php
$prod = new TitreBD($cnx);
$liste = $prod->getAllTitre();
$nbr = count($liste);

?>

<div class=" container ">


<div class="menuRecherche">
    <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="get">
        <label for="id">Identifiant : </label>
        <input type="text" id="id" name="id">&nbsp;
        <input type="submit" name="submit_id" value="Chercher" id="submit_id">

        &nbsp;&nbsp;

        <select name="choix_titre" id="choix_titre">
            <option value="">Choisissez</option>
            <?php
            for($i=0;$i<$nbr;$i++){
                ?>
            <option value="<?php print $liste[$i]->idtitre;?>">
                <?php print $liste[$i]->nomtitre;?>
            </option>
            <?php
            }
            ?>


        </select>

    </form>





    <div class="card-group align-items-center " >
        <div class="card" style="width: 18rem;">
            <div class="card-body ">
                <h5 class="card-title "></h5>
                <div id="idtitre"></div>
                <audio class="container" style="padding-top: 10px;" controls id="mp3titre"></audio>

            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"></h5>
                <div id="imagealbum"></div>
            </div>
        </div>
    </div>
</div>



</div>

<?php
$prod = new TitreBD($cnx);
if (isset($_GET['idplaylist'])) {
    $liste = $prod->getTitrebyidPlay($_GET['idplaylist']);

} else {

    $liste = $prod->getAllTitre();

}
$nbr = count($liste);
//var_dump($liste);
?>

<div class="playlistPage">
    <h6 class="titreplaylist">Playlist:  </h6>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-1 row-cols-md-3 g-3">
                <?php
                $ok = 0;
                for ($i = 0; $i < $nbr; $i++) {
                    ?>
                    <div class="col">
                        <div class="card shadow-sm">
                            <img loading="lazy" src="./admin/images/pochette/<?php print $liste[$i]->imagealbum; ?>"
                                 alt="image"/>
                            <div class="card-body">
                                <p class="card-text">
                                    <?php print $liste[$i]->nomtitre;
                                    print " - ";
                                    print $liste[$i]->nominterprete; ?>
                                </p>

                                <audio controls class="container">
                                    <source src="./admin/images/fichierMusique/<?php print $liste[$i]->mp3titre; ?>"
                                            type="audio/mp3">
                                </audio>


                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group" id="remove_a">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>



<!-- Espace commentaire -->

<form class="container">
    <div class="mb-3 ">
        <label for="pseudo" class="form-label">Votre pseudo</label>
        <input type="text" class="form-control" id="pseudo" placeholder="Pseudo">
    </div>
    <div class="mb-3">
        <label for="Commentaire" class="form-label">Commentaire</label>
        <input type="text" class="form-control" id="Commentaire">
    </div>
    <button type="submit" class="btn btn-primary">Publier</button>
</form>

