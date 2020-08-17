<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Reservation;
use Authorization\IdentityInterface;

/**
 * Reservation policy
 */
class ReservationPolicy
{   
    public function canCreate(IdentityInterface $user, Reservation $reservation)
    {
        return true;
    }

    public function canEdit(IdentityInterface $user, Reservation $reservation)
    {
        // logged in users can edit their own reservations.
        return $this->isOwner($user, $reservation);
    }

    public function canDelete(IdentityInterface $user, Reservation $reservation)
    {
        return $this->isOwner($user, $reservation);
    }

    public function canView(IdentityInterface $user, Reservation $reservation)
    {
        return $this->isOwner($user, $reservation);

    }

    protected function isOwner(IdentityInterface $user, Reservation $reservation)
    {
        return $reservation->user_id === $user->getIdentifier();
    }
}
