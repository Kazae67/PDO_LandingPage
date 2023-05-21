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


        // Conversion de la valeur de onlinespace en GB si elle dépasse 1000
        if ($onlinespace > 999) {
            $onlinespace = round($onlinespace / 1000, 1) . 'GB';
        } else {
            $onlinespace = $onlinespace . 'MB';
        }

        // Afficher les formules de pricing dans le format souhaité
        echo "<div class='pricing-box'>";
        echo "<h2>$formule</h2>";
        echo "<p>Prix : $prix €</p>";

        // Condition pour afficher la réduction [0 :? 1]
        if ($afficherReduction && $reduction > 0) {
            echo "<p>Réduction : -$reduction €</p>";
        }

        // Typage catégories des formules de pricing 
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