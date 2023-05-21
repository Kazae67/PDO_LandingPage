<?php
// Require pour la connexion
require_once 'db-functions.php';

// [Trouver une méthode pour établir la connexion] 
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
}
// [Trouver un moyen de mettre à jour après la récupération (piste QUERY)]
?>

<!-- LES FORMULAIRES -->
<!-- Form Starter -->
<form action="admin.php" method="POST">
    <h2>Starter</h2>
    <input type="hidden" name="formule" value="Starter">

    <label for="name">Nom:</label>
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


<!-- Form Advanced-->
<form action="admin.php" method="POST">
    <h2>Professional</h2>
    <input type="hidden" name="formule" value="Professional">

    <label for="name">Nom:</label>
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

    <label for="name">Nom:</label>
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
