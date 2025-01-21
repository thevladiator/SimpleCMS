<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Software Development, Programming">
    <meta name="description" content="<?php echo $page->title; ?>">
    <link rel="stylesheet" type="text/css" href="../styles/site.css">
    <title><?php echo $page->title; ?></title>
  </head>
  <body>
    <?php include (dirname(__DIR__) . "/components/header.html"); ?>
    <div id="content">
      <?php require_once (dirname(dirname(__DIR__)) . "/content/pages/{$page->slug}.html"); ?>
    </div>
    <?php include (dirname(__DIR__) . "/components/footer.html"); ?>
  </body>
</html>