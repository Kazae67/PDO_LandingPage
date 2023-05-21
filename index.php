<?php
require_once 'db-functions.php';

?>
<link rel="stylesheet" href="style.css">
<!-- Conteneur offres -->
<div class="pricing-container">

<?php
// Requête pour récupérer les formules de pricing depuis la base de données heidiSQL
$query = "SELECT * FROM pricing_db";
$result = $db->query($query);

// Vérifier s'il y a des résultats
if ($result->rowCount() > 0) {
    // Parcourir les résultats
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $formule = $row['formule']; 
        $prix = $row['prix'];
        $mois = $row['mois'];
        $reduction = $row['reduction'];
        $afficherReduction = $row['afficher_reduction'];
        $bandwidth = $row['bandwidth'];
        $onlinespace = $row['onlinespace'];
        $support = $row['support'];
        $domain = $row['domain'];
        $hidden_fees = $row['hidden_fees'];


        // bandwidth en GB si elle dépasse 1000MB
        if ($bandwidth > 999) {
            $bandwidth = round($bandwidth / 999, 1) . 'GB';
        } else {
            $bandwidth = $bandwidth . 'MB';
        }

        // onlinespace en GB si elle dépasse 1000MB
        if ($onlinespace > 999) {
            $onlinespace = round($onlinespace / 999, 1) . 'GB';
        } else {
            $onlinespace = $onlinespace . 'MB';
        }

        // Afficher les formules, prix, month de pricing 
        echo "<div class='pricing-box'>";
        echo "<h2>$formule</h2>";
        echo "<p><span class='prix'>$$prix<span class='month'>/$mois</span></p>";

        // Condition pour afficher la réduction [0 :? 1] 
        if ($afficherReduction && $reduction > 0) {
            echo "<p class='reduction'>$reduction%<br>sale</p>"; // Décimal en 5,2 pour le %
        }
    /* CONDITION POUR LE METTRE SEULEMENT SUR LES ADVANCED
        if ($afficherReduction && $reduction > 0) {
            if ($formule == "Advanced") { // Vérifiez si c'est la formule "Advanced"
                echo "<p class='reduction'>-$reduction%</p>";
            } else {
                echo "<p>Réduction : -$reduction %</p>"; // Décimal en 5,2 pour le %
            }
        }
    */
        // Typage catégories des formules de pricing && Affichage des icones && ETIQUETTES/VALEURS
        // Créer des functions pour raccourcir le code et la la lisibilité
        echo "<p><span class='label'>Bandwidth</span><span class='value'>$bandwidth " . ($bandwidth > 0 ? "<span class='symbol-vert'>✓</span>" : "<span class='symbol-rouge'>×</span>") . "</span></p>";
        echo "<p><span class='label'>Onlinespace</span><span class='value'>$onlinespace " . ($onlinespace > 0 ? "<span class='symbol-vert'>✓</span>" : "<span class='symbol-rouge'>×</span>") . "</span></p>";
        echo "<p><span class='label'>Support</span><span class='value'>" . ($support ? "Yes <span class='symbol-vert'>✓</span>" : "No <span class='symbol-rouge'>×</span>") . "</span></p>";
        echo "<p><span class='label'>Domain</span><span class='value'>" . ($domain > 0 ? $domain . " <span class='symbol-vert'>✓</span>" : "0 <span class='symbol-rouge'>×</span>") . "</span></p>";
        echo "<p><span class='label'>Hidden fees</span><span class='value'>" . ($hidden_fees ? "Yes <span class='symbol-vert'>✓</span>" : "No <span class='symbol-rouge'>×</span>") . "</span></p>";

        echo "<button class='join-button'>Join Now</button>";

        echo "</div>";
    }
} else {
    echo "Aucune formule de la base de données pricing trouvée.";
}


?>
</div>