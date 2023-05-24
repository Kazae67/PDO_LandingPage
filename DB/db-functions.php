<!-- Conteneur offres -->
<div class="pricing-container">
<?php

function connection(){
$host = 'localhost';
$dbname = 'pricing';
$username = 'root';
$password = '';
try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
    } catch (PDOException $err) {
        echo "Erreur de connexion à la base de données : " . $err->getMessage();
        exit;
    }
}

function ajouterCommande(){
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $db = connection();
        // Vérification des données envoyées
        foreach ($_POST['commande'] as $formule => $commande) {
            $query = "UPDATE pricing_db SET commande = :commande WHERE formule = :formule";
            $update = $db->prepare($query);
            $commande = intval($commande) + 1;
            $update->bindParam(':commande', $commande);
            $update->bindParam(':formule', $formule);
            $update->execute();
        }
    }
}


function updateForm(){
    if (isset($_POST['update'])) { 
        $db = connection();
        // Vérification des données envoyées
        $formule = $_POST['name'];
        $prix = $_POST['price'];
        $reduction = $_POST['sale'];
        $bandwidth = $_POST['bandwidth'];
        $onlinespace = $_POST['onlinespace'];
        $support = $_POST['support'] == 'Yes' ? 1 : 0;
        $domain = $_POST['domain'];
        $hidden_fees = $_POST['hidden_fees'] == 'Yes' ? 1 : 0;
        $commande = $_POST['commande'];
    
        $query = "UPDATE pricing_db SET prix = :prix, reduction = :reduction, bandwidth = :bandwidth, onlinespace = :onlinespace, support = :support, domain = :domain, hidden_fees = :hidden_fees, commande = :commande WHERE formule = :formule";
        $update = $db->prepare($query);
        $update->bindParam(':prix', $prix);
        $update->bindParam(':reduction', $reduction);
        $update->bindParam(':bandwidth', $bandwidth);
        $update->bindParam(':onlinespace', $onlinespace);
        $update->bindParam(':support', $support);
        $update->bindParam(':domain', $domain);
        $update->bindParam(':hidden_fees', $hidden_fees);
        $update->bindParam(':formule', $formule);
        $update->bindParam(':commande', $commande);
        $update->execute();
        // Message de validation de la modification formulaire
        if($update->rowCount() > 0){
            echo "Vous avez bien modifié votre formule";
            header("Location: public/index.php");
            exit;
        }else{
            echo "Malheuresement vous n'avez pas réussi à modifier votre formule";
        }
    }
}

// Affichage index

function affichage(){

    $query = "SELECT * FROM pricing_db";
    $result = connection()->query($query);
    if ($result->rowCount() > 0) {
        
        /**
         * La boucle while ($row = $result->fetch(PDO::FETCH_ASSOC)) parcourt chaque ligne de résultat de la requête. 
         * Les valeurs des colonnes sont assignées à des variables appropriées telles que $formule, $prix, $mois, etc. 
         * Des conditions sont utilisées pour afficher la réduction sur chaque formule tarification, 
         * telles que la réduction, la bande passante, l'espace en ligne, le support, le domaine, les frais cachés, etc.
         * ainsi que des symboles de vérification ou de croix en fonction des caractéristiques telles que la bande passante, l'espace en ligne, le support, le domaine, les frais cachés, etc. 
         */
        $db = connection();
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
    
            /**
             * Les caractéristiques de chaque formule de tarification sont affichées à l'aide d'instructions echo. 
             * Des conditions sont utilisées pour afficher les caractéristiques de chaque formule de tarification, 
             * telles que la réduction, la bande passante, l'espace en ligne, le support, le domaine, les frais cachés, etc.
             */
            echo "<div class='pricing-box'>";
            echo "<h2>$formule</h2>";
            echo "<p><span class='prix'>$$prix<span class='month'>/$mois</span></p>";
            // Condition pour afficher la réduction sur chaque formule 
            if ($afficherReduction && $reduction >= 0) {
                if ($formule == "Starter") { // Vérifier si c'est la formule "Advanced"
                    echo "<p class='reduction'>$reduction%<br>sale</p>";
                } elseif ($formule == "Advanced") { // Vérifier si c'est la formule "Starter".
                    echo "<p class='reduction'>$reduction%<br>sale</p>";
                } elseif ($formule == "Professional") { // Vérifier si c'est la formule "Professional".
                    echo "<p class='reduction'>$reduction%<br>sale</p>";
                } else {
                    echo "<p>Réduction : -$reduction %</p>"; // Décimal en 5,2 dans la BDD pour le % de la réduction.
                }
            }
            /**
             * Ce code crée un tableau multidimensionnel appelé $features qui contient des caractéristiques de chaque formule de tarification. 
             * Chaque élément du tableau représente une caractéristique et contient trois clés : 'label', 'value' et 'symbol'.
             * La clé 'label' représente le nom de la caractéristique.
             * La clé 'value' représente la valeur de la caractéristique.
             * La clé 'symbol' représente un symbole qui indique si la caractéristique est présente ou non. 
             * Si la valeur de la caractéristique est supérieure à zéro, le symbole affiché est '✓', sinon il est '×'.
             */
            $features = [
                ['label' => 'Bandwidth', 'value' => $bandwidth, 'symbol' => ($bandwidth > 0 ? '✓' : '×')],
                ['label' => 'Onlinespace', 'value' => $onlinespace, 'symbol' => ($onlinespace > 0 ? '✓' : '×')],
                ['label' => 'Support', 'value' => ($support ? 'Yes' : 'No'), 'symbol' => ($support ? '✓' : '×')],
                ['label' => 'Domain', 'value' => ($domain > 0 ? $domain : '0'), 'symbol' => ($domain > 0 ? '✓' : '×')],
                ['label' => 'Hidden fees', 'value' => ($hidden_fees ? 'Yes' : 'No'), 'symbol' => ($hidden_fees ? '✓' : '×')],
            ];
            
            /**
             * Ce code utilise une boucle foreach pour parcourir le tableau $features et afficher les caractéristiques de chaque formule de tarification.
             * À l'intérieur du paragraphe, il y a deux éléments <span> avec les classes CSS 'label' et 'value'. 
             * Le premier élément <span> affiche le nom de la caractéristique, qui est extrait de la clé 'label' de l'élément $feature. 
             * Le deuxième élément <span> affiche la valeur de la caractéristique, qui est extraite de la clé 'value' de l'élément $feature.
             * il y a un autre élément <span> avec une classe CSS dynamique. La classe est déterminée en fonction du symbole de la caractéristique. 
             * Si le symbole est '✓', la classe sera 'symbol-vert', sinon elle sera 'symbol-rouge '×''. 
             * Cela permet d'appliquer une couleur différente au symbole en fonction de sa valeur.
             */
            foreach ($features as $feature) {
                echo "<p><span class='label'>{$feature['label']}</span><span class='value'>{$feature['value']} <span class='symbol-" . ($feature['symbol'] === '✓' ? 'vert' : 'rouge') . "'>{$feature['symbol']}</span></span></p>";
            }
            /**
             * Un formulaire de commande est affiché pour chaque formule, avec un bouton "Join Now" pour soumettre le formulaire.
             * L'attribut method du formulaire est défini sur "post" et l'attribut action est laissé vide pour soumettre le formulaire à la même page.
             */
            echo "<form method='post' action=''>";
            echo "<p>commande : <span id='commande-$formule'>$commande</span></p>";
            echo "<input type='hidden' name='commande[$formule]' value='$commande'>";
            // Bouton join now
            echo "<button class='join-button' type='submit' name='update' value='Update'>Join Now</button>";
            echo "</form>";
            echo "</div>";
        }
    } else {
        // Enfin, si aucune formule de tarification n'est trouvée dans la base de données, un message indiquant qu'aucune formule n'a été trouvée est affiché.
        echo "Aucune formule de la base de données pricing trouvée.";
    }
}

?>

</div>
