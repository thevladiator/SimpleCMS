<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="<?php echo htmlspecialchars($siteKeywords, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="description" content="<?php echo htmlspecialchars($siteDescription, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="robots" content="index, follow">
    <link rel="stylesheet" type="text/css" href="styles/site.css">
    <title><?php echo htmlspecialchars($siteName, ENT_QUOTES, 'UTF-8'); ?></title>
  </head>
  <body>
    <?php 
      include (dirname(__DIR__) . '/components/header.php');
      include (dirname(__DIR__) . '/components/menu.html');
    ?>
    <div id="content">
      <?php include (dirname(dirname(__DIR__)) . "/content/pages/home.html"); ?>
      <h2>Articles:</h2>
      <ul class="article-list">
        <?php echo $articleListHtml; ?>
      </ul>
      <h2>Pages:</h2>
      <ul class="article-list">
        <?php echo $pageListHtml; ?>
      </ul>
      <h2>Categories:</h2>
      <ul class="article-list">
        <?php echo $categoryListHtml; ?>
      </ul>
      <h2>Tags:</h2>
      <ul class="article-list">
        <?php echo $tagListHtml; ?>
      </ul>
    </div>
    <?php include (dirname(__DIR__) . '/components/footer.php'); ?>
  </body>
</html>