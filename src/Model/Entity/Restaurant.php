<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Restaurant Entity
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property int $user_id
 * @property string $address_line_1
 * @property string $address_line_2
 * @property string $postcode
 * @property string $city
 * @property string $state
 * @property string $contact_no
 * @property string|null $website
 * @property string $operation_hours
 * @property string $price_range
 * @property string $payment_options
 * @property string $image_file
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Cuisine[] $cuisines
 * @property \App\Model\Entity\Menu[] $menus
 * @property \App\Model\Entity\Reservation[] $reservations
 * @property \App\Model\Entity\RestaurantCuisine[] $restaurant_cuisines
 * @property \App\Model\Entity\RestaurantGallery[] $restaurant_galleries
 * @property \App\Model\Entity\SavedRestaurant[] $saved_restaurants
 */
class Restaurant extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
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
        'restaurant_galleries' => true,
        'saved_restaurants' => true,
    ];
    protected $_virtual = ['full_address'];

    protected function _getFullAddress() {
        return $this->address_line_1 . ' ' . $this->address_line_2 . ' ' . 
             $this->city. ', ' . $this->postcode . ', ' . $this->state . '.';
    } 
}
