<?php
    class OrderItem {
        public $first_name;

        public $last_name;

        public $address;

        public $country;

        public $zip;

        public $email;

        public $product_id;

        public $card_issuer;

        public $card_number;

        public $cvv;

        public $qty;
    }

    $ROOT_PATH = $_SERVER['DOCUMENT_ROOT'];
    include_once $ROOT_PATH . '/inc/CRUD.php';

    $db = new CRUD();

    $select = $db->prepare("SELECT * FROM orders");
    $select->execute();

    $select->setFetchMode(PDO::FETCH_CLASS, 'OrderItem');
    $orders = array();

    while ($order = $select->fetch())
        array_push($orders, $order);
    

    var_dump($orders);
    
    ?>