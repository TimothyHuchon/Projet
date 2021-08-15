<?php
class InterpreteBD extends Interprete{
    private $_db;
    private $_data;
    private $_resultset;

    public function __construct($cnx){
        $this->_db = $cnx;
    }


    public function getAllInterprete(){
        $query = "select * from interprete";
        $_resultset = $this->_db->prepare($query);
        $_resultset->execute();

        while ($d = $_resultset->fetch()){
            $_data[] = new interprete($d);
        }
        //var_dump($_data);
        return $_data;
    }

    public function getInterpreteById($idinterprete){
        try {
            $this->_db->beginTransaction();
            $query = "select * from interprete where idinterprete =:idinterprete";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':idinterprete',$idinterprete);
            $resultset->execute();
            $data = $resultset->fetch();
            return $data;

        }catch (PDOException $e){
            print "Echec de la requête: " .$e->getMessage();
            $_db->rollback();
        }
    }

    public function updateInterprete($idinterprete,$nominterprete,$prenominterprete,$dateinterprete){
        try {
            $query="update interprete set nominterprete=:nominterprete, prenominterprete=:prenominterprete, dateinterprete=:dateinterprete where idinterprete=:idinterprete";

            $_resultset = $this->_db->prepare($query);
            $_resultset->bindValue(':idinterprete', $idinterprete);
            $_resultset->bindValue(':nominterprete', $nominterprete);
            $_resultset->bindValue(':prenominterprete', $prenominterprete);
            $_resultset->bindValue(':dateinterprete', $dateinterprete);
            $_resultset->execute();

        }catch (PDOException $e){
            print $e->getMessage();
        }
    }



    public function ajout_interprete($idinterprete,$nominterprete,$prenominterprete,$dateinterprete){
        try {
            $query="insert into interprete(idinterprete,nominterprete,prenominterprete,dateinterprete) values (:idinterprete,:nominterprete,:prenominterprete,:dateinterprete)";
            $_resultset = $this->_db->prepare($query);
            $_resultset->bindValue(':idinterprete',$idinterprete);
            $_resultset->bindValue(':nominterprete',$nominterprete);
            $_resultset->bindValue(':prenominterprete',$prenominterprete);
            $_resultset->bindValue(':dateinterprete',$dateinterprete);
            $_resultset->execute();

        }catch (PDOException $e){
            print $e->getMessage();
        }

    }

}