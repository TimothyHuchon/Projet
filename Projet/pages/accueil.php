<?php
    $liste = new PlaylistBD($cnx);
    $themes = $liste->getPlaylist();
    $nbr = count($themes);



?>
    <div class="centre ">
        <video autoplay muted loop>
  <source class="ratio" src="./admin/images/video1.mp4" type="video/mp4">
        </video>

        <div class="accueilText text-center ">
            <h2 class="text-light display-4 font-weight-bold">I Love Music</h2>
            <p class="text-light mx-auto">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                incididunt ut labore et dolore magna aliqua.</p>
            <a class="text-light"  href="./index_.php?page=playlists.php">Commencer</a>
        </div>
    </div>



<section id="menu1" class="menu1  py-5  ">
    <div class="row align-items-center container my-5 mx-auto ">
        <div class="text col-lg-6 col-md-6 col-12 w-50 pt-5 pb-5">
            <h6> MENU 1 </h6>
            <h2> Lorem ipsum dolor sit amet, consectetur adipiscing </h2>
            <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua.
                Lorem ipsum dolor sit amet,
                consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <a href="index_.php?page=disconnect.php"> deco </a>

        </div>

        <div class="image col-lg-4 col-md-6 col-12 w-50 pt-5 pb-5">
            <img class="img-fluid" src="./admin/images/imageA.jpg">

        </div>
    </div>


</section>


<section id="menu2" class="menu2  py-5 ">
    <div class="row align-items-center container my-5 mx-auto ">

        <div class="image col-lg-6 col-md-6 col-12 w-50  pt-5 pb-5">
            <img class="img-fluid" src="./admin/images/imageB.jpg">
        </div>

        <div class="text col-lg-6 col-md-6 col-12 w-50 pt-5 pb-5">
            <h6> MENU 2 </h6>
            <h2> Lorem ipsum dolor sit amet, consectetur adipiscing </h2>
            <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua.
                Lorem ipsum dolor sit amet,
                consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <a href=index_.php?page=signin.php"> Bouton </a>
        </div>
    </div>
</section>
    <?php


        $ti = new TitreBD($cnx);
        $liste_ti = $ti->getTitre();
        $nbr_ti = count($liste_ti);

    ?>

    <section id="menu3" class="menu3  py-5 ">
        <div class="col mx-auto align-items-center my-5">
        <div class="titreMenu3 text-center">
            <h2 class="font-weight-bold pb-5 text-light">Nos playlists</h2>
        </div>
        <div class="row mx-auto justify-content-center align-items-center text-center container ">

            <?php
            for($i=0; $i < $nbr; $i++){

            ?>

            <div class="un col-lg-3 col-md-3 col-12 w-25 m-2">
                <img class="img-fluid w-75" src="./admin/images/<?php print $themes[$i]->imageplaylist ?>">
                <h5 class="font-weight-bold pt-4">
                    <?php
                       print $themes[$i]->nomplaylist;
                    ?>


                </h5>
                <p> <?php
                    print $themes[$i]->descriptionplaylist;
                    ?>
                </p>

                <a href="index_.php?page=playlists.php&idplaylist=<?php print $themes[$i]->idplaylist;?>" type="button" class="btn btn-outline-warning">Play</a>


            </div>


            <?php

            }

            ?>







           <!-- <div class="un col-lg-3 col-md-3 col-12 w-25 m-2">
                <img class="img-fluid w-75" src="./admin/images/rock.jpg">
                <h5 class="font-weight-bold pt-4"> Playlist 2</h5>
                <p> Lorem ipsum dolor sit amet, consectetur adipiscing </p>
            </div>

            <div class="un col-lg-3 col-md-3 col-12 w-25 m-2">
                <img class="img-fluid w-75" src="./admin/images/dnb.jpg">
                <h5 class="font-weight-bold pt-4"> Playlist 3</h5>
                <p> Lorem ipsum dolor sit amet, consectetur adipiscing </p>
            </div> -->


        </div>
        </div>
    </section>



    <section id="menu4" class="menu4  py-5  ">
        <div class="row align-items-center container my-5 mx-auto ">
            <div class="text col-lg-6 col-md-6 col-12 w-50 pt-5 pb-5">
                <h6> S'inscrire </h6>
                <h2> Lorem ipsum dolor sit amet, consectetur adipiscing </h2>
                <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua.
                    Lorem ipsum dolor sit amet,
                    consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <a href="./index_.php?page=test.php"> Bouton </a>

            </div>

            <div class="image col-lg-4 col-md-6 col-12 w-50 pt-5 pb-5">
                <img class="img-fluid" src="./admin/images/imageD.jpg">

            </div>
        </div>


    </section>