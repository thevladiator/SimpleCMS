<?php

require_once dirname(__FILE__) . '/utils/Utilities.php';
require_once dirname(__FILE__) . '/config/Config.php';
require_once dirname(__FILE__) . '/ContentList.php';

class SiteGenerator {
  private $contentList;
  private $config;
  private $contentDir;
  private $siteDir;
  private $applyMinification;

  // Constructor
  public function __construct() {
    $this->contentList = new ContentList();
    $this->config = new Config();
    $this->applyMinification = Utilities::parseBoolean($this->config->MINIFY_HTML);
  }

  public function generateSite() {
    $this->cleanupSiteFolders(strval($this->config->SITE_ROOT));
    $this->copyStyles(strval($this->config->SITE_ROOT));
    $this->copyMedia(strval($this->config->SITE_ROOT));
    $this->generateMenu();
    $this->generateArticleFiles(strval($this->config->SITE_ROOT));
    $this->generatePageFiles(strval($this->config->SITE_ROOT));
    $this->generateCategoryPages(strval($this->config->SITE_ROOT));
    $this->generateTagPages(strval($this->config->SITE_ROOT));
    $this->generateHomePage(strval($this->config->SITE_ROOT));
  }
  
  public function generateHomePage(string $outputRoot) {
    $homeInputFile = $this->config->GENERATOR_ROOT . '/templates/home.php';
    $homeOutputFile = strval($outputRoot) . '/index.html';

    $articleListHtml = $this->contentList->toArticleListHTML();
    $pageListHtml = $this->contentList->toPageListHTML();
    $categoryListHtml = $this->contentList->toCategoryListHTML();
    $tagListHtml = $this->contentList->toTagListHTML();
    ob_start();
    extract(['siteUrl' => $this->config->SITE_URL_ROOT]);
    extract(['siteName' => $this->config->SITE_NAME]);
    extract(['siteDescription' => $this->config->SITE_DESCRIPTION]);
    extract(['siteKeywords' => $this->config->SITE_KEYWORDS]);
    extract(['articleListHtml' => $articleListHtml]);
    extract(['pageListHtml' => $pageListHtml]);
    extract(['categoryListHtml' => $categoryListHtml]);
    extract(['tagListHtml' => $tagListHtml]);
    include $homeInputFile;
    $htmlContent = ob_get_contents();
    // End and clean the output buffer
    ob_end_clean(); 
    if($this->applyMinification) {
      $htmlContent = Utilities::minifyHtml($htmlContent);
    }
    // Write the HTML content to the file 
    file_put_contents($homeOutputFile, $htmlContent);
    echo "<br />+ Generated: $homeOutputFile";
  }

  public function generateMenu() {
    $menuInputFile = $this->config->GENERATOR_ROOT . "/templates/menu.php";
    $menuOutputFile = $this->config->GENERATOR_ROOT . "/components/menu.html";
    ob_start();
    extract(['menuListHtml' => $this->contentList->getMenu()]);
    include $menuInputFile;
    $htmlContent = ob_get_contents();
    ob_end_clean();
    file_put_contents($menuOutputFile, $htmlContent);
    echo "<br />+ Generated: $menuOutputFile";
  }

  public function generateArticleFiles(string $outputRoot) {
    $articles = $this->contentList->getArticles();
    foreach($articles as $article) {
      $articleInputFile = $this->config->GENERATOR_ROOT . "/templates/article.php";
      $articleOutputFile = $outputRoot . "/articles/{$article->slug}.html";
      ob_start();
      extract(['siteUrl' => $this->config->SITE_URL_ROOT]);
      extract(['siteName' => $this->config->SITE_NAME]);
      extract(['article' => $article]);
      include $articleInputFile;
      $htmlContent = ob_get_contents();
      ob_end_clean();
      if($this->applyMinification) {
        $htmlContent = Utilities::minifyHtml($htmlContent);
      }
      file_put_contents($articleOutputFile, $htmlContent);
      
      echo "<br />+ Generated Article: $articleOutputFile";
    }
  }

  public function generatePageFiles(string $outputRoot) {
    $pages = $this->contentList->getPages();
    foreach($pages as $page) {
      $pageInputFile = $this->config->GENERATOR_ROOT . "/templates/page.php";
      $pageOutputFile = $outputRoot . "/pages/{$page->slug}.html";
      ob_start();
      extract(['siteUrl' => $this->config->SITE_URL_ROOT]);
      extract(['siteName' => $this->config->SITE_NAME]);
      extract(['page' => $page]);
      include $pageInputFile;
      $htmlContent = ob_get_contents();
      ob_end_clean();
      if($this->applyMinification) {
        $htmlContent = Utilities::minifyHtml($htmlContent);
      }
      file_put_contents($pageOutputFile, $htmlContent);
      echo "<br />+ Generated Page: $pageOutputFile";
    }
  }

  public function generateCategoryPages(string $outputRoot) {
    $categories = $this->contentList->getCategories();
    foreach($categories as $category) {
      $this->generateCategoryPage($category, $outputRoot);
    }
  }

  private function generateCategoryPage($category, string $outputRoot) {
    $articlesPerCategory = $this->contentList->getArticlesPerCategory($category);

    $articleListHtml = '';
    foreach($articlesPerCategory as $article) {
      $articleListHtml .= $article->toListItemHTML();
    }
    $categoryInputFile = $this->config->GENERATOR_ROOT . "/templates/category.php";
    $categoryOutputFile = $outputRoot . "/category/{$category->slug}.html";
    ob_start();
    extract(['siteUrl' => $this->config->SITE_URL_ROOT]);
    extract(['siteName' => $this->config->SITE_NAME]);
    extract(['category' => $category]);
    extract(['articleListHtml' => $articleListHtml]);
    include $categoryInputFile;
    $htmlContent = ob_get_contents();
    ob_end_clean();
    if($this->applyMinification) {
      $htmlContent = Utilities::minifyHtml($htmlContent);
    }
    file_put_contents($categoryOutputFile, $htmlContent);
    echo "<br />+ Generated categories: $categoryOutputFile";
  }

  public function generateTagPages(string $outputRoot) {
    $tags = $this->contentList->getTags();
    foreach($tags as $tag) {
      $this->generateTagPage($tag, $outputRoot);
    }
  }

  private function generateTagPage($tag, string $outputRoot) {
    $articlesPerTag = $this->contentList->getArticlesPerTag($tag);

    // Initialize the variable outside the loop
    $articleListHtml = ''; 
    foreach($articlesPerTag as $article) {
      $articleListHtml .= $article->toListItemHTML();
    }

    $tagInputFile = $this->config->GENERATOR_ROOT . "/templates/tag.php";
    $tagOutputFile = $outputRoot . "/tag/{$tag->slug}.html";

    ob_start();
    extract(['siteUrl' => $this->config->SITE_URL_ROOT]);
    extract(['siteName' => $this->config->SITE_NAME]);
    extract(['tag' => $tag]);
    extract(['articleListHtml' => $articleListHtml]);
    include $tagInputFile;
    $htmlContent = ob_get_contents();
    ob_end_clean();
    if($this->applyMinification) {
      $htmlContent = Utilities::minifyHtml($htmlContent);
    }
    file_put_contents($tagOutputFile, $htmlContent);
    echo "<br />+ Generated tags: $tagOutputFile";
  }

  private function copyStyles(string $outputRoot) {
    $styleInputFile = $this->config->CONTENT_ROOT . "/styles/site.css";
    $styleOutputFile = $outputRoot . "/styles/site.css";
    copy($styleInputFile, $styleOutputFile);
    echo "<br />+ Copied: $styleOutputFile";
  }

  private function copyMedia($outputRoot) {
    $mediaSourceDir = $this->config->CONTENT_ROOT . "/media";
    $mediaDestinationDir = strval($outputRoot) . "/media";
    Utilities::recursiveCopy($mediaSourceDir, $mediaDestinationDir);
    echo "<br />+ Copied: $mediaDestinationDir";
  }
  private function cleanupSiteFolders($outputRoot) {
    Utilities::deleteDirectoryAndRecreate(strval($outputRoot) . "/articles");
    Utilities::deleteDirectoryAndRecreate(strval($outputRoot) . "/pages");
    Utilities::deleteDirectoryAndRecreate(strval($outputRoot) . "/category");
    Utilities::deleteDirectoryAndRecreate(strval($outputRoot) . "/tag");
    Utilities::deleteDirectoryAndRecreate(strval($outputRoot) . "/media");
    Utilities::deleteDirectoryAndRecreate(strval($outputRoot) . "/styles");
  }
}