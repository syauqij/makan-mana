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
use App\Controller\AppController;
use Cake\Http\Exception\NotFoundException;

class RestaurantsController extends AppController
{       
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        $this->Authentication->addUnauthenticatedActions(['home', 'search', 'view']);
        $this->Authorization->skipAuthorization('upload');
    }

    public function home()
    {     
        $this->Authorization->skipAuthorization();

        $now = FrozenTime::now();
        $date = $now->i18nFormat('yyyy-MM-dd');
        $timeOptions = $this->getTimeSelections();
        $time = $this->getDefaultTime();
        $guests = 2;
       
        $cuisinesTable = $this->getTableLocator()->get('Cuisines');

        $results = $cuisinesTable->find('list', [
            'limit' => 5
        ]);
        
        $cuisines = $results->toArray();
        
        $featured = $this->Restaurants->find('all')
            ->contain([ 'Cuisines'])
            ->where(['Restaurants.status' => 'featured']);

        $this->set(compact('featured', 'cuisines', 'date', 'time', 'guests', 'timeOptions'));
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
        $this->viewBuilder()->setOption('serialize', ['restaurants']);
    }

    public function view($slug)
    {   
        $this->Authorization->skipAuthorization();
        
        $now = FrozenTime::now();
        $date = $today = $now->i18nFormat('yyyy-MM-dd');
        $timeOptions = $this->getTimeSelections();
        $time = $this->getDefaultTime();
        $guests = 2;
        
        $query = $this->Restaurants->findBySlug($slug, [
            'contain' => ['RestaurantPhotos']
        ])->firstOrFail();

        $restaurantId = $query['id'];

        $params = $this->request->getQuery();

        if ($params) {
            $date = $params['date'];
            $time = $params['time'];
            $guests = $params['guests'];
        }

        $selectedDate = new FrozenTime($date . $time);
        
        $restaurant = $this->Restaurants->find()
        ->where(['id' => $restaurantId])
        ->contain(['Cuisines', 'Menus', 'RestaurantPhotos'])
        ->first();
        
        $timeslots = $this->getTimeslots($selectedDate, $restaurantId);
        
        $tableMenuCategories = $this->getTableLocator()->get('MenuCategories');
        $menuCategories = $tableMenuCategories->find()
            ->contain(['Menus.MenuItems'])
            ->contain('Menus', function (Query $q) use ($restaurantId) {
                return $q
                    ->where(['Menus.restaurant_id' => $restaurantId]);
            });

        $user = $this->request->getAttribute('identity');
        if($user) {
            $savedRestaurantsTable = $this->getTableLocator()->get('SavedRestaurants');
            $hasSaved = $savedRestaurantsTable->find('hasSaved', [
                'user_id' => $user->get('id'),
            ])->first();
            $this->set('hasSaved', $hasSaved);
        }

        $this->set(compact('restaurant', 'timeslots', 'menuCategories', 'date', 'today', 'time', 'guests', 'timeOptions'));
    }

    public function edit($id = null)
    {   
        $restaurant = $this->Restaurants->find()
            ->where(['Restaurants.id' => $id])
            ->contain('RestaurantCuisines')
            ->first();
        
        $stateOptions = $this->getStates();

        if (!$this->request->getAttribute('identity')->can('edit', $restaurant)) {
            $this->Flash->alert('Sorry you are not allowed to edit this restaurant.', [
                'params' => ['type' => "warning"]
            ]);

            return $this->redirect('/');
        }
        
        $cuisinesTable = $this->getTableLocator()->get('Cuisines');
        $cuisines = $cuisinesTable->find('list');

        $collection = new Collection($restaurant->restaurant_cuisines);
        $currentCuisines = $collection->extract('cuisine_id')->toList();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $selectedCuisines = $data['cuisine_ids'];

            if($selectedCuisines){
                foreach($selectedCuisines as $key => $cuisine) {
                    $data['restaurant_cuisines'][$key]['cuisine_id'] = $cuisine;
                    $data['restaurant_cuisines'][$key]['restaurant_id'] = $id;
                }
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
                $this->Flash->alert($restaurant->name . ' details updated.', [
                    'params' => [
                        'type' => "success",
                        'name' => $restaurant->name
                    ]
                ]);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->alert($restaurant->name . ' details could not be saved. Please, try again.', [
                'params' => [
                    'type' => "warning",
                    'name' => $restaurant->name
                ]
            ]);
        }
        $this->set(compact('restaurant', 'cuisines', 'currentCuisines', 'stateOptions'));
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
            'contain' => ['RestaurantPhotos'],
        ]);

        $this->set(compact('restaurant'));        
    }

}
