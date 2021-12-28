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
        <link type="text/css" rel="stylesheet" href="views/css/RSS1.css">
        <meta charset="utf-8">
        <title>Erreur interne</title>
    </head>
    <body>
        <header>
            <img src="views/ressources/images/RSS-logo.png"/>
            <h1>My RSS Website</h1>

            <a class="button" href=".">Revenir en lieu sûr</a>
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
