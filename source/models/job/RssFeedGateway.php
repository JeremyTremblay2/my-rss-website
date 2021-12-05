<?php
/**
 * Name : RssFeedGateway.php
 * Project : My RSS website
 * Usefulness : contains a RssFeedGateway class, allowing actions on data inside the database, like updates,
 * researches and deletes.
 * Last Modification date : 05/12/2021
 * Authors : Maxime GRANET, Jérémy TREMBLAY
 */

/**
 * A RssFeedGateway class, allows you to carry out actions on the Rss feeds of the database.
 *
 * RssFeedGateway must have a way to connect to the database. A RssFeedGateway can do some actions on data.
 */
class RssFeedGateway {
    private $connection;

    /**
     * Create a new RssFeedGateway.
     *
     * @param Connection $connection A way to connect at the database.
     */
    public function __construct(Connection $connection) {
        $this->connection = $connection;
    }

    /**
     * Get a RssFeed in the database with its id.
     *
     * @param int $id The id of the RssFeed that will be get retrieve.
     * @return array Returns an array of data or null if the request fails.
     */
    public function findByIndex(int $id) : ?array {
        $query = 'SELECT * FROM rssfeed WHERE streamId = :id';
        $success = $this->connection->executeQuery($query, array(
            ':id' => array($id, PDO::PARAM_INT)
        ));

        if ($success) {
            $results = $this->connection->getResults();
            return $results;
        }
        return null;
    }

    /**
     * Get an array of RssFeed from the database.
     *
     * @return array Returns an array of data or null if the request fails.
     */
    public function findAllStreams() : ?array {
        $query = 'SELECT * FROM rssfeed';
        $success = $this->connection->executeQuery($query, array());

        if ($success) {
            $results = $this->connection->getResults();
            return $results;
        }
        return null;
    }

    /**
     * Count the number of rss feeds in the database.
     *
     * @return array An array of results or null if the request fails.
     */
    public function numberOfRssFeeds(): ?array {
        $query = 'SELECT COUNT(*) FROM rssfeed';
        $success = $this->connection->executeQuery($query, array());
        if ($success) {
            $results = $this->connection->getResults();
            return $results;
        }
        return null;
    }

    /**
     * Insert a RssFeed in the database.
     *
     * @param string $name The name of the rss feed that will be inserted.
     * @param string $link The link to the rss feed that will be inserted.
     * @param string $updateDate The last modification date of the rss feed that will be inserted.
     */
    public function insert(string $name, string $link, string $updateDate) {
        $query = 'INSERT INTO rssfeed VALUES(NULL, :name, :link, :updateDate)';
        $this->connection->executeQuery($query, array(
            ':name' => array($name, PDO::PARAM_STR),
            ':link' => array($link, PDO::PARAM_STR),
            ':updateDate' => array($updateDate, PDO::PARAM_STR)
        ));
    }

    /**
     * Delete a RssFeed from its id.
     *
     * @param int $id The id of the rss feed to delete.
     */
    public function delete(int $id) {
        $query = 'DELETE FROM rssfeed WHERE streamId = :id';
        $this->connection->executeQuery($query, array(
            ':id' => array($id, PDO::PARAM_INT)
        ));
    }

    /**
     * Update a RssFeed from its id.
     *
     * @param int $id The id of the rss feed to update.
     * @param string $name The new name of the rss feed.
     * @param string $link The new link of the rss feed.
     * @param string $updateDate The new last modification date of the rss feed.
     */
    public function update(int $id, string $name, string $link, string $updateDate) {
        $query = 'UPDATE rssfeed SET name = :name, updateDate = :updateDate, link = :link WHERE streamId = :id';
        $this->connection->executeQuery($query, array(
            ':name' => array($name, PDO::PARAM_STR),
            ':updateDate' => array($updateDate, PDO::PARAM_STR),
            ':link' => array($link, PDO::PARAM_STR),
            ':id' => array($id, PDO::PARAM_INT)
        ));
    }
}