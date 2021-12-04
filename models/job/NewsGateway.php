<?php
/**
 * Name : NewsGateway.php
 * Project : My RSS website
 * Usefulness : contains a NewsGateway class, allowing actions on data inside the database, like updates,
 * researches and deletes.
 * Last Modification date : 18/11/2021
 * Authors : Maxime GRANET, Jérémy TREMBLAY
 */

/**
 * A NewsGateway class, allows you to carry out actions on the news of the database.
 *
 * NewsGateway must have a way to connect to the database. A NewsGateway can do some actions on data.
 */
class NewsGateway {
    private $connection;

    /**
     * Create a NewsGateway.
     *
     * @param Connection $connection A connexion to the database where data will be manipulated.
     */
    public function __construct(Connection $connection) {
        $this->connection = $connection;
    }

    /**
     * Delete a news from its id.
     *
     * @param int $id The id of the news that will be deleted.
     */
    public function delete(int $id) {
        $query = "DELETE FROM news WHERE id = :id";
        $this->connection->executeQuery($query, array(
            ':id' => array($id, PDO::PARAM_INT)
        ));
    }

    /**
     * Insert a news in the database.
     *
     * @param int $id The id of the news that will be inserted.
     * @param int $idRssFeed The id of the rss feed in which the news comes.
     * @param string $title The title of the news that will be inserted.
     * @param string $link The link of the news that will be inserted.
     * @param string $description The description of the news that will be inserted.
     * @param string $publicationDate The publication date of the news that will be inserted.
     */
    public function insert(int $idRssFeed, string $title, string $link, string $description, string $publicationDate) {
        $query = 'INSERT INTO news VALUES(NULL, :idRssFeed, :title, :link, :description, :publicationDate)';
        $this->connection->executeQuery($query, array(
            ':idRssFeed' => array($idRssFeed, PDO::PARAM_INT),
            ':title' => array($title, PDO::PARAM_STR),
            ':link' => array($link, PDO::PARAM_STR),
            ':description' => array($description, PDO::PARAM_STR),
            ':publicationDate' => array($publicationDate, PDO::PARAM_STR)
        ));
    }

    /**
     * Find all the news in the database.
     *
     * @return array An array of results or null if the request fail.
     */
    public function findAllNews() : ?array {
        $query = 'SELECT * FROM news ORDER BY publicationDate';
        $success = $this->connection->executeQuery($query, array());
        if ($success) {
            $results = $this->connection->getResults();
            return $results;
        }
        return null;
    }

    /**
     * Get an array of news in the database with a range and a limit.
     *
     * @param int $limit The maximum number of news to find.
     * @param int $offset The offset of the news to recovered in the database from the beginning.
     * @return array Returns an array of data or null if the request fails.
     */
    public function findInRange(int $limit, int $offset) : ?array {
        $rssFeedArray = array();
        $query = 'SELECT * FROM news LIMIT :limit OFFSET :offset';
        $success = $this->connection->executeQuery($query, array(
            ':limit' => array($limit, PDO::PARAM_INT),
            ':offset' => array($offset, PDO::PARAM_INT)
        ));

        if ($success) {
            $results = $this->connection->getResults();
            return $results;
        }
        return null;
    }

    /**
     * Find all the news in the database coming from the feed passed in parameter.
     *
     * @param int $idRssFeed The id of the feed
     * @return array An array of news or null if the request fails.
     */
    public function findByStream(int $idRssFeed) : ?array {
        $query = 'SELECT * FROM news WHERE streamIdf = :idRssFeed ORDER BY publicationDate ';
        $success = $this->connection->executeQuery($query, array(
            ':idRssFeed' => array($idRssFeed, PDO::PARAM_INT)
        ));
        if ($success) {
            $results = $this->connection->getResults();
            return $results;
        }
        return null;
    }

    /**
     * Count the number of news in the database.
     *
     * @return array An array of results or null if the request fails.
     */
    public function numberOfNews() : ?array {
        $query = 'SELECT COUNT(*) FROM news';
        $success = $this->connection->executeQuery($query, array());
        if ($success) {
            $results = $this->connection->getResults();
            return $results;
        }
        return null;
    }
}