<?php

    interface ICRUD {

        /**
         * @param string $stm
         * @return PDOStatement|false
         */
        function prepare(string $stm);

        /**
         * @param string $stm
         * @param array $params
         * @return PDOStatement | false
         */
        function prepareStatement(string $stm, array $params);
    }