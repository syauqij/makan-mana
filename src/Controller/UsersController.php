<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Utility\Security;

class UsersController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->addUnauthenticatedActions(['login', 'register']);
        $this->Authorization->skipAuthorization('login', 'logout', 'register');
    }

    public function login()
    {   
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            
            $identity = $this->request->getAttribute('identity');
            $role = $identity->get('role');

            if ($role == 'member') {
                $contoller = 'Reservations';
                $action = 'upcoming';
            } elseif ($role == 'owner') {
                $restaurantsTable = $this->getTableLocator()->get('Restaurants');
                $hasRestaurant = $restaurantsTable->find('hasRestaurant', [
                    'user_id' => $identity->get('id'),
                ]);
                if ($hasRestaurant->isEmpty()) {
                    $this->Flash->alert('Welcome back. Please continue filling-in your restaurant information.', [
                        'params' => ['type' => "info"]
                    ]);

                    $contoller = 'Register';
                    $action = 'restaurant';
                } else {
                    $contoller = 'Reservations';
                    $action = 'index';
                }
            } else {
                $contoller = 'Restaurants';
                $action = 'index';
            }

            $redirect = $this->request->getQuery('redirect', [
                'controller' => $contoller,
                'action' => $action,
            ]);
            return $this->redirect($redirect);
        }

        // display error if user submitted and authentication failed
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->alert(__('Invalid username or password'), [
                'params' => ['type' => "warning"]
            ]);
        }

        $redirect = $this->request->getQuery('redirect');

        $this->set('redirect', $redirect);
    }

    public function logout()
    {   
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'Restaurants', 'action' => 'home']);
        }
    }    
    
    public function index()
    {   
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    public function view($id = null)
    {   
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->Authorization->authorize($user);
        $this->set(compact('user'));
    }

    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['UserProfiles'],
        ]);

        $identity = $this->request->getAttribute('identity');
        if ($identity->can('edit', $user)) {
            if ($this->request->is(['patch', 'post', 'put'])) {
                
                $data = $this->request->getData();

                if($data['password'] == "") {
                    unset($data['password']);
                }

                $user = $this->Users->patchEntity($user, $data,
                    ['associated' => 'UserProfiles'], ['validate' => 'passwords']
                );

                $dir = new Folder(WWW_ROOT . 'img\user-profile-photos');
                $attachment = $this->request->getData('photo');
                
                if($attachment) {
                    $fileName = $attachment->getClientFilename();
                    $targetPath = $dir->path . DS . $fileName ;
                    
                    if($fileName) {
                        $attachment->moveTo($targetPath);
                        $user->image_file = $fileName;
                    }
                }
                
                //dd($this->Users->save($user));
                
                //add new entity user profiles if not exist
                if($user->user_profile == null) {
                    $profiles = $this->getTableLocator()->get('UserProfiles');
                    $profile = $profiles->newEntity($data['user_profile']);
                    
                    $profile->user_id = $user->id;
                    
                    if($profiles->save($profile)){
                        $this->Flash->alert(__($user->full_name . ' account profiles has been saved.'), [
                            'params' => ['type' => "warning"]
                        ]);
                    }
                }
                    
                if ($this->Users->save($user)) {
                        
                    $this->Flash->alert(__($user->full_name . ' account details has been saved.'), [
                        'params' => ['type' => "success"]
                    ]);

                    return $this->redirect(['action' => 'edit', $id]);
                }
                $this->Flash->alert(__($user->full_name . ' account details could not be saved. Please, try again.'), [
                    'params' => ['type' => "warning"]
                ]);
            }
        } else {
            $this->Flash->alert(__('Sorry you are not allowed to update this record'));
            return $this->redirect('/');
        }

        $this->set(compact('user'));
    }

    public function updateStatus($id = null) {
        $this->request->allowMethod(['post']);

        $user = $this->Users->get($id);

        $identity = $this->request->getAttribute('identity');

        if ($identity->can('updateStatus', $user)) {
            $status = ($user->status == 1) ? 0 : 1; 
            $query = $this->Users->query();
            $status = $query->update()
                    ->set(['active' => $status])
                    ->where(['id' => $id])
                    ->execute();

            if ($status) {
                $this->Flash->alert(__('The user status has been updated'), [
                    'params' => ['type' => "success"]
                ]);
            } else {
                $this->Flash->alert(__('The user status could not be updated. Please, try again.'));
            }
        } else {
            $this->Flash->alert(__('Sorry you are not allowed to update this record'));
            return $this->redirect('/');
        }

        return $this->redirect(['action' => 'index']);
    }    
}
