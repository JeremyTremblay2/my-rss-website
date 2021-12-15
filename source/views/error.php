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
            body{
                background-image: linear-gradient(to bottom,#e0cc91,lightgrey );
                background-repeat: repeat-x;
                min-height: 98vh;
            }

            header{
                display: flex;
                justify-content: space-between;
                flex-direction: row;
                align-items: center;
                height: 100px;
            }

            header img{
                width: 10%;
            }

            header h1 {
                text-decoration: none;
                justify-content: center;
                color: white;
            }

            header a.button{
                display: flex;
                transition: 0.5s;
                justify-content: center;
                border:2px solid rgb(167, 89, 17);
                border-radius: 12px;
                height: 30px;
                width : 10%;
                min-width: 100px;
                margin: 0 10px 0 0;
                background-color: white;
                text-decoration: none;
                color: rgb(167, 89, 17);
                font-size: 1rem;
            }

            header .button:hover{
                transition: 0.5s;
                background-color: rgb(167, 89, 17);
                transition: 0.5s;
                font-weight: bold;
                color: white;
            }

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
        <title>Erreur interne</title>
    </head>
    <body>
        <header>
            <img src="views/ressources/images/RSS-logo.png"/>
            <h1>My RSS Website</h1>

            <a class="button" href="?action=connection">Connexion</a>
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
