<?php
    $this->extend('/Common/registered');

    $this->start('sidebar');
        $role = $this->Identity->get('role');
        echo $this->element('sidebar/'.$role, ['active' => 'setting']);
    $this->end(); 
?>

<?php $this->start('page-content'); ?>
<div class="d-flex bd-highlight">
        <div class="p-2 flex-grow-1 bd-highlight"><h3><?= __('Manage Menu Category') ?></h3></div>
        <div class="p-2 bd-highlight">
            <?php if($role == 'admin') : ?>
                <?= $this->Html->link(__('New Category'), ['action' => 'add'],['class' => 'btn btn-secondary']); ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('sequence') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($menuCategories as $menuCategory): ?>
                <tr>
                    <td><?= $this->Number->format($menuCategory->id) ?></td>
                    <td><?= h($menuCategory->name) ?></td>
                    <td><?= $this->Number->format($menuCategory->sequence) ?></td>
                    <td><?= h($menuCategory->created) ?></td>
                    <td><?= h($menuCategory->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $menuCategory->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $menuCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menuCategory->id)]) ?>
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

<?php $this->end(); ?>