<?php
    class FeedbackService {

        private $db;


        public function saveFeedback($email, $feedback): bool {
            $insert = $this->prepareInsert($email, $feedback);

            return $insert->execute();
        }


        private function prepareInsert($email, $feedback) {
            $insert = $this->db->prepare("INSERT INTO questions(who, message) VALUES (:email, :comment)");
            $insert->bindParam('email', $email);
            $insert->bindParam('comment', $feedback);

            return $insert;
        }


        public function __construct(ICRUD $db) {
            $this->db = $db;
        }
    }