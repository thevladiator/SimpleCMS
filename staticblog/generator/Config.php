<?php

  class Config {
    public $PROJECT_ROOT;
    public $CONTENT_ROOT;
    public $DATABASE_LOCATION;
    public $SITE_ROOT;

    public function __construct() {
      $this->PROJECT_ROOT = dirname(dirname(__FILE__));
      $this->CONTENT_ROOT = $this->PROJECT_ROOT . '/content';
      $this->DATABASE_LOCATION = $this->CONTENT_ROOT . '/database/articles-db.json';
      $this->SITE_ROOT = 'C:/01-DEV/programs/wamp64/www/site_generator/site';
    }
  }

?>