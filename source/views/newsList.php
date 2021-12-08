<!-- Created: 05/12/2021 by maxime.granet -->
<?php
global $localPath, $views;
if (!isset($viewData)) {
    $errorView[] = "Veuillez ne pas accéder à cette page directement, mais admirez son contenu en allant sur index.php";
    require('error.php');
}
else {
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link type="text/css" rel="stylesheet" href="views/css/stylesheet2.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>My RSS Website</title>
</head>
<header>
    <img src="views/ressources/images/RSS-logo.png"/>
    <h1>My RSS Website</h1>

    <button><a class="button" href=<?= $views['auth']?>>Connexion</a></button>
</header>
    <body>
            <?php
                if (isset($viewData)) {
                    echo "<article>";
                    echo "<div class='row'>";
                    foreach ($viewData as $news) {
                        echo "<a href='" . $news->getLink() . "' class='col-md-3'>";
                        echo "<ul class='flux'>";
                        echo "<li class='title'>" . $news->getTitle() . "</li>";
                        echo "<li class='descr'>" . $news->getDescription() . "</li>";
                        echo "</ul>";
                        echo "<p class='dateP'>" . $news->getPublicationDate() . '</p>';
                        echo "</a>";
                    }
                }
                echo "</div>";
                echo "</article>";
                echo "<footer>";
                if (isset($numberOfPages)) {
                    for ($i = 1; $i <= $numberOfPages; $i++) {
                        echo "<a href='views/newsList.php?page='" . $i . ">" . $i . "</a> ";
                    }
                }echo "</footer>";
    }
            ?>
    </body>
</html>