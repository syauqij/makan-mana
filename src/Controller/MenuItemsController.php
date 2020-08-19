<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * MenuItems Controller
 *
 * @property \App\Model\Table\MenuItemsTable $MenuItems
 * @method \App\Model\Entity\MenuItem[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
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

    /**
     * View method
     *
     * @param string|null $id Menu Item id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $menuItem = $this->MenuItems->get($id, [
            'contain' => ['Menus'],
        ]);

        $this->set(compact('menuItem'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $menuItem = $this->MenuItems->newEmptyEntity();
        if ($this->request->is('post')) {
            $menuItem = $this->MenuItems->patchEntity($menuItem, $this->request->getData());
            if ($this->MenuItems->save($menuItem)) {
                $this->Flash->success(__('The menu item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The menu item could not be saved. Please, try again.'));
        }
        $menus = $this->MenuItems->Menus->find('list', ['limit' => 200]);
        $this->set(compact('menuItem', 'menus'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Menu Item id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $menuItem = $this->MenuItems->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $menuItem = $this->MenuItems->patchEntity($menuItem, $this->request->getData());
            if ($this->MenuItems->save($menuItem)) {
                $this->Flash->success(__('The menu item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The menu item could not be saved. Please, try again.'));
        }
        $menus = $this->MenuItems->Menus->find('list', ['limit' => 200]);
        $this->set(compact('menuItem', 'menus'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Menu Item id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $menuItem = $this->MenuItems->get($id);
        if ($this->MenuItems->delete($menuItem)) {
            $this->Flash->success(__('The menu item has been deleted.'));
        } else {
            $this->Flash->error(__('The menu item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
