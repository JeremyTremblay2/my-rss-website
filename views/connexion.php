<?php
/** Name : Connection.php
 * Project : My RSS website
 * Usefulness : Class allowing a user to connect himself to a database and execute some queries.
 * Last Modification date : 18/11/2021
 * Authors : SALVA Sébastien, VIALLEMONTEIL Sébastien
 */

/**
 * A Connection class, allowing the user to connect himself to a database.
 *
 * It can execute some queries and modify data.
 */
class Connection extends PDO {
    private $stmt;

    /**
     * Create a new Connection.
     *
     * @param string $dsn The database name.
     * @param string $username The username of the database.
     * @param string $password The password of the user.
     */
    public function __construct(string $dsn, string $username, string $password) {
        parent::__construct($dsn, $username, $password);
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Execute a query in the database.
     *
     * @param string $query The query in SQL format.
     * @param array $parameters An array of parameters representing the types of the values to bind.
     * @return bool Returns `true` on success, `false` otherwise.
    */
    public function executeQuery(string $query, array $parameters = []) : bool{
        $this->stmt = parent::prepare($query);
        foreach ($parameters as $name => $value) {
            $this->stmt->bindValue($name, $value[0], $value[1]);
        }
        return $this->stmt->execute();
    }

    /**
     * Get the result of the last request.
     *
     * @return array The results of the last request.
     */
    public function getResults() : array {
        return $this->stmt->fetchall();
    }
}