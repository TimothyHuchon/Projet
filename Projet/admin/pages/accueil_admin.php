<h2>Accueil admin</h2>
<?php
if(isset($_POST['submit'])){
    extract($_POST,EXTR_OVERWRITE);
    $ad = new AdminBD($cnx);
    $admin = $ad->getAdmin($login, $password);
}
?>
<form action="<?php print $_SERVER['PHP_SELF'];?>" method="post">
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