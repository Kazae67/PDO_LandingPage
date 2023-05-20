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
        $bandwidth = $row['bandwidth'];
        $onlinespace = $row['onlinespace'];
        $support = $row['support'];
        $domain = $row['domain'];
        $hidden_fees = $row['hidden_fees'];

        // Afficher les formules de pricing dans le format souhaité
        echo "<div class='pricing-box'>";
        echo "<h3>$formule</h3>";
        echo "<p>Prix : $prix €</p>";

        if ($afficherReduction && $reduction > 0) {
            echo "<p>Réduction : -$reduction €</p>";
        }

        // [TÂCHE IMPORTANTE ne pas oublier] Trouvez une condition pour afficher soit GB soit MB à la fin
        echo "<p>Bandwidth : $bandwidth</p>";
        echo "<p>Onlinespace : $onlinespace</p>";
        echo "<p>Support : " . ($support ? "Yes" : "No") . "</p>";
        echo "<p>Domain : " . ($domain ? $domain : "N/A") . "</p>";
        echo "<p>Hidden fees : " . ($hidden_fees ? "No" : "Yes") . "</p>";

        echo "</div>";
    }
} else {
    echo "Aucune formule de la base de donnée pricing trouvée.";
}

?>