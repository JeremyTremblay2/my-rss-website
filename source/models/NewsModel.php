<?php

/**
 * Name : NewsModel.php
 * Project : My RSS website
 * Usefulness : contains a NewsModel class, manage News.
 * Last Modification date : 29/12/2021
 * Authors : Maxime GRANET, Jérémy TREMBLAY
 */

/**
 * A news model manage the news, it's an intermediate between the gateway and the controller.
 */

class NewsModel {
    private $gateway;

    /**
     * Create a new newsGateway with a new connection
     */
    public function __construct() {
        global $dsn, $login, $password;
        $this->gateway = new NewsGateway(new Connection($dsn, $login, $password));
    }

    /**
     * Delete a News whose id is passed in argument
     * @param int $id The id of the news
     * @return void
     */
    public function deleteNews(int $id): void {
        $this->gateway->delete($id);
    }

    /**
     * Insert a news into database throw a gateway
     * @param int $idRssFeed The id of the stream
     * @param string $title The title of the news
     * @param string $link The link of the news
     * @param string $description The description of the news
     * @param string $publicationDate The publication date of the news
     * @return void
     */
    public function insertNews(int $idRssFeed, string $title, string $link,
                               string $description, string $publicationDate): void {
        $this->gateway->insert($idRssFeed, $title, $link,$description, $publicationDate);
    }

    /**
     * Find a news into a stream
     * @param int $idRssFeed The id of the stream
     * @return array|null An array of the result or null if the news did not exist
     */
    public function findNewsByStream(int $idRssFeed): ?array {
        $results = $this->gateway->findByStream($idRssFeed);
        return $this->getInstances($results);
    }

    /**
     * Find a news into all of stream
     * @return array|null An array of the result or null if the news did not exist
     */
    public function findAllNews(): ?array {
        $results = $this->gateway->findAllNews();
        return $this->getInstances($results);
    }

    /**
     * Find a news into all of stream between two boundary
     * @param int $limit The max number of news returned
     * @param int $offset The index of the start of the reserch
     * @return array|null The array of news finding, null otherwise
     */
    public function findNewsInRange(int $limit, int $offset): ?array {
        $results = $this->gateway->findInRange($limit, $offset);
        return $this->getInstances($results);
    }

    /**
     * Get the total number of news
     * @return int The total number of news
     */
    public function getNumberOfNews(): int {
        return $this->gateway->numberOfNews()[0][0];
    }

    /**
     * Return the array with all of news finding
     * @param array|null $results The result of the research, null if the news was not found
     * @return array|null An array with the news finding, null otherwise
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
