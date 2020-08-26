<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\I18n\FrozenTime;


/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');

        // Check authentication result and lock your site
        $this->loadComponent('Authentication.Authentication');

        $this->loadComponent('Authorization.Authorization');
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
    }

    public function getDefaultTime()
    {   
        $now = FrozenTime::now();
        $minutes = $now->i18nFormat('mm');
        $clearMinutes = $now->modify('-' . $minutes . 'minutes');

        if ($minutes < 15) {
            $time = $clearMinutes->modify('+30 minutes')->i18nFormat('HH:mm');
        } else if ($minutes > 45) {
            $time = $clearMinutes->modify('+1 hour 30 minutes')->i18nFormat('HH:mm');
        } else {
            $time = $clearMinutes->modify('+1 hour')->i18nFormat('HH:mm');
        }

        return $time;
    }

    public function getTimeSelections() {
        $now = FrozenTime::now();
        $date = $now->i18nFormat('yyyy-MM-dd');

        $startTime = new FrozenTime($date . ' 00:00:00');
        $endTime = new FrozenTime($date . ' 24:00:00');

        while ($startTime < $endTime) {
            $times[$startTime->i18nFormat('HH:mm')] = $startTime->i18nFormat('h:mm a');
            $startTime = $startTime->modify('+30 minutes');
        }

        return $times;
    }

    public function getTimeslots($selectedDate, $restaurantId) {
        $timeslots = null;
        $now = FrozenTime::now();

        if ($selectedDate > $now) {
            
            $startTime = $selectedDate->modify('-30 minutes');
            $endTime = $selectedDate->modify('+30 minutes');
    
            while ($startTime < $endTime) {
                if ($startTime > $now->modify('+15 minutes')) {
                    $timeslots[$startTime->i18nFormat('yyyy-MM-dd HH:mm:ss')] = $startTime->i18nFormat('yyyy-MM-dd HH:mm:ss');
                }
                $startTime = $startTime->modify('+15 minutes');
            }
           
            $reservations = $this->getTableLocator()->get('Reservations');
            $getReservations = $reservations->find('reserved', [
                'params' => ['restaurant_id' => $restaurantId, 'reserved_date' => $selectedDate],
            ]);
            
            if(!$getReservations->isEmpty()) {
                foreach ($getReservations as $reservation) {
                    $reserved = $reservation['reserved_date']->i18nFormat('yyyy-MM-dd HH:mm:ss');
                    $key = array_search($reserved, $timeslots);
                    
                    if (false !== $key) {
                        // /unset($timeslots[$key]);
                        $timeslots[$key] = null;
                    }
                }     
            }       
        }

        return $timeslots;
    } 
}
