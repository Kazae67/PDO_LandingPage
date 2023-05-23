<?php
// La ligne require_once 'db-functions.php' inclut le fichier db-functions.php, qui contient les fonctions nécessaires pour la connexion à la base de données.
require_once 'DB/db-functions.php';
?>

<!-- CSS -->
<link rel="stylesheet" href="PUBLIC/css/form-style.css">

<?php
/**
 * Le code vérifie si le formulaire a été soumis en vérifiant si $_POST['update'] est défini. 
 * Cela signifie que le code suivant s'exécute lorsque le bouton "Update" est cliqué pour soumettre le formulaire.
 */
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
        echo "Malheuresement vous n'avez pas réussi à modifier votre formule";
    }
}

?>

<!-- 
* Chaque formulaire est enveloppé dans une balise <form> avec une action admin.php et une méthode POST. 
* L'action spécifie le fichier vers lequel les données du formulaire seront envoyées pour traitement. Dans ce cas, il s'agit du même fichier (admin.php).
* Les balises <input> sont utilisées pour les champs de formulaire. 
* Chaque champ a un attribut name qui correspond aux clés dans $_POST lorsque le formulaire est soumis. 
* Par exemple, le champ "Name" a name="name", le champ "Price" a name="price", etc.
* Chaque formulaire a également un champ <input> de type "hidden" qui contient la valeur de la formule correspondante. 
* Cela est utilisé pour identifier la formule lors de la mise à jour des données dans la base de données.
* Lorsque l'utilisateur soumet l'un des formulaires en cliquant sur le bouton "Update", 
* les données du formulaire sont envoyées à la même page (admin.php) et traitées selon les étapes mentionnées précédemment.
-->
<!-- Form Starter -->
<form action="admin.php" method="POST">
    <h2>Starter</h2>
    <input type="hidden" name="formule" value="Starter">

    <label for="name">Name:</label>
    <input type="text" name="name" required>
    <br>

    <label for="price">Price:</label>
    <input type="text" name="price" required>
    <br>

    <label for="sale">Sale:</label>
    <input type="text" name="sale" required>
    <br>

    <label for="bandwidth">Bandwidth:</label>
    <input type="text" name="bandwidth" required>
    <br>

    <label for="onlinespace">Onlinespace:</label>
    <input type="text" name="onlinespace" required>
    <br>

    <label for="support">Support:</label>
    <input type="text" name="support" required>
    <br>

    <label for="domain">Domain:</label>
    <input type="text" name="domain" required>
    <br>

    <label for="hidden_fees">Hidden fees:</label>
    <input type="text" name="hidden_fees" required>
    <br>

    <label for="commande">Commande:</label>
    <input type="text" name="commande" required>
    <br>

    <input type="submit" name="update" value="Update">
</form>

<!-- Form Advanced-->
<form action="admin.php" method="POST">
    <h2>Professional</h2>
    <input type="hidden" name="formule" value="Professional">

    <label for="name">Name:</label>
    <input type="text" name="name" required>
    <br>

    <label for="price">Price:</label>
    <input type="text" name="price" required>
    <br>

    <label for="sale">Sale:</label>
    <input type="text" name="sale" required>
    <br>

    <label for="bandwidth">Bandwidth:</label>
    <input type="text" name="bandwidth" required>
    <br>

    <label for="onlinespace">Onlinespace:</label>
    <input type="text" name="onlinespace" required>
    <br>

    <label for="support">Support:</label>
    <input type="text" name="support" required>
    <br>

    <label for="domain">Domain:</label>
    <input type="text" name="domain" required>
    <br>

    <label for="hidden_fees">Hidden fees:</label>
    <input type="text" name="hidden_fees" required>
    <br>

    <input type="submit" name="update" value="Update">
</form>

<!-- Form Professional -->
<form action="admin.php" method="POST">
    <h2>Advanced</h2>
    <input type="hidden" name="formule" value="Advanced">

    <label for="name">Name:</label>
    <input type="text" name="name" required>
    <br>

    <label for="price">Price:</label>
    <input type="text" name="price" required>
    <br>

    <label for="sale">Sale:</label>
    <input type="text" name="sale" required>
    <br>

    <label for="bandwidth">Bandwidth:</label>
    <input type="text" name="bandwidth" required>
    <br>

    <label for="onlinespace">Onlinespace:</label>
    <input type="text" name="onlinespace" required>
    <br>

    <label for="support">Support:</label>
    <input type="text" name="support" required>
    <br>

    <label for="domain">Domain:</label>
    <input type="text" name="domain" required>
    <br>

    <label for="hidden_fees">Hidden fees:</label>
    <input type="text" name="hidden_fees" required>
    <br>

    <input type="submit" name="update" value="Update">
</form>