<?php

    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

    if ($email === false) {
        // TODO: log hacking attempt
        exit(-1);
    }

    $ROOT_PATH = $_SERVER['DOCUMENT_ROOT'];
    include_once $ROOT_PATH . '/inc/CRUD.php';
    include_once 'SubscribeService.php';

    $db               = new CRUD();
    $subscribeService = new SubscribeService($db);

    $subscribeService->saveEmail($email);