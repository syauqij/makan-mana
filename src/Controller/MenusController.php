<?php
declare(strict_types=1);

namespace App\Controller;

class MenusController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        $this->Authorization->skipAuthorization();
    }  
    
    public function index()
    {   
        $this->paginate = [
            'contain' => ['Restaurants', 'MenuCategories'],
        ];
        $menus = $this->paginate($this->Menus);

        $this->set(compact('menus'));
    }

    public function view($id = null)
    {   
        $this->Authorization->skipAuthorization();
        $menu = $this->Menus->get($id, [
            'contain' => ['Restaurants', 'MenuCategories', 'MenuItems'],
        ]);

        $this->set(compact('menu'));
    }

    public function add()
    {   
        $this->Authorization->skipAuthorization();
        $menu = $this->Menus->newEmptyEntity();
        if ($this->request->is('post')) {
            $menu = $this->Menus->patchEntity($menu, $this->request->getData());
            if ($this->Menus->save($menu)) {
                $this->Flash->alert(__('The menu has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->alert(__('The menu could not be saved. Please, try again.'));
        }
        $restaurants = $this->Menus->Restaurants->find('list', ['limit' => 200]);
        $menuCategories = $this->Menus->MenuCategories->find('list', ['limit' => 200]);
        $this->set(compact('menu', 'restaurants', 'menuCategories'));
    }

    public function edit($id = null)
    {   
        $this->Authorization->skipAuthorization();
        $menu = $this->Menus->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $menu = $this->Menus->patchEntity($menu, $this->request->getData());
            if ($this->Menus->save($menu)) {
                $this->Flash->alert(__('The menu has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->alert(__('The menu could not be saved. Please, try again.'));
        }
        $restaurants = $this->Menus->Restaurants->find('list', ['limit' => 200]);
        $menuCategories = $this->Menus->MenuCategories->find('list', ['limit' => 200]);
        $this->set(compact('menu', 'restaurants', 'menuCategories'));
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
