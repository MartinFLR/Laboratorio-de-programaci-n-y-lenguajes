<?php
require_once 'cookieManager.php';
$cookieManager = new CookieManager();


$cookieManager->clearAllExceptSession();

header('Location: index.php');