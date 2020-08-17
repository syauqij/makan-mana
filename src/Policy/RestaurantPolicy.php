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
    /**
     * Check if $user can create Restaurant
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Restaurant $restaurant
     * @return bool
     */
    public function canCreate(IdentityInterface $user, Restaurant $restaurant)
    {
    }

    /**
     * Check if $user can update Restaurant
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Restaurant $restaurant
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, Restaurant $restaurant)
    {
    }

    /**
     * Check if $user can delete Restaurant
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Restaurant $restaurant
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Restaurant $restaurant)
    {
    }

    /**
     * Check if $user can view Restaurant
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Restaurant $restaurant
     * @return bool
     */
    public function canView(IdentityInterface $user, Restaurant $restaurant)
    {
    }
}
