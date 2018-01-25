<?php
    $ROOT_PATH = $_SERVER['DOCUMENT_ROOT'];
    include_once $ROOT_PATH . '/inc/CRUD.php';
    include_once $ROOT_PATH . '/inc/SessionService.php';
    include_once $ROOT_PATH . '/admin/service/AuthService.php';

    $db      = new CRUD();
    $session = SessionService::getSharedInstance();
    $auth    = new AuthService($db, $session);

    $auth->setIsAuthorized(false);