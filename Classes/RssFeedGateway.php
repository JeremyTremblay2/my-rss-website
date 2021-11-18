<?php
/**
 * Name : RssFeedGateway.php
 * Project : My RSS website
 * Usefulness : contains a RssFeedGateway class, allowing actions on data inside the database, like updates,
 * researches and deletes.
 * Last Modification date : 18/11/2021
 * Authors : Maxime GRANET, Jérémy TREMBLAY
 */

/**
 * A RssFeedGateway class, allows you to carry out actions on the Rss feeds of the database.
 *
 * RssFeedGateway must have a way to connect to the database. A RssFeedGateway can do some actions on data.
 */
class RssFeedGateway {
    private Connection $connection;

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
     * @return RssFeed Returns a RssFeed found by the id.
     */
    public function get(int $id) : RssFeed {
        $rssFeedArray = array();
        $query = 'SELECT * FROM CONFIGURATION WHERE streamId = :id';
        $this->connexion->executeQuery($query, array(
            ':id' => array($id, PDO::PARAM_STR)
        ));
        $results = $this->connection->getResults();
        // Please add a try catch block
        $rssFeedArray[] = new RssFeed($results['name'], $results['link'], $results['updateDate'], $results['id']);
        return $rssFeedArray[0];
    }

    /**
     * Insert a RssFeed in the database.
     *
     * @param string $name The name of the rss feed that will be inserted.
     * @param string $link The link to the rss feed that will be inserted.
     * @param string $updateDate The last modification date of the rss feed that will be inserted.
     * @param int $id The id of the rss feed that will be inserted.
     */
    public function insert(string $name, string $link, string $updateDate, int $id) {
        $query = 'INSERT INTO RSSFEED VALUES(:name, :link, :updateDate, :id)';
        $this->connection->executeQuery($query, array(
            ':name' => array($name, PDO::PARAM_STR),
            ':link' => array($link, PDO::PARAM_STR),
            ':updateDate' => array($updateDate, PDO::PARAM_STR),
            ':id' => array($id, PDO::PARAM_INT)
        ));
    }

    /**
     * Delete a RssFeed from its id.
     *
     * @param int $id The id of the rss feed to delete.
     */
    public function delete(int $id) {
        $query = 'DELETE FROM RSSFEED WHERE streamId = :id';
        $this->connection->executeQuery($query, array(
            ':key' => array($id, PDO::PARAM_STR)
        ));
    }
}