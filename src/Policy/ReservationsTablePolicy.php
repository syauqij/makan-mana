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
        return $query->where(['Reservations.user_id' => $user->getIdentifier()]);
    }
}
