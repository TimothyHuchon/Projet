<?php
header('Content-Type: application/json');
include('../pg_connect.php');
include('../classes/Connexion.class.php');
include('../classes/Interprete.class.php');
include('../classes/InterpreteBD.class.php');


$cnx = Connexion::getInstance($dsn, $user, $password);

$in = array();
$interprete = new InterpreteBD($cnx);
$in[] = $interprete->getInterpreteById($_GET['idinterprete']);
print json_encode($in);