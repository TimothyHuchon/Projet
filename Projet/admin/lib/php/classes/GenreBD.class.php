<?php
class GenreBD extends Genre{
    private $_db;
    private $_data;
    private $_resultset;

    public function __construct($cnx){
        $this->_db = $cnx;
    }


    public function getAllGenre(){
        $query = "select * from genre";
        $_resultset = $this->_db->prepare($query);
        $_resultset->execute();

        while($d = $_resultset->fetch()){
            $_data[] = new Genre($d);
        }
        //var_dump($_data);
        return $_data;
    }



}