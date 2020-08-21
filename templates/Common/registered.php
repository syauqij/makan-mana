
<?= $this->fetch('content') ?>

<div class="page-header">
    <div class="container">
        <h1 class="display-4"><?= h($this->Identity->get('full_name')) ?></h1>
    </div>
</div>

<div class="registered-content py-3 bg-light">
<div class="container">
    <div class="row">
    <div class="col-md-3 pb-3">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <?= $this->fetch('sidebar') ?>
        </div>
    </div>
    <div class="col-md-9">
        <div class="tab-content" id="v-pills-tabContent">
        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
            <?= $this->fetch('page-content') ?>
        </div>
        </div>
    </div>
    </div>
</div>
</div>