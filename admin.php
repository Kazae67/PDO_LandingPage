<?php
// Require pour la connexion
require_once 'db-functions.php';

// [Trouver une méthode pour établir la connexion] 

?>

<!-- Formulaire -->
<form action="admin.php" method="POST">
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