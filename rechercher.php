<?php
require_once("include/header_meta.php");
require_once("include/menu.php");
require_once("include/banniere.php");
require_once("include/connect.php");
$connection = Connect::getInstance();

print('<h1>Zone de rechercher</h1>');

require_once("include/news.php");
require_once("include/footer.php");
?>