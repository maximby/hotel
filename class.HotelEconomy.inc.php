<?php
/**
 * Hotel Economy class.
 */
class HotelEconomy extends Hotel {

    /**
     *  Initialization.
     */
    protected function _init() {
        $this->setHotelCategoryId(self::HOTEL_CATEGORY_ECONOMY);
    }
}