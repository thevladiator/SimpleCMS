<?php
  require_once dirname(__FILE__) . '/ArticleList.php';
  require_once dirname(__FILE__) . '/config/Config.php';

  class SiteGenerator {
    private $articleList;
    private $config;
    private $contentDir;
    private $siteDir;

    // Constructor
    public function __construct() {
      $this->articleList = new ArticleList();
      $this->config = new Config();
    }

    public function generateSite() {
      echo '<hr />';
      $this->copyStyles();
      $this->generateArticleFiles();
      $this->generateCategoryPages();
      $this->generateTagPages();
      $this->generateHomePage();
      echo '<hr />';
    }

    public function generateHomePage() {
      $homeInputFile = $this->config->CONTENT_ROOT . '/templates/home.php';
      $homeOutputFile = $this->config->SITE_ROOT . '/index.html';

      $articleListHtml = $this->articleList->toListHTML();
      $categoryListHtml = $this->articleList->toCategoryListHTML();
      $tagListHtml = $this->articleList->toTagListHTML();
      ob_start();
      extract(['articleListHtml' => $articleListHtml]);
      extract(['categoryListHtml' => $categoryListHtml]);
      extract(['tagListHtml' => $tagListHtml]);
      include $homeInputFile;
      $htmlContent = ob_get_contents();
      // End and clean the output buffer
      ob_end_clean(); 
      // Write the HTML content to the file 
      file_put_contents($homeOutputFile, $htmlContent);
      echo "<br />Generated: $homeOutputFile";
    }

    public function generateArticleFiles() {
      $articles = $this->articleList->getArticles();
      foreach($articles as $article) {
        $articleInputFile = $this->config->CONTENT_ROOT . "/templates/article.php";
        $articleOutputFile = $this->config->SITE_ROOT . "/articles/{$article->slug}.html";
        ob_start();
        include $articleInputFile;
        $htmlContent = ob_get_contents();
        ob_end_clean();
        file_put_contents($articleOutputFile, $htmlContent);
        echo "<br />Generated: $articleOutputFile";
      }
    }

    public function generateCategoryPages() {
      $categories = $this->articleList->getCategories();
      foreach($categories as $category) {
        $this->generateCategoryPage($category);
      }
    }

    private function generateCategoryPage($category) {
      $articlesPerCategory = $this->articleList->getArticlesPerCategory($category);

      $articleListHtml = '';
      foreach($articlesPerCategory as $article) {
        $articleListHtml .= $article->toListItemHTML();
      }
      $categoryInputFile = $this->config->CONTENT_ROOT . "/templates/category.php";
      $categoryOutputFile = $this->config->SITE_ROOT . "/categories/{$category->slug}.html";
      ob_start();
      extract(['category' => $category]);
      extract(['articleListHtml' => $articleListHtml]);
      include $categoryInputFile;
      $htmlContent = ob_get_contents();
      ob_end_clean();
      file_put_contents($categoryOutputFile, $htmlContent);
      echo "<br />Generated: $categoryOutputFile";
    }

    public function generateTagPages() {
      $tags = $this->articleList->getTags();
      foreach($tags as $tag) {
        $this->generateTagPage($tag);
      }
    }
  
    private function generateTagPage($tag) {
      $articlesPerTag = $this->articleList->getArticlesPerTag($tag);

      // Initialize the variable outside the loop
      $articleListHtml = ''; 
      foreach($articlesPerTag as $article) {
        $articleListHtml .= $article->toListItemHTML();
      }

      $tagInputFile = $this->config->CONTENT_ROOT . "/templates/tag.php";
      $tagOutputFile = $this->config->SITE_ROOT . "/tags/{$tag->slug}.html";

      ob_start();
      // Make the variable available in the included file
      extract(['tag' => $tag]);
      extract(['articleListHtml' => $articleListHtml]);
      include $tagInputFile;
      $htmlContent = ob_get_contents();
      ob_end_clean();
      file_put_contents($tagOutputFile, $htmlContent);
      echo "<br />Generated: $tagOutputFile";
    }

    private function copyStyles() {
      $styleInputFile = $this->config->CONTENT_ROOT . "/styles/site.css";
      $styleOutputFile = $this->config->SITE_ROOT . "/styles/site.css";
      copy($styleInputFile, $styleOutputFile);
      echo "<br />Copied: $styleOutputFile";
    }
  }

?>