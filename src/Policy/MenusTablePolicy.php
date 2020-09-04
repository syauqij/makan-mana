<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Table\MenusTable;
use Authorization\IdentityInterface;

/**
 * Menus policy
 */
class MenusTablePolicy
{
  public function scopeIndex($user, $query)
  {   
      $role = $user->getOriginalData()->role;
      switch($role) {
          case 'member' :
              return null;
          case 'owner' :
              return $query->where([
                'Restaurants.user_id' => $user->getIdentifier()
              ]);
          case 'admin' :
              return $query;
          default :
              return null;
      }
  }
}
