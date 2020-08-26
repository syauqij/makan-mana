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

    public function add($restaurant_id = null, $slug)
    {
        $this->request->allowMethod(['post', 'get']);
        
        $user_id = $this->request->getAttribute('identity')->getIdentifier();
        
        $savedRestaurant = $this->SavedRestaurants->newEmptyEntity();
        
        if ($this->request->getAttribute('identity')->can('create', $savedRestaurant)) {
            if ($this->request->is('post')) {
                $savedRestaurant = $this->SavedRestaurants->patchEntity($savedRestaurant, $this->request->getData());
                $savedRestaurant->user_id = $user_id;
                $savedRestaurant->restaurant_id = $restaurant_id;
                if ($this->SavedRestaurants->save($savedRestaurant)) {
                    $this->Flash->alert(__('Restaurant successfully saved.'));
                } else {
                    $this->Flash->alert(__('Restaurant could not be saved. Please, try again.'));
                }
            }
        } else {
            $this->Flash->alert('Sorry you are not allowed to make a reservation.', [
                'params' => ['type' => "warning"]
            ]);
            return $this->redirect('/');
        }
            
        return $this->redirect(['controller' => 'restaurants', 'action' => 'view', $slug]);        
    }

    public function delete($id = null, $slug = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        
        $savedRestaurant = $this->SavedRestaurants->get($id);

        $user = $this->request->getAttribute('identity');
        
        if ($user->can('delete', $savedRestaurant)) {
            // Do delete operation
            if ($this->SavedRestaurants->delete($savedRestaurant)) {
                $this->Flash->alert(__('The saved restaurant has been deleted.'));
            } else {
                $this->Flash->alert(__('Could not delete saved restaurant. Please, try again.'));
            }
        } else {
            $this->Flash->alert(__('Could not delete saved restaurant. Please, try again.'));
        }

        if ($slug) {
            return $this->redirect(['controller' => 'restaurants', 'action' => 'view', $slug]);
        }
        return $this->redirect(['action' => 'index']);
    }
}
