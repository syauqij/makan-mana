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

                $this->Flash->alert('Your account has been created. Please, fill-in your restaurant information.', [
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
        $cuisinesTable = $this->getTableLocator()->get('Cuisines');
        
        $restaurant = $restaurantsTable->newEmptyEntity([
            'associated' => 'RestaurantCuisines'
        ]);

        $cuisines = $cuisinesTable->find('list');

        if ($this->request->is('post')) {
            $data = $this->request->getData();
  
            foreach($data['cuisine_ids'] as $cuisine) {
                $data['restaurant_cuisines'][]['cuisine_id'] = $cuisine;
            }

            $restaurant->user_id = $this->request->getAttribute('identity')->getIdentifier();

            $restaurant = $restaurantsTable->patchEntity($restaurant, $data, [
                'associated' => 'RestaurantCuisines'
            ]);

            $dir = new Folder(WWW_ROOT . 'img\restaurant-profile-photos');
            $attachment = $this->request->getData('photo');
           
            if($attachment) {
                $fileName = $attachment->getClientFilename();
                $targetPath = $dir->path . DS . $fileName ;

                if($fileName) {
                    $attachment->moveTo($targetPath);
                    $restaurant->image_file = $fileName;  
                }
            }

            if ($restaurantsTable->save($restaurant)) {
                
                $this->Flash->alert('Almost there. Please, complete your restaurant details.', [
                    'params' => ['type' => "success"]
                ]);

                return $this->redirect(['controller' => 'Restaurants', 'action' => 'edit', $restaurant->id]);

            } else {
                $this->Flash->alert('The details could not be saved. Please, try again.', [
                    'params' => [
                        'type' => "warning"
                    ]
                ]);
            } 
            //debug($restaurant);
        }
        $this->set(compact('restaurant', 'cuisines'));        
    }

}
