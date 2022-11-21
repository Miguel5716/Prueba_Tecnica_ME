<?php

require 'config/global.php';

class Conexion {

    public function abrir_conexion() {

        $servidor   = DB_HOST;
        $usuario    = DB_USERNAME;
        $contrasena = DB_PASSWORD;
        $database   = DB_NAME;
        $pdo        = null;

        try {
            $pdo = new PDO("mysql:host=$servidor; dbname=$database", $usuario, $contrasena);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            echo "Error " .$e->getmessage();
        } 

    }

    public function cerrar_conexion(&$pdo) {
        $pdo = null;
    }

}