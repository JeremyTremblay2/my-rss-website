<?php

require_once('config/config.php');
require_once('models/job/Connection.php');
require_once('models/job/RssFeed.php');
require_once('models/job/RssFeedGateway.php');
require_once('models/RssFeedModel.php');
require_once('models/job/News.php');
require_once('models/job/NewsGateway.php');
require_once('models/NewsModel.php');
require_once('parser/Parser.php');

// Connection and instantiations.
if (!(isset($login) and isset($password) and isset($dsn))) {
    throw new Exception("Impossible de se connecter à la base de données, arrêt du script.");
}
$connection = new Connection($dsn, $login, $password);
$newsModel = new NewsModel($connection);
$rssFeedModel = new RssFeedModel($connection);
$parser = new Parser();

// The current time.
$date = strftime("%Y-%m-%d %H:%M:%S", strtotime('now'));

// Browse the rss feeds and add all the news from this rss feeds
$rssFeeds = $rssFeedModel->getAllRssFeed();
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

?>