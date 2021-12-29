<?php

/**
 * Name : NewsModel.php
 * Project : My RSS website
 * Usefulness : contains a NewsModel class, manage News.
 * Last Modification date : 29/12/2021
 * Authors : Maxime GRANET, Jérémy TREMBLAY
 */


class NewsModel {
    private $gateway;

    /**
     * create a new newsGateway with a new connection
     */
    public function __construct() {
        global $dsn, $login, $password;
        $this->gateway = new NewsGateway(new Connection($dsn, $login, $password));
    }

    /**
     * delete a News whose id is passed in argument
     * @param int $id id of the news
     * @return void
     */
    public function deleteNews(int $id): void {
        $this->gateway->delete($id);
    }

    /**
     * insert a news into database throw a gateway
     * @param int $idRssFeed id of the stream
     * @param string $title title of the news
     * @param string $link link of the news
     * @param string $description description of the news
     * @param string $publicationDate publication date of the news
     * @return void
     */
    public function insertNews(int $idRssFeed, string $title, string $link,
                               string $description, string $publicationDate): void {
        $this->gateway->insert($idRssFeed, $title, $link,$description, $publicationDate);
    }

    /**
     * find a news into a stream
     * @param int $idRssFeed id of the stream
     * @return array|null array of the result or null if the news did not exist
     */
    public function findNewsByStream(int $idRssFeed): ?array {
        $results = $this->gateway->findByStream($idRssFeed);
        return $this->getInstances($results);
    }

    /**
     * find a news into all of stream
     * @return array|null array of the result or null if the news did not exist
     */
    public function findAllNews(): ?array {
        $results = $this->gateway->findAllNews();
        return $this->getInstances($results);
    }

    /**
     * find a news into all of stream between two boundary
     * @param int $limit max number of news returned
     * @param int $offset index of the start of the reserch
     * @return array|null array of news finding, null otherwise
     */
    public function findNewsInRange(int $limit, int $offset): ?array {
        $results = $this->gateway->findInRange($limit, $offset);
        return $this->getInstances($results);
    }

    /**
     * return the total number of news
     * @return int total number of news
     */
    public function getNumberOfNews(): int {
        return $this->gateway->numberOfNews()[0][0];
    }

    /**
     * return the array with all of news finding
     * @param array|null $results result of the research, null if the news is not finding
     * @return array|null return an array with the news finding, null otherwise
     */
    private function getInstances(?array $results): ?array
    {
        $newsArray = array();

        if (!empty($results)) {
            foreach ($results as $row) {
                $news = new News($row['id'], $row['streamIdf'], $row['title'], $row['link'],
                    $row['description'], $row['publicationDate']);
                $newsArray[] = $news;
            }
            return $newsArray;
        }
        return null;
    }
}
