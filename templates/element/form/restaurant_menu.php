<div class="row">      
    <div class="col-md-6">
      <?= $this->Form->control('menu_category_id', [
          'type' => 'select',
          'label' => 'Menu Category',
          'options' => $menuCategories,
          'empty' => 'Select Category'
      ]); ?>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <?= $this->Form->control('title', [
            'label' => 'Menu',
            'placeholder' => 'Title'
        ]); ?>
        <?= $this->Form->control('description', [
            'label' => false,
            'placeholder' => 'Description'
        ]); ?>
    </div>
</div>

<?php $this->start('script'); ?>
  <script>
  $(document).ready(function(){
    $( ".add-item" ).click(function() {
        var newItem = $(".menu-item").eq(0).clone(true);
        newItem.find(':input').each(function() {
            this.value = "";
        });

        $('#menu-items').append(newItem);

        $('#menu-items').find('.menu-item').each(function(index) {
            console.log('index = ' + index);
            
            $(this).find(':input').each(function() {
                var inputName = this.name;
                var theNum = inputName.replace(/[^0-9]/g,'');
                this.name = inputName.replace(theNum, ''+ index +'');
                console.log(this.name);
            });
        });    

        $("input:text").focus(); 
    });


    $( ".delete-item" ).click(function() {
        if (confirm("Confirm remove this item?")) {
            var totalItem = $(".menu-item").length;
            if (totalItem > 1) {
                this.closest('.menu-item').remove();
            } else{
                $(this).closest('.menu-item').find(':input').val('');
            }
        }
    });
  });
  </script>
<?php $this->end(); ?>