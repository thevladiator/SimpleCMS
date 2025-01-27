<?php

  require_once dirname(__DIR__) . '/config/Config.php';
  require_once 'Category.php';
  require_once 'Tag.php';

  class Page {
    // Properties
    public $config;
    public $title;
    public $slug;

    // Constructor
    public function __construct($title, $slug) {
      $this->config = new Config();
      $this->title = $title;
      $this->slug = $slug;
    }

    public function toListItemHTML() {
        return "<li class=\"page-list-item\"><a href=\"{$this->config->SITE_URL_ROOT}/pages/{$this->slug}.html\">$this->title</a></li>";
    }

    public function toCommaSeparatedTitle() {
      $words = explode(' ', trim($this->title));
      return implode(', ', $words);
    }
  }

?>
