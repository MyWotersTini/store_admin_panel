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
            
            if(!empty($args['name'])
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


function create_breadcrumbs($data = []){
    //якщо data=пусто то return, інакше має через цикл вивестися всі елементи масиву в классі breadcrumpbs
?>
    <nav aria-label="Breadcrumb">
        <ul class="uk-breadcrumb">
            <li><a href="/">Home</a></li>
            <li><a href="/manufacture">Manufactures</a></li>
            <li><a href="#"><?php echo $manufacture['name']?></a></li>
        </ul>
    </nav>
    <?php
}

?>
