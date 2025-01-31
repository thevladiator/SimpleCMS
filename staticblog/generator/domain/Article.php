<?php

require_once dirname(__DIR__) . '/config/Config.php';
require_once 'Category.php';
require_once 'Tag.php';

class Article {
  // Properties
  public Config $config;
  public string $title;
  public string $slug;
  public string $category;
  public string $canonical;
  public array $tags = [];
  public Category $categoryObject;
  public array $tagObjects = [];

  // Constructor
  public function __construct($title, $slug, $category, $tags) {
    $this->config = new Config();
    $this->title = $title;
    $this->slug = $slug;
    $this->category = $category;
    $this->canonical = "https://www.{$this->config->SITE_NAME}/articles/{$this->slug}.html";
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

  public function toSiteMapItemXML($xml) {
    $url = $xml->addChild('url');
    $url->addChild('loc', htmlspecialchars("$this->canonical"));
    $url->addChild('lastmod', date('Y-m-d'));
    $url->addChild('changefreq', 'weekly');
    $url->addChild('priority', '0.5');
  }

  private function convertStringsToTagObjects(array $tagStrings) {
    $tagObjects = [];
    foreach($tagStrings as $tag) {
      $tagObjects[] = new Tag($tag);
    }
    return $tagObjects;
  }

  private function convertTagObjectsToLinks(array $tagObjects) {
    $tagLinks = [];
    foreach($tagObjects as $tagObject) {
      $tagLinks[] = $tagObject->toLinkHTML();
    }
    return $tagLinks;
  }
}
