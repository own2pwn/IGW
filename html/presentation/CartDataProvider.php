<?php
    include_once 'Item.php';

    include_once $_SERVER['DOCUMENT_ROOT'] . '/api/CartService.php';

    class CartDataProvider {

        private $items;

        private $itemsCount;


        public function getItems(): array {
            return $this->items;
        }

        public function getItemsCount(): int {
            return $this->itemsCount;
        }

        public function getItemQuantity(Item $item): int {
            return $this->cartService->itemQuantity($item->id);
        }

        public function getItemSubtotal(Item $item): int {
            return $this->getItemQuantity($item) * $item->price;
        }

        public function getTotalSum(): int {
            $sum = 0;

            foreach ($this->items as $item)
                $sum += $this->getItemSubtotal($item);

            return $sum;
        }

        public function fetchItems(): void {
            if (!$this->cartNonEmpty()) {
                $this->itemsCount = 0;
                $this->items      = array();

                return;
            }

            $items  = $this->prepareFetchStatement();
            $result = $items->execute();

            if (!$result)
                var_dump($items->errorInfo());

            $items->setFetchMode(PDO::FETCH_CLASS, 'Item');
            $this->items = array();

            while ($item = $items->fetch())
                array_push($this->items, $item);

            $this->itemsCount = $items->rowCount();
        }


        private function cartNonEmpty(): bool {
            return $this->cartService->cartNotEmpty();
        }

        private function prepareFetchStatement(): PDOStatement {
            $ids    = $this->getCartIDs();
            $params = [':ids' => $ids];

            $items = $this->db->prepareStatement("SELECT * FROM item WHERE id IN (:ids)", $params);

            return $items;
        }

        private function getCartIDs(): string {
            $items_in_cart     = $this->cartService->getItemsInCart();
            $items_in_cart_str = implode(', ', $items_in_cart);

            return $items_in_cart_str;
        }


        /**
         * @var ICRUD
         */
        private $db;

        /**
         * @var CartService
         */
        private $cartService;

        public function __construct(ICRUD $db, CartService $cartService) {
            $this->db          = $db;
            $this->cartService = $cartService;
        }
    }