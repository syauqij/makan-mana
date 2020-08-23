<?php
declare(strict_types=1);

namespace App\View\Cell;

use Cake\View\Cell;

class BookedCell extends Cell
{
    protected $_validCellOptions = [];

    public function initialize(): void
    {
    }

    public function display($restaurant_id)
    {   
        $this->loadModel('Reservations');
        $bookedToday = $this->Reservations->find('bookedToday', [
            'restaurant_id' => $restaurant_id
        ]);

        $this->set('booked_count', $bookedToday->count());
    }
}
