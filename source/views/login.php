<!-- Created: 05/12/2021 by maxime.granet -->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="views/css/RSS1.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
        <title>My RSS Website</title>
    </head>
    <body>
    <?php
    if (!isset($viewData)) {
        $viewData = array(
            'username' => "",
            'password' => ""
        );
    }
    ?>
        <header>
            <img src="views/ressources/images/RSS-logo.png"/>
            <h1>My RSS Website</h1>

            <a class="button" href="?action=home">Accueil</a>
        </header>
        <section id="login">
            <div class="formulaire">
                <h1>Connexion</h1>
                    <form name="myForm" method="post" action="?action=connectionClick">
                        <label>Pseudo :</label>
                        <input type=text pattern="[a-zA-Z0-9\d@$!%*_-#?&]+" name="name" class="field-long" placeholder="pseudo">
                        <label>Mot de passe :</label>
                        <input type=password name="password" class="field-long" placeholder="mot de passe">
                        <input class="validation" type="submit" value="Envoyer">
                        <?php
                        if (isset($errorView) && count($errorView)>0) {
                            echo "<div class='error'>";
                            echo "<div class='txt'>";
                            foreach ($errorView as $error) {
                                echo $error . "<br />";
                            }
                            echo "</div></div>";
                        }
                        ?>
                </form>
            </div>
        </section>
        <footer>

            <div class="help"></div>
            <div class="footRow">
                <a class="footOne" href="https://www.linkedin.com/in/maxime-granet">
                    <img src="views/ressources/images/linkedIn.png">
                    <ul>
                        <li>GRANET Maxime</li>
                        <li>DUT informatique</li>
                        <li>Expert HTML/CSS</li>
                    </ul>
                </a>
                <a class="footTwo" href="https://www.linkedin.com/in/j%C3%A9r%C3%A9my-tremblay2">
                    <img src="views/ressources/images/linkedIn.png">
                    <ul>
                        <li>TREMBLAY Jeremy</li>
                        <li>DUT informatique</li>
                        <li>Expert PHP</li>
                    </ul>
                </a>
            </div>
        </footer>
    </body>
</html>
