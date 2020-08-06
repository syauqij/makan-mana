<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\Collection\Collection;

class RestaurantsController extends AppController
{   
    public function beforeFilter(EventInterface $event)
    {
        //$this->viewBuilder()->setLayout('default_cake');
    }

    public function home()
    {   
        $this->viewBuilder()->setLayout('default');

        $getCuisines = $this->getTableLocator()->get('Cuisines');

        $results = $getCuisines->find('list', [
            'limit' => 5
        ]);
        
        $cuisines = $results->toArray();
        
        $featured = $this->Restaurants->find('all', [
            'contain' => [ 'Cuisines'],
        ]);

        $query = $this->Restaurants->find();
        $query->select(['city', 'state'])
            ->distinct(['state']);
        
        $this->set(compact('featured', 'cuisines', 'query'));
    }

    public function search()
    {   
        $params = $this->request->getQuery();
        if ($params) {
            $getRestaurants = $this->Restaurants->find('all')
                ->where([
                    'name like' => '%' . $params['key'] . '%'
                ]);

            if ($getRestaurants->isEmpty()) {
                $this->Flash->alert('No result found. Please try again.', [
                    'params' => [
                        'type' => "warning"
                    ]
                ]);
            }
        } else {
            $getRestaurants = $this->Restaurants;
        }

        $this->paginate = [
            'contain' => ['RestaurantCuisines.Cuisines'],
        ];
        
        $restaurants = $this->paginate($getRestaurants);

        $this->set(compact('restaurants')); 
    }

    public function cuisines()
    {
        // The 'pass' key is provided by CakePHP and contains all
        // the passed URL path segments in the request.
        $tags = $this->request->getParam('pass');

        // Use the ArticlesTable to find tagged articles.
        $restaurants = $this->Restaurants->find('byCuisines', [
            'cuisines' => $tags,
            'contain' => ['Cuisines'],
        ]);

        $this->set(compact('restaurants', 'tags')); 
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
        $restaurant = $this->Restaurants->findBySlug($slug)->firstOrFail();
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
}
