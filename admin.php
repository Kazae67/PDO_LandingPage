<?php
// La ligne require_once 'db-functions.php' inclut le fichier db-functions.php, qui contient les fonctions nécessaires pour la connexion à la base de données.
require_once 'DB/db-functions.php';
?>

<!-- CSS -->
<link rel="stylesheet" href="PUBLIC/css/form-style.css">
<?php

// Function(s)
updateForm(connection());
// Récupération des valeurs à partir de la base de données
$db = connection();
$statement = $db->query("SELECT * FROM pricing_db");
$data = $statement->fetchAll(PDO::FETCH_ASSOC);

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
foreach ($formules as $formule) {
    // Recherche de la correspondance dans les données de la base de données
    $matchingData = array_filter($data, function ($row) use ($formule) {
        return $row['formule'] === $formule;
    });

    // Vérification si une correspondance a été trouvée
    if (!empty($matchingData)) {
        $row = reset($matchingData); 

        $name = $row['formule'];
        $price = $row['prix'];
        $sale = $row['reduction'];
        $bandwidth = $row['bandwidth'];
        $onlinespace = $row['onlinespace'];
        $support = $row['support'] ? 'Yes' : 'No';
        $domain = $row['domain'];
        $hidden_fees = $row['hidden_fees'] ? 'Yes' : 'No';
        $commande = $row['commande'];
    } else {
        // Utilise des valeurs par défaut si aucune correspondance n'a été trouvée dans la base de données
        $name = $formule;
        $price = '';
        $sale = '';
        $bandwidth = '';
        $onlinespace = '';
        $support = 'Yes';
        $domain = '';
        $hidden_fees = 'Yes';
        $commande = '';
    }
        ?>
        <!-- Début Formulaire -->
        <div class="admin-form-box">
            <form action="admin.php" method="POST"> <!--(2)-->
                <h2><?php echo $name; ?></h2>
                <input type="hidden" name="formule" value="<?php echo $name; ?>">  <!--(3)-->

                <!-- Champ "Name" -->
                <label for="name">Name:</label>
                <input type="text" name="name" value="<?php echo $name; ?>" required>
                <br>

                <!-- Champ "Price" -->
                <label for="price">Price:</label>
                <input type="text" name="price" value="<?php echo $price; ?>" required>
                <br>

                <!-- Champ "Sale" -->
                <label for="sale">Sale:</label>
                <input type="text" name="sale" value="<?php echo $sale; ?>" required>
                <br>

                <!-- Champ "Bandwidth" -->
                <label for="bandwidth">Bandwidth:</label>
                <input type="text" name="bandwidth" value="<?php echo $bandwidth; ?>" required>
                <br>

                <!-- Champ "Onlinespace" -->
                <label for="onlinespace">Onlinespace:</label>
                <input type="text" name="onlinespace" value="<?php echo $onlinespace; ?>" required>
                <br>

                <!-- Champ "Support" -->
                <label for="support">Support:</label>
                <select name="support" required> <!--(4)-->
                <option value="Yes" <?php if ($support === 'Yes') echo 'selected'; ?>>Yes</option>
                <option value="No" <?php if ($support === 'No') echo 'selected'; ?>>No</option>
                </select>
                <br>

                <!-- Champ "Domain" -->
                <label for="domain">Domain:</label>
                <input type="text" name="domain" value="<?php echo $domain; ?>" required>
                <br>

                <!-- Champ "Hidden fees" -->
                <label for="hidden_fees">Hidden fees:</label>
                <select name="hidden_fees" required>
                <option value="Yes" <?php if ($hidden_fees === 'Yes') echo 'selected'; ?>>Yes</option>
                <option value="No" <?php if ($hidden_fees === 'No') echo 'selected'; ?>>No</option>
                </select>
                <br>

                <!-- Champ "Commande" -->
                <label for="commande">Commande:</label>
                <input type="text" name="commande" value="<?php echo $commande; ?>" required>
                <br>

                <!-- Bouton de soumission -->
                <input type="submit" name="update" value="Update">
            </form>
        </div>
        <?php
    }
    ?>
</div>