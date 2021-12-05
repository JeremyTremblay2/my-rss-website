<?php/** Name : error.php
* Project : My RSS website
* Usefulness : error page displayed when an error occur.
* Last Modification date : 05/12/2021
* Authors : Maxime GRANET, Jérémy TREMBLAY
*/
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="css/stylesheet2.css">
        <title>Erreur interne</title>
    </head>
    <body>
        <header>
            <img src="ressources/images/RSS-logo.png"/>
            <h1>My RSS Website</h1>

            <button><a class="button" href="../index.php">retour en lieu sûr</a></button>
        </header>
        <main>
            <h1>Vous ne devriez pas être ici !!!</h1>
            <p>
                Il semblerait qu'il y a eu une erreur interne. Pour plus d'informations, contactez l'administrateur du site web à l'adresse suivante :
            </p>
            <a class="email" href="mailto: helper.RSSWEBSITE@outlook.fr">helper.RSSWEBSITE@outlook.fr</a>
            <p>
            <h3>Informations relatives à l'erreur :</h3><br>
                <div class="list">
                <?php
                if(isset($errorView)) {
                    foreach($errorView as $value) {
                        echo $value . "<br>";
                    }
                }
                else{
                    echo "cette erreur semble encore inconnue";
                }
                ?></div>
            </p>
        </main>
    </body>
</html>
