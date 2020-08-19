<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UserProfile $userProfile
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit User Profile'), ['action' => 'edit', $userProfile->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete User Profile'), ['action' => 'delete', $userProfile->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userProfile->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List User Profiles'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New User Profile'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="userProfiles view content">
            <h3><?= h($userProfile->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $userProfile->has('user') ? $this->Html->link($userProfile->user->id, ['controller' => 'Users', 'action' => 'view', $userProfile->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Profile Photo') ?></th>
                    <td><?= h($userProfile->profile_photo) ?></td>
                </tr>
                <tr>
                    <th><?= __('Phone No 2') ?></th>
                    <td><?= h($userProfile->phone_no_2) ?></td>
                </tr>
                <tr>
                    <th><?= __('Address Line 1') ?></th>
                    <td><?= h($userProfile->address_line_1) ?></td>
                </tr>
                <tr>
                    <th><?= __('Address Line 2') ?></th>
                    <td><?= h($userProfile->address_line_2) ?></td>
                </tr>
                <tr>
                    <th><?= __('Postcode') ?></th>
                    <td><?= h($userProfile->postcode) ?></td>
                </tr>
                <tr>
                    <th><?= __('City') ?></th>
                    <td><?= h($userProfile->city) ?></td>
                </tr>
                <tr>
                    <th><?= __('State') ?></th>
                    <td><?= h($userProfile->state) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($userProfile->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Gender') ?></th>
                    <td><?= $this->Number->format($userProfile->gender) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
