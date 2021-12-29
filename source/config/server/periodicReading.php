<?php

/** Name : periodicReading.php
 * Project : My RSS website
 * Usefulness : Read the differents stream to complete the database with the last news.
 * Last Modification date : 29/12/2021
 * Authors : Maxime GRANET, Jérémy TREMBLAY
 */


require_once('../config.php');
require_once('../Autoload.php');
if (!Autoload::isStarted()) {
    Autoload::charger();
}

// Connection and instantiations.
if (!(isset($login) and isset($password) and isset($dsn))) {
    throw new Exception("Impossible de se connecter à la base de données, arrêt du script.");
}

$newsModel = new NewsModel();
$rssFeedModel = new RssFeedModel();
$parser = new Parser();

// The current time.
$date = strftime("%Y-%m-%d %H:%M:%S", strtotime('now'));

// Browse the rss feeds and add all the news from this rss feeds
$rssFeeds = $rssFeedModel->getAllRssFeed();
if (!empty($rssFeeds)) {
    foreach ($rssFeeds as $rssFeed) {
        $parser->setPath($rssFeed->getLink());
        $results = $parser->parse($rssFeed->getUpdateDate());
        // We add each news in database for each rss feed.
        foreach ($results as $line) {
            $newsModel->insertNews($rssFeed->getId(),$line[0], $line[1], $line[2],
                strftime("%Y-%m-%d %H:%M:%S", strtotime($line[3])));
        }
        //We update the date of the research in each rss feed.
        $rssFeedModel->updateRssFeed($rssFeed->getId(), $rssFeed->getName(), $rssFeed->getLink(), $date);
    }
}
?>