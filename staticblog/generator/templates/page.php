<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="travel, adventure, hiking, camping, backpacking">
    <meta name="description" content="<?php echo htmlspecialchars($page->title, ENT_QUOTES, 'UTF-8'); ?>">
    <link rel="stylesheet" type="text/css" href="../styles/site.css">
    <title><?php echo $article->title; ?></title>
  </head>
  <body>
    <?php include (dirname(__DIR__) . "/components/header.html"); ?>
    <div id="content">
      <?php require_once (dirname(dirname(__DIR__)) . "/content/pages/{$page->slug}.html"); ?>
    </div>
    <?php include (dirname(__DIR__) . "/components/footer.html"); ?>
  </body>
</html>