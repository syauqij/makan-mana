<?php
    $this->extend('/Common/registered');

    $this->start('sidebar');
        $role = $this->Identity->get('role');
        echo $this->element('sidebar/'.$role, ['active' => 'users']);
    $this->end(); 
?>

<?php $this->start('page-content'); ?>
<div class="users index content">
    <div class="d-flex bd-highlight">
        <div class="p-2 flex-grow-1 bd-highlight"><h3><?= __('Manage Users') ?></h3></div>
        <div class="p-2 bd-highlight">
            <?php if($role == 'admin') : ?>
                <?= $this->Html->link(__('New User'), ['action' => 'add'],['class' => 'btn btn-secondary']); ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('full_name') ?></th>
                    <th><?= $this->Paginator->sort('email') ?></th>
                    <th><?= $this->Paginator->sort('phone_no') ?></th>
                    <th><?= $this->Paginator->sort('role') ?></th>
                    <th><?= $this->Paginator->sort('active') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= h($user->full_name) ?></td>
                    <td><?= h($user->email) ?></td>
                    <td><?= h($user->phone_no) ?></td>
                    <td><?= h($user->get('role')) ?></td>
                    <td><?= h($user->status ? "Active" : "Disabled") ?></td>
                    <td><?= h($this->Time->format($user->created, "dd/MM/yy")) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
                        <?php if ($user->status) : ?>
                            <?= $this->Form->postLink(__('Disable'), ['action' => 'updateStatus', $user->id], ['confirm' => __('Are you sure you want to disable {0}?', $user->email)]) ?>
                        <?php else: ?>
                            <?= $this->Form->postLink(__('Enable'), ['action' => 'updateStatus', $user->id], ['confirm' => __('Are you sure you want to enable {0}?', $user->email)]) ?>
                        <?php endif; ?>
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
<?php $this->end(); ?>