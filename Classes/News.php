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
 * News have a title, a small description, a release date and a link to the news.
 */
class News {
    private string $title;
    private string $link;
    private string $description;
    private string $date;

    /**
     * Create a news, as we can find on the net.
     *
     * @param $title string The title of the news.
     * @param $link string The link to access the news.
     * @param $description string A small description.
     * @param $date string The release date of the news.
     */
    public function __construct(string $title, string $link, string $description, string $date) {
        $this->title = $title;
        $this->link = $link;
        $this->description = $description;
        $this->date = $date;
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
     * Changes the title of the news.
     *
     * @param string $title The title to modify.
     */
    public function setTitle(string $title): void {
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
    public function setLink(string $link): void {
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
    public function setDescription(string $description): void {
        $this->description = $description;
    }

    /**
     * Get the release date of the news.
     *
     * @return string The release date of the news.
     */
    public function getDate(): string {
        return $this->date;
    }

    /**
     * Set the release date of the news.
     *
     * @param string $date The date to modify
     */
    public function setDate(string $date): void {
        $this->date = $date;
    }

    /**
     * Return a string representing the news.
     *
     * @return string A string representing the news.
     */
    public function __toString() : string {
        return 'Title : ' . $this->title . ', Release date : ' . $this->date .
            ', Description : ' . $this->description . ', Link : ' . $this->link;
    }
}