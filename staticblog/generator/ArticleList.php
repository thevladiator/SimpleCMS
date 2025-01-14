<?php
  require_once dirname(__FILE__) . '/config/Config.php';
  require_once dirname(__FILE__) . '/domain/Article.php';

  class ArticleList {
    private $articles = [];
    private $categories = [];
    private $tags = [];
    private $config;

    // Constructor
    public function __construct() {
      $this->config = new Config();
      // Read the JSON file
      $jsonString = file_get_contents($this->config->DATABASE_LOCATION);

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

      $categoriesData = $dataArray['categories'];
      foreach ($categoriesData as $categoryData) {
        $category = new Category($categoryData);
        array_push($this->categories, $category);
      }

      $tagsData = $dataArray['tags'];
      foreach ($tagsData as $tagData) {
        $tag = new Tag($tagData);
        array_push($this->tags, $tag);
      }
    }

    public function getArticles() {
      return $this->articles;
    }

    public function getArticlesPerCategory($category) {
      $articlesPerCategory = [];
      foreach($this->articles as $article) {
        if($article->category == $category->title) {
          array_push($articlesPerCategory, $article);
        }
      }
      return $articlesPerCategory;
    }

    public  function getArticlesPerTag($tag) {
      $articlesPerTag = [];
      foreach($this->articles as $article) {
        if(in_array($tag->title, $article->tags)) {
          array_push($articlesPerTag, $article);
        }
      }
      return $articlesPerTag;
    }

    public function getCategories() {
      return $this->categories;
    }

    public function getTags() {
      return $this->tags;
    }

    public function toListHTML() {
      $listHtml = '';
      foreach($this->articles as $article) {
        $listHtml = $listHtml . $article->toListItemHTML();
      }

      return $listHtml;
    }

    public function toCategoryListHTML() {
      $listHtml = '';
      foreach($this->categories as $category) {
        $listHtml = $listHtml . $category->toListItemHTML();
      }

      return $listHtml;
    }

    public function toTagListHTML() {
      $listHtml = '';
      foreach($this->tags as $tag) {
        $listHtml = $listHtml . $tag->toListItemHTML();
      }

      return $listHtml;
    }
  }
?>