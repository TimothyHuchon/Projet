<?php include('lib/php/verifier_connexion.php'); ?>

<!-- ajouter / modifier Album -->
<?php
$album = new AlbumBD($cnx);
if (isset($_GET['editer_ajouter'])) {
    extract($_GET, EXTR_OVERWRITE);
    if ($_GET['action'] == "editer") {
        ?>
        <pre><?php var_dump($_GET); ?></pre><?php
        if (!empty($idalbum) && !empty($nomalbum) && !empty($datealbum) && !empty($imagealbum)) {
            $album->updateAlbum($idalbum, $nomalbum, $datealbum, $imagealbum);
        }
    } else if ($_GET['action'] == "inserer") {
        ?>
        <pre><?php var_dump($_GET); ?></pre><?php
        if (!empty($idalbum) && !empty($nomalbum) && !empty($datealbum) && !empty($imagealbum)) {
            $retour = $album->ajout_album($idalbum, $nomalbum, $datealbum, $imagealbum);
            print "retour: " . $retour;
        }
    }
}



/* Modifier une playlist */
$playlist = new PlaylistBD($cnx);
if (isset($_GET['editer_playlist'])) {
    extract($_GET, EXTR_OVERWRITE);
    ?>
    <pre><?php var_dump($_GET); ?></pre><?php
    if (!empty($idplaylist) && !empty($nomplaylist) && !empty($descriptionplaylist) && !empty($imageplaylist)) {
        $playlist->updatePlaylist($idplaylist, $nomplaylist, $descriptionplaylist, $imageplaylist);
    }

}


/* Modifier / ajouter un interprete */

$interprete = new InterpreteBD($cnx);
if (isset($_GET['editer_ajouter2'])) {
    extract($_GET, EXTR_OVERWRITE);
    if ($_GET['action2'] == "editer") {
        ?>
        <pre><?php var_dump($_GET); ?></pre><?php
        if (!empty($idinterprete) && !empty($nominterprete) && !empty($dateinterprete)) {
            $interprete->updateInterprete($idinterprete, $nominterprete, $prenominterprete, $dateinterprete);
        }
    } else if ($_GET['action2'] == "inserer") {
        ?>
        <pre><?php var_dump($_GET); ?></pre><?php
        if (!empty($idinterprete) && !empty($nominterprete) && !empty($dateinterprete)) {
            $retour = $interprete->ajout_interprete($idinterprete, $nominterprete, $prenominterprete, $dateinterprete);
            print "retour: " . $retour;
        }
    }
}
$genre = new GenreBD($cnx);
$playlist = new AlbumBD($cnx);
$interprete = new InterpreteBD($cnx);
$album = new AlbumBD($cnx);
$titre = new TitreBD($cnx);
if (isset($_GET['editer_ajouter3'])) {
    extract($_GET, EXTR_OVERWRITE);
    if ($_GET['action3'] == "editer") {
        ?>
        <pre><?php var_dump($_GET); ?></pre><?php
        if (!empty($idtitre) && !empty($nomtitre) && !empty($datetitre) && !empty($mp3titre)  && !empty($idgenre)  && !empty($idalbum)  && !empty($idplaylist)  && !empty($idinterprete)) {
            $titre->updateTitre($idtitre, $nomtitre, $datetitre, $mp3titre, $idgenre, $idalbum, $idplaylist, $idinterprete);
        }
    } else if ($_GET['action3'] == "inserer") {
        ?>
        <pre><?php var_dump($_GET); ?></pre><?php
        if (!empty($idtitre) && !empty($nomtitre) && !empty($datetitre) && !empty($mp3titre)  && !empty($idgenre)  && !empty($idalbum)  && !empty($idplaylist)  && !empty($idinterprete)) {
            $retour = $titre->ajout_titre($idtitre, $nomtitre, $datetitre, $mp3titre, $idgenre, $idalbum, $idplaylist, $idinterprete);
            print "retour: " . $retour;
        }
    }

}

?>

<div class="modAjAlbum container-fluid ">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-6 col-md-8">
            <h2>Modifier/Ajouter un album: </h2>
            <form class="row g-3">
                <div class="col-md-2">
                    <label for="idalbum" class="form-label">Numéro</label>
                    <input type="number" class="form-control" id="idalbum" name="idalbum">
                </div>
                <div class="col-md-6">
                    <label for="nomalbum" class="form-label">Nom album</label>
                    <input type="text" class="form-control" id="nomalbum" name="nomalbum">
                </div>
                <div class="col-md-2">
                    <label for="datealbum" class="form-label">Date de l'album</label>
                    <input type="text" class="form-control" id="datealbum" name="datealbum">
                </div>
                <div class="col-md-5" style="margin-top: 15px;">
                    <label for="imagealbum" class="form-label">Nom du fichier de la pochette de l'album</label>
                    <input type="text" class="form-control" id="imagealbum" name="imagealbum">
                </div>

                <div class="col-12">
                    <input type="hidden" name="action" id="action">
                    <button type="submit" class="btn btn-primary" id="editer_ajouter" name="editer_ajouter"
                            style="margin-top: 15px;">Nouveau ou mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modifier Playlist -->

<div class="modPlaylist container-fluid ">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-6 col-md-8">
            <h2>Modifier une playlist:</h2>
            <form class="row g-3">
                <div class="col-md-2">
                    <label for="idplaylist" class="form-label">Numéro</label>
                    <input type="number" class="form-control" id="idplaylist" name="idplaylist">
                </div>
                <div class="col-md-6">
                    <label for="nomplaylist" class="form-label">Nom playlist</label>
                    <input type="text" class="form-control" id="nomplaylist" name="nomplaylist">
                </div>
                <div class="col-md-12">
                    <label for="descriptionplaylist" class="form-label">Description</label>
                    <input type="text" class="form-control" id="descriptionplaylist" name="descriptionplaylist">
                </div>
                <div class="col-md-5" style="margin-top: 15px;">
                    <label for="imageplaylist" class="form-label">Illustration</label>
                    <input type="text" class="form-control" id="imageplaylist" name="imageplaylist">
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary" id="editer_playlist" name="editer_playlist"
                            style="margin-top: 15px;">Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modifier / ajouter un interprete-->

<div class="modPlaylist container-fluid ">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-6 col-md-8">
            <h2>Modifier/Ajouter un interprète:</h2>
            <form class="row g-3">
                <div class="col-md-2">
                    <label for="idinterprete" class="form-label">Numéro</label>
                    <input type="number" class="form-control" id="idinterprete" name="idinterprete">
                </div>
                <div class="col-md-6">
                    <label for="nominterprete" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nominterprete" name="nominterprete">
                </div>
                <div class="col-md-12">
                    <label for="prenominterprete" class="form-label">Prenom</label>
                    <input type="text" class="form-control" id="prenominterprete" name="prenominterprete">
                </div>
                <div class="col-md-5" style="margin-top: 15px;">
                    <label for="dateinterprete" class="form-label">Date</label>
                    <input type="text" class="form-control" id="dateinterprete" name="dateinterprete">
                </div>


                <input type="hidden" name="action2" id="action2">
                <button type="submit" class="btn btn-primary" id="editer_ajouter2" name="editer_ajouter2"
                        style="margin-top: 15px;">Nouveau ou mettre à jour
                </button>
            </form>
        </div>
    </div>
</div>


<!-- modifier / ajouter titre -->

<?php
$gen = new GenreBD($cnx);
$genre = $gen->getAllGenre();
$nbr = count($genre);

$al = new AlbumBD($cnx);
$album = $al->getAllAlbum();
$nbral = count($album);

$pl = new PlaylistBD($cnx);
$playlist = $pl->getPlaylist();
$nbrpl = count($playlist);

$in = new InterpreteBD($cnx);
$interprete = $in->getAllInterprete();
$nbrin = count($interprete);

?>


<div class="modAjAlbum container-fluid ">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-6 col-md-8">
            <h2>Modifier/Ajouter un titre: </h2>
            <form class="row g-3">
                <div class="col-md-2">
                    <label for="idtitre" class="form-label">Numéro</label>
                    <input type="number" class="form-control" id="idtitre" name="idtitre">
                </div>
                <div class="col-md-6">
                    <label for="nomtitre" class="form-label">Nom titre</label>
                    <input type="text" class="form-control" id="nomtitre" name="nomtitre">
                </div>
                <div class="col-md-2">
                    <label for="datetitre" class="form-label">Date du titre</label>
                    <input type="text" class="form-control" id="datetitre" name="datetitre">
                </div>
                <div class="col-md-5" style="margin-top: 15px;">
                    <label for="mp3titre" class="form-label">Nom du fichier MP3</label>
                    <input type="text" class="form-control" id="mp3titre" name="mp3titre">
                </div>


                <!-- On va sélectionner le genre pour récupérer l'id -->
                <div class="col-md-5">
                    <select name="idgenre" id="idgenre_choix">
                        <option value="">Genre</option>
                        <?php
                        for ($i = 0; $i < $nbr; $i++) {
                            ?>
                            <option value="<?php print $genre[$i]->idgenre; ?>">
                                <?php print $genre[$i]->nomgenre; ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>


                <!-- On va sélectionner l'album pour récupérer l'id -->
                <div class="col-md-5">
                    <select name="idalbum" id="idalbum_choix">
                        <option value="">Album</option>
                        <?php
                        for ($i = 0; $i < $nbral; $i++) {
                            ?>
                            <option value="<?php print $album[$i]->idalbum; ?>">
                                <?php print $album[$i]->nomalbum; ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>

                <!-- On va sélectionner la playlist pour récupérer l'id -->
                <div class="col-md-5">
                    <select name="idplaylist" id="idplaylist_choix">
                        <option value="">Playlist</option>
                        <?php
                        for ($i = 0; $i < $nbrpl; $i++) {
                            ?>
                            <option value="<?php print $playlist[$i]->idplaylist; ?>">
                                <?php print $playlist[$i]->nomplaylist; ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>

                <!-- On va sélectionner l'interprete' pour récupérer l'id -->
                <div class="col-md-5">
                    <select name="idinterprete" id="idinterprete_choix">
                        <option value="">Interprete</option>
                        <?php
                        for ($i = 0; $i < $nbrin; $i++) {
                            ?>
                            <option value="<?php print $interprete[$i]->idinterprete; ?>">
                                <?php print $interprete[$i]->nominterprete; ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="col-12">
                    <input type="hidden" name="action3" id="action3">
                    <button type="submit" class="btn btn-primary" id="editer_ajouter3" name="editer_ajouter3"
                            style="margin-top: 15px;">Nouveau ou mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>