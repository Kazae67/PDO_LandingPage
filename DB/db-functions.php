<!-- Il est important de noter que ce code doit être placé avant toute autre opération d'accès à la base de données, car il établit la connexion nécessaire pour ces opérations. -->

<?php
/**
 * Les variables $host, $dbname, $username et $password stockent les informations nécessaires pour la connexion à la base de données. 
 * remplacer les valeurs par les informations de connexion réelles de la base de données.
*/
$host = 'localhost';
$dbname = 'pricing';
$username = 'root';
$password = '';

/**
 * Commence une structure try-catch pour gérer les exceptions qui pourraient se produire lors de la connexion à la base de données.
 * Dans le bloc try, une nouvelle instance de la classe PDO est créée pour établir la connexion avec la base de données. 
 * La chaîne de connexion est construite en utilisant les valeurs des variables $host, $dbname, $username et $password.
 * La méthode setAttribute est appelée sur l'objet PDO pour configurer le mode d'erreur. 
 * Ici, nous utilisons PDO::ATTR_ERRMODE avec la valeur PDO::ERRMODE_EXCEPTION, ce qui signifie que les exceptions seront levées en cas d'erreur.
 * Si une exception de type PDOException est levée pendant la tentative de connexion à la base de données, le bloc catch est exécuté.
 * Dans le bloc catch, un message d'erreur est affiché, qui inclut le message d'erreur spécifique retourné par l'exception PDO. 
 * Ensuite, le script est arrêté en utilisant la fonction exit.
 */
try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $err) {
    echo "Erreur de connexion à la base de données : " . $err->getMessage();
    exit;
    // CHANGEMENT ICI PEUT ETRE 
}