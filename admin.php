<?php
// La ligne require_once 'db-functions.php' inclut le fichier db-functions.php, qui contient les fonctions nécessaires pour la connexion à la base de données.
require_once 'DB/db-functions.php';
?>

<!-- CSS -->
<link rel="stylesheet" href="PUBLIC/css/form-style.css">

<?php
// Function(s)
updateForm(connection());
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
<!-- Form Starter [A CHANGER] -->
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