<?php

  require_once dirname(__DIR__) . '/utils/Utilities.php';

  class Category {
      // Properties
      public $title;
      public $slug;

      // Constructor
      public function __construct($title) {
        $this->title = $title;
        $this->slug = Utilities::convertTitleToSlug($title);
      }

      public function toListItemHTML() {
        return "<li class=\"category-list-item\"><a href=\"categories/{$this->slug}.html\">$this->title</a></li>";
      }

      public function toLinkHTML() {
        return "<a href=\"categories/{$this->slug}.html\">$this->title</a>";
      }
  }

?>
