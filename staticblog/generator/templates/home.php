<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/site.css">
    <title>Making Better Software</title>
  </head>
  <body>
    <?php 
      include (dirname(__DIR__) . '/components/header.html'); 
    ?>
    <div id="content">
      <h2>Welcome</h2>
      <h2>Articles:</h2>
      <ul class="article-list">
        <?php echo $articleListHtml; ?>
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
    <?php include (dirname(__DIR__) . '/components/footer.html'); ?>
  </body>
</html>