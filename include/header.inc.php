<header>
    <div id="bandeau-superieur">
        <div>

            <nav>
                <i class="bi bi-list"></i>
                <ul>
                    <li>
                        <a href="./?accueil">Accueil</a>
                    </li>

                    <li>
                        <a href="./?rencontres">Rencontres</a>
                    </li>

                    <li>
                        <a href="./?conseils-de-lecture">Conseils de lecture</a>
                    </li>

                    <li>
                        <a href="./?la-librairie">La librairie</a>
                    </li>

                    <li>
                        <a href="./?contact">Contact</a>
                    </li>

                </ul>
            </nav>
        </div>

        <div id="compte">
            <ul>
                <li>
                    <?php if(isset($_SESSION["connexion-utilisateur"]) && $_SESSION["connexion-utilisateur"]) { ?>
                        <a href="./?profil&utilisateur=<?= $_SESSION["utilisateur"] ?>">Mon compte</a>
                    <?php } else { ?>
                        <a href="./?connexion">S'inscrire / Se connecter</a>
                    <?php } ?>
                </li>
            </ul>
        </div>
    </div>

    <div id="titres">
        <a href="./?accueil">
            <h1>
                <img src="./assets/img/logo/logo-c-h.svg" alt="L'Alpha-Bêtise">
            </h1>
        </a>

        <h2>Librairie spécialisée dans la littérature jeunesse</h2>
    </div>

</header>