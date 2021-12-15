<?php
    require_once('Classes/RssFeedGateway.php');
    require_once('Classes/NewsGateway.php');
    require_once('Classes/Connection.php');

    $user= 'jetremblay';
	$pass='achanger';
	$dsn='mysql:host=localhost;dbname=dbjetremblay';
	try {
		$con = new Connection($dsn, $user, $pass);
    }
    catch (PDOException $e) {
    echo $e->getMessage();
    }
    $newsGateway = new NewsGateway($con);
    $rssGateway = new RssFeedGateway($con);

    //paswword_hash et verify
    $date = strtotime("next Sunday"); echo 
    $mysqldate = date( 'Y-m-d H:i:s', $date);
    $rssGateway->insert('testative', 'https://www.lemonde.fr/pixels/rss_full.xml', $mysqldate , 0);
?>