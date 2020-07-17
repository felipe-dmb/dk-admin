<?php

echo $_SERVER['REDIRECT_URL'] . "\n";
echo $_SERVER['QUERY_STRING'] . "\n";
print_r($_GET);

// $url = explode("/", $_GET['url']);
// print_r($_GET['url']."\n");
// print_r($url);