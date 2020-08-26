<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Reservation;
use Authorization\IdentityInterface;

class ReservationPolicy
{  
    public function canCreate(IdentityInterface $user, Reservation $reservation)
    {
        $role = $user->getOriginalData()->role;
        if ($role == 'member') {
            return true;
        } else {
            return false;
        }
    }

    public function canModify(IdentityInterface $user, Reservation $reservation)
    {
        // logged in users can edit their own reservations.
        return $this->isOwner($user, $reservation);
    }

    public function canUpdateStatus(IdentityInterface $user, Reservation $reservation)
    {
        $role = $user->getOriginalData()->role;
        if ($role == 'admin' || $role == 'owner') {
            return true;
        }
        else {
            return $this->isOwner($user, $reservation);
        }
    }
    
    public function canView(IdentityInterface $user, Reservation $reservation)
    {
        $role = $user->getOriginalData()->role;
        if ($role == 'admin' || $role == 'owner') {
            return true;
        } else {
            return $this->isOwner($user, $reservation);
        }
    }

    protected function isOwner(IdentityInterface $user, Reservation $reservation)
    {
        return $reservation->user_id === $user->getIdentifier();
    }
}
