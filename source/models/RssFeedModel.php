<?php

/**
 * Name : RssFeedModel.php
 * Project : My RSS website
 * Usefulness : contains a RssFeedModel class, manage stream.
 * Last Modification date : 29/12/2021
 * Authors : Maxime GRANET, Jérémy TREMBLAY
 */

/**
 * A Rss feed model manage the Rss feed between a controller and the gateway.
 */
class RssFeedModel {
    private $gateway;

    /**
     * Create a new RssFeedGateway with a new connection
     */
    public function __construct() {
        global $dsn, $login, $password;
        $this->gateway = new RssFeedGateway(new Connection($dsn, $login, $password));
    }

    /**
     * Get the RssFeed whose id is passed in argument
     * @param int $id The id of the stream
     * @return RssFeed|null An array with the stream if it exist, else otherwise
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
     * Get all instances of RssFeed
     * @return array|null An array with all instance of stream, null if there is no stream
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


    /**
     * Get the number of RssFeed
     * @return int The number of stream
     */
    public function getNumberOfRssFeeds(): int {
        return $this->gateway->numberOfRssFeeds()[0][0];
    }

    /**
     * Check if the link is already exist
     * @param string $link link of the stream
     * @return mixed An array of results or null if the request fails
     */
    public function checkIfExists(string $link) {
        return $this->gateway->isRssFeedExists($link)[0][0];
    }

    /**
     * Insert a new RssFeed
     * @param string $name The name of the stream
     * @param string $link The link of the stream
     * @param string $updateDate The date of last update of the stream
     * @return void
     */
    public function insertRssFeed(string $name, string $link, string $updateDate) : void {
        $this->gateway->insert($name, $link, $updateDate);
    }

    /**
     * Delete a stream whose id is passed in argument
     * @param int $id The id of the stream
     * @return void
     */
    public function deleteRssFeed(int $id) : void {
        $this->gateway->delete($id);
    }

    /**
     * Update a RssFeed
     * @param int $id The id of the stream
     * @param string $name The name of the stream
     * @param string $link The link of the stream
     * @param string $updateDate The date of last update of the stream
     * @return void
     */
    public function updateRssFeed(int $id, string $name, string $link, string $updateDate) : void {
        $this->gateway->update($id, $name, $link, $updateDate);
    }
}