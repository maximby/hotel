<?php

class Hotel {

    const HOTEL_CATEGORY_BUSINESS = 1;
    const HOTEL_CATEGORY_STANDARD = 2;
    const HOTEL_CATEGORY_ECONOMY = 3;

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
        $this->_time_create = time();
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

    



}