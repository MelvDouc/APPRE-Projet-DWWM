<?php
    require './processing/db.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
        require './include/head.inc.html';
        if(isset($_GET["fiche-livre"])) {
    ?>
        <script src="./assets/js/fiche-livre.js" defer></script>
    <?php } ?>
    <title>L'Alpha-Bêtise - Accueil</title>
</head>

<body>

    <?php require './include/header.inc.php'; ?>

    <?php if(isset($_GET['rencontres'])) {

        require './pages/rencontres.php';

    } else if(isset($_GET['conseils-de-lecture'])) {
        
        require './pages/conseils.php';
    
    } else if(isset($_GET["contact"])) {
        
        require './pages/contact.php';
        
    } else if(isset($_GET["fiche-livre"]) && isset($_GET["id"])) {
        
        require './pages/fiche-livre.php';

    } else if(isset($_GET["connexion"])) {

        require './pages/connexion.php';

    } else if(isset($_GET["inscription"])) {
        
        require './pages/inscription.php';

    } else if(isset($_GET["confirmer-email"])) {

        require './processing/verify.php';

    } else { ?>

    <main>

        <section id="upcoming">
            <div id="carousel">
                <img src="https://picsum.photos/id/1011/200/300" alt="Slider picture 1">
                <img src="https://picsum.photos/id/1024/200/300" alt="Slider picture 2">
                <img src="https://picsum.photos/id/1042/200/300" alt="Slider picture 3">
                <img src="https://picsum.photos/id/1022/200/300" alt="Slider picture 4">
                <img src="https://picsum.photos/id/1013/200/300" alt="Slider picture 5">
            </div>
        </section>

        <section id="introduction">
            <h2>Bienvenue sur le site de la librairie Alpha-Bêtise&thinsp;!</h2>

            <div class="gradient-wrapper">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem sit corporis possimus voluptatibus
                    similique
                    officia aliquam soluta quod maxime et enim, saepe aliquid! Consectetur rem nostrum corrupti nihil
                    alias
                    voluptatum blanditiis eaque, repellat nemo aperiam. Ut quod debitis voluptate non ex commodi tenetur
                    reprehenderit dolore! Provident, perferendis dolorum vel voluptatum blanditiis distinctio veniam
                    quaerat.
                    Eius totam repudiandae nobis eveniet ad officiis quidem delectus voluptatibus optio. Illum quaerat
                    porro
                    enim eos id rem voluptatem commodi ex, incidunt, dicta repellat beatae. Quidem ab minus adipisci
                    enim,
                    possimus voluptatum natus eveniet amet quibusdam numquam! Temporibus voluptatem reprehenderit
                    accusantium
                    natus doloribus ipsam cum quod.</p>
            </div>
        </section>

        <section id="selection">
            <h2>Notre sélection du moment</h2>

            <div id="books-selection">
                <!-- templates go here -->
                <?php
                    $books = $db->query("SELECT * FROM livres");
                    while($book = $books->fetch()) {
                ?>
                    <div class="book">
                        <h3>
                            <?= $book["titre"]?>
                        </h3>
                        <div class="author">
                            <?= $book["auteur"] ?>
                        </div>
                        <p class="summary">
                            <?= $book["description"] ?>
                        </p>
                        <div class="price">
                            <?= $book["prix"] ?>&thinsp;€
                        </div>
                        <a href="./?fiche-livre&id=<?= $book["id"] ?>" class="book-page-link">Voir livre</a>
                    </div>
                <?php } ?>
            </div>

            <button>Plus de livres</button>
        </section>

        <section id="newsletter">

        </section>

    </main>

    <?php } ?>

    <?php require './include/footer.inc.html'; ?>

</body>

</html>