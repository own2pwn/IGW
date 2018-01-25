<?php
    class SessionService {

        private $session;

        private static $sharedInstance;


        public function startSession() {
            $params = ['cookie_httponly' => true];
            session_name('shop-sess');
            session_start($params);

            $this->session = &$_SESSION;
        }

        public function getSessionValue(string $key) {
            if (isset($this->session[$key]))
                return $this->session[$key];

            return null;
        }

        public function &getSessionValueReference(string $key) {
            if (isset($this->session[$key]))
                return $this->session[$key];

            return null;
        }

        public function setSessionValue(string $key, $value): void {
            $this->session[$key] = $value;
        }

        public function valueExists($key): bool {
            return isset($this->session[$key]);
        }


        public static function getSharedInstance(): SessionService {
            if (!self::$sharedInstance)
                self::$sharedInstance = new static();

            return self::$sharedInstance;
        }

        public function __construct() {
            $this->startSession();
        }
    }