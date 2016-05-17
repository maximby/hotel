<?php

abstract class Hotel {

    const HOTEL_CATEGORY_BUSINESS = 1;
    const HOTEL_CATEGORY_STANDARD = 2;
    const HOTEL_CATEGORY_ECONOMY = 3;

    const HOTEL_ERROR_NOT_FOUND = 1000;
    // Категория отеля.
    static public $valid_hotel_category = array(
        Hotel::HOTEL_CATEGORY_BUSINESS => 'Business',
        Hotel::HOTEL_CATEGORY_STANDARD => 'Standard',
        Hotel::HOTEL_CATEGORY_ECONOMY => 'Economy',
    );

    // Название отеля.
    public $hotel_name;

    // Название страны.
    public $country_name;

    // Название города.
    public  $city_name;

    // Название улицы.
    public $street_name;

    // Номер телефона.
    public $phone_number;

    // Время создания записи
    protected $_time_created;

    // Первичный ключ для Hotel.
    protected $_hotel_id;

    //
    protected $_hotel_category;

    /**
     * Constructor.
     * @param array $data Необязательный массив своиств и значений.
     */
    public function __construct($data = array()) {
        $this->_init();
        $this->_time_created = time();

        // Проверяем, что объект Hotel может быть заполнен.
        if (!is_array($data)) {
            trigger_error('__construct expects an argument array');
        }

        //Если есть хотя бы одно значение, заполняем объект Hotel.
        if (count($data)>0) {
            foreach ($data as $name => $value) {
                if (in_array($name, array(
                    'time_created'
                ))) {
                     $name = '_' . $name;
                    }
                $this->$name = $value;
            }
        }
    }

    /**
     * Magic __toString
     * @return string
     */
    public function __toString() {
        return $this->display();
    }

    /**
     * Отображение описания отеля в HTML.
     * @return string
     */
    public function display() {
        $output = '';

        $output .= $this->hotel_name . '<br/>';
        $output .= $this->country_name . '<br/>';
        $output .= $this->city_name . '<br/>';
        $output .= $this->street_name . '<br/>';
        $output .= $this->phone_number;

        return $output;
    }

    /**
     * Допустима ли категория отеля.
     * @param $hotel_category_id
     * @return bool
     */
    static public function isValidHotelCategoryId($hotel_category_id) {
        return array_key_exists($hotel_category_id, self::$valid_hotel_category);
    }

    /**
     * Задаем индентификатор сатегории отеля, если он допустим
     * @param int $hotel_category_id
     */
    protected function setHotelCategoryId($hotel_category_id) {
        if (self::isValidHotelCategoryId($hotel_category_id)) {
            $this->_hotel_category = $hotel_category_id;
        }
    }

    abstract protected  function _init();


    /**
     * Загружает данные из БД в объект соответсвующего класса
     * @param int $hotel_id
     * @throws ExceptionHotel
     * @return array
     */
    final public static function load($hotel_id) {
        $db = DataBase::getInstance();
        $mysql = $db->getConnection();

        $sql_query = 'SELECT * FROM hotel WHERE hotel_id=';
        $hotel_id = (int) $hotel_id;
        $hotel_id = $mysql->quote($hotel_id);
        $sql_query .= $hotel_id;

        $result = $mysql->query($sql_query);
        if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
           return self::getInstance($row['hotel_category'], $row);
        }
        throw new ExceptionHotel('Hotel not found', self::HOTEL_ERROR_NOT_FOUND);
    }

    /**
     * Метод получает индентификатор категории отеля и возвращает
     * экземпляр соответсвующего подкласса
     * @param $hotel_category_id
     * @param array $data
     * @return object Hotel
     * @throws ExceptionHotel
     */
    final public static function getInstance($hotel_category_id, $data = array()) {
        if (self::isValidHotelCategoryId($hotel_category_id)) {

            $class_name = 'Hotel' . self::$valid_hotel_category[$hotel_category_id];
            if (!class_exists($class_name) || $class_name == 'Hotel') {
                throw new ExceptionHotel('Подкласс класса Hotel не найден,
                    создать класс не возможно');
            }
            return new $class_name($data);
        }
        throw new ExceptionHotel('Отсутствует заданая категория отеля');
    }



}