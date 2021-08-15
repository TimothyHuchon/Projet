<?php


class TitreBD extends Titre
{
    private $_db;
    private $_data = array();
    private $_resultset;

    public function __construct($cnx)
    {
        $this->_db = $cnx;
    }

    public function getTitre()
    {
        $query = "select * from titre";

        $_resultset = $this->_db->prepare($query);
        $_resultset->execute();


        while ($d = $_resultset->fetch()) {
            $_data[] = new titre($d);
        }
        //var_dump($_data);
        return $_data;
    }


    public function getAllTitre()
    {
        $query = "select * from vue_info_titre order by idplaylist";
        $_resultset = $this->_db->prepare($query);
        $_resultset->execute();

        while ($d = $_resultset->fetch()) {
            $_data[] = new Titre($d);
        }
        //var_dump($_data);
        return $_data;
    }


    public function getTitrebyidPlay($id)
    {
        try {
            $query = "select * from vue_info_titre where idplaylist = :id";
            $_resultset = $this->_db->prepare($query);
            $_resultset->bindValue(':id', $id);
            $_resultset->execute();

            while ($d = $_resultset->fetch()) {
                $_data[] = new Titre($d);
            }
            return $_data;
        } catch (PDOException $e) {
            print "Echec de la requête" . $e->getMessage();
        }
    }


    public function getTitrebyid ($idtitre){
        try {
            $this->_db->beginTransaction();
            $query = "select * from vue_info_titre where idtitre = :idtitre";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':idtitre', $idtitre);
            $resultset->execute();
            $data = $resultset->fetch();
            return $data;

        }catch (PDOException $e){
            print "Echec de la requête: ".$e->getMessage();
            $_db->rollback();
        }
    }



    public function getTitreById2($idtitre){
        try {
            $this->_db->beginTransaction();
            $query = "select * from titre where idtitre=:idtitre";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':idtitre',$idtitre);
            $resultset->execute();
            $data = $resultset->fetch();
            return $data;


        }catch (PDOException $e){
            print "Echec de la requête: " .$e->getMessage();
            $_db->rollback();
        }
    }


    public function updateTitre($idtitre, $nomtitre, $datetitre, $mp3titre, $idgenre, $idalbum, $idplaylist, $idinterprete){
        try {
            $query="update titre set nomtitre=:nomtitre, datetitre=:datetitre, mp3titre=:mp3titre, idgenre=:idgenre, idalbum=:idalbum, idplaylist=:idplaylist, idinterprete=:idinterprete where idtitre=:idtitre";

            $_resultset = $this->_db->prepare($query);
            $_resultset->bindValue(':idtitre', $idtitre);
            $_resultset->bindValue(':nomtitre', $nomtitre);
            $_resultset->bindValue(':datetitre', $datetitre);
            $_resultset->bindValue(':mp3titre', $mp3titre);
            $_resultset->bindValue(':idgenre', $idgenre);
            $_resultset->bindValue(':idalbum', $idalbum);
            $_resultset->bindValue(':idplaylist', $idplaylist);
            $_resultset->bindValue(':idinterprete', $idinterprete);
            $_resultset->execute();


        }catch (PDOException $e){
            print $e->getMessage();
        }
    }


    public function ajout_titre($idtitre, $nomtitre, $datetitre, $mp3titre, $idgenre, $idalbum, $idplaylist, $idinterprete){
        try {
            $query="insert into titre (idtitre,nomtitre,datetitre,mp3titre,idgenre,idalbum,idplaylist,idinterprete) values (:idtitre,:nomtitre,:datetitre,:mp3titre,:idgenre,:idalbum,:idplaylist,:idinterprete)";
            $_resultset = $this->_db->prepare($query);
            $_resultset->bindValue(':idtitre', $idtitre);
            $_resultset->bindValue(':nomtitre', $nomtitre);
            $_resultset->bindValue(':datetitre', $datetitre);
            $_resultset->bindValue(':mp3titre', $mp3titre);
            $_resultset->bindValue(':idgenre', $idgenre);
            $_resultset->bindValue(':idalbum', $idalbum);
            $_resultset->bindValue(':idplaylist', $idplaylist);
            $_resultset->bindValue(':idinterprete', $idinterprete);
            $_resultset->execute();
        }catch (PDOException $e){
            print $e->getMessage();
        }

    }

}