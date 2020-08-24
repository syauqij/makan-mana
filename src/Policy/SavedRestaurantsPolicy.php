<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\SavedRestaurants;
use Authorization\IdentityInterface;

/**
 * SavedRestaurants policy
 */
class SavedRestaurantsPolicy
{
    public function canCreate(IdentityInterface $user, SavedRestaurants $savedRestaurants)
    {
        $role = $user->getOriginalData()->role;
        if ($role == 'member') {
            return true;
        }
    }

    public function canDelete(IdentityInterface $user, SavedRestaurants $savedRestaurants)
    {
        return $this->isOwner($user, $reservation);
    }

    public function canView(IdentityInterface $user, SavedRestaurants $savedRestaurants)
    {
        return $this->isOwner($user, $reservation);
    }

    protected function isOwner(IdentityInterface $user, Reservation $savedRestaurants)
    {
        return $savedRestaurants->user_id === $user->getIdentifier();
    }
}
