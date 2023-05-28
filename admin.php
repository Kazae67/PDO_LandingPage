<?php
// Nécessaires pour la connexion à la base de données.
require_once 'DB/db-functions.php';

// Function(s)
updateForm(connection());

// Récupération des valeurs à partir de la base de données
$db = connection();
$statement = $db->query("SELECT * FROM pricing_db");
$data = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- CSS -->
<link rel="stylesheet" href="PUBLIC/css/form-style.css">
<?php

// Formules
$formules = array(
    "Starter",
    "Advanced",
    "Professional"
);

/**
 * (1) À l'intérieur de la boucle, un filtrage est effectué sur le tableau $data à l'aide de la fonction array_filter. (https://www.php.net/manual/en/function.array-filter.php)
 *     Cette fonction recherche une correspondance entre la clé 'formule' de chaque élément du tableau $data et la valeur de la variable $formule. 
 * (2) Ensuite, une vérification est effectuée pour déterminer si une correspondance a été trouvée. 
 *     Si la variable $matchingData n'est pas vide, cela signifie qu'une correspondance a été trouvée.
 * (3) Si une correspondance est trouvée, la première ligne correspondante est extraite à l'aide de la fonction reset pour obtenir le premier élément de $matchingData. 
 *     Les différentes valeurs de la ligne correspondante sont ensuite assignées à des variables spécifiques telles que $name, $price, $sale, $bandwidth etc.
 * (4) Si aucune correspondance n'est trouvée, les valeurs par défaut sont assignées aux variables telles que $name, $price, $sale etc.
 * (5) Le formulaire a comme action le fichier "admin.php", donc on reste sur la page.
 * (6) À l'intérieur du formulaire, le nom de la formule est stocké dans un champ caché en utilisant la balise <input> avec le type "hidden". 
 *     (https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/hidden)
 * (7) Les valeurs de ces champs sont pré-remplies avec les valeurs des variables correspondantes (par exemple, value="<?php echo $name; ?>").
 */
?>
<div class="admin-form-container">
    <?php
foreach ($formules as $formule) {
    // Recherche de la correspondance dans les données de la base de données
    $matchingData = array_filter($data, function ($row) use ($formule) { // (1)
        return $row['formule'] === $formule;
    });

    // Vérification si une correspondance a été trouvée
    if (!empty($matchingData)) { // (2)
        $row = reset($matchingData); // (3)

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
        // Utilise des valeurs par défaut si aucune correspondance n'a été trouvée dans la base de données (4)
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
        <!-- Formulaire -->
        <div class="admin-form-box">
            <form action="admin.php" method="POST"> <!--(5)-->
                <h2><?php echo $name; ?></h2>
                <input type="hidden" name="formule" value="<?php echo $name; ?>"> <!--(6)-->

                <!-- Champ "Name" -->
                <label for="name">Name:</label>
                <input type="text" name="name" value="<?php echo $name; ?>" required> <!--(7)-->
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