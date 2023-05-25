<?php
// Contient les fonctions nécessaires pour la connexion à la base de données.
require_once '../DB/db-functions.php';
?>

<!-- CSS -->
<link rel="stylesheet" href="css/style.css">

<!-- Conteneur offres -->
<div class="pricing-container">

<?php
// Function(s)
ajouterCommande(); // Incrémente à chaque clic
$value = 999; // formatValue() | MB/GB
formatValue($value);

/**
 * (1) Une requête SQL est exécutée pour récupérer toutes les lignes de la table pricing_db de la base de données.
 * (2) Les résultats sont stockés dans la variable $result.
 * (3) La condition if ($result->rowCount() > 0) vérifie s'il y a des résultats de la requête. 
 * (4) Si c'est le cas, la boucle while est utilisée pour parcourir chaque ligne de résultat et afficher les détails de chaque formule de tarification.
 * (5) Les données sont extraites et stockées dans des variables individuelles telles que $formule, $prix, $mois, etc.
 * (6) La condition if ($afficherReduction && $reduction >= 0) vérifie si la réduction doit être affichée et si sa valeur est supérieure ou égale à zéro.
 * (7) Les fonctionnalités de la formule sont stockées dans un tableau $features contenant des tableaux associatifs, les valeurs et les symboles correspondants.
 * (8) Foreach utilisée pour parcourir chaque fonctionnalité du tableau $features et appeler la fonction displayFeature() pour afficher chaque fonctionnalité son label, sa valeur et son symbole.
 * (9) Un formulaire de commande est affiché avec la valeur de la commande extraite de la base de données, ainsi qu'un boutton.
 * 
 */
$query = "SELECT * FROM pricing_db"; // (1)
$result = connection()->query($query); // (2)
 
if ($result->rowCount() > 0) { // (3)
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) { // (4)
        $formule = $row['formule']; //(5)
        $prix = $row['prix'];
        $mois = $row['mois'];
        $reduction = $row['reduction'];
        $afficherReduction = $row['afficher_reduction'];
        $bandwidth = formatValue($row['bandwidth']);
        $onlinespace = formatValue($row['onlinespace']);
        $support = $row['support'] ? 'Yes' : 'No';
        $domain = ($row['domain'] > 0) ? $row['domain'] : '0';
        $hidden_fees = $row['hidden_fees'] ? 'Yes' : 'No';
        $commande = $row['commande'];

        // Boîte de tarification.
        echo "<div class='pricing-box'>";
        echo "<h2>$formule</h2>";
        echo "<p><span class='prix'>$$prix<span class='month'>/$mois</span></p>";

        // Tableau associatif
        if ($afficherReduction && $reduction >= 0) { // (6)
            echo ($formule == "Starter" || $formule == "Advanced" || $formule == "Professional") ? "<p class='reduction'>$reduction%<br>sale</p>" : "<p>Réduction : -$reduction %</p>";
        }
        
        // Fonctionnalités de la formule.
        $features = [ // (7)
            ['label' => 'Bandwidth', 'value' => $bandwidth, 'symbol' => ($bandwidth > 0 ? '✓' : '×')],
            ['label' => 'Onlinespace', 'value' => $onlinespace, 'symbol' => ($onlinespace > 0 ? '✓' : '×')],
            ['label' => 'Support', 'value' => $support, 'symbol' => ($support == 'Yes' ? '✓' : '×')],
            ['label' => 'Domain', 'value' => $domain, 'symbol' => ($domain > 0 ? '✓' : '×')],
            ['label' => 'Hidden fees', 'value' => $hidden_fees, 'symbol' => ($hidden_fees == 'Yes' ? '✓' : '×')],
        ];
        
        // Foreach des tableaux.
        foreach ($features as $feature) { // (8)
            displayFeature($feature['label'], $feature['value'], $feature['symbol']);
        }
        // Formulaire de commande.
        echo "<form method='post' action=''>"; // (9)
        echo "<p>commande : <span id='commande-$formule'>$commande</span></p>";
        echo "<input type='hidden' name='commande[$formule]' value='$commande'>";
        echo "<button class='join-button' type='submit' name='update' value='Update'>Join Now</button>";
        echo "</form>";
        echo "</div>";
    }
} else {
    echo "Aucune formule de la base de données pricing trouvée.";
}

?>
</div>
