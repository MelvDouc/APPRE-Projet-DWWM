<?php
    if(isset($_SESSION["connexion-utilisateur"]) && $_SESSION["connexion-utilisateur"]) {
        $commandes = $_SESSION["commande"];
?>

<section id="mon-panier">

    <h2>Mon panier</h2>
    
    <div class="conteneur">

    <?php
        // Regrouper les doublons dans des sous-tableaux
        function array_group_by_value(array $array, $threshold = 1)
        {
            $grouped = array();
            foreach(array_count_values($array) as $value => $count)
            {
                if ($count < $threshold) continue;
                $grouped[$value] = array_intersect($array, array($value));
            }
            return $grouped;
        }
        $commandes = array_group_by_value($commandes);
        foreach ($commandes as $commande) {
            // Obtenir premier élément de chaque sous-tableau
            $livre_commande = reset($commande);
            $livre = $bdd->query("SELECT * FROM livres WHERE id = $livre_commande;")->fetch();
    ?>

        <div class="carte-livre">
        
            <h3><?= $livre["titre"] ?></h3>

            <h4><?= $livre["auteur"] ?></h4>

            <div class="illustration">
                <img src="./assets/img/book-covers/<?= $livre["image"] ?>" alt="Couverture de <?= $livre["titre"] ?>">
            </div>

            <p><?= count($commande) ?></p>

        </div>

    <?php
        }
    ?>

    </div>

</section>

<?php
    } else {
        header("Location: ./?connexion&erreur=5");
        die();
    }
?>