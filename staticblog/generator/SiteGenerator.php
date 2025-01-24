<?php
  require_once dirname(__FILE__) . '/utils/Utilities.php';
  require_once dirname(__FILE__) . '/config/Config.php';
  require_once dirname(__FILE__) . '/ContentList.php';

  class SiteGenerator {
    private $contentList;
    private $config;
    private $contentDir;
    private $siteDir;

    // Constructor
    public function __construct() {
      $this->contentList = new ContentList();
      $this->config = new Config();
    }

    public function generateSite() {
      echo '<hr />';
      $this->cleanupSiteFolders();
      $this->copyStyles();
      $this->copyMedia();
      $this->generateMenu();
      $this->generateArticleFiles();
      $this->generatePageFiles();
      $this->generateCategoryPages();
      $this->generateTagPages();
      $this->generateHomePage();
      echo '<hr />';
    }

    public function generateHomePage() {
      $homeInputFile = $this->config->GENERATOR_ROOT . '/templates/home.php';
      $homeOutputFile = $this->config->SITE_ROOT . '/index.html';

      $articleListHtml = $this->contentList->toArticleListHTML();
      $pageListHtml = $this->contentList->toPageListHTML();
      $categoryListHtml = $this->contentList->toCategoryListHTML();
      $tagListHtml = $this->contentList->toTagListHTML();
      ob_start();
      extract(['articleListHtml' => $articleListHtml]);
      extract(['pageListHtml' => $pageListHtml]);
      extract(['categoryListHtml' => $categoryListHtml]);
      extract(['tagListHtml' => $tagListHtml]);
      include $homeInputFile;
      $htmlContent = ob_get_contents();
      // End and clean the output buffer
      ob_end_clean(); 
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

    public function generateArticleFiles() {
      $articles = $this->contentList->getArticles();
      foreach($articles as $article) {
        $articleInputFile = $this->config->GENERATOR_ROOT . "/templates/article.php";
        $articleOutputFile = $this->config->SITE_ROOT . "/articles/{$article->slug}.html";
        ob_start();
        include $articleInputFile;
        $htmlContent = ob_get_contents();
        ob_end_clean();
        $minifiedHtml = Utilities::minifyHtml($htmlContent);
        file_put_contents($articleOutputFile, $minifiedHtml);
        echo "<br />+ Generated Article: $articleOutputFile";
      }
    }

    public function generatePageFiles() {
      $pages = $this->contentList->getPages();
      foreach($pages as $page) {
        $pageInputFile = $this->config->GENERATOR_ROOT . "/templates/page.php";
        $pageOutputFile = $this->config->SITE_ROOT . "/pages/{$page->slug}.html";
        ob_start();
        include $pageInputFile;
        $htmlContent = ob_get_contents();
        ob_end_clean();
        $minifiedHtml = Utilities::minifyHtml($htmlContent);
        file_put_contents($pageOutputFile, $minifiedHtml);
        echo "<br />+ Generated Page: $pageOutputFile";
      }
    }

    public function generateCategoryPages() {
      $categories = $this->contentList->getCategories();
      foreach($categories as $category) {
        $this->generateCategoryPage($category);
      }
    }

    private function generateCategoryPage($category) {
      $articlesPerCategory = $this->contentList->getArticlesPerCategory($category);

      $articleListHtml = '';
      foreach($articlesPerCategory as $article) {
        $articleListHtml .= $article->toListItemHTML();
      }
      $categoryInputFile = $this->config->GENERATOR_ROOT . "/templates/category.php";
      $categoryOutputFile = $this->config->SITE_ROOT . "/category/{$category->slug}.html";
      ob_start();
      extract(['category' => $category]);
      extract(['articleListHtml' => $articleListHtml]);
      include $categoryInputFile;
      $htmlContent = ob_get_contents();
      ob_end_clean();
      $minifiedHtml = Utilities::minifyHtml($htmlContent);
      file_put_contents($categoryOutputFile, $minifiedHtml);
      echo "<br />+ Generated categories: $categoryOutputFile";
    }

    public function generateTagPages() {
      $tags = $this->contentList->getTags();
      foreach($tags as $tag) {
        $this->generateTagPage($tag);
      }
    }
  
    private function generateTagPage($tag) {
      $articlesPerTag = $this->contentList->getArticlesPerTag($tag);

      // Initialize the variable outside the loop
      $articleListHtml = ''; 
      foreach($articlesPerTag as $article) {
        $articleListHtml .= $article->toListItemHTML();
      }

      $tagInputFile = $this->config->GENERATOR_ROOT . "/templates/tag.php";
      $tagOutputFile = $this->config->SITE_ROOT . "/tag/{$tag->slug}.html";

      ob_start();
      // Make the variable available in the included file
      extract(['tag' => $tag]);
      extract(['articleListHtml' => $articleListHtml]);
      include $tagInputFile;
      $htmlContent = ob_get_contents();
      ob_end_clean();
      file_put_contents($tagOutputFile, $htmlContent);
      echo "<br />+ Generated tags: $tagOutputFile";
    }

    private function copyStyles() {
      $styleInputFile = $this->config->GENERATOR_ROOT . "/styles/site.css";
      $styleOutputFile = $this->config->SITE_ROOT . "/styles/site.css";
      copy($styleInputFile, $styleOutputFile);
      echo "<br />+ Copied: $styleOutputFile";
    }

    private function copyMedia() {
      
      $mediaSourceDir = $this->config->CONTENT_ROOT . "/media";
      $mediaDestinationDir = $this->config->SITE_ROOT . "/media";
      Utilities::recursiveCopy($mediaSourceDir, $mediaDestinationDir);
      echo "<br />+ Copied: $mediaDestinationDir";
    }

    private function cleanupSiteFolders() {
      Utilities::deleteDirectoryAndRecreate($this->config->SITE_ROOT . "/articles");
      Utilities::deleteDirectoryAndRecreate($this->config->SITE_ROOT . "/pages");
      Utilities::deleteDirectoryAndRecreate($this->config->SITE_ROOT . "/category");
      Utilities::deleteDirectoryAndRecreate($this->config->SITE_ROOT . "/tag");
      Utilities::deleteDirectoryAndRecreate($this->config->SITE_ROOT . "/media");
      Utilities::deleteDirectoryAndRecreate($this->config->SITE_ROOT . "/styles");
    }
  }
?>