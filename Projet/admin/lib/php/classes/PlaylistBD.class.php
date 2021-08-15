<?php

class PlaylistBD extends Playlist{
    private $_db;
    private $_data = array();
    private $_resultset;

    public function __construct($cnx){
        $this->_db = $cnx;
    }

    public function getPlaylist(){
        $query = "select * from playlist";

        $_resultset = $this->_db->prepare($query);
        $_resultset->execute();


        while ($d = $_resultset->fetch()){
            $_data[] = new Playlist($d);
        }
        //var_dump($_data);
        return $_data;
    }



    public function getPlaylistById($idplaylist){
        try {
            $this->_db->beginTransaction();
            $query = "select * from playlist where idplaylist =:idplaylist";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':idplaylist',$idplaylist);
            $resultset->execute();
            $data = $resultset->fetch();
            return $data;

        }catch (PDOException $e){
            print "Echec de la requête: " .$e->getMessage();
            $_db->rollback();
        }
    }


    public function updatePlaylist($idplaylist,$nomplaylist,$descriptionplaylist,$imageplaylist){
        try {
            $query ="update playlist set nomplaylist=:nomplaylist, descriptionplaylist=:descriptionplaylist,imageplaylist=:imageplaylist where idplaylist=:idplaylist";

            $_resultset = $this->_db->prepare($query);
            $_resultset->bindValue(':idplaylist', $idplaylist);
            $_resultset->bindValue(':nomplaylist',$nomplaylist);
            $_resultset->bindValue(':descriptionplaylist',$descriptionplaylist);
            $_resultset->bindValue(':imageplaylist',$imageplaylist);
            $_resultset->execute();


        }catch (PDOException $e){
            print $e->getMessage();
        }

    }

}