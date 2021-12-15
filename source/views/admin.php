<!-- Created: 05/12/2021 by maxime.granet -->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="views/css/RSS1.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
        <title>My RSS Website</title>
    </head>
    <body>
        <header>
                <img src="views/ressources/images/RSS-logo.png"/>
                <h1>My RSS Website</h1>
                
                <a class="button" href="?action=disconnection">Déconnection</a>
        </header>

        <a class="accueil" href="?action=home"><-Accueil</a>
        <section>
            <div class="formulaireAdmin">
                <label>Nombre de ligne par page :</label>
                <form class="admin" name="myForm"  method="post" action="?action=changeNumberOfNews">
                    <input type=number pattern="[0-9]+" name="numberPerPage" class="field-long" placeholder="number">
                    <input class="submit" type="submit" value="OK">
                </form>
                <?php
                if(isset($tabErr)){
                    echo "<p>{$tabErr}</p>";
                }
                ?>
            </div>
        </section>
        <article>
            <h1>Liste des flux :</h1>
            <table>
                <?php
                $rssFeedModel = new RssFeedModel();
                $numberOfRssFeed = $rssFeedModel->getNumberOfRssFeeds();
                $viewData = $rssFeedModel->getAllRssFeed();
                if (isset($viewData) && isset($numberOfRssFeed)) {
                    echo '<tr class="row">';
                    echo '<th class="col-3">Nom</th>';
                    echo '<th class="col-5">Lien du flux</th>';
                    echo '<th class="col-2">Date de dernière modification</th>';
                    echo '<th class="col-2">Supprimer</th>';
                    echo '</tr>';

                    for ($i = 0; $i < $numberOfRssFeed; $i++) {
                        echo '<tr class="row">';
                        echo "<th class='col-3'>" . $viewData[$i]->getName() . "</th>";
                        echo "<th class=col-5>" . $viewData[$i]->getLink() . "</th>";
                        echo "<th class=col-2>" . $viewData[$i]->getUpdateDate() . "</th>";
                        $id = $viewData[$i]->getId();
                        echo '<td class="col-2">';
                        echo "<a class='sup' href=?action=deleteRssFeed&idStream=$id>" . 'X' . "</a>";
                        echo '</td>';
                        echo '</tr>';
                    }
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
    </body>
</html>