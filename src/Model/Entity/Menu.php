<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Menu Entity
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $restaurant_id
 * @property int $menu_category_id
 * @property int $order
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Restaurant $restaurant
 * @property \App\Model\Entity\MenuCategory $menu_category
 * @property \App\Model\Entity\MenuItem[] $menu_items
 */
class Menu extends Entity
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
        'description' => true,
        'restaurant_id' => true,
        'menu_category_id' => true,
        'sequence' => true,
        'created' => true,
        'modified' => true,
        'restaurant' => true,
        'menu_category' => true,
        'menu_items' => true,
    ];
}
