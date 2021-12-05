<!-- Created: 05/12/2021 by maxime.granet -->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="css/stylesheet2.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
        <title>My RSS Website</title>
    </head>
    <body>
        <header>
                <img src="ressources/images/RSS-logo.png"/>
                <h1>My RSS Website</h1>
                
                <button><a class="button" href="login.php">déconnection</a></button>
        </header>

        <a class="accueil" href="../index.php"><-Accueil</a>
        <section>
            <div class="formulaireAdmin">
                <label>Nombre de ligne par page :</label>
                <form class="admin" name="myForm"  method="post" action="../controllers/UserController.php?action=valider">
                    <input type=number pattern="[0-9]+" name="nbByPage" class="field-long" placeholder="number">
                    <input class="submit" type="submit" value="OK">
                </form>
                <?php
                if(isset($tabErr)){
                    echo "<p>{$tabErr}</p>";
                }
                /*require("../Classes/Validation.php");
                $e = new Validation();
                $msg = '';
                $deb = '<div class="error"><div class="txt">';
                $fin = '</div></div>';
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $msg = $deb;
                    $nb = 0;
                    $err = $e->entier((int)$_POST["nbByPage"]);
                    if ($err != null){
                        $msg .= 'Nombre de ligne par page : ';
                        $msg .= $err;
                        $nb = 1;
                    }
                    $err = $e->entier((int)$_POST["nbTotal"]);
                    if ($err != null){
                        $msg .= 'Nombre de flux RSS retenu au total : ';
                        $msg .= $err;
                        $nb = 1;
                    }
                    $msg .= $fin;
                    if($nb==0){
                        $msg='';
                    }
                    echo $msg;
                }*/

                ?>
            </div>
        </section>
        <article>
            <h1>Liste des flux :</h1>
            <table>
                <tr class="row">
                    <th class="col-3">Nom</th>
                    <th class="col-5">url</th>
                    <th class="col-2">date</th>
                    <th class="col-2">supprimer</th>
                </tr>
                <tr class="row">
                    <td class="col-3">Nom</td>
                    <td class="col-5">url</td>
                    <td class="col-2">date</td>
                    <td class="col-2"><a class="sup" href="">X</a></td>
                </tr>
                <tr class="row">
                    <td class="col-3">Nom</td>
                    <td class="col-5">url</td>
                    <td class="col-2">date</td>
                    <td class="col-2"><a class="sup" href="">X</a></td>
                </tr>
                <tr class="row">
                    <td class="col-3">Nom</td>
                    <td class="col-5">url</td>
                    <td class="col-2">date</td>
                    <td class="col-2"><a class="sup" href="">X</a></td>
                </tr>
            </table>
            <h3>Ajouter un flux</h3>
            <div class="row1">
                    <input class="col-3" type="text" placeholder="Nom">
                    <input class="col-5" type="url" placeholder="Url">
                    <input class="col-2" type="date" placeholder="Date">
                    <button class="add">Ajouter</button>
            </div>
        </article>
    </body>
</html>