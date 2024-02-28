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


function create_breadcrumbs($data = []){
?>
    <nav aria-label="Breadcrumb">
        <ul class="uk-breadcrumb">
            <li><a href="/">Home</a></li>
            <?php
            foreach ($data as $item) {
                echo '<li><a href="' . $item['url'] . '">' . $item['name'] . '</a></li>';
            }
            ?>
        </ul>
    </nav>
    <?php
}

function pagination($data){
    $page_count = ceil($data['count']/$data['limit']);

    $i = 1;
    ?> <ul class="uk-pagination" uk-margin> <?php
        if($data['page'] != 1){
            ?>
            <li>
                <a href='?page=<?php echo $data['page'] - 1 ?>'>
                    <span uk-pagination-previous></span>
                </a>
            </li>
            <?php
        }
        while($i <= $page_count){
            if($i == 1 || $i == $page_count){
                echo "<li><a href=''>$i</a></li>";
            }
            $i++;
        }
        if($data['page'] != $page_count){
            ?> 
            <li>
                <a href='?page=<?php echo $data['page'] + 1 ?>'>
                    <span uk-pagination-previous></span>
                </a>
            </li>
            <?php
        }
    ?> </ul> <?php
}
?>
