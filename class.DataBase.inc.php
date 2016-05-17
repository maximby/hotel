<?php

class DataBase {

   private $connection;

    // Хранит один экземпляр.
    private static $_instance;

    /**
     * Получает экземпляр БД
     * @return DataBase|null
     */
    public static function getInstance() {
        if (!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Constructor.
     */
    public function __construct() {
        $this->connection = new PDO('mysql:dbname=hotel;host=localhost','root',"");
    }

    /**
     * Пустой маг. метод __clone для запрета клонирования.
     */
    private function __clone() {}

    /**
     * @return object mysql connection.
     */
    public function getConnection() {
        return $this->connection;
    }
}
