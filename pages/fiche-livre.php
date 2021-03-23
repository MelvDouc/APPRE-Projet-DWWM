<?php
    $livre = $bdd->query("SELECT * FROM livres WHERE id =".$_GET["id"])->fetch();
    setlocale(LC_TIME, "fr_FR", "French");
?>

<h2><?= $livre["titre"] ?></h2>

<section id="fiche-livre">
    
    <div class="illustration">
        <img src="./assets/img/book-covers/<?= $livre["image"] ?>" alt="Couverture du livre <?= $livre["titre"] ?>">
    </div>

    <div class="resume">
        <h3>Résumé</h3>
        
        <p><?= $livre["description"] ?></p>
    </div>

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

    <form action="./traitement/traitement.php?ajout-panier" method="POST" class="ajouter-panier">
        <input type="hidden" name="id_livre" value="<?= $livre["id"] ?>">
        <button type="submit">Ajouter au panier</button>
    </form>

    <aside class="suggestions-livres">
        <p>D'autres livres qui pourraient vous intéresser&thinsp;:</p>

        <div>

        </div>
    </aside>
</section>

<div id="commentaires-livre">
    <div id="voir-commentaires">
        <button>Voir les commentaires clients</button>
    </div>

    <div id="commentaires-clients" style="display: none">
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut deserunt, itaque laborum officia aperiam repellendus ex cupiditate. Quos aperiam voluptatibus autem quibusdam tempore alias suscipit mollitia eum cupiditate repudiandae! Veniam eius corrupti dolore fuga minima quia, facere vitae, asperiores tenetur perspiciatis vel, expedita nulla? Autem assumenda suscipit laudantium animi. Fugiat dolorem hic doloremque mollitia natus molestias itaque quidem totam nostrum porro doloribus voluptate accusantium cupiditate nulla, sit pariatur saepe optio delectus, consequatur adipisci! Eius incidunt deserunt pariatur porro esse dignissimos, ex unde. Nulla neque eum facilis sequi dolorum voluptatibus, asperiores nobis cupiditate labore suscipit delectus mollitia excepturi reiciendis obcaecati quam alias placeat cum, facere similique aspernatur ipsum officiis autem. Deleniti quisquam veniam repellendus numquam quis quos harum quam autem placeat tempore eum, delectus, iusto qui id voluptates aperiam laborum sit at, expedita blanditiis velit. Quae asperiores quas veniam, et sapiente voluptas animi adipisci nemo sit fugit, minus commodi! Incidunt, vel!</p>
        <p>Inventore nostrum laudantium rem accusantium dolorem optio quisquam obcaecati eius? Sit dolorem aut assumenda laborum quo corporis incidunt nulla eveniet soluta, omnis fuga accusantium repudiandae accusamus facilis quae nostrum eaque. Hic dolor itaque eius molestias adipisci rerum dignissimos molestiae voluptatem quibusdam rem alias, impedit ut est deleniti dolores quasi reprehenderit facilis, quaerat aspernatur nulla iusto ducimus consequatur! Dicta hic eaque sint corporis veritatis, sequi tempore earum molestias voluptas. Temporibus earum dolor in vel impedit veniam iure dolore reprehenderit debitis facere! Voluptate dignissimos porro quod hic, nulla iste ab atque, exercitationem nisi quaerat ipsam dolorem eveniet aut vitae similique aliquid laboriosam officiis, doloremque et nostrum at omnis! Cum debitis tempora ducimus aliquid at tenetur sit, repellat quia dignissimos quis itaque corrupti rerum ab nisi soluta delectus voluptas alias expedita vitae! Eaque ducimus architecto cupiditate. Molestiae labore commodi molestias earum quod! Inventore repudiandae cupiditate fugiat dicta fugit quos dolor explicabo illum earum.</p>
        <p>Inventore, doloremque. Similique atque eligendi esse nulla quaerat, rem reprehenderit minus, nesciunt cumque itaque vel hic a aliquam consectetur sapiente accusamus labore exercitationem porro impedit libero corporis sequi totam! Modi illo labore nisi deleniti ut voluptate natus architecto consectetur eum inventore officia ratione vero, pariatur totam culpa, expedita officiis minus quasi at minima consequuntur tempora? Ullam velit numquam delectus dolorum maiores, doloremque vel, ratione voluptate soluta quaerat excepturi dolorem a. In fuga excepturi adipisci modi numquam neque cumque incidunt, esse, perspiciatis, minima voluptatem ad itaque quod. Natus reprehenderit quidem praesentium possimus voluptatem provident velit quas odit asperiores cum exercitationem soluta dolorem animi eos accusantium a qui eum ab esse, earum nesciunt corporis libero? Delectus, voluptas. Asperiores ex, maxime animi, voluptates quaerat autem deserunt beatae obcaecati repellat natus vel minus id ipsam voluptate saepe sed repellendus cumque. Tempora quia esse deleniti assumenda, exercitationem pariatur ipsa quod animi, obcaecati nihil impedit quos.</p>
        <p>Voluptatibus animi hic quasi ducimus, doloremque natus incidunt magnam nulla aliquid neque ex, magni similique deserunt optio. Suscipit fugit, temporibus excepturi, labore vitae voluptate dolore necessitatibus sunt ipsa, voluptas assumenda! Totam, eveniet. Odio nemo consequatur voluptas, sed voluptatem, enim nulla doloribus accusantium minus earum doloremque non, aliquam numquam animi nam dolorem? Aliquid ratione neque dolore non reiciendis laudantium deleniti saepe ducimus aperiam veniam reprehenderit beatae aliquam explicabo nostrum voluptatum fuga, molestiae eos tempora libero, animi quidem amet sunt. Laboriosam possimus nihil repellat similique quis vel iusto aut, nisi non modi delectus aliquid ut sit necessitatibus minus debitis? Minima sint illo maxime error alias harum voluptate tempore similique magnam laborum ipsam aut, corporis nemo rerum animi voluptatem nulla earum ab doloremque, dolorum quo expedita explicabo? Excepturi, ab distinctio, dolor facere itaque iure rerum aliquam porro voluptas expedita earum reiciendis. Enim praesentium dignissimos sed aspernatur quaerat eos necessitatibus officia veritatis aperiam similique.</p>
        <p>Id, dignissimos magni odit explicabo aspernatur beatae perferendis reprehenderit pariatur molestiae labore, consequatur facilis! Optio porro doloremque nulla, illum perspiciatis facilis ea iusto minus ab non iure temporibus ipsum. Aspernatur veritatis rerum aperiam officia odit facere soluta reprehenderit maiores ex qui, quasi commodi temporibus. Quidem, similique voluptates voluptatibus quis repellendus beatae, labore repudiandae consequatur voluptas totam, reiciendis facilis eum! Modi expedita quos exercitationem excepturi quas impedit enim voluptates aut. Esse sit magni architecto fugit non repellendus aliquid rerum facere voluptatem vero reprehenderit, ex error tempora ipsam sed nobis dolores sint, at necessitatibus iste explicabo rem. Distinctio veniam nemo, explicabo fugit voluptas officia minus, illo nobis esse ullam omnis voluptatum, blanditiis sunt ea sapiente. Nam nihil earum amet blanditiis facere fugit laboriosam voluptates pariatur deleniti consequatur quas minima sapiente numquam labore voluptatum assumenda fugiat dolorem tenetur quisquam quasi, nostrum, nulla obcaecati! Mollitia, cum? Recusandae sint excepturi qui dolores, deserunt rerum non?</p>
    </div>
</div>