<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\I18n\FrozenTime;


class CuisinesController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        $this->Authorization->skipAuthorization('');
    }

    public function index()
    {
        $cuisines = $this->paginate($this->Cuisines);

        $this->set(compact('cuisines'));
    }

    public function view($id = null)
    {
        $cuisine = $this->Cuisines->get($id, [
            'contain' => ['RestaurantCuisines'],
        ]);

        $this->set(compact('cuisine'));
    }

    public function add()
    {
        $cuisine = $this->Cuisines->newEmptyEntity();
        if ($this->request->is('post')) {
            $cuisine = $this->Cuisines->patchEntity($cuisine, $this->request->getData());
            if ($this->Cuisines->save($cuisine)) {
                $this->Flash->alert(__('The cuisine has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->alert(__('The cuisine could not be saved. Please, try again.'));
        }
        $this->set(compact('cuisine'));
    }

    public function edit($id = null)
    {
        $cuisine = $this->Cuisines->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cuisine = $this->Cuisines->patchEntity($cuisine, $this->request->getData());
            $cuisine->modified = FrozenTime::now();
            if ($this->Cuisines->save($cuisine)) {
                $this->Flash->alert(__('The cuisine has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->alert(__('The cuisine could not be saved. Please, try again.'));
        }
        $this->set(compact('cuisine'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cuisine = $this->Cuisines->get($id);
        if ($this->Cuisines->delete($cuisine)) {
            $this->Flash->alert(__('The cuisine has been deleted.'));
        } else {
            $this->Flash->alert(__('The cuisine could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
