<!-- Created: 17/11/2021 by maxime.granet -->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="css/stylesheet.css">
        <title>My RSS Website</title>
    </head>
    <body>

        <?php
            if (isset($viewData)) {
        ?>
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
                        <input type=text pattern="[a-zA-Z0-9\d@$!%*_-#?&]+" value="<?= $viewData['username'] ?>" name="name" class="field-long" placeholder="pseudo" VALUE=<?=$dataVue['pseudo']?>>
                        <label>mot de passe :</label>
                        <input type=password pattern="[a-zA-Z0-9]+" name="password" class="field-long" placeholder="mot de passe">
                        <p><input type="submit" value="Envoyer"></p>
                </form>
            </div>
        </section>
    <?php
        }
        else {
            print ("Erreur !!<br>");
            print ("utilisation anormale de la vue");
        }
    ?>
    </body>
</html>
