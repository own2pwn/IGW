<?php

    $ROOT_PATH = $_SERVER['DOCUMENT_ROOT'];
    include_once $ROOT_PATH . '/inc/CRUD.php';
    include_once $ROOT_PATH . '/inc/SessionService.php';
    include_once $ROOT_PATH . '/admin/service/AuthService.php';

    $db      = new CRUD();
    $session = SessionService::getSharedInstance();
    $auth    = new AuthService($db, $session);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $login = $_POST['login'];
        $pass  = $_POST['pass'];

        if ($auth->validate($login, $pass))
            $auth->setIsAuthorized(true);
    }

    if ($auth->isAuthorized())
        include_once 'view/Dashboard.php';
    else
        include_once 'view/Login.php';

