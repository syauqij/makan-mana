<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserProfile Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $profile_photo
 * @property string|null $phone_no_2
 * @property int|null $gender
 * @property string|null $address_line_1
 * @property string|null $address_line_2
 * @property string|null $postcode
 * @property string|null $city
 * @property string|null $state
 *
 * @property \App\Model\Entity\User $user
 */
class UserProfile extends Entity
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
        'user_id' => true,
        'profile_photo' => true,
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
