<?php
require_once 'cookieManager.php';
require_once 'user.php';
require_once 'sessionManager.php';

$cookieManager = new CookieManager();
$sessionManager = new SessionManager();

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['login'])) {
        $usernameIngresado = trim($_POST['nombre']);
        $contraIngresada = trim($_POST['password']);
        
        //recordarme checkbox
        if (isset($_POST['remember']) && $_POST['remember'] == '1') {
            setcookie('remembered_user', $usernameIngresado, time() + (30 * 24 * 60 * 60), "/");
            setcookie('remembered_pass', $contraIngresada, time() + (30 * 24 * 60 * 60), "/");
        } else {
            setcookie('remembered_user', '', time() - 3600, "/");
            setcookie('remembered_pass', '', time() - 3600, "/");
        }

        if ($cookieManager->exists($usernameIngresado)) {
            $datos = $cookieManager->getJson($usernameIngresado);
                if($usernameIngresado === $datos['nombre'] && $contraIngresada === $datos['contra']){
                    $user = User::fromArray($datos);

                    $sessionManager->set('user', $user);
                    header('Location: index.php');
                    exit;
                }else{
                    header('Location: index.php');
                    exit;
                }
            }else{
                header('Location: index.php');
                    exit;
            }

        }