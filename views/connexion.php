<!-- Created: 17/11/2021 by maxime.granet -->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="css/stylesheet.css">
        <title>My RSS Website</title>
    </head>
    <body>
    <?php


    // on v�rifie les donn�es provenant du mod�le
    if (isset($dataVue))
    {?>
        <header>
                <img src="https://imgr.search.brave.com/XcnMrUqaudF1J_X_M9oulPGbTeZ-ri9MJ_N7oXbqVWI/fit/844/225/ce/1/aHR0cHM6Ly90c2Uy/Lm1tLmJpbmcubmV0/L3RoP2lkPU9JUC5y/NndKcDBkTXBRcHJm/UzJOVWxELUlRSGFF/SyZwaWQ9QXBp"/>
            <h1><a class="h1" href="projet.php">My RSS Website</a></h1>
                
                <button><a class="button" href="admin.php">admin</a></button>
        </header>
        <?php
        if (isset($tabErr) && count($tabErr)>0) {
            echo "<h2>ERREUR !!!!!</h2>";
            foreach ($tabErr as $value){
                echo $value;
            }}
        ?>
        <section>
            <div class="formulaire">
                <h1>Connexion</h1>
                    <form name="myForm" method="post" action="../controllers/CtrlUser.php?action=valider">
                        <label>pseudo :</label>
                        <input type=text pattern="[a-zA-Z0-9\d@$!%*_-#?&]+" name="name" class="field-long" placeholder="pseudo" VALUE=<?=$dataVue['pseudo']?>>
                        <label>mot de passe :</label>
                        <input type=password pattern="[a-zA-Z0-9]+" name="password" class="field-long" placeholder="mot de passe">
                        <p><input type="submit" value="Envoyer"></p>
                </form>
                <?php
                if (!isset($tabErr)) {
                    echo "<p>$tabErr</p>";
                } else {
                    echo "tranquillou pillou";
                }
                /*
                require("../Classes/Validation.php");
                $e = new Validation();
                $msg = '';
                $deb = '<div class="error"><div class="txt">';
                $fin = '</div></div>';
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $msg = $deb;
                    $nb = 0;
                    $err = $e->str($_POST["name"]);
                    if ($err != null){
                        $msg .= 'Nom : ';
                        $msg .= $err;
                        $nb = 1;
                    }
                    $err = $e->str($_POST["password"]);
                    if ($err != null){
                        $msg .= 'Mot de passe : ';
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
    <?php }
    else {
        print ("erreur !!<br>");
        print ("utilisation anormale de la vuephp");
    } ?>
    </body>
</html>
