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
        //$this->Authorization->skipAuthorization('login', 'logout', 'register');
        $this->Authorization->skipAuthorization();
    }

    public function login()
    {   
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            // redirect to /articles after login success
            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'Reservations',
                'action' => 'index',
            ]);
            return $this->redirect($redirect);
        }

        // display error if user submitted and authentication failed
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid username or password'));
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

    public function register()
    {   
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            //generate token for email validation and authenticate user
            $token = Security::hash(Security::randomBytes(32));

            $user = $this->Users->patchEntity($user, $this->request->getData());

            $user->token = $token;
            $user->role = "member";

            $dir = new Folder(WWW_ROOT . 'img\profile-photos');
            $attachment = $this->request->getData('attachment');
            if($attachment) {
                $fileName = $attachment->getClientFilename();
                $targetPath = $dir->path . DS . $fileName ;

                if($fileName) {
                    $attachment->moveTo($targetPath);
                    $user->photo_path = $fileName;  
                }
            }

            if ($this->Users->save($user)) {
                $user = $this->Users->find('byToken', ['token' => $token])->first();

                $this->Authentication->setIdentity($user);

                $redirect = $this->request->getQuery('redirect');

                //dd($redirect);
        
                // regardless of POST or GET, redirect if user is logged in
                if ($redirect) {

                    $this->Flash->alert('Registration successful. Please, complete your reservation.', [
                        'params' => ['type' => "success"]
                    ]);

                    return $this->redirect($redirect);
                }

                $this->Flash->alert('Registration successful. Please, sign in.', [
                    'params' => ['type' => "success"]
                ]);

                return $this->redirect(['controller' => 'Reservations', 'action' => 'index']);

            } else {
                $this->Flash->alert('Registration not successful. Please, try again.', [
                    'params' => ['type' => "warning"]
                ]);
            }

            //dd($user);
        }
        $this->set(compact('user'));
    }

    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        
        //dd($this->Authorization->authorize($user));
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }
}
