<?php
declare(strict_types=1);

namespace App\Controller;

class MenuItemsController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        $this->Authorization->skipAuthorization();
        $this->viewBuilder()->setLayout('default_cake');
    }  
    public function index()
    {
        $this->paginate = [
            'contain' => ['Menus'],
        ];
        $menuItems = $this->paginate($this->MenuItems);

        $this->set(compact('menuItems'));
    }

    public function view($id = null)
    {
        $menuItem = $this->MenuItems->get($id, [
            'contain' => ['Menus'],
        ]);

        $this->set(compact('menuItem'));
    }

    public function add()
    {
        $menuItem = $this->MenuItems->newEmptyEntity();
        if ($this->request->is('post')) {
            $menuItem = $this->MenuItems->patchEntity($menuItem, $this->request->getData());
            if ($this->MenuItems->save($menuItem)) {
                $this->Flash->alert(__('The menu item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->alert(__('The menu item could not be saved. Please, try again.'));
        }
        $menus = $this->MenuItems->Menus->find('list', ['limit' => 200]);
        $this->set(compact('menuItem', 'menus'));
    }

    public function edit($id = null)
    {
        $menuItem = $this->MenuItems->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $menuItem = $this->MenuItems->patchEntity($menuItem, $this->request->getData());
            if ($this->MenuItems->save($menuItem)) {
                $this->Flash->alert(__('The menu item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->alert(__('The menu item could not be saved. Please, try again.'));
        }
        $menus = $this->MenuItems->Menus->find('list', ['limit' => 200]);
        $this->set(compact('menuItem', 'menus'));
    }
    
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $menuItem = $this->MenuItems->get($id);
        if ($this->MenuItems->delete($menuItem)) {
            $this->Flash->alert(__('The menu item has been deleted.'));
        } else {
            $this->Flash->alert(__('The menu item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
