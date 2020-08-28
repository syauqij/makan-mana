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

        $this->Authentication->addUnauthenticatedActions(['login']);
        $this->Authorization->skipAuthorization('login', 'logout');
    }

    public function login()
    {   
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            
            if($this->request->getAttribute('identity')->get('status') == 0) {
                $this->Authentication->logout();
                $this->Flash->alert('Your account has been disabled. Contact our Admin for further info.', [
                    'params' => ['type' => "warning"]
                ]);
                return $this->redirect(['controller' => 'Restaurants', 'action' => 'home']);
            }
            
            $target = $this->Authentication->getLoginRedirect();
            
            if (!$target) {
                //check user's role and redirect to their respective pages.
                $role = $this->request->getAttribute('identity')->get('role');
                $this->roleRedirects($role);
            }
            //remove app name if application installed in sub directory.
            $target = str_replace("makan-mana/", "",$target);
            return $this->redirect($target);
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
    
    public function roleRedirects($role)
    {
        $identity = $this->request->getAttribute('identity');
        if ($role == 'member') {
            $contoller = 'Reservations';
            $action = 'upcoming';
        } elseif ($role == 'owner') {
            //check if owner has completed register a restaurant
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
        } elseif($role == "admin") {
            $contoller = 'Restaurants';
            $action = 'index';
        } else {
            $contoller = 'Users';
            $action = 'logout';
        }

        $redirect = $this->request->getQuery('redirect', [
            'controller' => $contoller,
            'action' => $action,
        ]);

        return $this->redirect($redirect);
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

    public function add()
    {
        $user = $this->Users->newEmptyEntity(['associated' => 'UserProfiles']);
        $stateOptions = $this->getStates();

        if ($this->request->getAttribute('identity')->can('create', $user)) {
            if ($this->request->is('post')) {

                $token = Security::hash(Security::randomBytes(32));

                $user = $this->Users->patchEntity($user, $this->request->getData(),
                    ['associated' => 'UserProfiles'], ['validate' => 'passwords']
                );

                $user->token = $token;

                if ($this->Users->save($user)) {
                    $this->Flash->alert(__('The user has been saved.'));
    
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->alert(__('The user could not be saved. Please, try again.'), [
                    'params' => ['type' => "warning"]
                ]);
            }
            $restaurants = $this->Users->Restaurants->find('list', ['limit' => 200]);
            $this->set(compact('user', 'stateOptions'));
        }
    } 

    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['UserProfiles'],
        ]);

        $stateOptions = $this->getStates();

        if ($this->request->getAttribute('identity')->can('edit', $user)) {
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
                
                //add new entity user profiles if not exist
                if($user->user_profile == null) {
                    $profiles = $this->getTableLocator()->get('UserProfiles');
                    $profile = $profiles->newEntity($data['user_profile']);
                    
                    $profile->user_id = $user->id;
                    
                    if($profiles->save($profile)){
                        $this->Flash->alert(__($user->full_name . ' account profiles has been saved.'), [
                            'params' => ['type' => "success"]
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

        $this->set(compact('user', 'stateOptions'));
    }

    public function updateStatus($id = null) {
        $this->request->allowMethod(['post']);

        $user = $this->Users->get($id);

        if ($this->request->getAttribute('identity')->can('updateStatus', $user)) {
            $status = ($user->status == 1) ? 0 : 1; 
            $user = $this->Users->query();
            $status = $user->update()
                    ->set(['status' => $status])
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
