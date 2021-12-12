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
                /*background-image: url("https://imgr.search.brave.com/sDA-IJzo6udlVvcM3FXQ4sWFuPVyxyAxvoBg5XkgizU/fit/844/225/ce/1/aHR0cHM6Ly90c2Uy/Lm1tLmJpbmcubmV0/L3RoP2lkPU9JUC5R/LUh5WUlaazhWMVBZ/RWMwMV9QTEF3SGFF/SyZwaWQ9QXBp");
                background-repeat: repeat-x;
                width: 100vh;
                height: 100vh;*/
                background-image: linear-gradient(to bottom,#346291e0,lightgrey );
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

            header button{
                transition: 1s;
                border:2px solid rgb(167, 89, 17);
                border-radius: 12px;
                height: 30px;
                margin: 0 10px 0 0;
            }

            header button a.button{
                transition: 1s;
                background-color: transparent;
                text-decoration: none;
                color: rgb(167, 89, 17);
                font-size: 1rem;
            }

            header button:hover{
                transition: 1s;
                background-color: rgb(167, 89, 17);
            }

            header button:hover > a{
                transition: 1s;
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
        <link type="text/css" rel="stylesheet" href="views/css/stylesheet.css">
        <title>Erreur interne</title>
    </head>
    <body>
        <header>
            <img src="views/ressources/images/RSS-logo.png"/>
            <h1>My RSS Website</h1>

            <button><a class="button" href="?action=home">retour en lieu sûr</a></button>
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
