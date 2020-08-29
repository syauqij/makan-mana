<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class MenuCategory extends Entity
{
    protected $_accessible = [
        'name' => true,
        'sequence' => true,
        'created' => true,
        'modified' => true,
        'menus' => true,
    ];
}
