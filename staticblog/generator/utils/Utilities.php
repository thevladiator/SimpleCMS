<?php

  class Utilities {
    public static function convertTitleToSlug ($title) {
      // Convert the string to lowercase
      $lowercaseString = strtolower($title);

      // Replace all spaces with hyphens
      $slug = str_replace(' ', '-', $lowercaseString);

      return $slug;
    }

    public static function minifyHtml($html) {
      // Remove whitespaces after tags, except space
      // Remove whitespaces before tags, except space
      // Shorten multiple whitespace sequences
      $search = [
          '/\>[^\S ]+/s',
          '/[^\S ]+\</s',
          '/(\s)+/s'
      ];
      $replace = [
          '>',
          '<',
          '\\1'
      ];
      return preg_replace($search, $replace, $html);
    }
  }
  
?>