<?php

/**
 * Name : Parser.php
 * Project : My RSS website
 * Usefulness : contains a Parser class, manage the parsing of stream .
 * Last Modification date : 29/12/2021
 * Authors : Maxime GRANET, Jérémy TREMBLAY
 */

/**
 * A parser allows reading XML files and streams, by using simpleXML.
 */
class Parser {
    private $path;
    private $results;
    private $stream;

    /**
     * Create a new Parser. Manage errors.
     * @throws ParseError If an error occurs.
     */
    public function __construct() {
        set_error_handler(function($errno, $errstr) {
            throw new ParseError(Constants::PARSE_ERROR, $errno);
        });
    }

    /**
     * Get the current path of the stream
     * @return string The current path
     */
    public function getPath(): string {
        return $this->path;
    }

    /**
     * Set a new path
     * @param string $path The new path
     * @return void
     */
    public function setPath(string $path): void {
        $this->path = $path;
        $this->stream = simplexml_load_file($path, 'SimpleXMLElement', LIBXML_NOWARNING);
    }

    /**
     * Get the last results
     * @return mixed An array with of news
     */
    public function getResults() {
        return $this->results;
    }

    /**
     * Search the news from the stream and get the news that are not already in the database by comparing dates
     * @param string $publicationDate The date of the last update
     * @return array An array of the news after the last update
     */
    public function parse(string $publicationDate): array {
        set_error_handler(function($errno, $errstr) {
            throw new ParseError(Constants::PARSE_ERROR, $errno);
        });
        if (false === $this->stream) {
            restore_error_handler();
        }

        $this->results = array();
        foreach ($this->stream->channel->item as $item) {
            $date = strftime("%Y-%m-%d %H:%M:%S", strtotime(($item->pubDate)));
            if ($date > $publicationDate) {
                $this->results[] = $this->getNews($item);
            }
        }
        return $this->results;
    }

    /**
     * Get a new
     * @param SimpleXMLElement $item The item which must be translated into news
     * @return array A news corresponding to the item
     */
    private function getNews(SimpleXMLElement $item): array {
       return array($item->title, $item->link, $item->description, $item->pubDate);
    }
}