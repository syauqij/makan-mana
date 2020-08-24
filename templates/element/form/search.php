<?php
    $no = 1;
    while($no <= 20) {
        $options[$no] = $no . ' people';
        $no++;
    }
?>
    <div class="col-md-2">
        <?= $this->Form->date('date', [
            'value' => $date,
            'min' => $date,
            'id' => 'date'
        ]); ?>
    </div>
    <div class="col-md-2">
        <?= $this->Form->select('time', $timeOptions, [
            'value' => $time,
            'id' => "time"
            ]); ?>
    </div>
    <div class="col-md-2">
        <?= $this->Form->select('guests', $options, [
            'value' => $guests
            ]); ?>
    </div>
    <div class="col-md-4">
        <?= $this->Form->control('term', [
            'label' => false, 
            'value' => $this->request->getQuery('term'),
            'placeholder' => 'Search a Location, Restaurant, or Cuisine'
            ]
        ) ?>
    </div>
    <?= $this->Form->submit('Search', ['class' => 'btn btn-primary']) ?>
