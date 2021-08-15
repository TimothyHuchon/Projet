

<?php
$utilisateur = new AdminBD($cnx);
if(isset($_GET['ajout_user'])){
    extract($_GET,EXTR_OVERWRITE);

    if(!empty($login) && !empty($password)){
        $grade = 'utilisateur';
        $retour = $utilisateur->ajout_utilisateur($login,$password,$grade);
    }
}
?>



<div class="signup">
    <div class="container-fluid bg">
        <div class="row justify-content-center">
            <div class="col-sm-5 col-md-4 col-lg-5">
                <form class="form-container">
                    <div class="form-group">
                        <label for="login" class="form-label">Pseudo</label>
                        <input type="text" class="form-control" id="login" name="login">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" id="ajout_user" name="ajout_user">S'inscrire</button>
                </form>
            </div>
        </div>
    </div>
</div>