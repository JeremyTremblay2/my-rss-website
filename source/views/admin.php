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
                        echo "<div class='listeFlux col-2'>";
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
               /*
                    for ($i = 0; $i < $numberOfRssFeed; $i++) {
                        echo '<tr class="row">';
                        $name = $viewData[$i]->getName();
                        $length = 10;
                        if(strlen($name)>$length) {
                            $name = substr($name, 0, $length) . " ...";
                        }
                        echo "<th class='col-2' title='".$viewData[$i]->getName()."'>" . $name . "</th>";
                        $link = $viewData[$i]->getLink();
                        $linkLength = 30;
                        if(strlen($link) >$linkLength) {
                            $link = substr($link, 0, $linkLength) . " ...";
                        }
                        echo "<th class=col-5><a href=" . $viewData[$i]->getLink() . " title='".$viewData[$i]->getLink()."'>" . $link . "</a></th>";
                        echo "<th class=col-3>" . $viewData[$i]->getUpdateDate() . "</th>";
                        $id = $viewData[$i]->getId();
                        echo "<th class='col-1'><a class='refresh' href=?action=deleteRssFeed&idStream=$id><img src='views/ressources/icons/delete.png'></a></th>";
                        echo "<th class='col-1'><a class='refresh' href=?action=refreshRssFeed&idStream=$id> <img src='views/ressources/icons/refresh-on.png'> </a></th>";
                        echo '</tr>';*/
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