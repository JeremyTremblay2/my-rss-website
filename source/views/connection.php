<!-- Created: 05/12/2021 by maxime.granet -->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="css/stylesheet2.css">
        <title>My RSS Website</title>
    </head>
    <body>
    <?php
    /*$viewData = array(
            'username' => "",
            'password' => "",
            'data'=>"",
        );*/
    if (isset($viewData)) {

        ?>
        <header>
            <img src="ressources/images/RSS-logo.png"/>
            <h1>My RSS Website</h1>

            <button><a class="button" href="newsList.php">Accueil</a></button>
        </header>
        <?php
            if (isset($errorViews) && count($errorViews)>0) {
                echo "<h2>ERREUR !!!!!</h2>";
                foreach ($errorViews as $error) {
                    echo $error . "<br />";
                }
            }
        ?>
                <?= $viewData['data']  ?>
        <section>
            <div class="formulaire">
                <h1>Connexion</h1>
                    <form name="myForm" method="post" action="../controllers/UserController.php?action=connection">
                        <label>pseudo :</label>
                        <input type=text pattern="[a-zA-Z0-9\d@$!%*_-#?&]+" value="<?= $viewData['username'] ?>" name="name" class="field-long" placeholder="pseudo" VALUE=<?=$viewData['username']?>>
                        <label>mot de passe :</label>
                        <input type=password pattern="[a-zA-Z0-9]+" name="password" class="field-long" placeholder="mot de passe">
                        <p><input type="submit" value="Envoyer"></p>
                </form>
            </div>
        </section>
    <?php
        }
    ?>
    </body>
</html>
