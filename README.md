# My Rss Website

Ce projet a permit de réaliser un site web de news en utilisant les flux RSS de plusieurs sites webs.  
Il a été réalisé dans le cadre de la deuxième année de DUT information à l'IUT de Clermont-Ferrand.
Technologies utilisées : PHP, SQL, HTML, CSS (JS)

## Features

- [x] Il est possible de voir sur la page principales les différentes news provenant des flux RSS, de cliquer dessus pour aller lire l'article.  
- [x] Les news sont triées par dates décroissantes, il n'y a aucun doublon.
- [x] Un système de pagination poussé permet de naviguer facilement entre les différentes pages de news.
- [x] L'utilisateur peut également se connecter si c'est un administrateur, et il accède alors à une page de configuration. 
- [x] Il peut alors changer le nombre de news affichées sur la page principale, ajouter des nouveaux flux, en supprimer (ce qui effacera les news correspondantes), ou mettre à jour manuellement chaque flux pour obtenir les nouvelles news que sur certains flux bien précis.
- [x] Il peut se déconnecter quand il a fini et admirer les modifications qu'il a effectué prendre vie sur la page principale.
- [x] Le tout est bien sûr assez accessible, et dans un environnement graphique plutôt soigné.


## Les + 
- [x] Un fichier de lecture periodique peut-être configuré sur le serveur pour être lancé régulièrement. Ainsi, les flux resteront à jour, il n'y aura pas besoin de faire le rafraîchissement manuellement, et des news seront automatiquement ajoutées.
- [x] Des messages d'erreurs s'affichent à l'écran quand l'utilisateur n'effectue pas des actions valides.
- [x] Un fichier d'initialisation de la BD permet de rapidement configurer le site.

## Points importants du programme
* Divers patrons d'architecture utilisés (MVC...)
* Programmation Objet et patrons de conception
* Utilisation de base de données, interface de configuration pour l'administrateur.
* Intégration d'un thème sombre (à modifier depuis la BD).
* Séparation des responsabilités. 

## Comment le lancer ?

* Si aucune base de donnée n'existe, en créer une sous son serveur web (phpmyadmin pour wamp par exemple).
* Modifier le fichier config.php qui se trouver dans source/config. Remplacer les valeurs des variables "login", "password" et "database" par celles de la base de données créé précédemment.
* A noter qu'il est aussi possible de directement importer une base de donnée pré-remplie en chargeant le fichier source/config/server/database.sql qui contient toutes les requêtes de création des tables et des insertions.
Attention : il se peut qu'en fonction du format d'encodage de votre base de données des caractères se comportent bizaremment sur les données déjà présentes (les accents).
* Lancer le site en allant dans son serveur local et en allant dans le dossier source. A ce moment là le site devrait s'afficher.

> Note : si une erreur s'affiche il s'agit probablement d'un problème de configuration de la base de données.

## Membres du projet 
Jérémy TREMBLAY  
Maxime GRANET
