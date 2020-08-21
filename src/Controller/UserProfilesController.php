<?php
declare(strict_types=1);

namespace App\Controller;

class UserProfilesController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authorization->skipAuthorization();
    }
    
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
        ];
        $userProfiles = $this->paginate($this->UserProfiles);

        $this->set(compact('userProfiles'));
    }

    public function view($id = null)
    {
        $userProfile = $this->UserProfiles->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set(compact('userProfile'));
    }

    public function add()
    {
        $userProfile = $this->UserProfiles->newEmptyEntity();
        if ($this->request->is('post')) {
            $userProfile = $this->UserProfiles->patchEntity($userProfile, $this->request->getData());
            if ($this->UserProfiles->save($userProfile)) {
                $this->Flash->alert(__('The user profile has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->alert(__('The user profile could not be saved. Please, try again.'));
        }
        $users = $this->UserProfiles->Users->find('list', ['limit' => 200]);
        $this->set(compact('userProfile', 'users'));
    }

    public function edit($id = null)
    {
        $userProfile = $this->UserProfiles->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userProfile = $this->UserProfiles->patchEntity($userProfile, $this->request->getData());
            if ($this->UserProfiles->save($userProfile)) {
                $this->Flash->alert(__('The user profile has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->alert(__('The user profile could not be saved. Please, try again.'));
        }
        $users = $this->UserProfiles->Users->find('list', ['limit' => 200]);
        $this->set(compact('userProfile', 'users'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userProfile = $this->UserProfiles->get($id);
        if ($this->UserProfiles->delete($userProfile)) {
            $this->Flash->alert(__('The user profile has been deleted.'));
        } else {
            $this->Flash->alert(__('The user profile could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
