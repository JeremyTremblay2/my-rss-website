<!-- Created: 05/12/2021 by maxime.granet -->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="views/css/stylesheet1.css">
        <title>My RSS Website</title>
    </head>
    <body>
    <?php
    $viewData = array(
            'username' => "",
            'password' => "",
            'data'=>"",
        );
    if (isset($viewData)) {

        ?>
        <header>
            <img src="views/ressources/images/RSS-logo.png"/>
            <h1>My RSS Website</h1>

            <button><a class="button" href="?action=home">Accueil</a></button>
        </header>

                <?= $viewData['data']  ?>
        <section>
            <div class="formulaire">
                <h1>Connexion</h1>
                    <form name="myForm" method="post" action="?action=connectionClick">
                        <label>pseudo :</label>
                        <input type=text pattern="[a-zA-Z0-9\d@$!%*_-#?&]+" value="<?= $viewData['username'] ?>" name="name" class="field-long" placeholder="pseudo" VALUE=<?=$viewData['username']?>>
                        <label>mot de passe :</label>
                        <input type=password pattern="[a-zA-Z0-9]+" name="password" class="field-long" placeholder="mot de passe">
                        <input class="validation" type="submit" value="Envoyer">
                        <?php
                        if (isset($errorViews) && count($errorViews)>0) {
                            echo "<div class='error'>";
                            echo "<h2>ERREUR !!!!!</h2>";

                            echo "<div class='txt'>";
                            foreach ($errorViews as $error) {
                                echo $error . "<br />";
                            }
                            echo "</div></div>";
                        }
                        ?>
                </form>
            </div>
        </section>
    <?php
        }
    ?>
    </body>
</html>
