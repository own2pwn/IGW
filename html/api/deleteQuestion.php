<?php
    /**
     * Created by PhpStorm.
     * User: supreme is gay
     * Date: 10.02.18
     * Time: 22:50
     */

    $id = $_POST['id'];

    $ROOT_PATH = $_SERVER['DOCUMENT_ROOT'];
    include_once $ROOT_PATH . '/inc/CRUD.php';

    $db     = new CRUD();
    $insert = $db->prepare('DELETE FROM questions WHERE id = :id');

    $insert->bindParam('id', $id);
    $insert->execute();

    var_dump($insert->errorInfo());
