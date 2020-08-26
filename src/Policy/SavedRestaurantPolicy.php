<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\SavedRestaurant;
use Authorization\IdentityInterface;

/**
 * SavedRestaurants policy
 */
class SavedRestaurantPolicy
{
    public function canCreate(IdentityInterface $user, SavedRestaurant $savedRestaurant)
    {
        $role = $user->getOriginalData()->role;
        if ($role == 'member') {
            return true;
        } else {
            return false;
        }
    }

    public function canDelete(IdentityInterface $user, SavedRestaurant $savedRestaurant)
    {
        return $this->isOwner($user, $savedRestaurant);
    }

    public function canView(IdentityInterface $user, SavedRestaurant $savedRestaurant)
    {
        return $this->isOwner($user, $savedRestaurant);
    }

    protected function isOwner(IdentityInterface $user, SavedRestaurant $savedRestaurant)
    {
        return $savedRestaurant->user_id === $user->getIdentifier();
    }
}
