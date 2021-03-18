<?php
    $book = $db->query("SELECT * FROM livres WHERE id =".$_GET["id"])->fetch();
    date_default_timezone_set("Europe/Paris");
    setlocale(LC_TIME, "fr_FR", "French");
    // echo "<pre>";
    // var_dump($book["auteur"]);
    // echo "</pre>";
?>


<main>

    <h2>
        <?= $book["titre"] ?>
    </h2>

    <div id="book-page-main">
        <div class="illustration">
            <img src="./assets/img/book-covers/<?= $book["image"] ?>" alt="Couverture du livre <?= $book["titre"] ?>">
        </div>

        <div class="book-details">
            <div>
                <h3>Résumé</h3>
                
                <p>
                    <?= $book["description"] ?>
                </p>
            
                <div class="seller-blurb">
                    <h3>Avis du libraire</h3>

                    <p>
                        <?= $book["avis_libraire"] ?>
                    </p>
                </div>

                <p class="price">
                    <strong>Prix&thinsp;:</strong> <?= $book["prix"] ?>&thinsp;€
                </p>

                <p class="publisher">
                    <strong>Éditeur&thinsp;:</strong> <?= $book["editeur"] ?>
                </p>

                <p class="availability">
                    <strong>Disponible&thinsp;:</strong> 
                    <?php 
                        $available = ($book["stock"] > 0) ? "oui" : "non";
                        echo $available;
                    ?>
                </p>

                <p class="publish-date">
                    <strong>Date de publication&thinsp;:</strong> <?= strftime("%d %B %G", strtotime($book["date_publication"])) ?>
                </p>
            </div>

            <div class="add_to_cart">
                <button>Ajouter au panier</button>
            </div>
        </div>

        <aside class="book-suggestions">
            <p>D'autres livres qui pourraient vous intéresser&thinsp;:</p>

            <div>

            </div>
        </aside>
    </div>

    <div id="book-page-comments">
        <div id="view-comments">
            <button>Voir les commentaires clients</button>
        </div>

        <div id="customer-comments" style="display: none">
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eveniet harum aperiam quaerat consequuntur voluptatum nisi.</p>
            <p>Necessitatibus ipsa iure excepturi maxime, ex eos, repudiandae accusamus odit sint magni, assumenda reiciendis accusantium.</p>
            <p>Repellendus facere illum corrupti sit. Itaque deleniti id eligendi non ipsam iure suscipit voluptatibus ducimus.</p>
            <p>Recusandae sapiente amet fugit dolores adipisci, quae eius est vitae similique consequatur repudiandae consectetur doloribus.</p>
            <p>Quaerat a fuga alias quia, magni repellendus maxime omnis, sequi dicta placeat corporis, voluptatibus qui.</p>
        </div>
    </div>


</main>