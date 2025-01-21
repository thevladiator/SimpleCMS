<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="<?php echo $article->getArticleMetadata(); ?>">
    <meta name="description" content="<?php echo $article->title; ?>">
    <link rel="stylesheet" type="text/css" href="../styles/site.css">
    <title><?php echo $article->title; ?></title>
  </head>
  <body>
    <?php include (dirname(__DIR__) . "/components/header.html"); ?>
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