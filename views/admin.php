<!-- Created: 17/11/2021 by maxime.granet -->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="projet.css">
        <title>My RSS Website</title>
    </head>
    <body>
        <header>
                <img src="logo.png"/>
                <h1>My RSS Website</h1>
                
                <button><a href="connexion.html">admin</a></button>
        </header>
        
        <section>
            
            <form name="myForm" >
                <label>Nombre de ligne par page :</label>
                <input type=number pattern="[0-9]+" name="nbByPage" class="field-long" placeholder="number" required>
                <label>Nombre de flux RSS retenu au total :</label>
                <input type=number pattern="^[0-9]+$" name="nbTotal" class="field-long" placeholder="number" required>
                <p><input type="submit" value="Envoyer"></p>
            </form>
        </section>
    </body>
</html>