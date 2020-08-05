<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;


class RestaurantsController extends AppController
{   
    public function beforeFilter(EventInterface $event)
    {
        //$this->viewBuilder()->setLayout('default_cake');
    }

    public function home()
    {   
        $this->viewBuilder()->setLayout('default');
        
        $featured = $this->Restaurants->find('all', [
            'contain' => ['RestaurantCuisines', 'RestaurantCuisines.Cuisines'],
        ]);
        
        $this->set(compact('featured'));
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

    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
        ];
        $restaurants = $this->paginate($this->Restaurants);

        $this->set(compact('restaurants'));
    }

    /**
     * View method
     *
     * @param string|null $id Restaurant id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $restaurant = $this->Restaurants->get($id, [
            'contain' => ['Users', 'BusinessHours', 'Menus', 'Reservations', 'RestaurantCuisines', 'RestaurantGalleries', 'RestaurantTables'],
        ]);

        $this->set(compact('restaurant'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
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

    /**
     * Edit method
     *
     * @param string|null $id Restaurant id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
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

    /**
     * Delete method
     *
     * @param string|null $id Restaurant id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
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
