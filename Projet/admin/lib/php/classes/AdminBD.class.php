<?php
class AdminBD extends Admin{
    private $_db;
    private $_data;
    private $_resultset;

    public function __construct($cnx){
        $this->_db = $cnx;
    }

    public function getUtilisateur($login, $password){
        try {
            $query = "select is_utilisateur (:login,:password) as retour";
            $_resulset = $this->_db->prepare($query);
            $_resulset->bindValue(':login', $login);
            $_resulset->bindValue(':password',$password);
            $_resulset->execute();
            $retour = $_resulset->fetchColumn(0);
            return $retour;

        }catch (PDOException $e){
            print "Echec " .$e->getMessage();
        }
    }


    public function getAdmin($login,$password){
        try {
            $query = "select is_admin (:login,:password) as retour";
            $_resulset = $this->_db->prepare($query);
            $_resulset->bindValue(':login', $login);
            $_resulset->bindValue(':password',$password);
            $_resulset->execute();
            $retour = $_resulset->fetchColumn(0);
            return $retour;

        }catch (PDOException $e){
            print "Echec " .$e->getMessage();
        }
    }





    public function ajout_utilisateur($login,$password,$grade){
        try {
            $query="insert into bp_admin(login,password,grade) values (:login,:password,:grade)";
            $_resultset = $this->_db->prepare($query);
            $_resultset->bindValue(':login',$login);
            $_resultset->bindValue(':password',$password);
            $_resultset->bindValue(':grade',$grade);

            $_resultset->execute();

        }catch (PDOException $e){
            print $e->getMessage();
        }

    }




}