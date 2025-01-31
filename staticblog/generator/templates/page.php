<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="<?php echo htmlspecialchars($page->toCommaSeparatedTitle(), ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="description" content="<?php echo htmlspecialchars($page->title, ENT_QUOTES, 'UTF-8'); ?> Page">
    <meta name="robots" content="index, follow">
    <link rel="stylesheet" type="text/css" href="../styles/site.css">
    <link rel="canonical" href="<?php echo htmlspecialchars($page->canonical, ENT_QUOTES, 'UTF-8'); ?>" />
    <link rel="icon" type="image/x-icon" href="../media/favicons/favicon.ico">
    <link rel="icon" type="image/png" sizes="16x16" href="../media/favicons/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../media/favicons/favicon-32x32.png">
    <title><?php echo htmlspecialchars($page->title, ENT_QUOTES, 'UTF-8'); ?></title>
  </head>
  <body>
    <?php
      include (dirname(__DIR__) . '/components/header.php');
      include (dirname(__DIR__) . '/components/menu.html');
    ?>
    <div id="content">
      <?php require_once (dirname(dirname(__DIR__)) . "/content/pages/{$page->slug}.html"); ?>
    </div>
    <?php include (dirname(__DIR__) . "/components/footer.php"); ?>
  </body>
</html>