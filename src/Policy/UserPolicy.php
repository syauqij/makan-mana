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
    public function canCreate(IdentityInterface $user, User $resource)
    {
    }

    /**
     * Check if $user can update User
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\User $resource
     * @return bool
     */
    public function canEdit(IdentityInterface $user, User $resource)
    {
        return $this->isOwner($user, $resource);
    }

    public function canDelete(IdentityInterface $user, User $resource)
    {
    }

    public function canView(IdentityInterface $user, User $resource)
    {
        return $this->isOwner($user, $resource);
    }

    protected function isOwner(IdentityInterface $user, User $resource)
    {
        return $resource->user_id === $user->getIdentifier();
    }
}
