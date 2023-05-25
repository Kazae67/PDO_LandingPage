<?php
// La ligne require_once 'db-functions.php' inclut le fichier db-functions.php, qui contient les fonctions nécessaires pour la connexion à la base de données.
require_once 'DB/db-functions.php';
?>

<!-- CSS -->
<link rel="stylesheet" href="PUBLIC/css/form-style.css">
<?php

// Function(s)
updateForm(connection());

// Formules
$formules = array(
    "Starter",
    "Professional",
    "Advanced"
);

foreach ($formules as $formule) {
    ?>
    <!-- Début du formulaire -->
    <form action="admin.php" method="POST">
        <h2><?php echo $formule; ?></h2>
        <input type="hidden" name="formule" value="<?php echo $formule; ?>">

         <!-- Champ "Name" -->
        <label for="name">Name:</label>
        <input type="text" name="name" required>
        <br>

        <!-- Champ "Price" -->
        <label for="price">Price:</label>
        <input type="text" name="price" required>
        <br>

        <!-- Champ "Sale" -->
        <label for="sale">Sale:</label>
        <input type="text" name="sale" required>
        <br>

        <!-- Champ "Bandwidth" -->
        <label for="bandwidth">Bandwidth:</label>
        <input type="text" name="bandwidth" required>
        <br>

        <!-- Champ "Onlinespace" -->
        <label for="onlinespace">Onlinespace:</label>
        <input type="text" name="onlinespace" required>
        <br>

        <!-- Champ "Support" -->
        <label for="support">Support:</label>
        <input type="text" name="support" required>
        <br>

        <!-- Champ "Domain" -->
        <label for="domain">Domain:</label>
        <input type="text" name="domain" required>
        <br>

        <!-- Champ "Hidden fees" -->
        <label for="hidden_fees">Hidden fees:</label>
        <input type="text" name="hidden_fees" required>
        <br>

        <!-- Champ "Commande" -->
        <label for="commande">Commande:</label>
        <input type="text" name="commande" required>
        <br>

        <!-- Bouton de soumission -->
        <input type="submit" name="update" value="Update">
    </form>
    <?php
}
?>