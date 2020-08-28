<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\ORM\Entity;
use Cake\Utility\Text;

class User extends Entity
{
    protected $_accessible = [
        'first_name' => true,
        'last_name' => true,
        'email' => true,
        'password' => true,
        'phone_no' => true,
        'image_file' => true,
        'status' => true,
        'role' => true,
        'created' => true,
        'modified' => true,
        'reservations' => true,
        'restaurants' => true,
        'user_profile' => true,
    ];

    protected $_hidden = [
        'password', 'token'
    ];

    protected $_virtual = ['full_name'];

    //password hashing with bcrypt
    protected function _setPassword(string $password) : ?string
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher())->hash($password);
        }
    }

    protected function _getFullName() {
        $fullName = $this->first_name . ' ' . $this->last_name;
        return 
            Text::truncate(
                $fullName,
                25,
                [
                    'ellipsis' => '...',
                    'exact' => false
                ]
            );
    }
}
