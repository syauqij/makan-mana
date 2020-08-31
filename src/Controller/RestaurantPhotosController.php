<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Utility\Text;

class RestaurantPhotosController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        $this->Authentication->addUnauthenticatedActions(['upload']);
        $this->Authorization->skipAuthorization('upload');
    }

    public function upload($id = null)
    {   
        $restaurantsTable = $this->getTableLocator()->get('Restaurants');
        $restaurant = $restaurantsTable->get($id);
        $gallery = $this->RestaurantPhotos->newEmptyEntity();
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $gallery = $this->RestaurantPhotos->patchEntity($gallery, $this->request->getData());
            //debug($this->request->getData());

            //create folder if not exist
            $folder = WWW_ROOT . 'img\restaurant-photos';
            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }

            $dir = new Folder($folder);
            $attachment = $this->request->getData('file');
            
            if($attachment) {
                $fileName = $attachment->getClientFilename();
                $fileName = Text::slug($fileName, ['preserve' => '.']);
                $targetPath = $dir->path . DS . $fileName ;

                if($fileName) {
                    $attachment->moveTo($targetPath);
                    $gallery->image_file = $fileName;
                    $gallery->name = "success";
                    $gallery->restaurant_id = $id;
                }
            }

            if ($this->RestaurantPhotos->save($gallery)) {
                $this->Flash->alert('Photo successfully uploded.', [
                    'params' => ['type' => "success"]
                ]);
            } else {
                $this->Flash->alert(__('The photos could not be uploded. Please, try again.'));
            }
        }
        $this->set(compact('gallery'));
        $this->viewBuilder()->setOption('serialize', ['gallery']);
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $restaurantGallery = $this->RestaurantPhotos->get($id);
        if ($this->RestaurantPhotos->delete($restaurantGallery)) {
            $this->Flash->success(__('The restaurant gallery has been deleted.'));
        } else {
            $this->Flash->error(__('The restaurant gallery could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}