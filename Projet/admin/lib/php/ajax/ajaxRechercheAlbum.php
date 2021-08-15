<?php
header('Content-Type: application/json');
include('../pg_connect.php');
include('../classes/Connexion.class.php');
include('../classes/Album.class.php');
include('../classes/AlbumBD.class.php');


$cnx = Connexion::getInstance($dsn, $user, $password);

$al = array();
$album = new AlbumBD($cnx);
$al[] = $album->getAlbumById($_GET['idalbum']);
print json_encode($al);