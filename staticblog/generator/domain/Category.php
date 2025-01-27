<?php

require_once dirname(__DIR__) . '/config/Config.php';
require_once dirname(__DIR__) . '/utils/Utilities.php';

class Category {
  // Properties
  private Config $config;
  public string $title;
  public string $slug;

  // Constructor
  public function __construct(string $title) {
    $this->config = new Config();
    $this->title = $title;
    $this->slug = Utilities::convertTitleToSlug($title);
  }

  public function toListItemHTML() {
    return "<li class=\"category-list-item\"><a href=\"{$this->config->SITE_URL_ROOT}/category/{$this->slug}.html\">$this->title</a></li>";
  }

  // We want to display only the first word of the category title
  public function toMenuItemHTML() {
    $firstWord = explode(' ', trim($this->title))[0];
    return "<li class=\"category-list-item\"><a href=\"{$this->config->SITE_URL_ROOT}/category/{$this->slug}.html\">$firstWord</a></li>";
  }

  public function toLinkHTML() {
    return "<span class=\"category-link\"><a href=\"{$this->config->SITE_URL_ROOT}/category/{$this->slug}.html\">$this->title</a></span>";
  }

  public function toCommaSeparatedTitle() {
    $words = explode(' ', trim($this->title));
    return implode(', ', $words);
  }
}
