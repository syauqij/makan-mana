<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\ORM\Query;
use Cake\Collection\Collection;
use Cake\I18n\FrozenTime;
use Cake\Utility\Text;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

class RestaurantsController extends AppController
{       
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        $this->Authentication->addUnauthenticatedActions(['home', 'search', 'view']);
        //$this->Authorization->skipAuthorization();
    }

    public function getDefaultTime()
    {   
        $now = FrozenTime::now();
        $minutes = $now->i18nFormat('mm');
        $clearMinutes = $now->modify('-' . $minutes . 'minutes');

        if ($minutes < 15) {
            $time = $clearMinutes->modify('+30 minutes')->i18nFormat('HH:mm');
        } else if ($minutes > 45) {
            $time = $clearMinutes->modify('+1 hour 30 minutes')->i18nFormat('HH:mm');
        } else {
            $time = $clearMinutes->modify('+1 hour')->i18nFormat('HH:mm');
        }

        return $time;
    }

    public function home()
    {     
        $this->Authorization->skipAuthorization();

        $now = FrozenTime::now();
        $date = $now->i18nFormat('yyyy-MM-dd');
        $timeOptions = $this->getTimeSelections();
        $time = $this->getDefaultTime();
       
        $cuisinesTable = $this->getTableLocator()->get('Cuisines');

        $results = $cuisinesTable->find('list', [
            'limit' => 5
        ]);
        
        $cuisines = $results->toArray();
        
        $featured = $this->Restaurants->find('all')
            ->contain([ 'Cuisines'])
            ->where(['Restaurants.status' => 'featured']);

        $this->set(compact('featured', 'cuisines', 'date', 'time', 'timeOptions'));
    }

    public function search()
    {   
        $this->Authorization->skipAuthorization();

        $now = FrozenTime::now();
        $date = $today = $now->i18nFormat('yyyy-MM-dd');
        $timeOptions = $this->getTimeSelections();
        $time = $this->getDefaultTime();
        $guests = 2;

        //using search 
        $params = $this->request->getQuery();
        //selected cuisines
        $cuisines = $this->request->getParam('pass');

        if ($params) {
            $date = $params['date'];
            $time = $params['time'];
            $guests = $params['guests'];

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
            //get timeslots for each restaurant
            foreach ($restaurants as $restaurant) {
                $timeslots[] = $this->getTimeslots($selectedDate, $restaurant->id);
            }
            $restaurants = (new Collection($restaurants))->insert('timeslots', $timeslots);
        }

        $this->set(compact('restaurants', 'date', 'today', 'time', 'timeOptions', 'guests')); 
    }

    public function index()
    {   
        //filter results based on user's role and authorization
        $filter = $this->Authorization->applyScope($this->Restaurants->find());

        $this->paginate = [
            'contain' => ['Users'],
        ];

        $restaurants = $this->paginate($filter);

        $this->set(compact('restaurants'));
    }

    public function view($slug)
    {   
        $options = ['1' => '1 People', '2' => '2 People'];

        $this->Authorization->skipAuthorization();
        
        $now = FrozenTime::now();
        $date = $today = $now->i18nFormat('yyyy-MM-dd');
        $timeOptions = $this->getTimeSelections();
        $time = $this->getDefaultTime();
        
        $query = $this->Restaurants->findBySlug($slug)->firstOrFail();
        $restaurantId = $query['id'];

        $params = $this->request->getQuery();

        if ($params) {
            $date = $params['date'];
            $time = $params['time'];
            $guests = $params['guests'];

            $selectedDate = new FrozenTime($date . $time);
        }
        
        $restaurant = $this->Restaurants->find()
        ->where(['id' => $restaurantId])
        ->contain(['Cuisines', 'Menus']);
        
        $timeslots[] = $this->getTimeslots($selectedDate, $restaurantId);

        $merge = (new Collection($restaurant))->insert('timeslots', $timeslots);
        //dd($merge);
        $restaurant = $merge->first();

        $tableMenuCategories = $this->getTableLocator()->get('MenuCategories');
        $menuCategories = $tableMenuCategories->find()
            ->contain(['Menus.MenuItems'])
            ->contain('Menus', function (Query $q) use ($restaurantId) {
                return $q
                    //->select(['body', 'author_id'])
                    ->where(['Menus.restaurant_id' => $restaurantId]);
            });

        $this->set(compact('restaurant', 'menuCategories', 'date', 'time', 'timeOptions', 'options'));
    }

    public function edit($id = null)
    {   
        $restaurant = $this->Restaurants->find()
            ->where(['Restaurants.id' => $id])
            ->contain('RestaurantCuisines')
            ->first();
        
        $this->Authorization->authorize($restaurant);
        
        $cuisinesTable = $this->getTableLocator()->get('Cuisines');
        $cuisines = $cuisinesTable->find('list');
                        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
  
            foreach($data['cuisine_ids'] as $cuisine) {
                $data['restaurant_cuisines'][]['cuisine_id'] = $cuisine;
            }

            $restaurant = $this->Restaurants->patchEntity($restaurant, $data, [
                'associated' => 'RestaurantCuisines'
            ]);
            
            $dir = new Folder(WWW_ROOT . 'img\restaurant-profile-photos');
            $attachment = $this->request->getData('photo');
  
            if($attachment) {
                $fileName = $attachment->getClientFilename();
                $targetPath = $dir->path . DS . $fileName ;

                if($fileName) {
                    //dd($targetPath);
                    $attachment->moveTo($targetPath);
                    $restaurant->image_file = $fileName;  
                }
            }

            if ($this->Restaurants->save($restaurant)) {
                //dd($restaurant);
                $this->Flash->alert('Restaurant details updated', [
                    'params' => [
                        'type' => "success",
                        'name' => $restaurant->name
                    ]
                ]);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->alert('Restaurant details could not be saved. Please, try again.', [
                'params' => [
                    'type' => "warning",
                    'name' => $restaurant->name
                ]
            ]);
        }
        $this->set(compact('restaurant', 'cuisines'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $restaurant = $this->Restaurants->get($id);
        if ($this->Restaurants->delete($restaurant)) {
            $this->Flash->alert(__('The restaurant has been deleted.'), [
                'params' => ['type' => "success"]
            ]);
        } else {
            $this->Flash->alert(__('The restaurant could not be deleted. Please, try again.'), [
                'params' => ['type' => "warning"]
            ]);
        }

        return $this->redirect(['action' => 'index']);
    }

    public function gallery($id = nul)
    {
        $restaurant = $this->Restaurants->get($id, [
            'contain' => ['RestaurantCuisines'],
        ]);

        $this->Authorization->authorize($restaurant, 'edit');
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            //dd($this->request);
            $restaurant = $this->Restaurants->patchEntity($restaurant, $this->request->getData());
            
            $dir = new Folder(WWW_ROOT . 'img\restaurant-profile-photos');
            $attachment = $this->request->getData('photo');
  
            if($attachment) {
                $fileName = $attachment->getClientFilename();
                $targetPath = $dir->path . DS . $fileName ;

                if($fileName) {
                    //dd($targetPath);
                    $attachment->moveTo($targetPath);
                    $restaurant->image_file = $fileName;  
                }
            }

            if ($this->Restaurants->save($restaurant)) {
                $this->Flash->alert('Restaurant details updated.', [
                    'params' => ['type' => "success"]
                ]);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->alert(__('The restaurant could not be saved. Please, try again.'));
        }
        $this->set(compact('restaurant'));        
    }
    
    private function getTimeSelections() {
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

    private function getTimeslots($selectedDate, $restaurantId) {
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
