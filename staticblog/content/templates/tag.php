<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../styles/site.css">
  </head>
  <body>
    <?php 
      include (dirname(__DIR__) . '/components/header.html'); 
    ?>
    <div id="content">
      <h2>Articles for topic: <?php echo $tag->title; ?></h2>
      <ul class="article-list">
        <?php echo $articleListHtml; ?>
      </ul>
    </div>
    <?php include (dirname(__DIR__) . '/components/footer.html'); ?>
  </body>
</html>