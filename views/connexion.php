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
                
                <button><a href="admin.html">admin</a></button>
        </header>
        
        <section>
            <div class="connexion">
                <h1>Connexion</h1>
                <form name="myForm" >
                    <label>pseudo :</label>
                    <input type=text pattern="[a-zA-Z0-9\d@$!%*_-#?&]+" name="name" class="field-long" placeholder="pseudo" required>
                    <label>mot de passe :</label>
                    <input type=password pattern="[a-zA-Z0-9]+" name="password" class="field-long" placeholder="mot de passe" required>
                    <p><input type="submit" value="Envoyer"></p>
                </form>
            </div>
        </section>
    </body>
</html>