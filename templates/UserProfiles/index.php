<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UserProfile[]|\Cake\Collection\CollectionInterface $userProfiles
 */
?>
<div class="userProfiles index content">
    <?= $this->Html->link(__('New User Profile'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('User Profiles') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('profile_photo') ?></th>
                    <th><?= $this->Paginator->sort('phone_no_2') ?></th>
                    <th><?= $this->Paginator->sort('gender') ?></th>
                    <th><?= $this->Paginator->sort('address_line_1') ?></th>
                    <th><?= $this->Paginator->sort('address_line_2') ?></th>
                    <th><?= $this->Paginator->sort('postcode') ?></th>
                    <th><?= $this->Paginator->sort('city') ?></th>
                    <th><?= $this->Paginator->sort('state') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($userProfiles as $userProfile): ?>
                <tr>
                    <td><?= $this->Number->format($userProfile->id) ?></td>
                    <td><?= $userProfile->has('user') ? $this->Html->link($userProfile->user->full_name, ['controller' => 'Users', 'action' => 'view', $userProfile->user->id]) : '' ?></td>
                    <td><?= h($userProfile->profile_photo) ?></td>
                    <td><?= h($userProfile->phone_no_2) ?></td>
                    <td><?= $this->Number->format($userProfile->gender) ?></td>
                    <td><?= h($userProfile->address_line_1) ?></td>
                    <td><?= h($userProfile->address_line_2) ?></td>
                    <td><?= h($userProfile->postcode) ?></td>
                    <td><?= h($userProfile->city) ?></td>
                    <td><?= h($userProfile->state) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $userProfile->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $userProfile->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $userProfile->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userProfile->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
