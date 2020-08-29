<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * MenuCategories Controller
 *
 * @property \App\Model\Table\MenuCategoriesTable $MenuCategories
 * @method \App\Model\Entity\MenuCategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MenuCategoriesController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        $this->Authorization->skipAuthorization('');
    }

    public function index()
    {
        $menuCategories = $this->paginate($this->MenuCategories);

        $this->set(compact('menuCategories'));
    }

    public function view($id = null)
    {
        $menuCategory = $this->MenuCategories->get($id, [
            'contain' => ['Menus'],
        ]);

        $this->set(compact('menuCategory'));
    }

    public function add()
    {
        $menuCategory = $this->MenuCategories->newEmptyEntity();
        if ($this->request->is('post')) {
            $menuCategory = $this->MenuCategories->patchEntity($menuCategory, $this->request->getData());
            if ($this->MenuCategories->save($menuCategory)) {
                $this->Flash->alert(__('The menu category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->alert(__('The menu category could not be saved. Please, try again.'));
        }
        $this->set(compact('menuCategory'));
    }

    public function edit($id = null)
    {
        $menuCategory = $this->MenuCategories->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $menuCategory = $this->MenuCategories->patchEntity($menuCategory, $this->request->getData());
            if ($this->MenuCategories->save($menuCategory)) {
                $this->Flash->alert(__('The menu category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->alert(__('The menu category could not be saved. Please, try again.'));
        }
        $this->set(compact('menuCategory'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $menuCategory = $this->MenuCategories->get($id);
        if ($this->MenuCategories->delete($menuCategory)) {
            $this->Flash->alert(__('The menu category has been deleted.'));
        } else {
            $this->Flash->alert(__('The menu category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
