<?php

class RssFeedModel {
    private $gateway;

    public function __construct() {
        global $dsn, $login, $password;
        $this->gateway = new RssFeedGateway(new Connection($dsn, $login, $password));
    }

    public function getRssFeed(int $id) : ?RssFeed {
        $results = $this->gateway->findByIndex($id);

        if (!empty($results)) {
            return new RssFeed($results[0]['streamId'], $results[0]['name'],
                $results[0]['link'], $results[0]['updateDate']);
        }
        return null;
    }

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

    public function getNumberOfRssFeeds(): int {
        return $this->gateway->numberOfRssFeeds()[0][0];
    }

    public function checkIfExists(string $link) {
        return $this->gateway->isRssFeedExists($link)[0][0];
    }

    public function insertRssFeed(string $name, string $link, string $updateDate) : void {
        $this->gateway->insert($name, $link, $updateDate);
    }

    public function deleteRssFeed(int $id) : void {
        $this->gateway->delete($id);
    }

    public function updateRssFeed(int $id, string $name, string $link, string $updateDate) : void {
        $this->gateway->update($id, $name, $link, $updateDate);
    }
}