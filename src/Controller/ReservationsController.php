<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Collection\Collection;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\I18n\FrozenTime;
use Cake\Utility\Text;

class ReservationsController extends AppController
{   
    public function index()
    {   
        $filter = $this->Authorization->applyScope($this->Reservations->find());

        $this->paginate = [
            'limit' => 5,
            'order' => [
                'Reservations.reserved_date' => 'desc'],
            'contain' => ['Users', 'Restaurants'],
        ];

        $reservations = $this->paginate($filter);

        $this->set(compact('reservations'));
    }

    public function upcoming()
    {   
        $now = FrozenTime::now();
        $date = $now->i18nFormat('yyyy-MM-dd HH:mm:ss');

        $reservations = $this->Reservations->find('upcoming', [
            'params' => $date
        ]);
        
        $reservations = $this->Authorization->applyScope($reservations, 'index');

        $this->set(compact('reservations'));
    }

    public function view ($uuid = null)
    {   
        $reservation = $this->Reservations->find()
            ->where(['Reservations.id' => $uuid])
            ->contain(['Users', 'Restaurants'])
            ->first();

            $this->Authorization->authorize($reservation);

        $occasions = $this->getOccassions();

        $selectedDate = new FrozenTime($reservation->reserved_date);
        $date = $selectedDate->i18nFormat('dd/MM/yyyy');
        $time = $selectedDate->i18nFormat('h:mm a');
               
        $this->set(compact('reservation', 'occasions', 'date', 'time'));
    }

    public function create()
    {   
        $restaurant_id = $this->request->getQuery('restaurant_id');
        $reserved_date = $this->request->getQuery('reserved_date');
        $guests = $this->request->getQuery('total_guests');
               
        $restaurants = $this->getTableLocator()->get('Restaurants');            
        $restaurant = $restaurants->get($restaurant_id);
        
        $reservation = $this->Reservations->find()
            ->where(['restaurant_id' => $restaurant_id, 'reserved_date' => $reserved_date])
            ->first();
             
        if ($reservation) {
            $this->Flash->alert('Sorry the timeslot is no longer available. Please, try again.', [
                'params' => ['type' => "warning"]
            ]);
            return $this->redirect(['controller' => 'restaurants', 'action' => 'view', $restaurant->slug]);
        }
        
        $selectedDate = new FrozenTime($reserved_date);
        $date = $selectedDate->i18nFormat('dd/MM/yyyy');
        $time = $selectedDate->i18nFormat('h:mm a');
       
        //get logged in user_id
        $user_id = $this->request->getAttribute('identity')->getIdentifier();

        $occasions = $this->getOccassions();     

        $reservation = $this->Reservations->newEmptyEntity();
       
        $identity = $this->request->getAttribute('identity');
        if (!$identity->can('create', $reservation)) {
            $this->Flash->alert('Sorry you are not allowed to make a reservation.', [
                'params' => ['type' => "warning"]
            ]);

            return $this->redirect('/');
        }
        
        if ($this->request->is('post')) {
            $reservation = $this->Reservations->patchEntity($reservation, $this->request->getData());
            $reservation->id = Text::uuid();
            $reservation->restaurant_id = $restaurant->id;
            $reservation->user_id = $user_id;
            $reservation->total_guests = $guests;
            $reservation->reserved_date = $selectedDate;
            

            if ($this->Reservations->save($reservation)) {
                $this->Flash->alert(__('The reservation has been saved.'), [
                    'params' => ['type' => "success"]
                ]);

                return $this->redirect(['action' => 'upcoming']);
            }

            if($reservation->getErrors('reserved_date')) {
               
                $this->Flash->alert('Sorry the timeslot is no longer available. Please, try again.', [
                    'params' => ['type' => "warning"]
                ]);

                return $this->redirect(['controller' => 'restaurants', 'action' => 'view', $restaurant->slug]);
            }


            $this->Flash->alert('The reservation could not be saved. Please, try again.', [
                'params' => ['type' => "danger"]
            ]);
        }
        
        $this->set(compact('restaurant', 'date', 'time', 'guests', 'occasions', 'reservation'));
    }

    public function edit($uuid = null)
    {   
        $reservation = $this->Reservations->find()
            ->where(['Reservations.id' => $uuid])
            ->contain('Restaurants')
            ->first();
        
        $this->Authorization->authorize($reservation);

         if ($this->request->is(['patch', 'post', 'put'])) {
            $reservation = $this->Reservations->patchEntity($reservation, $this->request->getData());
            if ($this->Reservations->save($reservation)) {
                $this->Flash->alert(__('The reservation has been saved.'), [
                    'params' => ['type' => "success"]
                ]);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->alert(__('The reservation could not be saved. Please, try again.'), [
                'params' => ['type' => "danger"]
            ]);
        }
        $users = $this->Reservations->Users->find('list', ['limit' => 200]);
        $restaurants = $this->Reservations->Restaurants->find('list', ['limit' => 200]);
        $this->set(compact('reservation', 'users', 'restaurants', 'restaurantTables'));
    }

    public function updateStatus($status, $id) {
        $this->request->allowMethod(['patch', 'post', 'put']);

        $reservation = $this->Reservations->get($id);

        $user = $this->request->getAttribute('identity');

        // Check authorization on $reservation
        if ($user->can('updateStatus', $reservation)) {
            
            $query = $this->Reservations->query();
            $updated = $query->update()
                    ->set(['status' => $status])
                    ->where(['id' => $id])
                    ->execute();

            // Do update operation
            if ($updated) {
                $this->Flash->alert(__('The reservation has been ' . $status), [
                    'params' => ['type' => "success"]
                ]);
            } else {
                $this->Flash->alert(__('The reservation could not be ' . $status . '. Please, try again.'));
            }
        } else {
            $this->Flash->alert(__('Sorry you are not allowed to update this record'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function getOccassions() {
        return $occasions = ['birthday' => 'Birthday', 'anniversary' => 'Anniversary'];  
    }
}
