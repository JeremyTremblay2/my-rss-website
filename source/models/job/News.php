<?php
/**
 * Name : News.php
 * Project : My RSS website
 * Usefulness : contains a News class, allowing the instantiation of news.
 * Last Modification date : 18/11/2021
 * Authors : Maxime GRANET, Jérémy TREMBLAY
 */

/**
 * A news class, represent a news in a simplified way.
 *
 * News have an id, a title, a small description, a release date, a link to the news and an id representing
 * the rss feed in which they come.
 */
class News {

    private $id;
    private $idRssFeed;
    private $title;
    private $link;
    private $description;
    private $publicationDate;

    /**
     * Create a news, like we can find on the net.
     *
     * @param $id int The id of the news.
     * @param $idRssFeed int The id of the rss feed where the news come from.
     * @param $title string The title of the news.
     * @param $link string The link to access the news.
     * @param $description string A small description.
     * @param $date string The release date of the news.
     */
    public function __construct(int $id, int $idRssFeed, string $title, string $link, string $description, string $date) {
        $this->id = $id;
        $this->idRssFeed = $idRssFeed;
        $this->title = $title;
        $this->link = $link;
        $this->description = $description;
        $this->publicationDate = $date;
    }

    /**
     * Get the id of the news.
     *
     * @return int The id of the news.
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * Set the id of the news.
     *
     * @param int $id The id of the news to modify.
     */
    private function setId(int $id): void {
        $this->id = $id;
    }

    /**
     * Get the id of the rss feed of the news.
     *
     * @return int The id of the rss feed from witch the news comes.
     */
    public function getIdRssFeed(): int {
        return $this->idRssFeed;
    }

    /**
     * Set the id of the rss feed of the news.
     *
     * @param int $idRssFeed The id of the rss feed of the news.
     */
    private function setIdRssFeed(int $idRssFeed): void {
        $this->idRssFeed = $idRssFeed;
    }

    /**
     * Get the title of the news.
     *
     * @return string The title of the news
     */
    public function getTitle(): string {
        return $this->title;
    }

    /**
     * Set the title of the news.
     *
     * @param string $title The title to modify.
     */
    private function setTitle(string $title): void {
        $this->title = $title;
    }

    /**
     * Get the link of the news.
     *
     * @return string
     */
    public function getLink(): string {
        return $this->link;
    }

    /**
     * Set the link of the news.
     *
     * @param string $link The link to modify.
     * @return void
     */
    private function setLink(string $link): void {
        $this->link = $link;
    }

    /**
     * Get the description of the news.
     *
     * @return string The description of the news.
     */
    public function getDescription(): string {
        return $this->description;
    }

    /**
     * Set the description of the news.
     *
     * @param string $description The description to modify.
     */
    private function setDescription(string $description): void {
        $this->description = $description;
    }

    /**
     * Get the release date of the news.
     *
     * @return string The release date of the news.
     */
    public function getPublicationDate(): string {
        return $this->publicationDate;
    }

    /**
     * Set the release date of the news.
     *
     * @param string $date The date to modify
     */
    private function setDate(string $date): void {
        $this->publicationDate = $date;
    }

    /**
     * Return a string representing the news.
     *
     * @return string A string representing the news.
     */
    public function __toString() : string {
        return '[' . $this->id . ' - ' . $this->idRssFeed . '] ' . $this->publicationDate . ', Link : ' . $this->link .
            ', Title : ' . $this->title . ', Description : ' . $this->description ;
    }
}