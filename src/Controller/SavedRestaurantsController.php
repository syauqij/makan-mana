<?php
declare(strict_types=1);

namespace App\Controller;

class SavedRestaurantsController extends AppController
{
    public function index()
    {
        $filter = $this->Authorization->applyScope($this->SavedRestaurants->find());

        $this->paginate = [
            'contain' => ['Users', 'Restaurants'],
        ];

        $savedRestaurants = $this->paginate($filter);

        $this->set(compact('savedRestaurants'));
    }

    public function view($id = null)
    {
        $savedRestaurant = $this->SavedRestaurants->get($id, [
            'contain' => ['Users', 'Restaurants'],
        ]);

        $this->set(compact('savedRestaurant'));
    }

    public function add()
    {
        $savedRestaurant = $this->SavedRestaurants->newEmptyEntity();
        if ($this->request->is('post')) {
            $savedRestaurant = $this->SavedRestaurants->patchEntity($savedRestaurant, $this->request->getData());
            if ($this->SavedRestaurants->save($savedRestaurant)) {
                $this->Flash->success(__('The saved restaurant has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The saved restaurant could not be saved. Please, try again.'));
        }
        $users = $this->SavedRestaurants->Users->find('list', ['limit' => 200]);
        $restaurants = $this->SavedRestaurants->Restaurants->find('list', ['limit' => 200]);
        $this->set(compact('savedRestaurant', 'users', 'restaurants'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $savedRestaurant = $this->SavedRestaurants->get($id);
        
        if ($user->can('delete', $savedRestaurant)) {
            // Do delete operation
            if ($this->SavedRestaurants->delete($savedRestaurant)) {
                $this->Flash->alert(__('The saved restaurant has been deleted.'));
            } else {
                $this->Flash->alert(__('The saved restaurant could not be deleted. Please, try again.'));
            }
        } else {
            $this->Flash->alert(__('The saved restaurant could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
