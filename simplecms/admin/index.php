<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Static Website, Website Generator">
    <link rel="stylesheet" type="text/css" href="../generator/admin/styles/admin.css">
    <link rel="icon" type="image/x-icon" href="../generator/admin/media/favicon.ico">
    <link rel="icon" type="image/png" sizes="16x16" href="../generator/admin/media/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../generator/admin/media/favicon-32x32.png">
    <title>Static Blog Generator</title>
    <script>
      function generateSite() {
        document.getElementById('output').innerHTML = '';
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '../generator/generators/generateSite.php', true);
        xhr.onreadystatechange = function () {
          if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('output').innerHTML = xhr.responseText;
          }
        };
        xhr.send();
      }

      function generateArticle(slug) {
        document.getElementById('output').innerHTML = '';
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '../generator/generators/generateSingleArticle.php?slug=' + encodeURIComponent(slug), true);
        xhr.onreadystatechange = function () {
          if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('output').innerHTML = xhr.responseText;
          }
        };
        xhr.send();
      }
    </script>
  </head>
  <body>
    <h1>Static Blog Generator</h1>
    <ol>
      <li><a href="javascript:void(0);" onclick="generateSite();">Generate Entire Static Blog</a></li>
    </ol>
    <h2>Generate Individual Articles:</h2>
    <table>
      <thead>
        <tr>
          <th>Title</th>
          <th>Last Generated</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
<?php
require_once '../generator/ContentList.php';
require_once '../generator/config/Config.php';
$contentList = new ContentList();
$config = new Config();
$articles = $contentList->getArticles();
foreach($articles as $article) {
  $filePath = $config->SITE_ROOT . "/articles/{$article->slug}.html";
  $lastGenerated = file_exists($filePath) ? date('Y-m-d H:i:s', filemtime($filePath)) : 'Not generated yet';
  echo "<tr><td>{$article->title}</td><td>{$lastGenerated}</td><td><button onclick=\"generateArticle('{$article->slug}')\">Generate</button></td></tr>";
}
?>
      </tbody>
    </table>
    <h2>Output:</h2>
    <div id="output"></div>
  </body>
</html>