<?php

require_once('../config.php');
require_once('../Autoload.php');
Autoload::charger();

if (!(isset($login) and isset($password) and isset($dsn))) {
    throw new Exception("Impossible de se connecter à la base de données, arrêt du script.");
}

// We load our Models.
$userModel = new UserModel();
$configurationModel = new ConfigurationModel();
$newsModel = new NewsModel();
$rssFeedModel = new RssFeedModel();

// A past date.
$date = strftime("%Y-%m-%d %H:%M:%S", strtotime('4 december 2000'));

//Rss Feeds from the website 'Le Monde'
$rssFeedArray = array(
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

// Insertions in the database if the key/value pair doesn't exists.
$results = $userModel->getUser('admin');
if ($results == null) {
    $userModel->insertUser("admin", password_hash("motDePasse2*", PASSWORD_DEFAULT));
}
$results = $configurationModel->getConfiguration('numberOfNewsPerPage');
if ($results == null) {
    $configurationModel->insertConfiguration('numberOfNewsPerPage', Constants::DEFAULT_NUMBER_OF_NEWS);
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