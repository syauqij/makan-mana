<?php
    //customise Templates FormHelper for Bootstrap Forms components
    return [
        'formGroup' => '{{label}}{{input}}',
        'input' => '<input class="form-control" type="{{type}}" name="{{name}}"{{attrs}}/>',
        'inputContainer' =>'<div class="form-group input {{type}}{{required}}">{{content}}</div>',
        'label' => '<label{{attrs}}>{{text}}</label>',
        'error' => '<div class="invalid-feedback">{{content}}</div>',
        'select' => '<div class="form-group"><select class="form-control" name="{{name}}"{{attrs}}>{{content}}</select></div>'
    ];
?>