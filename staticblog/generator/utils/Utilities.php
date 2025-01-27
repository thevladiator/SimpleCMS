<?php

class Utilities {
  public static function convertTitleToSlug (string $title) {
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

  public static function deleteDirectoryAndRecreate (string $dir) {
    // Delete and recreate the folder
    if (is_dir($dir)) {
      self::deleteDirectory($dir);
      echo "<br /> - Deleted directory: $dir";
    }
    mkdir($dir, 0777, true);
  }

  private static function deleteDirectory(string $dir) {
    $DIRECTORY_SEPARATOR = '/';
    if (!file_exists($dir)) {
        return true;
    }
    if (!is_dir($dir)) {
        return unlink($dir);
    }
    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }
        if (!self::deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }
    }
    return rmdir($dir);
  }

  public static function recursiveCopy(string $source, string $destination) {
    $dir = opendir($source);
    @mkdir($destination);

    while (($file = readdir($dir)) !== false) {
        if ($file != '.' && $file != '..') {
            if (is_dir($source . '/' . $file)) {
                self::recursiveCopy($source . '/' . $file, $destination . '/' . $file);
            } else {
                copy($source . '/' . $file, $destination . '/' . $file);
            }
        }
    }
    closedir($dir);
  }
}