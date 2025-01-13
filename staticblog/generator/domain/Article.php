<?php

  class Article {
    // Properties
    public $title;
    public $slug;
    public $category;
    public $tags = [];

    // Constructor
    public function __construct($title, $slug, $category, $tags) {
      $this->title = $title;
      $this->slug = $slug;
      $this->category = $category;
      $this->tags = $tags;
    }

    public function printArticleMetadata() {
      return "Category: $this->category; Tags: " . implode(",", $this->tags);
    }

    public function getArticleMetadata() {
      return $this->category . ',' . implode(",", $this->tags);
    }

    // Method to display car details
    public function toListItemHTML() {
        return "<li class=\"article-list-item\"><a href=\"articles/$this->slug\">$this->title</a></li>";
    }

    public function debugArticle() {
      echo toListItem();
    }
  }

?>
