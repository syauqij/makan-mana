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
            'contain' => ['Users', 'Restaurants', 'RestaurantTables'],
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

        $users = $this->getTableLocator()->get('Users');
        $user = $users->get($user_id);

        $occasions = $this->getOccassions();     

        $reservation = $this->Reservations->newEmptyEntity();
        $this->Authorization->authorize($reservation);
        
        if ($this->request->is('post')) {
            $reservation = $this->Reservations->patchEntity($reservation, $this->request->getData());
            $reservation->id = Text::uuid();
            $reservation->restaurant_id = $restaurant->id;
            $reservation->user_id = $user_id;
            $reservation->total_guests = $guests;
            $reservation->reserved_date = $selectedDate;

            if ($this->Reservations->save($reservation)) {
                $this->Flash->success(__('The reservation has been saved.'));

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
        
        $this->set(compact('restaurant', 'date', 'time', 'guests', 'user', 'occasions', 'reservation'));
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

        $user = $this->request->getAttribute('identity');

        // Check authorization on $reservation
        if ($user->can('delete', $reservation)) {
            // Do delete operation
            if ($this->Reservations->delete($reservation)) {
                $this->Flash->success(__('The reservation has been deleted.'));
            } else {
                $this->Flash->error(__('The reservation could not be deleted. Please, try again.'));
            }
        } else {
            $this->Flash->error(__('The reservation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function getOccassions() {
        return $occasions = ['birthday' => 'Birthday', 'anniversary' => 'Anniversary'];  
    }
}
