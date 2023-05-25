<?php
/**
 * __________D___N___S___________________
 * (1) Les variables $host, $dbname, $username et $password stockent les informations nécessaires pour la connexion à la base de données. 
 * (2) Commence une structure try-catch pour gérer les exceptions qui pourraient se produire lors de la connexion à la base de données.
 *     Dans le bloc try, une nouvelle instance de la classe PDO est créée pour établir la connexion avec la base de données. 
 * (3) La chaîne de connexion est construite en utilisant les valeurs des variables $host, $dbname, $username et $password.
 * (4) La méthode setAttribute est appelée sur l'objet PDO pour configurer le mode d'erreur. 
 *     Nous utilisons PDO::ATTR_ERRMODE avec la valeur PDO::ERRMODE_EXCEPTION, ce qui signifie que les exceptions seront levées en cas d'erreur.
 * (5) Si une exception de type PDOException est levée pendant la tentative de connexion à la base de données, le bloc catch est exécuté.
 * (6) Un message d'erreur est affiché, qui inclut le message d'erreur spécifique retourné par l'exception PDO. 
 * (7) Le script s'arrête en utilisant la fonction exit.
 */
function connection(){
    $host = 'localhost'; // (1)
    $dbname = 'pricing';
    $username = 'root';
    $password = '';
    try { // (2)
        $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password); // (3)
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // (4)
        return $db;
        } catch (PDOException $err) { // (5)
            echo "Erreur de connexion à la base de données : " . $err->getMessage(); // (6)
            exit; // (7)
        }
    }

/** __________A___D___M___I___N__________
* (1) La fonction updateForm($db) prend en paramètre une instance de connexion à la base de données $db.
* (2) La condition if (isset($_POST['update'])) vérifie si la clé 'update' existe dans le tableau $_POST. 
*     Cela permet de déterminer si le formulaire a été soumis, car le bouton "Update" doit avoir l'attribut name="update".
* (3) Les données du formulaire sont récupérées à partir de $_POST et sont assignées à des variables. Les valeurs récupérées représentent les champs du formulaire.
* (4) Le code prépare une requête SQL pour mettre à jour les données dans la base de données. (https://www.php.net/manual/fr/pdo.prepare.php)
* (5) Les variables sont liées aux paramètres de la requête SQL à l'aide de la méthode bindParam() de l'objet $update. (https://www.php.net/manual/fr/pdostatement.bindparam)
*     Cela permet de sécuriser la requête en évitant les injections SQL. 
* (6) La méthode execute() est appelée sur l'objet $update pour exécuter la requête de mise à jour dans la base de données. (https://www.php.net/manual/fr/pdostatement.execute)
* (7) Après la mise à jour, le code vérifie si des lignes ont été affectées par la requête en utilisant la méthode rowCount() sur l'objet $update. 
*     La méthode rowCount() retourne le nombre de lignes affectées par la dernière requête d'exécution. 
*     Si des lignes ont été affectées, cela signifie que la mise à jour a réussi. (https://www.php.net/manual/en/pdostatement.rowcount.php)
*/
function updateForm($db) { // (1)
    if (isset($_POST['update'])) { // (2)
        // Vérification des données envoyées
        $formule = $_POST['name']; // (3)
        $prix = $_POST['price'];
        $reduction = $_POST['sale'];
        $bandwidth = $_POST['bandwidth'];
        $onlinespace = $_POST['onlinespace'];
        $support = $_POST['support'] == 'Yes' ? 1 : 0;
        $domain = $_POST['domain'];
        $hidden_fees = $_POST['hidden_fees'] == 'Yes' ? 1 : 0;
        $commande = $_POST['commande'];

        // Requête de mise à jour des données dans la base de donnée
        $query = "UPDATE pricing_db SET prix = :prix, reduction = :reduction, bandwidth = :bandwidth, onlinespace = :onlinespace, support = :support, domain = :domain, hidden_fees = :hidden_fees, commande = :commande WHERE formule = :formule";

        // Liaison des valeurs aux paramètres de la requête
        $update = $db->prepare($query); // (4)
        $update->bindParam(':prix', $prix); // (5)
        $update->bindParam(':reduction', $reduction);
        $update->bindParam(':bandwidth', $bandwidth);
        $update->bindParam(':onlinespace', $onlinespace);
        $update->bindParam(':support', $support);
        $update->bindParam(':domain', $domain);
        $update->bindParam(':hidden_fees', $hidden_fees);
        $update->bindParam(':formule', $formule);
        $update->bindParam(':commande', $commande);
        $update->execute(); // (6)

        // Message de validation de la modification formulaire
        if($update->rowCount() > 0){ // (7)
            echo "Vous avez bien modifié votre formule";
            header("Location: public/index.php");
            exit;
        }else{
            echo "Malheureusement vous n'avez pas réussi à modifier votre formule";
        }
    }
}

/**__________I___N___D___E___X__________
 * (1) La condition if ($_SERVER['REQUEST_METHOD'] === 'POST') vérifie si la méthode de requête est POST, permet de déterminer si un formulaire a été soumis.
 *     S'il s'agit d'une requête POST, cela signifie qu'un formulaire a été soumis, et les données de commande doivent être mises à jour dans la base de données.
 * (2) La fonction connection() est appelée pour établir une connexion à la base de données.
 * (3) La boucle foreach parcourt les données de commande envoyées par le formulaire et exécute une requête SQL pour mettre à jour les données correspondantes dans la table 'pricing_db'.
 *     Les données de commande sont accessibles via $_POST['commande'], et chaque élément de ce tableau correspond à une valeur de commande pour une formule spécifique.
 *     Si c'est le cas, cela signifie qu'un formulaire a été soumis et les données de commande doivent être mises à jour dans la base de données. 
 * (4) Une requête SQL est préparée pour mettre à jour les données de commande dans la table pricing_db. 
 *     La requête utilise des paramètres avec des marqueurs de nom (:commande et :formule) pour éviter les injections SQL. (https://www.php.net/manual/fr/pdo.prepare.php)
 * (5) La valeur de commande est incrémentée de 1 en utilisant intval($commande) + 1. 
 *     La fonction intval() est utilisée pour s'assurer que la valeur est un entier. (https://www.php.net/manual/fr/function.intval.php)
 * (6) Les valeurs de commande et de formule sont liées aux paramètres de la requête préparée en utilisant les méthodes bindParam() du statement préparé. (https://www.php.net/manual/fr/pdostatement.bindparam.php)
 * (7) La requête est exécutée en utilisant la méthode execute(). (https://www.php.net/manual/en/pdostatement.execute.php)
 */
 function ajouterCommande(){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') { // (1)
        $db = connection(); // (2)
        foreach ($_POST['commande'] as $formule => $commande) { // (3)
            
            // Vérification des données envoyées
            $query = "UPDATE pricing_db SET commande = :commande WHERE formule = :formule";
            $update = $db->prepare($query); // (4)
            $commande = intval($commande) + 1; // (5)
            $update->bindParam(':commande', $commande); // (6)
            $update->bindParam(':formule', $formule);
            $update->execute(); // (7)
        }
    }
}

/**
 * (1) La condition if ($value > 999) vérifie si la valeur donnée est supérieure à 999. Cela permet de déterminer si la valeur est exprimée en (MB) ou en (GB).
 * (2) Si la condition est vraie, cela signifie que la valeur est supérieure à 999 et doit être convertie en GB. 
 *     La valeur est divisée par 999 et le résultat est arrondi à une décimale en utilisant la fonction round($value / 999, 1). 
 * (3) Si ce n'est pas le cas, la valeur sera en MB.
 */
function formatValue($value){
    if ($value > 999) { // (1)
        return round($value / 999, 1) . 'GB'; // (2)
    } else {
        return $value . 'MB'; // (3)
    }
}

/**
 * (1) La fonction displayFeature est définie avec trois paramètres : $label, $value et $symbol. 
 *     Cette fonction est utilisée pour afficher une fonctionnalité (label), sa valeur correspondante et un symbole associé.
 * (2) Une variable $class est déclarée et initialisée en fonction du symbole donné. 
 *     Si le symbole est égal à '✓', la variable $class est définie sur 'vert'. 
 *     Sinon, si le symbole est différent, la variable $class est définie sur 'rouge'. 
 * (3) Le premier <span> a la classe CSS 'label', le deuxième <span> a la classe CSS 'value'.
 *     À l'intérieur de ce <span>, il y a un autre <span> qui a une classe CSS dynamique 'symbol-$class'. Cette classe sera 'symbol-vert' si le symbole est '✓'.
 */
function displayFeature($label, $value, $symbol) // (1)
{
    $class = ($symbol === '✓') ? 'vert' : 'rouge'; // (2)
    echo "<p><span class='label'>$label</span><span class='value'>$value <span class='symbol-$class'>$symbol</span></span></p>"; // (3)
}

?>