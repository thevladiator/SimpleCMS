<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="<?php echo $category->title; ?>">
    <meta name="description" content="<?php echo "Articles about $category->title"; ?> ?> Archive">
    <link rel="stylesheet" type="text/css" href="../styles/site.css">
    <title><?php echo "Articles about $category->title"; ?></title>
  </head>
  <body>
    <?php 
      include (dirname(__DIR__) . '/components/header.html'); 
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