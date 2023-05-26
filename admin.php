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

/**
 * (1) Le code utilise une boucle foreach pour itérer sur le tableau $formules et générer un formulaire pour chaque élément du tableau. 
 * (2) Le formulaire a l'attribut action défini sur "admin.php", les données du formulaire seront envoyées à cette page lors de la soumission.
 * (3) L'input de type "hidden" est utilisé pour stocker la valeur de la variable $formule et la transmettre à la page "admin.php" sans que l'utilisateur ne la voie.
 * (4) Les balises <select> pour afficher des options
 * 
 */
?>
<div class="admin-form-container">
    <?php
    foreach ($formules as $formule) { // (1)
        ?>
        <!-- Début Formulaire -->
        <div class="admin-form-box">
            <form action="admin.php" method="POST"> <!--(2)-->
                <h2><?php echo $formule; ?></h2>
                <input type="hidden" name="formule" value="<?php echo $formule; ?>">  <!--(3)-->

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
                <select name="support" required> <!--(4)-->
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
                <br>

                <!-- Champ "Domain" -->
                <label for="domain">Domain:</label>
                <input type="text" name="domain" required>
                <br>

                <!-- Champ "Hidden fees" -->
                <label for="hidden_fees">Hidden fees:</label>
                <select name="hidden_fees" required>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
                <br>

                <!-- Champ "Commande" -->
                <label for="commande">Commande:</label>
                <input type="text" name="commande" required>
                <br>

                <!-- Bouton de soumission -->
                <input type="submit" name="update" value="Update">
            </form>
        </div>
        <?php
    }
    ?>
</div>