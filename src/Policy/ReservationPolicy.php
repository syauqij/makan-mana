<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Reservation;
use Authorization\IdentityInterface;
use Authorization\Policy\BeforePolicyInterface;

class ReservationPolicy implements BeforePolicyInterface
{  
    public function before($user, $resource, $action)
    {
        //dd($user->getOriginalData());
        $role = $user->getOriginalData()->role;
        if ($role == 'admin') {
            return true;
        }
        // fall through
    }
 
    public function canCreate(IdentityInterface $user, Reservation $reservation)
    {
        $role = $user->getOriginalData()->role;
        if ($role == 'member') {
            return true;
        }
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
