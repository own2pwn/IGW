<?php
    class SubscribeService {

        private $db;


        public function saveEmail($email): bool {
            $insert = $this->prepareInsert($email);

            return $insert->execute();
        }


        private function prepareInsert($email) {
            $insert = $this->db->prepare("INSERT INTO subscribers(email) VALUES (:email)");
            $insert->bindParam('email', $email);

            return $insert;
        }


        public function __construct(ICRUD $db) {
            $this->db = $db;
        }
    }