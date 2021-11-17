<?php
/**
 * Name : NewsGateway.php
 * Project : My RSS website
 * Usefulness : contains a NewsGateway class, allowing actions on data inside the database, like updates,
 * researches and deletes.
 * Last Modification date : 17/11/2021
 * Authors : Maxime GRANET, Jérémy TREMBLAY
 */

/**
 * A NewsGateway class, allows you to carry out actions on the news of the database.
 *
 * NewsGateway must have a way to connect to the database. A NewsGateway can do some actions on data.
 */
class NewsGateway {
    private Connexion $connexion;

    /**
     * Create a NewsGateway.
     *
     * @param Connexion $connexion A connexion to the database where data will be manipulated.
     */
    public function __construct(Connexion $connexion) {
        $this->connexion = $connexion;
    }

    /**
     * Delete a news from its title.
     *
     * @param string $titre The title of the news that will be deleted.
     */
    public function delete(string $titre) {
        $query = "DELET FROM NEWS WHERE title = :title";
        $this->connexion->executeQuery($query, array(
            ':titre' => array($titre, PDO::PARAM_STR)
        ));
    }

    // Please add a select function that return all news from the database.

    /**
     * Count the number of news in the database.
     *
     * @return int The number of news in the database.
     */
    public function numberOfNews() : int {
        $query = "SELECT COUNT(*) FROM NEWS";
        $this->connexion->executeQuery($query, array());
        $results = $this->connexion->getResults();
        return results[0];
    }
}