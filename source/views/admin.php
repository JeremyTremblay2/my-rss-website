<!-- Created: 05/12/2021 by maxime.granet -->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link type='text/css' rel='stylesheet' href='views/css/RSS.css'>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
        <title>My RSS Website</title>
    </head>
    <body>
        <header>
                <img src="views/ressources/images/RSS-logo.png"/>
                <h1>My RSS Website</h1>

            <div class="menu">
                <a class="button" href="?action=disconnection">Déconnection</a>
            </div>

        </header>

        <a class="accueil" href="?action=home">< Accueil</a>
        <section>
            <div class="formulaireAdmin">
                <label>Nombre de news affichées par page :</label>
                <form class="admin" name="myForm"  method="post" action="?action=changeNumberOfNews">
                    <input type=number pattern="[0-9]+" name="numberPerPage"  placeholder="number">
                    <input class="submit" type="submit" value="OK">
                </form>
                <?php
                if(isset($errorView)){
                    foreach ($errorView as $error) {
                        echo "<b>$error</b>";
                    }
                }
                ?>
            </div>
        </section>
        <article>
            <h1>Liste des flux :</h1>
            <table>
                <?php
                if (isset($viewData) && isset($numberOfRssFeed)) {
                echo "<div class='adminFlux'>";
                for ($i = 0; $i < $numberOfRssFeed; $i++) {
                    echo "<div class='listeFlux col-3'>";
                        echo "<p class='name '>" . $viewData[$i]->getName() . "</p>";
                        echo "<p class='dop'>".$viewData[$i]->getUpdateDate()."</p>";
                        $link = $viewData[$i]->getLink();
                        $linkLength = 30;
                        if(strlen($link) >$linkLength) {
                            $link = substr($link, 0, $linkLength) . " ...";
                        }
                        echo "<a class='link' href=" . $viewData[$i]->getLink() . " title='".$viewData[$i]->getLink()."'>" . $link . "</a>";
                        $id = $viewData[$i]->getId();
                        echo "<div class='adminButton'>";
                            echo "<a class='delete' href=?action=deleteRssFeed&idStream=$id><img src='views/ressources/icons/delete1.png'></a>";
                            echo "<a class='refresh' href=?action=refreshRssFeed&idStream=$id><img src='views/ressources/icons/refresh-on.png'></a>";
                        echo "</div>";
                    echo "</div>";
                }
                echo "</div>";
                }
                ?>
            </table>
            <h3>Ajouter un flux</h3>
            <form class="row1" method="post" action="?action=addRssFeed">
                    <input class="col-3" name="rssFeedName" placeholder="Nom">
                    <input class="col-6" name = "rssFeedLink" type="url" placeholder="Url">
                    <input type="submit" class="add" value="Ajouter">
            </form>
        </article>
        <?php include ("footer.php");
        ?>
    </body>
</html>