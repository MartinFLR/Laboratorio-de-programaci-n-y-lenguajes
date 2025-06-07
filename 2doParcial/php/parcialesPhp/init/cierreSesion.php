<?php 
require_once 'sessionManager.php';
require_once 'user.php';
require_once 'cookieManager.php';
$sesion = new SessionManager();
?>
<html>
<body>
<?php

if (isset($_SESSION['user']))
{	
	$cookieManager = new CookieManager();
	$user = $sesion->get('user');
	$cookieManager->setJson($user->getNombre(),$user->toArray());
	$_SESSION[] = array();
	session_destroy();
	header("Location: index.php");
}
else
{	
	
}

?>
</body>
</html>