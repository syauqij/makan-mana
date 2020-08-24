<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Table\SavedRestaurantsTable;
use Authorization\IdentityInterface;

/**
 * SavedRestaurants policy
 */
class SavedRestaurantsTablePolicy
{
    public function scopeIndex($user, $query)
    {   
        $role = $user->getOriginalData()->role;
        switch($role) {
            case 'member' :
                return $query->where(['SavedRestaurants.user_id' => $user->getIdentifier()]);
            case 'owner' :
                return $query->where(['Restaurants.user_id' => $user->getIdentifier()]);
            case 'admin' :
                return $query;
            default :
                return null;
        }
    }
}
