<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Collection\Collection;

use Cake\I18n\FrozenTime;

class ReservationsController extends AppController
{
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Restaurants', 'RestaurantTables'],
        ];
        $reservations = $this->paginate($this->Reservations);

        $this->set(compact('reservations'));
    }

    public function view($id = null)
    {
        $reservation = $this->Reservations->get($id, [
            'contain' => ['Users', 'Restaurants', 'RestaurantTables', 'ReservationLogs'],
        ]);

        $this->set(compact('reservation'));
    }

    public function add()
    {
        $params = $this->request->getQuery();
        $id = 1;
        $now = new FrozenTime('20-08-10 12:30:00');
        $startTime = $now->modify('-1 hour');
        $endTime = $now->modify('+1 hour');

        while ($startTime < $endTime) {
            $times[] = $startTime->i18nFormat('yyyy-MM-dd HH:mm:ss');
            $startTime = $startTime->modify('+30 minutes');
        }

        if ($id) {
            //get reserved timeslots
            $getReserved = $this->Reservations->find('reserved', [
                'params' => $params
            ]);

            foreach ($getReserved as $reserved) {
                $reservedTime = $reserved['reserved_date']->i18nFormat('yyyy-MM-dd HH:mm:ss');
                echo $reservedTime . "<br/>";
                $key = array_search($reservedTime, $times);
                if (false !== $key) {
                    unset($times[$key]);
                }
                echo "key:" . $key . "<br/>";
            }

            pr($times);

            //$sorted = $collection->sortBy('time', SORT_LOCALE_STRING);

        }

        $this->set(compact('times', 'getReserved'));
        
        /*$reservation = $this->Reservations->newEmptyEntity();
        if ($this->request->is('post')) {
            $reservation = $this->Reservations->patchEntity($reservation, $this->request->getData());
            if ($this->Reservations->save($reservation)) {
                $this->Flash->success(__('The reservation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The reservation could not be saved. Please, try again.'));
        }
        $users = $this->Reservations->Users->find('list', ['limit' => 200]);
        $restaurants = $this->Reservations->Restaurants->find('list', ['limit' => 200]);
        $restaurantTables = $this->Reservations->RestaurantTables->find('list', ['limit' => 200]);
        $this->set(compact('reservation', 'users', 'restaurants', 'restaurantTables'));*/
    }

    public function edit($id = null)
    {
        $reservation = $this->Reservations->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $reservation = $this->Reservations->patchEntity($reservation, $this->request->getData());
            if ($this->Reservations->save($reservation)) {
                $this->Flash->success(__('The reservation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The reservation could not be saved. Please, try again.'));
        }
        $users = $this->Reservations->Users->find('list', ['limit' => 200]);
        $restaurants = $this->Reservations->Restaurants->find('list', ['limit' => 200]);
        $restaurantTables = $this->Reservations->RestaurantTables->find('list', ['limit' => 200]);
        $this->set(compact('reservation', 'users', 'restaurants', 'restaurantTables'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $reservation = $this->Reservations->get($id);
        if ($this->Reservations->delete($reservation)) {
            $this->Flash->success(__('The reservation has been deleted.'));
        } else {
            $this->Flash->error(__('The reservation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
