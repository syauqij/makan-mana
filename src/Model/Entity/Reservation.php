<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Reservation Entity
 *
 * @property int $id
 * @property string $uuid
 * @property int $user_id
 * @property int $restaurant_id
 * @property \Cake\I18n\FrozenTime $reserved_date
 * @property string $phone_no
 * @property string|null $occasion
 * @property string|null $request
 * @property int $total_guests
 * @property int|null $restaurant_table_id
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Restaurant $restaurant
 * @property \App\Model\Entity\RestaurantTable $restaurant_table
 * @property \App\Model\Entity\ReservationLog[] $reservation_logs
 */
class Reservation extends Entity
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
        'uuid' => true,
        'user_id' => true,
        'restaurant_id' => true,
        'reserved_date' => true,
        'phone_no' => true,
        'occasion' => true,
        'request' => true,
        'total_guests' => true,
        'restaurant_table_id' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'restaurant' => true,
        'reservation_logs' => true,
    ];
}
