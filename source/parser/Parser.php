<?php

class Parser {
    private $path;
    private $results;
    private $stream;

    public function getPath(): string {
        return $this->path;
    }

    public function setPath(string $path): void {
        $this->path = $path;
        $this->stream = simplexml_load_file($path, 'SimpleXMLElement', LIBXML_NOCDATA | LIBXML_COMPACT | LIBXML_NOWARNING);
    }

    public function getResults() {
        return $this->results;
    }

    public function parse(string $publicationDate): array {
        if (false === $this->stream) {
            throw new ParseError("Impossible de parser le flux RSS, il est incorrect ou non-reconnu.");
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

    private function getNews(SimpleXMLElement $item): array {
       return array($item->title, $item->link, $item->description, $item->pubDate);
    }
}