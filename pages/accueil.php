<section id="evenements-futurs">
    <div id="carousel">
        <img src="https://picsum.photos/id/1011/200/300" alt="Slider picture 1">
        <img src="https://picsum.photos/id/1024/200/300" alt="Slider picture 2">
        <img src="https://picsum.photos/id/1042/200/300" alt="Slider picture 3">
        <img src="https://picsum.photos/id/1022/200/300" alt="Slider picture 4">
        <img src="https://picsum.photos/id/1013/200/300" alt="Slider picture 5">
    </div>
</section>

<section id="presentation">
    <h2>Bienvenue sur le site de la librairie Alpha-Bêtise&thinsp;!</h2>

    <div class="contenu">
        <div class="conteneur-degrade">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem sit corporis possimus voluptatibus similique officia aliquam soluta quod maxime et enim, saepe aliquid! Consectetur rem nostrum corrupti nihil alias voluptatum blanditiis eaque, repellat nemo aperiam. Ut quod debitis voluptate non ex commodi tenetur reprehenderit dolore! Provident, perferendis dolorum vel voluptatum blanditiis distinctio veniam quaerat. Eius totam repudiandae nobis eveniet ad officiis quidem delectus voluptatibus optio. Illum quaerat porro enim eos id rem voluptatem commodi ex, incidunt, dicta repellat beatae. Quidem ab minus adipisci enim, possimus voluptatum natus eveniet amet quibusdam numquam! Temporibus voluptatem reprehenderit accusantium natus doloribus ipsam cum quod.</p>
        </div>
    </div>
</section>

<section id="selection">
    <h2>Notre sélection du moment</h2>

    <div class="contenu">

        <div id="selection-livres">
            <!-- templates go here -->
            <?php $livres = $bdd->query("SELECT * FROM livres");
            while($livre = $livres->fetch()) { ?>
                
                <div class="livre">
                    <h3><?= $livre["titre"]?></h3>
                    <div class="auteur">
                        <?= $livre["auteur"] ?>
                    </div>
                    <p class="resume"><?= $livre["description"] ?></p>
                    <div class="prix">
                        <?= $livre["prix"] ?>&thinsp;€
                    </div>
                    <a href="./?fiche-livre&id=<?= $livre["id"] ?>" class="lien-fiche-livre">Voir livre</a>
                </div>

            <?php } ?>
        </div>

        <button>Plus de livres</button>
    </div>
</section>

<section id="newsletter">

</section>