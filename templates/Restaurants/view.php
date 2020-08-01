<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Restaurant $restaurant
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Restaurant'), ['action' => 'edit', $restaurant->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Restaurant'), ['action' => 'delete', $restaurant->id], ['confirm' => __('Are you sure you want to delete # {0}?', $restaurant->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Restaurants'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Restaurant'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="restaurants view content">
            <h3><?= h($restaurant->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($restaurant->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Address Line 1') ?></th>
                    <td><?= h($restaurant->address_line_1) ?></td>
                </tr>
                <tr>
                    <th><?= __('Address Line 2') ?></th>
                    <td><?= h($restaurant->address_line_2) ?></td>
                </tr>
                <tr>
                    <th><?= __('Contact No') ?></th>
                    <td><?= h($restaurant->contact_no) ?></td>
                </tr>
                <tr>
                    <th><?= __('Website') ?></th>
                    <td><?= h($restaurant->website) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($restaurant->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('User Id') ?></th>
                    <td><?= $this->Number->format($restaurant->user_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Price Range') ?></th>
                    <td><?= $this->Number->format($restaurant->price_range) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($restaurant->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($restaurant->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($restaurant->description)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Operating Hours') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($restaurant->operating_hours)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Payment Options') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($restaurant->payment_options)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Menus') ?></h4>
                <?php if (!empty($restaurant->menus)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Restaurant Id') ?></th>
                            <th><?= __('Menu Category Id') ?></th>
                            <th><?= __('Order') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($restaurant->menus as $menus) : ?>
                        <tr>
                            <td><?= h($menus->id) ?></td>
                            <td><?= h($menus->name) ?></td>
                            <td><?= h($menus->description) ?></td>
                            <td><?= h($menus->restaurant_id) ?></td>
                            <td><?= h($menus->menu_category_id) ?></td>
                            <td><?= h($menus->order) ?></td>
                            <td><?= h($menus->created) ?></td>
                            <td><?= h($menus->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Menus', 'action' => 'view', $menus->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Menus', 'action' => 'edit', $menus->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Menus', 'action' => 'delete', $menus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menus->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Reservations') ?></h4>
                <?php if (!empty($restaurant->reservations)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Restaurant Id') ?></th>
                            <th><?= __('Total Guests') ?></th>
                            <th><?= __('Time') ?></th>
                            <th><?= __('Date') ?></th>
                            <th><?= __('Table Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($restaurant->reservations as $reservations) : ?>
                        <tr>
                            <td><?= h($reservations->id) ?></td>
                            <td><?= h($reservations->user_id) ?></td>
                            <td><?= h($reservations->restaurant_id) ?></td>
                            <td><?= h($reservations->total_guests) ?></td>
                            <td><?= h($reservations->time) ?></td>
                            <td><?= h($reservations->date) ?></td>
                            <td><?= h($reservations->table_id) ?></td>
                            <td><?= h($reservations->created) ?></td>
                            <td><?= h($reservations->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Reservations', 'action' => 'view', $reservations->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Reservations', 'action' => 'edit', $reservations->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Reservations', 'action' => 'delete', $reservations->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reservations->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Restaurant Cuisines') ?></h4>
                <?php if (!empty($restaurant->restaurant_cuisines)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Cuisine Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($restaurant->restaurant_cuisines as $restaurantCuisines) : ?>
                        <tr>
                            <td><?= h($restaurantCuisines->cuisine->name) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'RestaurantCuisines', 'action' => 'view', $restaurantCuisines->restaurant_id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'RestaurantCuisines', 'action' => 'edit', $restaurantCuisines->restaurant_id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'RestaurantCuisines', 'action' => 'delete', $restaurantCuisines->restaurant_id], ['confirm' => __('Are you sure you want to delete # {0}?', $restaurantCuisines->restaurant_id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Restaurant Galleries') ?></h4>
                <?php if (!empty($restaurant->restaurant_galleries)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Restaurant Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Photo') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($restaurant->restaurant_galleries as $restaurantGalleries) : ?>
                        <tr>
                            <td><?= h($restaurantGalleries->id) ?></td>
                            <td><?= h($restaurantGalleries->restaurant_id) ?></td>
                            <td><?= h($restaurantGalleries->name) ?></td>
                            <td><?= h($restaurantGalleries->photo) ?></td>
                            <td><?= h($restaurantGalleries->created) ?></td>
                            <td><?= h($restaurantGalleries->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'RestaurantGalleries', 'action' => 'view', $restaurantGalleries->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'RestaurantGalleries', 'action' => 'edit', $restaurantGalleries->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'RestaurantGalleries', 'action' => 'delete', $restaurantGalleries->id], ['confirm' => __('Are you sure you want to delete # {0}?', $restaurantGalleries->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Restaurant Tables') ?></h4>
                <?php if (!empty($restaurant->restaurant_tables)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Total Seats') ?></th>
                            <th><?= __('Restaurant Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($restaurant->restaurant_tables as $restaurantTables) : ?>
                        <tr>
                            <td><?= h($restaurantTables->id) ?></td>
                            <td><?= h($restaurantTables->name) ?></td>
                            <td><?= h($restaurantTables->total_seats) ?></td>
                            <td><?= h($restaurantTables->restaurant_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'RestaurantTables', 'action' => 'view', $restaurantTables->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'RestaurantTables', 'action' => 'edit', $restaurantTables->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'RestaurantTables', 'action' => 'delete', $restaurantTables->id], ['confirm' => __('Are you sure you want to delete # {0}?', $restaurantTables->id)]) ?>
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
