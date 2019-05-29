<?php

class Database{
    public static function connect(){
        $db = new mysqli('localhost', 'root', "", 'tienda');
        $db->query("SET NAMES 'utf8'");
        return $db;
    }
}

//cambio servidor linea 5: mysqli('localhost',