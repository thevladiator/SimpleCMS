<?php

  require_once dirname(__DIR__) . '/utils/Utilities.php';

  class Tag {
      // Properties
      public $title;
      public $slug;

      // Constructor
      public function __construct($title) {
        $this->title = $title;
        $this->slug = Utilities::convertTitleToSlug($title);
      }
  }

?>