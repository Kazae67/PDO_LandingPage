<?php

$host = 'localhost';
$dbname = 'pricing';
$username = 'root';
$password = '';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $err) {
    echo "Erreur de connexion à la base de données : " . $err->getMessage();
    exit;
}