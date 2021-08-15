
<?php

if (isset($_POST['submit'])) {
    extract($_POST, EXTR_OVERWRITE);
    $ad = new AdminBD($cnx);
    $admin = $ad->getAdmin($login,$password);
    //var_dump($admin);


    if ($admin){
        //print "touché il y a un admin";
        $_SESSION['admin'] = 1;
        $message = "Bienvenue " .$login;
    }

    else {
        //print "raté pas d'admin";
        $ut = new AdminBD($cnx);
        $utilisateur = $ut->getUtilisateur($login,$password);
        //var_dump($utilisateur);

        if ($utilisateur) {
            $_SESSION['utilisateur'] = 1;
            $message = "Bienvenue ".$login;
        } else {
            $message = "Identifiants incorrects";
        }
    }
}
?>



<div class="signin">
    <div class="container-fluid bg">
        <div class="row justify-content-center">
            <div class="col-sm-6 col-md-4 col-lg-3">
                <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post" class="form-container">
                    <p class=""><?php
                        if (isset($message)) {
                            print $message;
                        }
                        ?> </p>

                    <div class="mb-3">
                        <label for="login" class="form-label">Login</label>
                        <input type="login" class="form-control" id="login" name="login">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

