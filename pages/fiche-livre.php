<?php
    $livre = $bdd->query("SELECT * FROM livres WHERE id =".$_GET["id"])->fetch();
    date_default_timezone_set("Europe/Paris");
    setlocale(LC_TIME, "fr_FR", "French");
?>

<h2><?= $livre["titre"] ?></h2>

<div id="fiche-livre">
    <div class="illustration">
        <img src="./assets/img/book-covers/<?= $livre["image"] ?>" alt="Couverture du livre <?= $livre["titre"] ?>">
    </div>

    <div class="details-livre">
        <div>
            <h3>Résumé</h3>
            
            <p><?= $livre["description"] ?></p>
        
            <div class="avis-libraire">
                <h3>Avis du libraire</h3>

                <p><?= $livre["avis_libraire"] ?></p>
            </div>

            <p class="prix">
                <strong>Prix&thinsp;:</strong> <?= $livre["prix"] ?>&thinsp;€
            </p>

            <p class="editeur">
                <strong>Éditeur&thinsp;:</strong> <?= $livre["editeur"] ?>
            </p>

            <p class="disponibilite">
                <strong>Disponible&thinsp;:</strong> 
                <?php 
                    $disponible = ($livre["stock"] > 0) ? "oui" : "non";
                    echo $disponible;
                ?>
            </p>

            <p class="date-publication">
                <strong>Date de publication&thinsp;:</strong> <?= strftime("%d %B %G", strtotime($livre["date_publication"])) ?>
            </p>
        </div>

        <div class="ajouter-panier">
            <button>Ajouter au panier</button>
        </div>
    </div>

    <aside class="suggestions-livres">
        <p>D'autres livres qui pourraient vous intéresser&thinsp;:</p>

        <div>

        </div>
    </aside>
</div>

<div id="commentaires-livre">
    <div id="voir-commentaires">
        <button>Voir les commentaires clients</button>
    </div>

    <div id="commentaires-clients" style="display: none">
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eveniet harum aperiam quaerat consequuntur voluptatum nisi.</p>
        <p>Necessitatibus ipsa iure excepturi maxime, ex eos, repudiandae accusamus odit sint magni, assumenda reiciendis accusantium.</p>
        <p>Repellendus facere illum corrupti sit. Itaque deleniti id eligendi non ipsam iure suscipit voluptatibus ducimus.</p>
        <p>Recusandae sapiente amet fugit dolores adipisci, quae eius est vitae similique consequatur repudiandae consectetur doloribus.</p>
        <p>Quaerat a fuga alias quia, magni repellendus maxime omnis, sequi dicta placeat corporis, voluptatibus qui.</p>
    </div>
</div>