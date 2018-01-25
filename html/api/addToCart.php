<?php

    $product_id = filter_var($_POST['id'], FILTER_VALIDATE_INT);


    if ($product_id === false) {
        // TODO: log hacking attempt
        exit(-1);
    }

    $ROOT_PATH = $_SERVER['DOCUMENT_ROOT'];
    include_once 'CartService.php';
    include_once $ROOT_PATH . '/inc/SessionService.php';

    $session = SessionService::getSharedInstance();
    $cart    = new CartService($session);

    $cart->addToCart($product_id);
