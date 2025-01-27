<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="<?php echo htmlspecialchars($tag->toCommaSeparatedTitle(), ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="description" content="Articles about <?php echo htmlspecialchars($tag->title, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="robots" content="index, follow">
    <link rel="stylesheet" type="text/css" href="../styles/site.css">
    <link rel="icon" type="image/x-icon" href="../media/favicons/favicon.ico">
    <link rel="icon" type="image/png" sizes="16x16" href="../media/favicons/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../media/favicons/favicon-32x32.png">
    <title><?php echo htmlspecialchars($tag->title, ENT_QUOTES, 'UTF-8'); ?> Articles</title>
  </head>
  <body>
    <?php 
      include (dirname(__DIR__) . '/components/header.php');
      include (dirname(__DIR__) . '/components/menu.html');
    ?>
    <div id="content">
      <h2><?php echo $tag->title; ?> Articles:</h2>
      <ul class="article-list">
        <?php echo $articleListHtml; ?>
      </ul>
    </div>
    <?php include (dirname(__DIR__) . '/components/footer.php'); ?>
  </body>
</html>