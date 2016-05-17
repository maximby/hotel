<?php

/**
 * Hotel Business class.
 */
class HotelBusiness extends Hotel {

    /**
     *  Initialization.
     */
    protected function _init() {
        $this->setHotelCategoryId(self::HOTEL_CATEGORY_BUSINESS);
    }
}