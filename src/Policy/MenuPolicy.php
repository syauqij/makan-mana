<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Menu;
use Authorization\IdentityInterface;

/**
 * menu policy
 */
class MenuPolicy
{
    //Check if $user can update menu
    public function canUpdate(IdentityInterface $user, menu $menu)
    {
        return $this->isOwner($user, $menu);
    }

    //Check if $user can delete menu
    public function canDelete(IdentityInterface $user, menu $menu)
    {
    }

    //Check if $user can view menu
    public function canView(IdentityInterface $user, menu $menu)
    {
    }

    protected function isOwner(IdentityInterface $user, menu $menu)
    {   
        return $menu->restaurant->user_id === $user->getIdentifier();
    }
}
