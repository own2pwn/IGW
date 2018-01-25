<?php

    class DashboardService {

        private $uploadDir;

        private $db;

        private $feedback;


        public function saveUploadedFile($file, $file_name): bool {
            //TODO: validate A-Z?
            $name      = $this->filterImageName($file_name);
            $file_path = $this->uploadDir . $file_name;

            return move_uploaded_file($file['tmp_name'], $file_path);
        }

        public function addItem($data, $file_name): bool {
            $insert = $this->prepareInsert($data, $file_name);

            return $insert->execute();
        }

        public function getFeedbackMessages(): array {
            $this->feedback->fetchItems();
            $messages = $this->feedback->getMessages();

            return $messages;
        }


        private function filterImageName($value) {
            $name = filter_var($value, FILTER_SANITIZE_STRING);
            if ($name === false) {
                //TODO: log hack
                exit(0);

                return null;
            }

            return $name;
        }

        private function filterPrice($value): int {
            $price = filter_var($value, FILTER_VALIDATE_INT);

            if ($price === FALSE) {
                echo 'HACK!<br>';
                exit(-1);
            }

            return $price;
        }

        private function prepareInsert($data, $file_name) {
            $title = $data['name'];
            $desc  = $data['desc'];
            $price = $this->filterPrice($data['price']);

            $insert = $this->db->prepare("INSERT INTO item(name, description, price, image_name) VALUES (:item_name, :descr, :price, :img)");
            $insert->bindParam('item_name', $title);
            $insert->bindParam('descr', $desc);
            $insert->bindParam('price', $price);
            $insert->bindParam('img', $file_name);

            return $insert;
        }


        public function __construct(ICRUD $db, FeedbackDataProvider $feedback) {
            $this->db       = $db;
            $this->feedback = $feedback;

            $ROOT_PATH       = $_SERVER['DOCUMENT_ROOT'];
            $this->uploadDir = $ROOT_PATH . '/images/';
        }
    }
