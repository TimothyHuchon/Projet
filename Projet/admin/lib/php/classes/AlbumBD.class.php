<?php
class AlbumBD extends Album{
    private $_db;
    private $_data;
    private $_resultset;

    public function __construct($cnx){
        $this->_db = $cnx;
    }


    public function getAllAlbum(){
        $query = "select * from album";
        $_resultset = $this->_db->prepare($query);
        $_resultset->execute();

        while($d = $_resultset->fetch()){
            $_data[] = new Album($d);
        }
        //var_dump($_data);
        return $_data;
    }

    public function getAlbumById ($idalbum){
        try {
            $this->_db->beginTransaction();
            $query = "select * from album where idalbum = :idalbum";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':idalbum', $idalbum);
            $resultset->execute();
            $data = $resultset->fetch();
            return $data;

        }catch (PDOException $e){
            print "Echec de la requête: ".$e->getMessage();
            $_db->rollback();
        }
    }


    public function updateAlbum($idalbum,$nomalbum,$datealbum,$imagealbum){
        try {
            $query="update album set nomalbum=:nomalbum, datealbum=:datealbum, imagealbum=:imagealbum where idalbum=:idalbum";

            $_resultset = $this->_db->prepare($query);
            $_resultset->bindValue(':idalbum', $idalbum);
            $_resultset->bindValue(':nomalbum', $nomalbum);
            $_resultset->bindValue(':datealbum', $datealbum);
            $_resultset->bindValue(':imagealbum', $imagealbum);
            $_resultset->execute();


        }catch (PDOException $e){
            print $e->getMessage();
        }
    }


    public function ajout_album($idalbum,$nomalbum,$datealbum,$imagealbum){
        try {
            $query="insert into album (idalbum,nomalbum,datealbum,imagealbum) values (:idalbum,:nomalbum,:datealbum,:imagealbum)";
            $_resultset = $this->_db->prepare($query);
            $_resultset->bindValue(':idalbum', $idalbum);
            $_resultset->bindValue(':nomalbum', $nomalbum);
            $_resultset->bindValue(':datealbum', $datealbum);
            $_resultset->bindValue(':imagealbum', $imagealbum);
            $_resultset->execute();
        }catch (PDOException $e){
            print $e->getMessage();
        }

    }

}


