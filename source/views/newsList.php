<!-- Created: 17/11/2021 by maxime.granet -->
<?php
global $localPath, $views;
echo $localPath . $views['news'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link type="text/css" rel="stylesheet" href="css/stylesheet.css">
    <title>My RSS Website</title>
</head>
<header>
    <img src="https://imgr.search.brave.com/XcnMrUqaudF1J_X_M9oulPGbTeZ-ri9MJ_N7oXbqVWI/fit/844/225/ce/1/aHR0cHM6Ly90c2Uy/Lm1tLmJpbmcubmV0/L3RoP2lkPU9JUC5y/NndKcDBkTXBRcHJm/UzJOVWxELUlRSGFF/SyZwaWQ9QXBp"/>
    <h1><a class="h1" href="newsList.php">My RSS Website</a></h1>

    <button><a class="button" href=<?= $views['auth']?>>admin</a></button>
</header>
    <body>
    <?php
        if (isset($viewData)) {
            echo '<table border="1px solid black">';
            foreach ($viewData as $news) {
                echo '<tr>';
                echo '<td>' . $news->getPublicationDate() . '</td>';
                echo '<td><a href=' . $news->getLink() . '>' . $news->getTitle() . '</a></td>';
                echo '<td>' . $news->getDescription() . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        }
        if (isset($numberOfPages)) {
            for ($i = 1; $i <= $numberOfPages; $i++) {
                echo "<a href=views/newsList.php?page=$i>$i</a> ";
            }
        }
    ?>
    </body>
</html>