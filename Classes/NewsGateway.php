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
    private Connection $connection;

    /**
     * Create a NewsGateway.
     *
     * @param Connection $connection A connexion to the database where data will be manipulated.
     */
    public function __construct(Connection $connection) {
        $this->connection = $connection;
    }

    /**
     * Delete a news from its title.
     *
     * @param string $titre The title of the news that will be deleted.
     */
    public function delete(string $titre) {
        $query = "DELETE FROM NEWS WHERE title = :title";
        $this->connection->executeQuery($query, array(
            ':title' => array($titre, PDO::PARAM_STR)
        ));
    }

    /**
     * Insert a news in the database.
     *
     * @param string $title The title of the news that will be inserted.
     * @param string $link The link of the news that will be inserted.
     * @param string $description The description of the news that will be inserted.
     * @param string $date The date of the news that will be inserted.
     */
    public function insert(string $title, string $link, string $description, string $date) {
        $query = 'INSERT INTO NEWS VALUES(:title, :link, :description, :date)';
        $this->connection->executeQuery($query, array(
            ':title' => array($title, PDO::PARAM_STR),
            ':link' => array($link, PDO::PARAM_STR),
            ':description' => array($description, PDO::PARAM_STR),
            ':date' => array($date, PDO::PARAM_STR)
        ));
    }

    /**
     * Find all the news in the database.
     *
     * @return array An array of news.
     */
    public function findAllNews() : array {
        $newsArray = array();
        $query = 'SELECT * FROM NEWS ORDER BY date DSC';
        $this->connection->executeQuery($query, array());
        $results = $this->connection->getResults();
        foreach($results as $row) {
            $newsArray[] = new News($row['title'], $row['link'], $row['description'], $row['date']);
        }
        return $newsArray;
    }

    /**
     * Find all the news in the database coming from the feed passed in parameter.
     *
     * @param string $streamId The id of the feed
     * @return array An array of news.
     */
    public function findByStream(string $streamId) : array {
        $newsArray = array();
        $query = 'SELECT * FROM NEWS ORDER BY date DSC WHERE streamIdf = :id';
        $this->connection->executeQuery($query, array(
            ':id' => array($streamId, PDO::PARAM_STR)
        ));
        $results = $this->connection->getResults();
        foreach($results as $row) {
            $newsArray[] = new News($row['title'], $row['link'], $row['description'], $row['date']);
        }
        return $newsArray;
    }

    /**
     * Count the number of news in the database.
     *
     * @return int The number of news in the database.
     */
    public function numberOfNews() : int {
        $query = 'SELECT COUNT(*) FROM NEWS';
        $this->connection->executeQuery($query, array());
        $results = $this->connection->getResults();
        return $results[0];
    }
}