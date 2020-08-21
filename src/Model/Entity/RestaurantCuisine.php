<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RestaurantCuisine Entity
 *
 * @property int $id
 * @property int|null $restaurant_id
 * @property int|null $cuisine_id
 *
 * @property \App\Model\Entity\Restaurant $restaurant
 * @property \App\Model\Entity\Cuisine $cuisine
 */
class RestaurantCuisine extends Entity
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
        'restaurant_id' => true,
        'cuisine_id' => true,
        'restaurant' => true,
        'cuisine' => true,
    ];
}
