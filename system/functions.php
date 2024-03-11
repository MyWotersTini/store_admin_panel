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
                        <a href="?limit=<?php echo $lim; ?>&search=<?php echo urlencode($data['search']); ?>">
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
                    <a href='?page=<?php echo $data['page'] - 1 ?>&limit=<?php echo $data['limit']; ?>&search=<?php echo urlencode($data['search']); ?>'>
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
                    "class='uk-active'" : '') . "><a href='?page=$i&limit=" . $data['limit'] . "&search=" . urlencode($data['search']) . "'>$i</a></li>";
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
                    <a href='?page=<?php echo $data['page'] + 1 ?>&limit=<?php echo $data['limit']; ?>&search=<?php echo urlencode($data['search']); ?>'>
                    <span uk-pagination-next></span>
                </a>
            </li>
            <?php
        }
    ?> </ul> <?php
}

function urlGenerator($data, $item, $new_data, $show_array){
    $modifiedData = $data;

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
    
    
    // перше $data 
    // друге елемент який треба замінити
    // значення елемента який треба замінити
    // які елементи включити до генераціі лінки

    // 1. Якщо ми змінюємо ліміт то викликається ця функція з наступнимим параметрами ($data, 'limit', 25, ['search','limit','orderby','ordertype'])
    // Відповідно всі значення беруться з data, а лише limit замінюється на нове значення при цьому page не виводиться так як його немає в останньому масиві

    // 2. pagination. ($data, 'page', 2, ['search','limit','orderby','ordertype','page']) виводимо все й замінюємо page

    // 3. orderby ($data, 'orderby', 'type', ['search','limit','orderby']) // ?search=Ва&limit=15&orderby=type

    // 4. ordertype ($data, 'ordertype', 'DESC', ['search','limit','orderby','ordertype']) ?search=Ва&limit-15&orderby=type&ordertype=DESC
}
?>
