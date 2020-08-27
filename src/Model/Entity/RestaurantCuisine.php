<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class RestaurantCuisine extends Entity
{
    protected $_accessible = [
        'restaurant_id' => true,
        'cuisine_id' => true,
        'restaurant' => true,
        'cuisine' => true,
    ];
}
