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

// Connection and instantiations.
if (!(isset($login) and isset($password) and isset($dsn))) {
    throw new Exception("Impossible de se connecter à la base de données, arrêt du script.");
}
$connection = new Connection($dsn, $login, $password);
$userModel = new UserModel($connection);
$configurationModel = new ConfigurationModel($connection);
$newsModel = new NewsModel($connection);
$rssFeedModel = new RssFeedModel($connection);

// USERS
/*
//$userModel->insertUser("Jeremy T", password_hash("mdp", PASSWORD_DEFAULT));
//$userModel->insertUser("Jeremy D", password_hash("mdp2", PASSWORD_DEFAULT));

$user = $userModel->getUser("Jeremy t");
echo $user;

echo "Le mdp 'test' pour l'utilisateur Jeremy t est-il le bon ? réponse : ";
if (password_verify("test", $user->getPassword())) {
    echo "OUI <br />";
}
else {
    echo "NON <br />";
}
echo "Le mdp 'mdp' pour l'utilisateur Jeremy t est-il le bon ? réponse : ";
if (password_verify("mdp", $user->getPassword())) {
    echo "OUI <br />";
}
else {
    echo "NON <br />";
}

$user = $userModel->getUser("JeRemy D");
echo $user;
*/

// CONFIGURATIONS
/*
$configuration = $configurationModel->getConfiguration('numberOfNewsPerPage');
echo $configuration;
$configurationModel->updateConfiguration('numberOfNewsPerPage', 4);
$configurationModel->deleteConfiguration('numberOfNewsPerPage');
$configurationModel->insertConfiguration('numberOfNewsPerPage', 9);
$configuration = $configurationModel->getConfiguration('numberOfNewsPerPage');
echo $configuration;
*/

//RSS FEED
/*
$rssFeed = $rssFeedModel->getRssFeed(21);
echo $rssFeed . '<br />';
$rssFeeds = $rssFeedModel->getAllRssFeed();
foreach ($rssFeeds as $rssFeed) {
    echo $rssFeed . '<br />';
}
$rssFeedModel->updateRssFeed(25, "youlou", "lien", date( 'Y-m-d H:i:s', strtotime("yesterday")));

$rssFeedModel->deleteRssFeed(21);
$rssFeedModel->insertRssFeed('En continu', 'https://www.lemonde.fr/rss/en_continu.xml',
    date( 'Y-m-d H:i:s', strtotime("today")));
$rssFeed = $rssFeedModel->getRssFeed(24);
echo $rssFeed . '<br />';
*/

//NEWS
/*
echo 'AFFICHAGE DE TOUTES LES NEWS <br />';
$newsArray = $newsModel->findAllNews();
foreach ($newsArray as $news) {
    echo $news . '<br />';
}

echo 'AFFICHAGE DES NEWS DU FLUX 12 <br />';
$newsArray = $newsModel->findNewsByStream(12);
foreach ($newsArray as $news) {
    echo $news . '<br />';
}

echo 'AFFICHAGE DE 10 NEWS A PARTIR DE LA 3EME <br />';
$newsArray = $newsModel->findNewsInRange(10, 3);
foreach ($newsArray as $news) {
    echo $news . '<br />';
}

echo $newsModel->getNumberOfNews() . ' NEWS AU TOTAL <br />';

$newsModel->insertNews(12, "Coucou", "lien bizarre", "je suis une desc",
    date( 'Y-m-d H:i:s', strtotime("yesterday")));

$newsModel->deleteNews(12);
*/
?>