<?php

    include_once 'FeedbackMessage.php';

    class FeedbackDataProvider {

        private $db;

        private $messages;


        public function getMessages(): array {
            return $this->messages;
        }

        public function fetchItems() {
            $messages = $this->db->prepare('SELECT * FROM questions');
            $messages->execute();

            $messages->setFetchMode(PDO::FETCH_CLASS, 'FeedbackMessage');
            $this->messages = array();

            while ($message = $messages->fetch())
                array_push($this->messages, $message);
        }


        public function __construct(ICRUD $db) {
            $this->db = $db;
        }
    }