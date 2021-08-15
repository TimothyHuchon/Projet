<?php
header('Content-Type: application/json');
include('../pg_connect.php');
include('../classes/Connexion.class.php');
include('../classes/Playlist.class.php');
include('../classes/PlaylistBD.class.php');


$cnx = Connexion::getInstance($dsn, $user, $password);

$pl = array();
$album = new PlaylistBD($cnx);
$pl[] = $album->getPlaylistById($_GET['idplaylist']);
print json_encode($pl);