<?php

class Connexion
{

    private static $_instance = null;

    public static function getInstance($dsn, $user, $password)
    {
        // :: --> manière d atteindre une variable statique
        if (!self::$_instance) {
            //si l instance de connexion n'existe pas encore
            try {
                // on essaye d'instancier un objet PDO
                self::$_instance = new PDO($dsn, $user, $password);
                //print "Connecté";
            } catch (PDOException $e) {
                print "Echec : " . $e->getMessage();
            }

        }
        return self::$_instance;
    }
}
