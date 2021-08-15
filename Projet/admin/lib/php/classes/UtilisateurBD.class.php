<?php

class UtilisateurBD extends Utilisateur {
    private $_db; //recevoir la valeur de $cnx lors de la connexion à la BD dans index
    private $_data = array();
    private $_resultset;
    public function __construct($cnx){ //$cnx envoyé depuis la page qui instancie
        $this->_db = $cnx;
    }
    public function getUtilisateur($pseudo, $mdp){
        try {
            $query = "select is_utilisateur(:pseudo, :mdp) as retour";
            $_resultset = $this->_db->prepare($query);
            $_resultset->bindValue(':pseudo', $pseudo);
            $_resultset->bindValue(':mdp', $mdp);
            $_resultset->execute();
            $retour = $_resultset->fetchColumn(0);
            return $retour ;
        }catch(PDOException $e){
            print "Echec ".$e->getMessage();
        }
    }
}