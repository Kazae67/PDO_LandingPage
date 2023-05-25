<?php
// La ligne require_once 'db-functions.php' inclut le fichier db-functions.php, qui contient les fonctions nécessaires pour la connexion à la base de données.
require_once '../DB/db-functions.php';
?>

<!-- CSS -->
<link rel="stylesheet" href="css/style.css">

<!-- Conteneur offres -->
<div class="pricing-container">

<?php
// Function(s)
ajouterCommande();
$value = 999;
formatValue($value);

/**
 * La requête SQL SELECT * FROM pricing_db est exécutée pour récupérer toutes les formules de tarification à partir de la base de données. 
 * Les résultats sont stockés dans la variable $result.
 * La condition if ($result->rowCount() > 0) vérifie s'il y a des résultats de la requête. 
 * Si c'est le cas, la boucle while est utilisée pour parcourir chaque ligne de résultat et afficher les détails de chaque formule de tarification.
 */


 $query = "SELECT * FROM pricing_db";
 $result = connection()->query($query);
 
 if ($result->rowCount() > 0) {
    
     while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
         $formule = $row['formule']; 
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
 
         echo "<div class='pricing-box'>";
         echo "<h2>$formule</h2>";
         echo "<p><span class='prix'>$$prix<span class='month'>/$mois</span></p>";
 
         if ($afficherReduction && $reduction >= 0) {
             echo ($formule == "Starter" || $formule == "Advanced" || $formule == "Professional") ? "<p class='reduction'>$reduction%<br>sale</p>" : "<p>Réduction : -$reduction %</p>";
         }
 
         $features = [
             ['label' => 'Bandwidth', 'value' => $bandwidth, 'symbol' => ($bandwidth > 0 ? '✓' : '×')],
             ['label' => 'Onlinespace', 'value' => $onlinespace, 'symbol' => ($onlinespace > 0 ? '✓' : '×')],
             ['label' => 'Support', 'value' => $support, 'symbol' => ($support == 'Yes' ? '✓' : '×')],
             ['label' => 'Domain', 'value' => $domain, 'symbol' => ($domain > 0 ? '✓' : '×')],
             ['label' => 'Hidden fees', 'value' => $hidden_fees, 'symbol' => ($hidden_fees == 'Yes' ? '✓' : '×')],
         ];
 
         foreach ($features as $feature) {
             displayFeature($feature['label'], $feature['value'], $feature['symbol']);
         }
 
         echo "<form method='post' action=''>";
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
