<?php
/**
 * D_N_S_________________________________________________________________________________________________________________________________
 * Les variables $host, $dbname, $username et $password stockent les informations nécessaires pour la connexion à la base de données. 
 * remplacer les valeurs par les informations de connexion réelles de la base de données.
 * Commence une structure try-catch pour gérer les exceptions qui pourraient se produire lors de la connexion à la base de données.
 * Dans le bloc try, une nouvelle instance de la classe PDO est créée pour établir la connexion avec la base de données. 
 * La chaîne de connexion est construite en utilisant les valeurs des variables $host, $dbname, $username et $password.
 * La méthode setAttribute est appelée sur l'objet PDO pour configurer le mode d'erreur. 
 * Ici, nous utilisons PDO::ATTR_ERRMODE avec la valeur PDO::ERRMODE_EXCEPTION, ce qui signifie que les exceptions seront levées en cas d'erreur.
 * Si une exception de type PDOException est levée pendant la tentative de connexion à la base de données, le bloc catch est exécuté.
 * Dans le bloc catch, un message d'erreur est affiché, qui inclut le message d'erreur spécifique retourné par l'exception PDO. 
 * Ensuite, le script est arrêté en utilisant la fonction exit.
 */
function connection(){
    $host = 'localhost';
    $dbname = 'pricing';
    $username = 'root';
    $password = '';
    try {
        $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
        } catch (PDOException $err) {
            echo "Erreur de connexion à la base de données : " . $err->getMessage();
            exit;
        }
    }

/**
 * // A_D_M_I_N_____________________________________________________________________________________________________________________________
 * Le code vérifie si le formulaire a été soumis en vérifiant si $_POST['update'] est défini. 
 * Cela signifie que le code suivant s'exécute lorsque le bouton "Update" est cliqué pour soumettre le formulaire.
 */
function updateForm($db) {
    if (isset($_POST['update'])) {
        // Vérification des données envoyées
        $formule = $_POST['name'];
        $prix = $_POST['price'];
        $reduction = $_POST['sale'];
        $bandwidth = $_POST['bandwidth'];
        $onlinespace = $_POST['onlinespace'];
        $support = $_POST['support'] == 'Yes' ? 1 : 0;
        $domain = $_POST['domain'];
        $hidden_fees = $_POST['hidden_fees'] == 'Yes' ? 1 : 0;
        $commande = $_POST['commande'];
        /**
         * Les données du formulaire sont récupérées à partir de $_POST et sont assignées à des variables. 
         * Les variables incluent formule, prix, reduction, bandwidth, onlinespace, support, domain, hidden_fees et commande. 
         * Ces valeurs correspondent aux champs du formulaire.
         * Ensuite, le code prépare une requête SQL pour mettre à jour les données dans la base de données. 
         * La requête utilise des paramètres nommés (par exemple, :prix, :reduction, etc.) pour les valeurs qui seront liées ultérieurement.
         * Les variables sont liées aux paramètres de la requête SQL à l'aide de la méthode bindParam() de l'objet $update. (https://www.php.net/manual/fr/pdostatement.bindparam)
         * Cela permet de sécuriser la requête en évitant les injections SQL. 
         * La méthode execute() est appelée sur l'objet $update pour exécuter la requête de mise à jour dans la base de données. (https://www.php.net/manual/fr/pdostatement.execute)
         * Après la mise à jour, le code vérifie si des lignes ont été affectées par la requête en utilisant la méthode rowCount(). 
         * Si des lignes ont été affectées, le message de validation est affiché, sinon, le message d'erreur apparaît.
         */
        $query = "UPDATE pricing_db SET prix = :prix, reduction = :reduction, bandwidth = :bandwidth, onlinespace = :onlinespace, support = :support, domain = :domain, hidden_fees = :hidden_fees, commande = :commande WHERE formule = :formule";
        $update = $db->prepare($query);
        $update->bindParam(':prix', $prix);
        $update->bindParam(':reduction', $reduction);
        $update->bindParam(':bandwidth', $bandwidth);
        $update->bindParam(':onlinespace', $onlinespace);
        $update->bindParam(':support', $support);
        $update->bindParam(':domain', $domain);
        $update->bindParam(':hidden_fees', $hidden_fees);
        $update->bindParam(':formule', $formule);
        $update->bindParam(':commande', $commande);
        $update->execute();
        // Message de validation de la modification formulaire
        if($update->rowCount() > 0){
            echo "Vous avez bien modifié votre formule";
            header("Location: public/index.php");
            exit;
        }else{
            echo "Malheureusement vous n'avez pas réussi à modifier votre formule";
        }
    }
}

/**
 * I_N_D_E_X____________________________________________________________________________________________________________________________
 * La condition if ($_SERVER['REQUEST_METHOD'] === 'POST') vérifie si la méthode de requête est POST. 
 * S'il s'agit d'une requête POST, cela signifie qu'un formulaire a été soumis, et les données de commande doivent être mises à jour dans la base de données.
 * Si c'est le cas, cela signifie qu'un formulaire a été soumis et les données de commande doivent être mises à jour dans la base de données. 
 * La boucle foreach parcourt les données de commande envoyées par le formulaire et exécute une requête SQL pour mettre à jour les données correspondantes dans la table 'pricing_db'.
 */
 function ajouterCommande(){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $db = connection();
        foreach ($_POST['commande'] as $formule => $commande) {
            // Vérification des données envoyées
            $query = "UPDATE pricing_db SET commande = :commande WHERE formule = :formule";
            $update = $db->prepare($query);
            $commande = intval($commande) + 1;
            $update->bindParam(':commande', $commande);
            $update->bindParam(':formule', $formule);
            $update->execute();
        }
    }
}

function formatValue($value){
    if ($value > 999) {
        return round($value / 999, 1) . 'GB';
    } else {
        return $value . 'MB';
    }
}

function displayFeature($label, $value, $symbol)
{
    $class = ($symbol === '✓') ? 'vert' : 'rouge';
    echo "<p><span class='label'>$label</span><span class='value'>$value <span class='symbol-$class'>$symbol</span></span></p>";
}