<?php
header('Content-Type: application/json');
include('../pg_connect.php');
include('../classes/Connexion.class.php');
include('../classes/Titre.class.php');
include('../classes/TitreBD.class.php');


$cnx = Connexion::getInstance($dsn, $user, $password);

$ti= array();
$titre = new TitreBD($cnx);
$ti[] = $titre->getTitreById2($_GET['idtitre']);
print json_encode($ti);
