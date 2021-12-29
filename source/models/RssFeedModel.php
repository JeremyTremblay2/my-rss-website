<?php

/**
 * Name : RssFeedModel.php
 * Project : My RSS website
 * Usefulness : contains a RssFeedModel class, manage stream.
 * Last Modification date : 29/12/2021
 * Authors : Maxime GRANET, Jérémy TREMBLAY
 */


class RssFeedModel {
    private $gateway;

    /**
     * create a new RssFeedGateway with a new connection
     */
    public function __construct() {
        global $dsn, $login, $password;
        $this->gateway = new RssFeedGateway(new Connection($dsn, $login, $password));
    }

    /**
     * return the RssFeed whose id is passed in argument
     * @param int $id id of the stream
     * @return RssFeed|null array with the stream if it exist, else otherwise
     */
    public function getRssFeed(int $id) : ?RssFeed {
        $results = $this->gateway->findByIndex($id);

        if (!empty($results)) {
            return new RssFeed($results[0]['streamId'], $results[0]['name'],
                $results[0]['link'], $results[0]['updateDate']);
        }
        return null;
    }

    /**
     * return all instance of RssFeed
     * @return array|null return an array with all instance of stream, null if there is no stream
     */
    public function getAllRssFeed() : ?array {
        $results = $this->gateway->findAllStreams();
        $rssFeedArray = array();

        if (!empty($results)) {
            foreach ($results as $row) {
                $rssFeed = new RssFeed($row['streamId'], $row['name'], $row['link'], $row['updateDate']);
                $rssFeedArray[] = $rssFeed;
            }
            return $rssFeedArray;
        }
        return null;
    }


    /**return the number of RssFeed
     * @return int number of stream
     */
    public function getNumberOfRssFeeds(): int {
        return $this->gateway->numberOfRssFeeds()[0][0];
    }

    /**
     * check if the link is already exist
     * @param string $link link of the stream
     * @return mixed array of results or null if the request fails
     */
    public function checkIfExists(string $link) {
        return $this->gateway->isRssFeedExists($link)[0][0];
    }

    /**
     * insert a new RssFeed
     * @param string $name name of the stream
     * @param string $link link of the stream
     * @param string $updateDate date of last update of the stream
     * @return void
     */
    public function insertRssFeed(string $name, string $link, string $updateDate) : void {
        $this->gateway->insert($name, $link, $updateDate);
    }

    /**
     * delete a stream whose id is passed in argument
     * @param int $id id of the stream
     * @return void
     */
    public function deleteRssFeed(int $id) : void {
        $this->gateway->delete($id);
    }

    /**
     * update a RssFeed
     * @param int $id id of the stream
     * @param string $name name of the stream
     * @param string $link link of the stream
     * @param string $updateDate date of last update of the stream
     * @return void
     */
    public function updateRssFeed(int $id, string $name, string $link, string $updateDate) : void {
        $this->gateway->update($id, $name, $link, $updateDate);
    }
}