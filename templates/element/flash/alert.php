<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}

    if(empty($params['type'])) {
        $type = "info";
    } else {
        $type = $params['type'];
    }
?>

<div class="col-12 mt-2 alert alert-<?= h($type) ?> alert-dismissible fade show" role="alert">
    <?= h($message) ?> </b>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>