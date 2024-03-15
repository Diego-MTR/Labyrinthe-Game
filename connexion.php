<?php 

class Connexion {
    public static function connect() {
        try {
            $db = new PDO("mysql:host=localhost;dbname=labyrinthe", "root", "root");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (PDOException $e) {
            // Log the error instead of echoing it
            error_log("Connection failed: " . $e->getMessage());
            return null;
        }
    }
}
