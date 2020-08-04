<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cuisine $cuisine
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Cuisine'), ['action' => 'edit', $cuisine->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Cuisine'), ['action' => 'delete', $cuisine->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cuisine->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Cuisines'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Cuisine'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="cuisines view content">
            <h3><?= h($cuisine->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($cuisine->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($cuisine->id) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($cuisine->description)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Restaurant Cuisines') ?></h4>
                <?php if (!empty($cuisine->restaurant_cuisines)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Restaurant Id') ?></th>
                            <th><?= __('Cuisine Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($cuisine->restaurant_cuisines as $restaurantCuisines) : ?>
                        <tr>
                            <td><?= h($restaurantCuisines->restaurant_id) ?></td>
                            <td><?= h($restaurantCuisines->cuisine_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'RestaurantCuisines', 'action' => 'view', $restaurantCuisines->]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'RestaurantCuisines', 'action' => 'edit', $restaurantCuisines->]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'RestaurantCuisines', 'action' => 'delete', $restaurantCuisines->], ['confirm' => __('Are you sure you want to delete # {0}?', $restaurantCuisines->)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
