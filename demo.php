<?php

require 'autoload.php';


echo '<h2>Пустой класс Hotel</h2>';
$hotel_business = new HotelBusiness();
echo '<code><pre>' . var_export($hotel_business, true) . '</pre></code>';

echo '<h2>Тест класс Hotel</h2>';
$hotel_business->hotel_name = 'Victoria';
$hotel_business->country_name = 'Республика Беларусь';
$hotel_business->city_name = 'Минск';
$hotel_business->street_name = 'Пр-т Победителей, 59';
$hotel_business->phone_number = '+375 (17) 239-77-44';
echo '<code><pre>' . var_export($hotel_business, true) . '</pre></code>';

echo $hotel_business->display();

echo '<br/><br/>';
$hotel_standard = Hotel::load(2);
echo $hotel_standard->display();