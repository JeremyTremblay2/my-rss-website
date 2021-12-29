<?php

/**
 * Name : Parser.php
 * Project : My RSS website
 * Usefulness : contains a Parser class, manage the parsing of stream .
 * Last Modification date : 29/12/2021
 * Authors : Maxime GRANET, Jérémy TREMBLAY
 */


class Parser {
    private $path;
    private $results;
    private $stream;

    /**
     * manage error
     * @throws ParseError
     */
    public function __construct() {
        set_error_handler(function($errno, $errstr) {
            throw new ParseError(Constants::PARSE_ERROR, $errno);
        });
    }

    /**
     * return the current path
     * @return string current path
     */
    public function getPath(): string {
        return $this->path;
    }

    /**
     * set the current path
     * @param string $path new path
     * @return void
     */
    public function setPath(string $path): void {
        $this->path = $path;
        $this->stream = simplexml_load_file($path, 'SimpleXMLElement', LIBXML_NOWARNING);
    }

    /**
     * return the current result
     * @return mixed arra with news
     */
    public function getResults() {
        return $this->results;
    }

    /**
     * search the news that is not already into BD
     * @param string $publicationDate date of the last update
     * @return array array of the news after the last update
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
     * return the corresponding news
     * @param SimpleXMLElement $item item which must be translated into news
     * @return array the news corresponding to the item
     */
    private function getNews(SimpleXMLElement $item): array {
       return array($item->title, $item->link, $item->description, $item->pubDate);
    }
}