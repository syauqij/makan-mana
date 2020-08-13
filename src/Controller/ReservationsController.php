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

    public function add($id = null)
    {   
        $restaurants = $this->getTableLocator()->get('Restaurants');
        $users = $this->getTableLocator()->get('Users');
        
        $restaurant = $restaurants->get($id, [
            'contain' => [],
        ]);
        
        $selectedDate = new FrozenTime($this->request->getQuery('reserved_date'));
        $date = $selectedDate->i18nFormat('dd/MM/yyyy');
        $time = $selectedDate->i18nFormat('h:mm a');
        $guests = $this->request->getQuery('total_guests');
        
        //get logged in user details
        $user_id = 1;
        $user = $users->get($user_id);

        $occasions = ['birthday' => 'Birthday', 'anniversary' => 'Anniversary'];

        $this->set(compact('restaurant', 'date', 'time', 'guests', 'user', 'occasions'));

        $reservation = $this->Reservations->newEmptyEntity();

        if ($this->request->is('post')) {
            
            $reservation = $this->Reservations->patchEntity($reservation, $this->request->getData());
            $reservation->restaurant_id = $restaurant->id;
            $reservation->user_id = $user_id;
            $reservation->total_guests = $guests;
            $reservation->reserved_date = $selectedDate;
            $reservation->uuid = Text::uuid();

            if ($this->Reservations->save($reservation)) {
                $this->Flash->success(__('The reservation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }

            //dd($reservation->errors);
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
        //$users = $this->Reservations->Users->find('list', ['limit' => 200]);
        $restaurants = $this->Reservations->Restaurants->find('list', ['limit' => 200]);
        //$restaurantTables = $this->Reservations->RestaurantTables->find('list', ['limit' => 200]);
        $this->set(compact('reservation'));
    }

    public function edit($uuid = null)
    {   

        $reservation = $this->Reservations->find()->where(['uuid' => $uuid])->first();

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
