<?php
require_once 'db-functions.php';

// Requête pour récupérer les formules de pricing depuis la base de données heidiSQL
$query = "SELECT * FROM pricing_db";
$result = $db->query($query);

// Vérifier s'il y a des résultats
if ($result->rowCount() > 0) {
    // Parcourir les résultats
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $formule = $row['formule'];
        $prix = $row['prix'];
        $reduction = $row['reduction'];
        $afficherReduction = $row['afficher_reduction'];

        // Afficher les formules de pricing dans le format souhaité
        echo "<div class='pricing-box'>";
        echo "<h3>$formule</h3>";
        echo "<p>Prix : $prix €</p>";

        if ($afficherReduction && $reduction > 0) {
            echo "<p>Réduction : -$reduction €</p>";
        }

        echo "</div>";
    }
} else {
    echo "Aucune formule de la base de données 'pricing' trouvée.";
}
?>