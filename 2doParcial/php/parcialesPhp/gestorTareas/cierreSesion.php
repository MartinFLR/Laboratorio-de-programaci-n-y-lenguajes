<?php
require_once 'cookieManager.php';
require_once 'sessionManager.php';

$cookieManager = new CookieManager();
$sessionManager = new SessionManager();

$cookieManager->clearAllExceptSession();
$sessionManager->destroy("userActual");

header('Location: index.php');