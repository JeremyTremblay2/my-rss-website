<?php
/**
 * Name : RssFeed.php
 * Project : My RSS website
 * Usefulness : contains a RssFeed class, allowing the instantiation of rss feeds.
 * Last Modification date : 18/11/2021
 * Authors : Maxime GRANET, Jérémy TREMBLAY
 */

/**
 * A RssFeed class, represent an RSS feed in a simplified way.
 *
 * RssFeed have a name, a link to the stream, a unique id, and an update date.
 */
class RssFeed {

    private string $name;
    private string $link;
    private string $updateDate;
    private int $id;

    /**
     * Create a new RssFeed.
     *
     * @param string $name The name of this Rss feed.
     * @param string $link The link to this Rss feed.
     * @param string $updateDate The date of the last update of this Rss feed.
     * @param int $id A unique id for this Rss feed.
     */
    public function __construct(string $name, string $link, string $updateDate, int $id) {
        $this->name = $name;
        $this->link = $link;
        $this->updateDate = $updateDate;
        $this->id = $id;
    }

    /**
     * Get the name of the stream.
     *
     * @return string The name of the stream.
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * Set the name to the stream.
     *
     * @param string $name The name to set on the stream.
     */
    public function setName(string $name) {
        $this->name = $name;
    }

    /**
     * Get the link to the stream.
     *
     * @return string The link to the stream.
     */
    public function getLink(): string {
        return $this->link;
    }

    /**
     * Set the link to the stream.
     *
     * @param string $link The link to set on the stream.
     */
    public function setLink(string $link) {
        $this->link = $link;
    }

    /**
     * Get the last modification date of the stream.
     *
     * @return string The last modification date of the stream.
     */
    public function getUpdateDate(): string {
        return $this->updateDate;
    }

    /**
     * Set the last modification date of the stream.
     *
     * @param string $updateDate The last modification date to set on the stream.
     */
    public function setUpdateDate(string $updateDate) {
        $this->updateDate = $updateDate;
    }

    /**
     * Get the id of the stream.
     *
     * @return int The id of the stream.
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * Set the id of the stream.
     *
     * @param int $id The id to set.
     */
    private function setId(int $id) {
        $this->id = $id;
    }

    /**
     * Return a string representing the RssFeed.
     *
     * @return string A string representing the rss feed.
     */
    public function __toString() : string {
        return 'Id : ' . $this->id . ', Name : ' . $this->name . ', Last modification update : ' .
            $this->updateDate . ', Link : ' . $this->link;
    }
}