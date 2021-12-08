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
        <style>
            /*Vue d'erreur*/
            main{
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                height: 90vh;
            }

            main h1{
                color: white;
                font-size: xxx-large;
            }

            main a.email{
                color: black;
                text-decoration: underline;
            }

            main h3{
                font-size: x-large;
            }

            main .list{
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }
        </style>
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="views/css/stylesheet.css">
        <title>Erreur interne</title>
    </head>
    <body>
        <header>
            <img src="views/ressources/images/RSS-logo.png"/>
            <h1>My RSS Website</h1>

            <button><a class="button" href="?action=init">retour en lieu sûr</a></button>
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
