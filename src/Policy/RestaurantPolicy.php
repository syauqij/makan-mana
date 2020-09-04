<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Restaurant;
use Authorization\IdentityInterface;

/**
 * Restaurant policy
 */
class RestaurantPolicy
{
    public function canEdit(IdentityInterface $user, Restaurant $restaurant)
    {
        $role = $user->getOriginalData()->role;
        if ($role == 'admin') {
            return true;
        } else {
            return $this->isOwner($user, $restaurant);
        }
    }

    //check if user can create restaurant menu
    public function canCreateMenu(IdentityInterface $user, Restaurant $restaurant)
    {
        $role = $user->getOriginalData()->role;
        if ($role == 'admin') {
            return true;
        } else {
            return $this->isOwner($user, $restaurant);
        }
    }

    public function canChangeStatus(IdentityInterface $user, Restaurant $restaurant)
    {
        if ($role == 'admin') {
            return true;
        }
    }

    protected function isOwner(IdentityInterface $user, Restaurant $restaurant)
    {
        return $restaurant->user_id === $user->getIdentifier();
    }
}
