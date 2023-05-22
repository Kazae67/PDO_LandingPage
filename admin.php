<?php
// Require pour la connexion
require_once 'db-functions.php';
?>
<link rel="stylesheet" href="form-style.css">

<?php
// Chercher si elle existe
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

    // Mise à jour des données dans la base de données
    // https://www.php.net/manual/fr/pdostatement.bindparam.php
    $query = "UPDATE pricing_db SET prix = :prix, reduction = :reduction, bandwidth = :bandwidth, onlinespace = :onlinespace, support = :support, domain = :domain, hidden_fees, commande = :commande = :hidden_fees WHERE formule = :formule";
    $update = $db->prepare($query);
    $update->bindParam(':prix', $prix);
    $update->bindParam(':reduction', $reduction);
    $update->bindParam(':bandwidth', $bandwidth);
    $update->bindParam(':onlinespace', $onlinespace);
    $update->bindParam(':support', $support);
    $update->bindParam(':domain', $domain);
    $update->bindParam(':hidden_fees', $hidden_fees);
    $update->bindParam(':formule', $formule);
    $update->execute();
    header("Location: index.php");
    exit;
}
?>

<!-- LES FORMULAIRES -->
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