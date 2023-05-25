<?php
// La ligne require_once 'db-functions.php' inclut le fichier db-functions.php, qui contient les fonctions nécessaires pour la connexion à la base de données.
require_once 'DB/db-functions.php';
?>

<!-- CSS -->
<link rel="stylesheet" href="PUBLIC/css/form-style.css">

<?php
// Function(s)
updateForm(connection());

// Formulaires
$formules = array(
    "Starter",
    "Professional",
    "Advanced"
);

foreach ($formules as $formule) {
    ?>
    <form action="admin.php" method="POST">
        <h2><?php echo $formule; ?></h2>
        <input type="hidden" name="formule" value="<?php echo $formule; ?>">

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
    <?php
}
?>