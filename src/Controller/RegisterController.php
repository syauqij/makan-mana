<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Utility\Security;
use Cake\ORM\Locator\LocatorAwareTrait;

class RegisterController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->addUnauthenticatedActions(['member', 'owner']);
        $this->Authorization->skipAuthorization();
    }

    public function member()
    {   
        $usersTable = $this->getTableLocator()->get('Users');

        $user = $usersTable->newEmptyEntity();
        if ($this->request->is('post')) {
            //generate token for email validation and authenticate user
            $token = Security::hash(Security::randomBytes(32));

            $user = $usersTable->patchEntity($user, $this->request->getData(),
            ['validate' => 'passwords']);

            $user->token = $token;
            $user->role = "member";

            if ($usersTable->save($user)) {
                $user = $usersTable->find('byToken', ['token' => $token])->first();

                //authenticate newly registered user and log them in 
                $this->Authentication->setIdentity($user);

                // get redirect url (if any)
                $redirect = $this->request->getQuery('redirect');
        
                if ($redirect) {
                    $this->Flash->alert('Registration successful. Please, complete your reservation.', [
                        'params' => ['type' => "success"]
                    ]);

                    return $this->redirect($redirect);
                }

                $this->Flash->alert('Registration successful. Please, validate your email.', [
                    'params' => ['type' => "success"]
                ]);

                return $this->redirect(['controller' => 'Reservations', 'action' => 'index']);

            } else {
                $this->Flash->alert('Registration not successful. Please, try again.', [
                    'params' => ['type' => "warning"]
                ]);
            }
        }
        $this->set(compact('user'));
    }
    
    public function owner()
    {   
        $usersTable = $this->getTableLocator()->get('Users');

        $user = $usersTable->newEmptyEntity();
        if ($this->request->is('post')) {
            //generate token for email validation and authenticate user
            $token = Security::hash(Security::randomBytes(32));

            $user = $usersTable->patchEntity($user, $this->request->getData(),
            ['validate' => 'passwords']);

            $user->token = $token;
            $user->role = "owner";

            if ($usersTable->save($user)) {
                $user = $usersTable->find('byToken', ['token' => $token])->first();

                //authenticate newly registered owner and log them in 
                $this->Authentication->setIdentity($user);

                $this->Flash->alert('Your account has been created. Please, fill-in your restaurant basic information.', [
                    'params' => ['type' => "success"]
                ]);

                return $this->redirect(['controller' => 'Register', 'action' => 'restaurant']);

            } else {
                $this->Flash->alert('Registration not successful. Please, try again.', [
                    'params' => ['type' => "warning"]
                ]);
            }
        }
        $this->set(compact('user'));
    }

    public function restaurant()
    {   
        $restaurantsTable = $this->getTableLocator()->get('Restaurants');

        $restaurant = $restaurantsTable->newEmptyEntity();
        if ($this->request->is('post')) {
            $restaurant->user_id = $this->request->getAttribute('identity')->getIdentifier();
            $restaurant = $restaurantsTable->patchEntity($restaurant, $this->request->getData());

            if ($restaurantsTable->save($restaurant)) {

                $this->Flash->alert('Almost there. Please, complete your restaurant details.', [
                    'params' => ['type' => "success"]
                ]);

                return $this->redirect(['controller' => 'Restaurants', 'action' => 'edit', $restaurant->id]);

            } else {
                $this->Flash->alert('The restaurant information could not be saved. Please, try again.', [
                    'params' => ['type' => "warning"]
                ]);
            }
        }
        $this->set(compact('restaurant'));        
    }

}
