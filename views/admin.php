<!-- Created: 17/11/2021 by maxime.granet -->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="css/stylesheet.css">
        <title>My RSS Website</title>
    </head>
    <body>
        <header>
                <img src="https://imgr.search.brave.com/XcnMrUqaudF1J_X_M9oulPGbTeZ-ri9MJ_N7oXbqVWI/fit/844/225/ce/1/aHR0cHM6Ly90c2Uy/Lm1tLmJpbmcubmV0/L3RoP2lkPU9JUC5y/NndKcDBkTXBRcHJm/UzJOVWxELUlRSGFF/SyZwaWQ9QXBp"/>
                <h1><a class="h1" href="projet.php">My RSS Website</a></h1>
                
                <button><a class="button" href="connexion.php">admin</a></button>
        </header>
        
        <section>
            <div class="formulaire">
                <form name="myForm"  method="post">
                    <label>Nombre de ligne par page :</label>
                    <input type=number pattern="[0-9]+" name="nbByPage" class="field-long" placeholder="number">
                    <label>Nombre de flux RSS retenu au total :</label>
                    <input type=number pattern="^[0-9]+$" name="nbTotal" class="field-long" placeholder="number">
                    </br>
                    <p><input class="submit" type="submit" value="Envoyer"></p>
                </form>
                <?php
                require("../Classes/Validation.php");
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
                }

                ?>
            </div>
        </section>
    </body>
</html>