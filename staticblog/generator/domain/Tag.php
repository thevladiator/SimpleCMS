<?php

require_once dirname(__DIR__) . '/config/Config.php';
require_once dirname(__DIR__) . '/utils/Utilities.php';

class Tag {
  // Properties
  private Config $config;
  public string $title;
  public string $slug;
  public string $canonical;

  // Constructor
  public function __construct(string $title) {
    $this->config = new Config();
    $this->title = $title;
    $this->slug = Utilities::convertTitleToSlug($title);
    $this->canonical = "https://www.{$this->config->SITE_NAME}/tag/{$this->slug}.html";
  }

  public function toListItemHTML() {
    return "<li class=\"tag-list-item\"><a href=\"{$this->config->SITE_URL_ROOT}/tag/{$this->slug}.html\">$this->title</a></li>";
  }
  
  public function toLinkHTML() {
    return "<span class=\"tag-link\"><a href=\"{$this->config->SITE_URL_ROOT}/tag/{$this->slug}.html\">$this->title</a></span>";
  }

  public function toCommaSeparatedTitle() {
    $words = explode(' ', trim($this->title));
    return implode(', ', $words);
  }
}