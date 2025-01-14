<?php

  require_once dirname(__DIR__) . '/config/Config.php';
  require_once dirname(__DIR__) . '/utils/Utilities.php';

  class Category {
      // Properties
      private $config;
      public $title;
      public $slug;

      // Constructor
      public function __construct($title) {
        $this->config = new Config();
        $this->title = $title;
        $this->slug = Utilities::convertTitleToSlug($title);
      }

      public function toListItemHTML() {
        return "<li class=\"category-list-item\"><a href=\"{$this->config->SITE_URL_ROOT}/categories/{$this->slug}.html\">$this->title</a></li>";
      }

      public function toLinkHTML() {
        return "<span class=\"category-link\"><a href=\"{$this->config->SITE_URL_ROOT}/categories/{$this->slug}.html\">$this->title</a></span>";
      }
  }

?>
