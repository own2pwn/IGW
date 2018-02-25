<?php
    /**
     * Created by PhpStorm.
     * User: supreme
     * Date: 10.02.18
     * Time: 23:59
     */

    class OrderItem {
        public $id;

        public $order_id;

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

        function __construct() {
            $this->order_id = $this->id;
        }
    }