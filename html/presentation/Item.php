<?php

    class Image {
        public $name;
    }

    class Item {
        public $id;

        public $title;

        public $description;

        public $price;

        public $imageName;

        public $imagePath;

        public function getImagePath(): string {
            return $this->imageName;
        }

        /**
         * DB Mapping
         */

        private $image_name;

        private $name;

        public function __construct() {
            $this->title     = $this->name;
            $this->imageName = $this->image_name;
        }
    }