<?php
header('Content-Type: application/json');
include('../pg_connect.php');
include('../classes/Connexion.class.php');
include('../classes/Genre.class.php');
include('../classes/GenreBD.class.php');


$cnx = Connexion::getInstance($dsn, $user, $password);

$ge = array();
$genre = new GenreBD($cnx);
$ge[] = $genre->getGenreById($_GET['idgenre']);
print json_encode($ge);