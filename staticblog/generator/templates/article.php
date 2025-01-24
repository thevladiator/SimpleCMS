<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="<?php echo htmlspecialchars($article->getArticleMetadata(), ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="description" content="<?php echo htmlspecialchars($article->title, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="robots" content="index, follow">
    <link rel="stylesheet" type="text/css" href="../styles/site.css">
    <title><?php echo htmlspecialchars($article->title, ENT_QUOTES, 'UTF-8'); ?></title>
  </head>
  <body>
    <?php
      include (dirname(__DIR__) . '/components/header.html');
      include (dirname(__DIR__) . '/components/menu.html');
    ?>
    <div class="article-metadata">
      <?php echo $article->printArticleMetadata(); ?>
    </div>
    <div id="content">
      <?php require_once (dirname(dirname(__DIR__)) . "/content/articles/{$article->slug}.html"); ?>
    </div>
    <div class="article-metadata">
      <?php echo $article->printArticleMetadata(); ?>
    </div>
    <?php include (dirname(__DIR__) . "/components/footer.html"); ?>
  </body>
</html>