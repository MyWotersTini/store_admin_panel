<?php 

/*

    $args = array(
        'type'          => 'input', // select, textarea
        'format'        => 'password',
        'name'          => 'input_field_1',
        'placeholder'   => 'Enter name',
        'class'         => 'class1 class2'
    );

*/

function get_input_field($args = []){
    
    if(empty($args))
        return;

    // echo 'test';
    switch($args['type']){
        case 'input': 

            echo '<input ';

            if(!empty($args['format']))
                echo 'type="' . $args['format'] . '" ';
            
            if(!empty($args['name']))
                echo 'name="' . $args['name'] . '" ';
            
            if(!empty($args['class']))
                echo 'class="' . $args['class'] . '" ';
            
            if(!empty($args['placeholder']))
                echo 'placeholder="' . $args['placeholder'] . '" ';

            echo '>';
            break;
            
        case 'select': 
            break;
            
        case 'textarea': 
            break;
    }
}

?>
