<?php
  require_once dirname(__FILE__) . '/Config.php';
  require_once dirname(__FILE__) . '/domain/Article.php';

  class ArticleList {
    private $articles = [];

    // Constructor
    public function __construct() {
      $config = new Config();
      // Read the JSON file
      $jsonString = file_get_contents($config->DATABASE_LOCATION);

      // Decode the JSON string into an associative array
      $dataArray = json_decode($jsonString, true);
      print_r($dataArray);
      $articlesData = $dataArray['articles'];
      print_r($articlesData);

      // Accessing the nested array (skills)
      foreach ($articlesData as $articleData) {
        // Define the output file
        $article = new Article($articleData['title'], $articleData['slug'], $articleData['category'], $articleData['tags']);
        array_push($this->articles, $article);
      }
    }

    public function getArticles() {
      return $this->articles;
    }

    public function toListHTML() {
      $listHtml = '';
      foreach($this->articles as $article) {
        $listHtml = $listHtml . $article->toListItemHTML();
      }

      return $listHtml;
    }
  }
?>