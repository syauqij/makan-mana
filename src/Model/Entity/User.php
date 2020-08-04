<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property int $phone_country_code
 * @property string $phone_no
 * @property string $role
 * @property string|null $profile_photo
 * @property string|null $active
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime $created
 * @property \App\Model\Entity\Reservation[] $reservations
 * @property \App\Model\Entity\Restaurant[] $restaurants
 */
class User extends Entity
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
        'first_name' => true,
        'last_name' => true,
        'email' => true,
        'password' => true,
        'phone_country_code' => true,
        'phone_no' => true,
        'role' => true,
        'profile_photo' => true,
        'active' => true,
        'created' => true,
        'modified' => true,
        'reservations' => true,
        'restaurants' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];
}
