<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cuisine[]|\Cake\Collection\CollectionInterface $cuisines
 */
?>
<div class="cuisines index content">
    <?= $this->Html->link(__('New Cuisine'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Cuisines') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cuisines as $cuisine): ?>
                <tr>
                    <td><?= $this->Number->format($cuisine->id) ?></td>
                    <td><?= h($cuisine->name) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $cuisine->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $cuisine->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $cuisine->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cuisine->id)]) ?>
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
