<?php
declare(strict_types=1);

namespace App\Controller;

class MenusController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        //$this->Authorization->skipAuthorization();
    }  
    
    public function index($restaurantId = null)
    {   
        //get all menu
        $menus = $this->Menus->find();
        $restaurant = null;
        if ($restaurantId) {
            //Get a restaurant's menu
            $menus = $this->Menus->find('restaurantMenu', [
                'params' => ['restaurant_id' => $restaurantId]
            ]);
            $restaurants = $this->getTableLocator()->get('Restaurants');
            $restaurant = $restaurants->get($restaurantId);
            if (!$this->request->getAttribute('identity')->can('createMenu', $restaurant)) {
                $this->Flash->alert(__('You are not allowed to view this restaurant menu.'));
                return $this->redirect(['controller' => 'Restaurants', 'action' => 'index']);
            }
        }

        //determine which restaurants menu the user can access.
        $filter = $this->Authorization->applyScope($menus);

        $this->paginate = [
            'limit' => 5,
            'contain' => ['Restaurants', 'MenuCategories'],
        ];

        $menus = $this->paginate($filter);
        $this->set(compact('menus', 'restaurant'));
    }

    public function view($id = null)
    {   
        
        $menu = $this->Menus->get($id, [
            'contain' => ['Restaurants', 'MenuCategories', 'MenuItems'],
        ]);

        $this->set(compact('menu'));
    }

    public function add($restaurantId = null)
    {   
        $menus = $this->getTableLocator()->get('Menus');
        $menu = $menus->newEmptyEntity([
            'associated' => 'MenuItems'
        ]);

        $restaurants = $this->getTableLocator()->get('Restaurants');
        $restaurant = $restaurants->get($restaurantId);

        // Check authorization on $restaurant
        if ($this->request->getAttribute('identity')->can('createMenu', $restaurant)) {
            if ($this->request->is('post')) {
                //dd($this->request->getData());
                $data = $this->request->getData();
                
                foreach ($data['menu_items'] as $key => $item) {
                    $data['menu_items'][$key]['sequence']  = $key;
                }
                
                $menu = $menus->patchEntity($menu, $data, [
                    'associated' => 'MenuItems'
                ]);
                    
                $menu->restaurant_id = $restaurantId;

                $totalMenu = $menus->find('restaurantMenu', [
                    'params' => ['restaurant_id' => $restaurantId]
                ])->count();
                $menu->sequence = $totalMenu + 1;

                if ($this->Menus->save($menu)) {
                    $this->Flash->alert(__('The menu has been saved.'));

                    return $this->redirect(['action' => 'index', $restaurantId]);
                }
                $this->Flash->alert(__('The menu could not be saved. Please, try again.'));
            }
        } else {
            $this->Flash->alert(__('You are not allowed to add this restaurant menu.'));
            return $this->redirect(['controller' => 'Restaurants', 'action' => 'index']);
        }
        //$restaurants = $this->Menus->Restaurants->find('list', ['limit' => 200]);
        $menuCategories = $this->Menus->MenuCategories->find('list', ['limit' => 200]);
        $this->set(compact('menu', 'menuCategories', 'restaurant'));
    }

    public function edit($id = null)
    {   
        $menus = $this->getTableLocator()->get('Menus');
        $menu = $this->Menus->get($id, [
            'contain' => ['Restaurants', 'MenuCategories', 'MenuItems'],
        ]);

        $restaurant = $menu->restaurant;
        if ($this->request->getAttribute('identity')->can('update', $menu)) {
            if ($this->request->is(['patch', 'post', 'put'])) {
                //dd($this->request->getData());
                $data = $this->request->getData();

                foreach ($data['menu_items'] as $key => $item) {
                    $data['menu_items'][$key]['sequence']  = $key;
                }

                $menu = $menus->patchEntity($menu, $data, [
                    'associated' => 'MenuItems'
                ]);

                if ($this->Menus->save($menu)) {
                    $this->Flash->alert(__('The menu has been saved.'));

                    return $this->redirect(['action' => 'index', $restaurant->id]);
                }
                $this->Flash->alert(__('The menu could not be saved. Please, try again.'));
            }
        } else {
            $this->Flash->alert(__('You are not allowed to edit this restaurant menu.'));
            return $this->redirect(['controller' => 'Restaurants', 'action' => 'index']);
        }
        $menuCategories = $this->Menus->MenuCategories->find('list', ['limit' => 200]);
        $this->set(compact('menu', 'restaurant', 'menuCategories'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $menu = $this->Menus->get($id);
        if ($this->Menus->delete($menu)) {
            $this->Flash->alert(__('The menu has been deleted.'));
        } else {
            $this->Flash->alert(__('The menu could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
