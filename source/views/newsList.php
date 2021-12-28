<!-- Created: 05/12/2021 by maxime.granet -->
<?php
global $localPath, $views;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link type="text/css" rel="stylesheet" href="views/css/RSS1.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>My RSS Website</title>
</head>
<header>
    <img src="views/ressources/images/RSS-logo.png"/>
    <h1>My RSS Website</h1>

    <a class="button" href="?action=connection">Connexion</a>
</header>
    <body>
            <?php
                if (isset($viewData)) {
                    echo "<article class='accueil'>";
                    echo "<div class='row'>";
                    foreach ($viewData as $news) {
                        echo "<a href='" . $news->getLink() . "' class='col-md-3'>";
                        echo "<ul class='flux'>";
                        $title = $news->getTitle();
                        $length = 70;
                        if(strlen($title)>$length) {
                            $title = substr($title, 0, $length) . " ...";
                        }
                        echo "<li class='title'>" . $title  . "</li>";
                        $descr = $news->getDescription();
                        $lengthDescr = 200;
                        if(strlen($descr)>$lengthDescr) {
                            $descr = substr($descr, 0, $lengthDescr) . " ...";
                        }
                        echo "<li class='descr'>" . $descr . "</li>";
                        echo "</ul>";
                        echo "<p class='dateP'>" . $news->getPublicationDate() . '</p>';
                        echo "</a>";
                    }
                }
                echo "</div>";
                echo "</article>";
                echo "<div class='navig'>";
                if (isset($numberOfPages) && isset($currentPage)) {
                    if ($currentPage == 1) {
                        echo " <strong>$currentPage</strong>&nbsp;";
                        if ($currentPage < $numberOfPages) {
                            if ($currentPage < ($numberOfPages - 1)) {
                                $pageAfter = $currentPage + 1;
                                echo "<a href=?page=$pageAfter>" . '&gt;' . "</a>";
                            }
                            echo "<a href=?page=$numberOfPages>" . $numberOfPages . "</a>";
                        }
                    }
                    else {
                        echo "<a href='?page=1'>1</a>";
                        if ($currentPage == 2) {
                            echo " <strong>$currentPage</strong>&nbsp;";
                            if ($currentPage < $numberOfPages) {
                                if ($currentPage < ($numberOfPages - 1)) {
                                    $pageAfter = $currentPage + 1;
                                    echo "<a href=?page=$pageAfter>" . '&gt;' . "</a>";
                                }
                                echo "<a href=?page=$numberOfPages>" . $numberOfPages . "</a>";
                            }
                        }
                        else if ($currentPage > 2) {
                            $pageBefore = $currentPage - 1;
                            echo "<a href=?page=$pageBefore>" . '&lt;' . "</a> ";
                            echo " <strong>$currentPage</strong>&nbsp;";
                            if ($currentPage < ($numberOfPages - 1)) {
                                $pageAfter = $currentPage + 1;
                                echo "<a href=?page=$pageAfter>" . '&gt;' . "</a>";
                                echo "<a href=?page=$numberOfPages>" . $numberOfPages . "</a>";
                            }
                            else if ($currentPage < $numberOfPages) {
                                echo "<a href=?page=$numberOfPages>" . $numberOfPages . "</a>";
                            }
                        }
                    }
                }
                echo "</div>";
            ?><footer>

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