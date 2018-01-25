<?php
    $email    = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $feedback = $_POST['body'];

    if ($email === false) {
        // TODO: log hacking attempt
        exit(-1);
    }

    $ROOT_PATH = $_SERVER['DOCUMENT_ROOT'];
    include_once $ROOT_PATH . '/inc/CRUD.php';
    include_once 'FeedbackService.php';

    $db              = new CRUD();
    $feedbackService = new FeedbackService($db);

    $feedbackService->saveFeedback($email, $feedback);