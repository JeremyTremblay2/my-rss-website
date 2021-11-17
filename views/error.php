/** Name : error.php
* Project : My RSS website
* Usefulness : error page displayed when an error occur.
* Last Modification date : 17/11/2021
* Authors : Maxime GRANET, Jérémy TREMBLAY
*/

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Erreur interne</title>
    </head>
    <body>
        <header>
            <!-- Add content here -->
        </header>
        <main>
            <h1>Erreur, vous ne devriez pas être ici</h1>
            <p>
                Il semblerait qu'il y a eu une erreur interne. Pour plus d'informations, contactez l'administrateur du site web.
            </p>
            <p>
                Informations relatives à l'erreur :
                <?php
                if(isset($errorView)) {
                    foreach($errorView as $value) {
                        echo $value . "<br />";
                    }
                }
                ?>
            </p>
        </main>
        <footer>
            <!-- Add content here -->
        </footer>
    </body>
</html>
