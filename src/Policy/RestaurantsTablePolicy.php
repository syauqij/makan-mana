<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Table\RestaurantsTable;
use Authorization\IdentityInterface;

/**
 * Restaurants policy
 */
class RestaurantsTablePolicy
{
    public function scopeIndex($user, $query)
    {   
        $role = $user->getOriginalData()->role;
        switch($role) {
            case 'owner' :
                return $query->where(['Restaurants.user_id' => $user->getIdentifier()]);
            case 'admin' :
                return $query;
            default :
                return null;
        }
    }
}
