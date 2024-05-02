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


function createBreadcrumbs($data = []){
?>
    <nav aria-label="Breadcrumb">
        <ul class="uk-breadcrumb">
            <li><a href="/admin">Home</a></li>
            <?php
            foreach ($data as $item) {
                echo '<li><a href="' . $item['url'] . '">' . $item['name'] . '</a></li>';
            }
            ?>
        </ul>
    </nav>
    <?php
}

function limitList ($data){
    $limit_arr = array(
      10,
      15,
      25,
      50,
      100  
    );
    ?>
    <!-- <div class="limit_bar"> -->
        <button class="uk-button uk-button-default" type="button"><?php echo $data['limit']; ?></button>
        <div uk-dropdown>
            <ul class="uk-nav uk-dropdown-nav">
                <?php foreach($limit_arr as $lim): ?>
                    <li>
                        <a href="<?php echo urlGenerator($data, 'limit', $lim, ['search','limit','orderby','ordertype']) ?>">
                        <?php echo $lim; ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <!-- </div> -->

    <?php
}

function pagination($data){
    $page_count = ceil($data['count']/$data['limit']);

    $i = 1;
    ?> 
    <ul class="uk-pagination pagination" uk-margin> <?php
        if($data['page'] != 1){
            ?>
            <li>
                    <a href='<?php echo urlGenerator($data, 'page', $data['page'] - 1, ['search','limit','orderby','ordertype','page']) ?>'>
                    <span uk-pagination-previous></span>
                </a>
            </li>
            <?php
        }
        $flag_pagination = 0;
        while($i <= $page_count){
            if(
                $i == 1 || 
                $i == $page_count || 
                $i == $data['page'] ||
                $i+1 == $data['page'] ||
                $i+2 == $data['page'] ||
                $i+3 == $data['page'] ||
                $i-1 == $data['page'] ||
                $i-2 == $data['page'] ||
                $i-3 == $data['page'] 

            ){
                echo "<li " . (($i == $data['page']) ?
                    "class='uk-active'" : '') . "><a href='" . urlGenerator($data, 'page', $i, ['search','limit','orderby','ordertype','page']) . "'>$i</a></li>";
                // "class='uk-active'" : '') . "><a href='?page=$i'>$i</a></li>";
                $flag_pagination = 0;
            }
            else{
                if($flag_pagination == 0){
                ?> <li class="uk-disabled"><span>…</span></li> <?php
                }
                $flag_pagination = 1;
            }
            $i++;
        }
        if($data['page'] != $page_count){
            ?> 
            <li>
                    <a href='<?php echo urlGenerator($data, 'page', $data['page'] +  1, ['search','limit','orderby','ordertype','page']) ?>'>
                    <span uk-pagination-next></span>
                </a>
            </li>
            <?php
        }
    ?> </ul> <?php
}

function urlGenerator($data, $item, $new_data, $show_array){
    $modifiedData = $data;
    // var_dump($modifiedData);
    if (array_key_exists($item, $modifiedData)) {
        $modifiedData[$item] = $new_data;
    } else {
        $modifiedData[$item] = $new_data;
    }


    $queryParams = [];

    foreach ($show_array as $element) {
        if (array_key_exists($element, $modifiedData)) {
            $queryParams[$element] = $modifiedData[$element];
        }
    }


    $url = '?' . http_build_query($queryParams);

    return $url;
    
}

// array_merge(['f','d'],['a'],[4,6,9,'hff']) -> ['f','d','a',4,6,9,'hff']

// ['orderby', 'name']

function table_head_generator($data, $args, $get_array = []){ 
    $urlGenerator_array_1 = array_merge($get_array, ['search','limit','orderby','ordertype']);
    $urlGenerator_array_2 = array_merge($get_array, ['search','limit','orderby']);
    ?>
    <div class="table_edit-header-item">
        <?php if($args['orderby'] == $data['orderby'] && $args['ordertype'] != 'DESC'): ?>    
            <a href="<?php echo urlGenerator($args, 'ordertype', 'DESC',  $urlGenerator_array_1) ?>"> <?php echo $data['name'] ?> </a>
        <?php else: ?>
            <a href="<?php echo urlGenerator($args, 'orderby', $data['orderby'], $urlGenerator_array_2) ?>"><?php echo $data['name'] ?> </a>
        <?php endif; ?>
    </div>
<?php }
?>
