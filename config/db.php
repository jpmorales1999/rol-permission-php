<?php

    class DataBase {
        public static function connect () {
            $db = new mysqli('localhost', 'root', 'root', 'rol-permission');
            $db->query("SET NAMES 'utf8'");
            return $db;
        }
    }

?>