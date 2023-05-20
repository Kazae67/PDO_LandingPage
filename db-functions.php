<?php

/**
 *@DNSServer
 *Nom du domaine
 *Nom d'utilisateur
 *Password
 */
$host = 'localhost';
$dbname = 'pricing';
$username = 'root';
$password = '';


/**
 *@errorCode Affiche une erreur si la connexion ne s'établie pas
 *On aurait pu mettre dans ça dans une Class pour l'utiliser comme fonction
 */
try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $err) {
    echo "Erreur de connexion à la base de données : " . $err->getMessage();
    exit;
}