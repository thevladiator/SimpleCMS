<?php

require_once dirname(__FILE__) . '/../SiteGenerator.php';

$slug = $_GET['slug'];

if($slug) {
    $generator = new SiteGenerator();
    $generator->generateSingleArticle($slug, $generator->getSiteRoot());
} else {
    echo "No slug provided";
}

?>