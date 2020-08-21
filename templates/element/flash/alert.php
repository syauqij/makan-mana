<?php
/**
 * @var \App\View\AppView $this
 * @var array $params
 * @var string $message
 */
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>

<div class="col-12 mt-2 alert alert-<?= h($params['type']) ?> alert-dismissible fade show" role="alert">
    <?= h($message) ?> <b><?= h(isset($params['name'])) ?> </b>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>