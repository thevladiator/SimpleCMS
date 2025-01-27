<?php

  require_once dirname(__DIR__) . '/config/Config.php';
  require_once 'Category.php';
  require_once 'Tag.php';

  class Article {
    // Properties
    public $config;
    public $title;
    public $slug;
    public $category;
    public $tags = [];
    public $categoryObject;
    public $tagObjects = [];

    // Constructor
    public function __construct($title, $slug, $category, $tags) {
      $this->config = new Config();
      $this->title = $title;
      $this->slug = $slug;
      $this->category = $category;
      $this->tags = $tags;
      $this->categoryObject = new Category($category);
      $this->tagObjects= $this->convertStringsToTagObjects($tags);
    }

    public function printArticleMetadata() {
      return "Category: {$this->categoryObject->toLinkHTML()} Tags: "
        . implode(", ", $this->convertTagObjectsToLinks($this->tagObjects));
    }

    public function getArticleMetadata() {
      return $this->category . ',' . implode(",", $this->tags);
    }

    public function toListItemHTML() {
      return "<li class=\"article-list-item\"><a href=\"{$this->config->SITE_URL_ROOT}/articles/{$this->slug}.html\">$this->title</a></li>";
    }

    private function convertStringsToTagObjects($tagStrings) {
      $tagObjects = [];
      foreach($tagStrings as $tag) {
        $tagObjects[] = new Tag($tag);
      }
      return $tagObjects;
    }

    private function convertTagObjectsToLinks($tagObjects) {
      $tagLinks = [];
      foreach($tagObjects as $tagObject) {
        $tagLinks[] = $tagObject->toLinkHTML();
      }
      return $tagLinks;
    }
  }

?>
