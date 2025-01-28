<?php

class Config {
  public $PROJECT_ROOT;
  public $CONTENT_ROOT;
  public $GENERATOR_ROOT;
  public $DATABASE_LOCATION;
  public $SITE_NAME;
  public $SITE_KEYWORDS;
  public $SITE_DESCRIPTION;
  public $SITE_ROOT;
  public $SITE_URL_ROOT;
  public $MINIFY_HTML;

  public function __construct() {
    $this->PROJECT_ROOT = dirname(dirname(__DIR__));
    $properties = $this->loadProperties(file: $this->PROJECT_ROOT . '/config/config.properties');
    $this->CONTENT_ROOT = $this->PROJECT_ROOT . $properties['CONTENT_ROOT'];
    $this->GENERATOR_ROOT = $this->PROJECT_ROOT . $properties['GENERATOR_ROOT'];
    $this->DATABASE_LOCATION = $this->PROJECT_ROOT . $properties['CONTENT_DB_LOCATION'];
    $this->SITE_NAME = $properties['SITE_NAME'];
    $this->SITE_KEYWORDS = $properties['SITE_KEYWORDS'];
    $this->SITE_DESCRIPTION = $properties['SITE_DESCRIPTION'];
    $this->SITE_ROOT = $properties['SITE_ROOT'];
    $this->SITE_URL_ROOT = $properties['SITE_URL_ROOT'];
    $this->MINIFY_HTML = $properties['MINIFY_HTML'];
  }

  private function loadProperties($file) {
    $properties = [];
    $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Skip comments
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        list($key, $value) = explode('=', $line, 2);
        $properties[trim($key)] = trim($value);
    }
    return $properties;
  }
}