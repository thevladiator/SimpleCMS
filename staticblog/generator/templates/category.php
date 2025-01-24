<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="<?php echo htmlspecialchars($category->toCommaSeparatedTitle(), ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="description" content="Articles about <?php echo htmlspecialchars($category->title, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="robots" content="index, follow">
    <link rel="stylesheet" type="text/css" href="../styles/site.css">
    <title><?php echo htmlspecialchars($category->title, ENT_QUOTES, 'UTF-8') . ' Articles'; ?></title>
  </head>
  <body>
    <?php 
      include (dirname(__DIR__) . '/components/header.html');
      include (dirname(__DIR__) . '/components/menu.html');
    ?>
    <div id="content">
      <h2><?php echo $category->title; ?> Articles:</h2>
      <ul class="article-list">
        <?php echo $articleListHtml; ?>
      </ul>
    </div>
    <?php include (dirname(__DIR__) . '/components/footer.html'); ?>
  </body>
</html>