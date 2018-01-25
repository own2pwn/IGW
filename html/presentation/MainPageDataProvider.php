<?php
    include_once 'Item.php';

    class MainPageDataProvider {

        private $db;

        private $items;


        public function getItems(): array {
            return $this->items;
        }

        public function fetchItems() {
            $items = $this->db->prepare('SELECT * FROM item');
            $items->execute();

            $items->setFetchMode(PDO::FETCH_CLASS, 'Item');
            $this->items = array();

            while ($item = $items->fetch())
                array_push($this->items, $item);
        }


        public function __construct(ICRUD $db) {
            $this->db = $db;
        }
    }