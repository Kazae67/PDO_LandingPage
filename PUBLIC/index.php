<?php
// La ligne require_once 'db-functions.php' inclut le fichier db-functions.php, qui contient les fonctions nécessaires pour la connexion à la base de données.
require_once '../DB/db-functions.php';
?>

<!-- CSS -->
<link rel="stylesheet" href="css/style.css">

<!-- Conteneur offres -->
<div class="pricing-container">

<?php

/**
 * La condition if ($_SERVER['REQUEST_METHOD'] === 'POST') vérifie si la méthode de requête est POST. 
 * Si c'est le cas, cela signifie qu'un formulaire a été soumis et les données de commande doivent être mises à jour dans la base de données. 
 * La boucle foreach parcourt les données de commande envoyées par le formulaire et exécute une requête SQL pour mettre à jour les données correspondantes dans la table 'pricing_db'.
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST['commande'] as $formule => $commande) {
        // Vérification des données envoyées
        $query = "UPDATE pricing_db SET commande = :commande WHERE formule = :formule";
        $update = $db->prepare($query);
        $commande = intval($commande) + 1;
        $update->bindParam(':commande', $commande);
        $update->bindParam(':formule', $formule);
        $update->execute();
    }
}

/**
 * La requête SQL SELECT * FROM pricing_db est exécutée pour récupérer toutes les formules de tarification à partir de la base de données. 
 * Les résultats sont stockés dans la variable $result.
 */
$query = "SELECT * FROM pricing_db";
$result = $db->query($query);

/**
 * La condition if ($result->rowCount() > 0) vérifie s'il y a des résultats de la requête. 
 * Si oui, cela signifie qu'il y a des formules de tarification à afficher.
 */
if ($result->rowCount() > 0) {
    
    /**
     * La boucle while ($row = $result->fetch(PDO::FETCH_ASSOC)) parcourt chaque ligne de résultat de la requête. 
     * Les valeurs des colonnes sont assignées à des variables appropriées telles que $formule, $prix, $mois, etc. 
     * Ensuite, les caractéristiques de chaque formule de tarification sont affichées à l'aide d'instructions echo. 
     * Des conditions sont utilisées pour afficher la réduction sur chaque formule, 
     * ainsi que des symboles de vérification ou de croix en fonction des caractéristiques telles que la bande passante, l'espace en ligne, le support, le domaine, les frais cachés, etc. 
     * Un formulaire de commande est également affiché pour chaque formule, avec un bouton "Join Now" pour soumettre le formulaire.
     */
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
        $commande = $row['commande'];
        // bandwidth en GB si elle dépasse 999MB
        if ($bandwidth > 999) {
            $bandwidth = round($bandwidth / 999, 1) . 'GB';
        } else {
            $bandwidth = $bandwidth . 'MB';
        }
        // onlinespace en GB si elle dépasse 999MB
        if ($onlinespace > 999) {
            $onlinespace = round($onlinespace / 999, 1) . 'GB';
        } else {
            $onlinespace = $onlinespace . 'MB';
        }
        // Afficher les formules, prix, month de pricing 
        echo "<div class='pricing-box'>";
        echo "<h2>$formule</h2>";
        echo "<p><span class='prix'>$$prix<span class='month'>/$mois</span></p>";
        // Condition pour afficher la réduction sur chaque formule 
        if ($afficherReduction && $reduction >= 0) {
            if ($formule == "Starter") { // Vérifier si c'est la formule "Advanced"
                echo "<p class='reduction'>$reduction%<br>sale</p>";
            } elseif ($formule == "Advanced") { // Vérifier si c'est la formule "Starter"
                echo "<p class='reduction'>$reduction%<br>sale</p>";
            } elseif ($formule == "Professional") { // Vérifier si c'est la formule "Professional"
                echo "<p class='reduction'>$reduction%<br>sale</p>";
            } else {
                echo "<p>Réduction : -$reduction %</p>"; // Décimal en 5,2 pour le %
            }
        }
        echo "<p><span class='label'>Bandwidth</span><span class='value'>$bandwidth " . ($bandwidth > 0 ? "<span class='symbol-vert'>✓</span>" : "<span class='symbol-rouge'>×</span>") . "</span></p>";
        echo "<p><span class='label'>Onlinespace</span><span class='value'>$onlinespace " . ($onlinespace > 0 ? "<span class='symbol-vert'>✓</span>" : "<span class='symbol-rouge'>×</span>") . "</span></p>";
        echo "<p><span class='label'>Support</span><span class='value'>" . ($support ? "Yes <span class='symbol-vert'>✓</span>" : "No <span class='symbol-rouge'>×</span>") . "</span></p>";
        echo "<p><span class='label'>Domain</span><span class='value'>" . ($domain > 0 ? $domain . " <span class='symbol-vert'>✓</span>" : "0 <span class='symbol-rouge'>×</span>") . "</span></p>";
        echo "<p><span class='label'>Hidden fees</span><span class='value'>" . ($hidden_fees ? "Yes <span class='symbol-vert'>✓</span>" : "No <span class='symbol-rouge'>×</span>") . "</span></p>";
        // formulaire commande
        echo "<form method='post' action=''>";
        echo "<p>commande : <span id='commande-$formule'>$commande</span></p>";
        echo "<input type='hidden' name='commande[$formule]' value='$commande'>";
        // Boutton
        echo "<button class='join-button' type='submit' name='update' value='Update'>Join Now</button>";
        echo "</form>";
        echo "</div>";
    }
} else {
    // Si aucune formule de tarification n'a été trouvée dans la base de données, un message indiquant qu'aucune formule n'a été trouvée est affiché.
    echo "Aucune formule de la base de données pricing trouvée.";
}
?>
</div>
