<?php

class DB {

   private $connection;

    // Хранит один экземпляр.
    private static $_instance;

    /**
     * Получает экземпляр БД
     * @return DB|null
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
    public function __constructor() {
        $this->connection = new PDO('mysql:dbname=hotel;host=localhost','root',"",
            [PDO::ERRMODE_EXCEPTION]);
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