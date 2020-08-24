<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\User;
use Authorization\IdentityInterface;

/**
 * User policy
 */
class UserPolicy
{
    /**
     * Check if $user can create User
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\User $resource
     * @return bool
     */
    public function canEdit(IdentityInterface $user, User $resource)
    {   
        $role = $user->getOriginalData()->role;
        if ($role == 'admin') {
            return true;
        } else {
            return $this->isOwner($user, $resource);
        }   
    }

    public function canUpdateStatus(IdentityInterface $user, User $resource)
    {
        $role = $user->getOriginalData()->role;
        if ($role == 'admin') {
            return true;
        }        
    }

    protected function isOwner(IdentityInterface $user, User $resource)
    {
        return $resource->id === $user->getIdentifier();
    }
}
