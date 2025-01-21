<?php
  require_once dirname(__FILE__) . '/config/Config.php';
  require_once dirname(__FILE__) . '/domain/Article.php';
  require_once dirname(__FILE__) . '/domain/Page.php';

  class ContentList {
    private $articles = [];
    private $pages = [];
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

      $articlesData = $dataArray['articles'];
      foreach ($articlesData as $articleData) {
        // Define the output file
        $article = new Article($articleData['title'], $articleData['slug'], $articleData['category'], $articleData['tags']);
        array_push($this->articles, $article);
      }

      $pagesData = $dataArray['pages'];
      // We don't want Home to be in the list of pages
      $filteredPagesData = array_filter($pagesData, function($pageData) {
        return $pageData['title'] !== 'Home';
      });
      foreach ($filteredPagesData as $pageData) {
        // Define the output file
        $page = new Page($pageData['title'], $pageData['slug']);
        array_push($this->pages, $page);
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

    public function getPages() {
      return $this->pages;
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

    public function toArticleListHTML() {
      $listHtml = '';
      foreach($this->articles as $article) {
        $listHtml = $listHtml . $article->toListItemHTML();
      }

      return $listHtml;
    }

    public function toPageListHTML() {
      $listHtml = '';
      foreach($this->pages as $page) {
        $listHtml = $listHtml . $page->toListItemHTML();
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