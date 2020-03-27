<?php

abstract class Model
{
    const SERVER = "localhost";
    const USER = "root";
    const PASSWORD = "";
    const BASE = "csv_db";

    // define('SERVER' ,"sqlprive-pc2372-001.privatesql.ha.ovh.net");
    // define('USER' ,"cefiidev966");
    // define('PASSWORD' ,"4Lwc5pW3");
    // define('BASE' ,"cefiidev966");

    protected $connexion;

    /**
     * Connexion à la BDD en PHP en local ou à distance
     */
    public function __construct()
    {
        // Connexion
        try {
            $this->connexion = new PDO("mysql:host=" . self::SERVER . ";dbname="
            . self::BASE, self::USER, self::PASSWORD);
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
        //Résoudre problèmes d'encodages (accents)
        $this->connexion->exec("SET NAMES 'UTF8'");

    }

}
