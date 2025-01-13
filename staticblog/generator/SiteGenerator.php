<?php
  require_once dirname(__FILE__) . '/ArticleList.php';
  require_once dirname(__FILE__) . '/Config.php';

  class SiteGenerator {
    private $articleList;
    private $config;
    private $contentDir;
    private $siteDir;

    // Constructor
    public function __construct() {
      $this->articleList = new ArticleList();
      $this->config = new Config();
      echo "<br />ARTICLE LIST: <br />";
      print_r($this->articleList);
    }

    public function generateSite() {
      $this->generateArticleFiles();
      $this->generateHomePage();
    }

    public function generateHomePage() {
      $homeInputFile = $this->config->CONTENT_ROOT . '/templates/home.php';
      $homeOutputFile = $this->config->SITE_ROOT . '/index.html';

      $articleListHtml = $this->articleList->toListHTML();
      ob_start();
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
        $articleOutputFile = $this->config->SITE_ROOT . "/articles/$article->slug.html";
        ob_start();
        include $articleInputFile;
        $htmlContent = ob_get_contents();
        print_r($htmlContent);
        ob_end_clean();
        file_put_contents($articleOutputFile, $htmlContent);
      }
    }
  }
?>