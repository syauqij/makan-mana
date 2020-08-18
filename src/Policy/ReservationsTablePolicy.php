<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Table\ReservationsTable;
use Authorization\IdentityInterface;

/**
 * Reservations policy
 */
class ReservationsTablePolicy
{
    public function scopeIndex($user, $query)
    {   
        $role = $user->getOriginalData()->role;
        switch($role) {
            case 'member' :
                return $query->where(['Reservations.user_id' => $user->getIdentifier()]);
            case 'owner' :
                return $query->where(['Restaurants.user_id' => $user->getIdentifier()]);
            case 'admin' :
                return null;
            default :
                return false;
        }
    }
}
