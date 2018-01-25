<?php


    class AuthService {

        private $isAuthorized;

        private const AUTH_SESSION_KEY = 'admin_logged';


        public function isAuthorized(): bool {
            $auth_status = $this->sessionService->getSessionValue(self::AUTH_SESSION_KEY);

            return $auth_status ? true : false;
        }

        public function setIsAuthorized(bool $isAuthorized): void {
            $this->sessionService->setSessionValue(self::AUTH_SESSION_KEY, $isAuthorized);
        }

        public function validate(string $login, string $pass): bool {
            // DEFAULT: password_hash('admin', PASSWORD_BCRYPT);
            // password_verify('admin', '$hash') == 1;

            $stm = $this->prepareValidationStatement($login);
            $stm->execute();

            if ($hash = $stm->fetchColumn())
                return password_verify($pass, $hash);

            return false;
        }

        // MARK: - Private

        private function prepareValidationStatement(string $login): PDOStatement {
            $params = [':login' => $login];
            $result = $this->dbWorker->prepareStatement('SELECT pass_hash FROM admin WHERE login = :login',
                                                        $params);

            return $result;
        }

        // MARK: - DI

        /**
         * @var ICRUD
         */
        private $dbWorker;

        private $sessionService;

        public function __construct(ICRUD $dbWorker, SessionService $sessionService) {
            $this->dbWorker       = $dbWorker;
            $this->sessionService = $sessionService;
        }
    }