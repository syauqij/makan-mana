<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class UserProfile extends Entity
{

    protected $_accessible = [
        'user_id' => true,
        'phone_no_2' => true,
        'gender' => true,
        'address_line_1' => true,
        'address_line_2' => true,
        'postcode' => true,
        'city' => true,
        'state' => true,
        'user' => true,
    ];
}
