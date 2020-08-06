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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $restaurant->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $restaurant->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Restaurants'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="restaurants form content">
            <?= $this->Form->create($restaurant) ?>
            <fieldset>
                <legend><?= __('Edit Restaurant') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('description');
                    echo $this->Form->control('address_line_1');
                    echo $this->Form->control('address_line_2');
                    echo $this->Form->control('city');
                    echo $this->Form->control('state');
                    echo $this->Form->control('contact_no');
                    echo $this->Form->control('website');
                    echo $this->Form->control('price_range');
                    echo $this->Form->control('payment_options');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
