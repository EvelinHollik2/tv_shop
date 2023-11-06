<?php

switch ($menu) {
    case 'logout':
        require_once './pages/logout.php';
        break;
    case 'about_us':
        require_once './pages/about_us.php';
        break;
    case 'buy':
        require_once './pages/buy.php';
        break;
    case 'cart':
        require_once './pages/cart.php';
        break;
    case 'login':
        require_once './pages/login.php';
        break;
    case 'regist':
        require_once './pages/regist.php';
        break;
    case 'home':
        require_once './pages/home.php';
        break;
    case 'products':
        require_once './pages/products.php';
        break;
    case 'new_products':
        require_once './pages/new_products.php';
        break;
    default:
        require_once './index.php';
        break;
}