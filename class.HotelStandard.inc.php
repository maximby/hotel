<?php
/**
 * Hotel Standard class.
 */
class HotelStandard extends Hotel {

    /**
     *  Initialization.
     */
    protected function _init() {
        $this->setHotelCategoryId(self::HOTEL_CATEGORY_STANDARD);
    }
}