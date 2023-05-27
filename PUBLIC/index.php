<?php
// Contient les fonctions nécessaires pour la connexion à la base de données.
require_once '../DB/db-functions.php';

// Function(s)
ajouterCommande(); // Incrémente à chaque clic
$value = 999; // formatValue() | MB/GB
formatValue($value);


?>

<!-- CSS -->
<link rel="stylesheet" href="css/style.css">

<!-- Conteneur formules -->
<div class="pricing-container">

<?php
/** AFFICHAGE FORMULES
 * (1) Une requête SQL est exécutée pour récupérer toutes les lignes de la table pricing_db de la base de données.
 * (2) Les résultats sont stockés dans la variable $result.
 * (3) La condition if ($result->rowCount() > 0) vérifie s'il y a des résultats de la requête. 
 * (4) Si c'est le cas, la boucle while est utilisée pour parcourir chaque ligne de résultat et afficher les détails de chaque formule de tarification.
 * (5) Les données sont extraites et stockées dans des variables individuelles telles que $formule, $prix, $mois, etc.
 * (6) La condition if ($afficherReduction && $reduction >= 1) vérifie si la réduction doit être affichée.
 *     Si la valeur de la $reduction > 50, alors la class blink s'activera pour clignoter. 
 * (7) Les fonctionnalités de la formule sont stockées dans un tableau $features contenant des tableaux associatifs, les valeurs et les symboles correspondants.
 * (8) Foreach utilisée pour parcourir chaque fonctionnalité du tableau $features et appeler pour afficher chaque fonctionnalité son label, sa valeur et son symbole.
 * (9) Un formulaire de commande est affiché avec la valeur de la commande extraite de la base de données, ainsi qu'un boutton.
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

        // Boîte de formule.
        echo "<div class='pricing-box'>";
        echo "<h2>$formule</h2>";
        echo "<p><span class='prix'>$$prix<span class='month'>/$mois</span></p>";

        // Tableau associatif de reduction (6)
        if ($afficherReduction && $reduction >= 1) { 
            if ($reduction >= 50) {
                echo "<p class='reduction blink'>-$reduction%<br>sale</p>";
            } else {
                echo "<p class='reduction'>-$reduction%<br>sale</p>";
            }
        } 
        
        // Fonctionnalités de la formule.
        $features = [ // (7)
            ['label' => 'Bandwidth', 'value' => $bandwidth, 'symbol' => ($bandwidth > 0 ? '✓' : '×')],
            ['label' => 'Onlinespace', 'value' => $onlinespace, 'symbol' => ($onlinespace > 0 ? '✓' : '×')],
            ['label' => 'Support', 'value' => $support, 'symbol' => ($support == 'Yes' ? '✓' : '×')],
            ['label' => 'Domain', 'value' => $domain, 'symbol' => ($domain > 0 ? '✓' : '×')],
            ['label' => 'Hidden fees', 'value' => $hidden_fees, 'symbol' => ($hidden_fees == 'Yes' ? '✓' : '×')],
        ];

        // Affichage des fonctionnalités de la formule.
        foreach ($features as $feature) { // (8)
            echo "<div class='feature'>";
            echo "<span class='label'>" . $feature['symbol'] . " " . $feature['label'] . "</span>";
            echo "<span class='value'>" . $feature['value'] .  "</span>";
            echo "</div>";
        }
        
        // Formulaire de commande.
        echo "<form method='post' action=''>"; // (9)
        echo "<p>commande";
        if ($commande > 1) {
            echo "s";
        }
        echo " : <span id='commande-$formule'>$commande</span></p>";
        echo "<input type='hidden' name='commande[$formule]' value='$commande'>";
        echo "<button class='join-button' type='submit' name='update' value='Update'>Join Now</button>";
        echo "</form>";
        echo "</div>";
        ?>
        <?php
    }
} else {
    echo "Aucune formule de la base de données pricing trouvée.";
}
?>

<!-- Fin Conteneur formules -->
</div> 

<?php
/** AFFICHAGE NEWSLETTER
 * (1) On utilise superglobale $_SERVER['REQUEST_METHOD'] pour vérifier si la méthode de requête est POST et si l'index 'email' existe dans $_POST. 
 *     le code s'exécute uniquement lorsque le formulaire est soumis via la méthode POST et que la valeur de l'input 'email' est présente.
 * (2) La variable $email est initialisée avec la valeur de $_POST['email']. 
 * (3) La fonction ajouterEmail($email) est appelée pour ajouter l'adresse e-mail à une liste.
 * (4) Affiche un formulaire HTML avec la méthode POST et une action vide. L'action est vide donc on reste à la même page. 
 */
?>
<!-- SUBSCRIBE CONTAINER -->
<div class="subscribe-container">
<?php

// Message d'erreur
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) { // (1)
    $email = $_POST['email']; // (2)
    ajouterEmail($email); // (3)
}
?>

<!-- EMAIL -->
    <form method='post' action=''>
        <input type='email' name='email' placeholder='Votre adresse email' required>
        <button type='submit' name='subscribe'>Subscribe</button>
    </form>
</div>