<?php

class NewsModel {
    private $gateway;

    public function __construct() {
        global $dsn, $login, $password;
        $this->gateway = new NewsGateway(new Connection($dsn, $login, $password));
    }

    public function deleteNews(int $id): void {
        $this->gateway->delete($id);
    }
    public function insertNews(int $idRssFeed, string $title, string $link,
                               string $description, string $publicationDate): void {
        $this->gateway->insert($idRssFeed, $title, $link,$description, $publicationDate);
    }

    public function findNewsByStream(int $idRssFeed): ?array {
        $results = $this->gateway->findByStream($idRssFeed);
        return $this->getInstances($results);
    }

    public function findAllNews(): ?array {
        $results = $this->gateway->findAllNews();
        return $this->getInstances($results);
    }

    public function findNewsInRange(int $limit, int $offset): ?array {
        $results = $this->gateway->findInRange($limit, $offset);
        return $this->getInstances($results);
    }

    public function getNumberOfNews(): int {
        return $this->gateway->numberOfNews()[0][0];
    }

    private function getInstances(?array $results): ?array
    {
        $newsArray = array();

        if (!empty($results)) {
            foreach ($results as $row) {
                $news = new News($row['id'], $row['streamIdf'], $row['title'], $row['link'],
                    $row['description'], $row['publicationDate']);
                $newsArray[] = $news;
            }
            return $newsArray;
        }
        return null;
    }
}
