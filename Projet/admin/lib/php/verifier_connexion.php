<?php
if(!isset($_SESSION['admin'])){
    print "Accès réservé";
    session_destroy();
    ?>
    <meta http-equiv="refresh": content="0;URL=../index_.php">
<?php
}