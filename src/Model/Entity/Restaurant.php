<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\I18n\Number;

class Restaurant extends Entity
{
    protected $_accessible = [
        'name' => true,
        'slug' => true,
        'description' => true,
        'user_id' => true,
        'address_line_1' => true,
        'address_line_2' => true,
        'postcode' => true,
        'city' => true,
        'state' => true,
        'contact_no' => true,
        'website' => true,
        'operation_hours' => true,
        'price_range' => true,
        'payment_options' => true,
        'image_file' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'cuisines' => true,
        'menus' => true,
        'reservations' => true,
        'restaurant_cuisines' => true,
        'restaurant_photos' => true,
        'saved_restaurants' => true,
    ];
    protected $_virtual = ['full_address', 'price_range_desc'];

    protected function _getFullAddress() {
        return $this->address_line_1 . ' ' . $this->address_line_2 . ' ' . 
             $this->city. ', ' . $this->postcode . ', ' . $this->state . '.';
    }

    protected function _getPriceRangeDesc() {
        $price = $this->price_range;
        $price = Number::format($price, [
            'places' => 2
        ]);
        return "Avg Spending: RM " . $price . " per pax";
    } 
}
