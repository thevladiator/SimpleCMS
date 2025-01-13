<?php

  class Utilities {
    public static function convertTitleToSlug ($title) {
      // Convert the string to lowercase
      $lowercaseString = strtolower($title);

      // Replace all spaces with hyphens
      $slug = str_replace(' ', '-', $lowercaseString);

      return $slug;
    }
  }
  
?>