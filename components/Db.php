<?php

class Db {

    public static function getConnection() {

        $params = include(ROOT . '/config/db_params.php');
         
        $db = new PDO(
            "mysql:host={$params['host']};dbname={$params['dbname']};charset=utf8",
             $params['user'],
             $params['password']
        );
        return $db;
    }

}