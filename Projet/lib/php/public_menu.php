<header>

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index_.php?page=accueil.php">BiblioZic</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="#menu1">À Propos</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#menu2">Description</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#menu3">Playlist</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#menu4">Se connecter </a>
                    </li>

                </ul>

                <?php if(isset($_SESSION['utilisateur']))
                { ?> <a  class="btn text-white" href="index.php?page=disconnect.php" name="deco">Se déconnecter</a><?php } else{ ?>
                    <a href="index_.php?page=signup.php" class="btn  text-white" type="submit">S'inscrire</a>
               <?php } ?>


            </div>
        </div>
    </nav>

</header>