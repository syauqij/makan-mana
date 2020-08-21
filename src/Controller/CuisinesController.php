<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Cuisines Controller
 *
 * @property \App\Model\Table\CuisinesTable $Cuisines
 * @method \App\Model\Entity\Cuisine[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CuisinesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $cuisines = $this->paginate($this->Cuisines);

        $this->set(compact('cuisines'));
    }

    /**
     * View method
     *
     * @param string|null $id Cuisine id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cuisine = $this->Cuisines->get($id, [
            'contain' => ['RestaurantCuisines'],
        ]);

        $this->set(compact('cuisine'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
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

    /**
     * Edit method
     *
     * @param string|null $id Cuisine id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cuisine = $this->Cuisines->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cuisine = $this->Cuisines->patchEntity($cuisine, $this->request->getData());
            if ($this->Cuisines->save($cuisine)) {
                $this->Flash->alert(__('The cuisine has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->alert(__('The cuisine could not be saved. Please, try again.'));
        }
        $this->set(compact('cuisine'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Cuisine id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
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
