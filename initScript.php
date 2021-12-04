<?php

require_once('config/config.php');
require_once('models/job/Connection.php');
require_once('models/job/User.php');
require_once('models/job/UserGateway.php');
require_once('models/UserModel.php');
require_once('models/job/Configuration.php');
require_once('models/job/ConfigurationGateway.php');
require_once('models/ConfigurationModel.php');
require_once('models/job/RssFeed.php');
require_once('models/job/RssFeedGateway.php');
require_once('models/RssFeedModel.php');
require_once('models/job/News.php');
require_once('models/job/NewsGateway.php');
require_once('models/NewsModel.php');

if (!(isset($login) and isset($password) and isset($dsn))) {
    throw new Exception("Impossible de se connecter à la base de données, arrêt du script.");
}

// We load our Models.
$connection = new Connection($dsn, $login, $password);
$userModel = new UserModel($connection);
$configurationModel = new ConfigurationModel($connection);
$newsModel = new NewsModel($connection);
$rssFeedModel = new RssFeedModel($connection);

// A past date.
$date = strftime("%Y-%m-%d %H:%M:%S", strtotime('4 december 2000'));

//Rss Feeds from the website 'Le Monde'
$rssFeedArray = array(
    array('A la Une', 'https://www.lemonde.fr/rss/une.xml', $date),
    array('International', 'https://www.lemonde.fr/international/rss_full.xml', $date),
    array('Politique', 'https://www.lemonde.fr/politique/rss_full.xml', $date),
    array('Economie', 'https://www.lemonde.fr/economie/rss_full.xml', $date),
    array('Culture', 'https://www.lemonde.fr/culture/rss_full.xml', $date),
    array('Sport', 'https://www.lemonde.fr/sport/rss_full.xml', $date),
    array('Planete', 'https://www.lemonde.fr/planete/rss_full.xml', $date),
    array('Pixels', 'https://www.lemonde.fr/pixels/rss_full.xml', $date),
    array('Sciences', 'https://www.lemonde.fr/sciences/rss_full.xml', $date),
    array('Opinion', 'https://www.lemonde.fr/idees/rss_full.xml', $date),
    array('M le Mag', 'https://www.lemonde.fr/m-le-mag/rss_full.xml', $date),
    array('Guide d\'achats', 'https://www.lemonde.fr/guides-d-achat/rss_full.xml', $date),
);

// Insertions in the databases if the key value pair doesn't exists.
$results = $userModel->getUser('admin');
if ($results == null) {
    $userModel->insertUser("admin", password_hash("motDePasse2*", PASSWORD_DEFAULT));
}
$results = $configurationModel->getConfiguration('numberOfNewsPerPage');
if ($results == null) {
    $configurationModel->insertConfiguration('numberOfNewsPerPage', 10);
}

// If no streams are in the database, we insert the default streams.
if ($rssFeedModel->getNumberOfRssFeeds() == 0) {
    foreach ($rssFeedArray as $rssFeed) {
        $rssFeedModel->insertRssFeed($rssFeed[0], $rssFeed[1], $rssFeed[2]);
    }
}

// If no news was in the database, we call the script that will insert the news.
if ($newsModel->getNumberOfNews() == 0) {
    require('periodicReading.php');
}
?>