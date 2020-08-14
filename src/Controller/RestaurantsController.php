<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\ORM\Query;
use Cake\Collection\Collection;
use Cake\I18n\FrozenTime;

class RestaurantsController extends AppController
{   
    public function beforeFilter(EventInterface $event)
    {
        //$this->viewBuilder()->setLayout('default_cake');
    }

    public function home()
    {   
        $this->viewBuilder()->setLayout('default');

        $timeOptions = $this->getTimeSelections();
        $now = FrozenTime::now();
        $date = $now->i18nFormat('yyyy-MM-dd');
        $minutes = $now->i18nFormat('mm');
        $clearMinutes = $now->modify('-' . $minutes . 'minutes');

        if ($minutes < 15) {
            $time = $clearMinutes->modify('+30 minutes')->i18nFormat('HH:mm');
        } else if ($minutes > 45) {
            $time = $clearMinutes->modify('+1 hour 30 minutes')->i18nFormat('HH:mm');
        } else {
            $time = $clearMinutes->modify('+1 hour')->i18nFormat('HH:mm');
        }
       
        $getCuisines = $this->getTableLocator()->get('Cuisines');

        $results = $getCuisines->find('list', [
            'limit' => 3
        ]);
        
        $cuisines = $results->toArray();
        
        $featured = $this->Restaurants->find('all', [
            'contain' => [ 'Cuisines'],
        ]);
        
        $this->set(compact('featured', 'cuisines', 'date', 'time', 'timeOptions'));
    }

    public function search()
    {   
        $params = $this->request->getQuery();
        $cuisines = $this->request->getParam('pass');

        $timeOptions = $this->getTimeSelections();
        $now = FrozenTime::now();
        $date = $today = $now->i18nFormat('yyyy-MM-dd');
        $minutes = $now->i18nFormat('mm');
        $clearMinutes = $now->modify('-' . $minutes . 'minutes');

        if ($minutes < 15) {
            $time = $clearMinutes->modify('+30 minutes')->i18nFormat('HH:mm');
        } else if ($minutes > 45) {
            $time = $clearMinutes->modify('+1 hour 30 minutes')->i18nFormat('HH:mm');
        } else {
            $time = $clearMinutes->modify('+1 hour')->i18nFormat('HH:mm');
        }

        if ($params) {

            $date = $this->request->getQuery('date');
            $time = $this->request->getQuery('time');
            $guests = $this->request->getQuery('guests');

            $selectedDate = new FrozenTime($date . $time); 
            
            $restaurants = $this->Restaurants->find('search', [
                'params' => $params,
                'contain' => ['Cuisines'],
            ]);

        } else if ($cuisines) {
            $selectedDate = new FrozenTime($date . $time);
            $restaurants = $this->Restaurants->find('cuisines', [
                'term' => $cuisines,
                'contain' => ['Cuisines'],
            ]);
        } else {
            return $this->redirect(['action' => 'home']);
        }
               
        if ($restaurants->isEmpty()) {
            $this->Flash->alert('No result found. Please try again.', [
                'params' => ['type' => "warning"]
            ]);
        } else {     
            foreach ($restaurants as $restaurant) {
                $timeslots[] = $this->getTimeslots($selectedDate, $restaurant->id);
            }   
            $restaurants = (new Collection($restaurants))->insert('timeslots', $timeslots);
        }

        $this->set(compact('restaurants', 'date', 'today', 'time', 'timeOptions')); 
    }

    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
        ];
        $restaurants = $this->paginate($this->Restaurants);

        $this->set(compact('restaurants'));
    }

    public function view($slug)
    {   
        $query = $this->Restaurants->findBySlug($slug)->firstOrFail();
        $restaurant = $this->Restaurants->get($query['id'], [
            'contain' => ['Cuisines'],
        ]);

        $this->set(compact('restaurant'));
    }

    public function add()
    {
        $this->viewBuilder()->setLayout('default_cake');

        $restaurant = $this->Restaurants->newEmptyEntity();
        if ($this->request->is('post')) {
            $restaurant = $this->Restaurants->patchEntity($restaurant, $this->request->getData());
            if ($this->Restaurants->save($restaurant)) {
                $this->Flash->success(__('The restaurant has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The restaurant could not be saved. Please, try again.'));
        }
        $users = $this->Restaurants->Users->find('list', ['limit' => 200]);
        $this->set(compact('restaurant', 'users'));
    }

    public function edit($id = null)
    {
        $restaurant = $this->Restaurants->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $restaurant = $this->Restaurants->patchEntity($restaurant, $this->request->getData());
            if ($this->Restaurants->save($restaurant)) {
                $this->Flash->success(__('The restaurant has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The restaurant could not be saved. Please, try again.'));
        }
        $users = $this->Restaurants->Users->find('list', ['limit' => 200]);
        $this->set(compact('restaurant', 'users'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $restaurant = $this->Restaurants->get($id);
        if ($this->Restaurants->delete($restaurant)) {
            $this->Flash->success(__('The restaurant has been deleted.'));
        } else {
            $this->Flash->error(__('The restaurant could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function getTimeSelections() {
        $now = FrozenTime::now();
        $date = $now->i18nFormat('yyyy-MM-dd');

        //to add startime condition based on tim   
        $startTime = new FrozenTime($date . ' 00:00:00');
        $endTime = new FrozenTime($date . ' 24:00:00');

        while ($startTime < $endTime) {
            $times[$startTime->i18nFormat('HH:mm')] = $startTime->i18nFormat('h:mm a');
            $startTime = $startTime->modify('+30 minutes');
        }

        return $times;
    }

    public function getTimeslots($selectedDate, $restaurantId) {
        
        $timeslots = null;
        $now = FrozenTime::now();

        if ($selectedDate > $now) {
            
            $startTime = $selectedDate->modify('-30 minutes');
            $endTime = $selectedDate->modify('+45 minutes');
    
            while ($startTime < $endTime) {
                if ($startTime > $now->modify('+15 minutes')) {
                    $timeslots[$startTime->i18nFormat('yyyy-MM-dd HH:mm:ss')] = $startTime->i18nFormat('yyyy-MM-dd HH:mm:ss');
                }
                $startTime = $startTime->modify('+15 minutes');
            }
           
            $reservations = $this->getTableLocator()->get('Reservations');
            $getReservations = $reservations->find('reserved', [
                'params' => ['restaurant_id' => $restaurantId, 'reserved_date' => $selectedDate],
            ]);

            foreach ($getReservations as $reservation) {
                $reserved = $reservation['reserved_date']->i18nFormat('yyyy-MM-dd HH:mm:ss');
                $key = array_search($reserved, $timeslots);

                if (false !== $key) {
                    unset($timeslots[$key]);
                }
            }            
        }

        return $timeslots;
    }    

}
