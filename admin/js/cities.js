window.addEventListener("DOMContentLoaded", (event) => {

    let edit_button = document.getElementById('cities_edit_button');
    let cities_delete_button = document.getElementById('cities_delete_button');
    let delete_button = document.querySelectorAll('a[href="#modal_delete_table"]');
    let add_button = document.getElementById('cities_add_button');

    if(delete_button)
        delete_button.forEach((item) => {
            item.addEventListener("click", function(){
                open_delete_modal(this);
            });
    });

    if(add_button)
        add_button.addEventListener("click", add_function);

    if(edit_button)
        edit_button.addEventListener("click", edit_func);

    if(cities_delete_button)
        cities_delete_button.addEventListener("click", delete_cities);
    
});

function delete_cities() {
    let cities_delete_button = document.getElementById('cities_delete_button');
    let cities_id = cities_delete_button.getAttribute('cities_id');
    $.ajax({
        url: '/admin/system/server.php',
        type: 'POST',
        data: {
            'action' : 'cities_delete',
            'id' : cities_id 
        },
        success: function( response ) {

            location.reload();
        }
    }); 
}

function open_delete_modal(item){
    UIkit.modal('#modal_delete_table').show();

    document.querySelector('#modal_delete_table .uk-modal-title span').innerHTML = 
    item.getAttribute('data-name');

    document.getElementById('cities_delete_button').setAttribute('cities_id', item.getAttribute('data-id'));
}

function cities_list_location(){
    location.replace('/admin/cities'); 
}

function add_function(){
    let add_button = document.getElementById('cities_add_button');

    add_button.setAttribute('disabled', true);

    let cities_type   = document.getElementById('cities_type').value;
    let cities_district   = document.getElementById('cities_district').value;
    let cities_name   = document.getElementById('cities_name').value;

    $.ajax({
        url: '/admin/system/server.php',
        type: 'POST',
        data: {
            'action' : 'cities_add',
            'type' : cities_type,
            'district_id' : cities_district,
            'name' : cities_name,
        },
        success: function( response ) {
            let data = JSON.parse(response);

            if(data['success'] == false){

                console.log(data['errors']);
                for(let index in data['errors']){
                    //console.log(index);
                    document.getElementById('cities_label_' + index).innerHTML = data['errors'][index];
                }
                add_button.removeAttribute("disabled");
            }else{
                UIkit.notification({message: data['success'], status: 'success'})
                // location.replace('/cities'); 
                setTimeout(cities_list_location, 1500); 
            }
        },
    });
}

function edit_func(){

    let edit_button = document.getElementById('cities_edit_button');

    edit_button.setAttribute('disabled', true);

    let cities_name    = document.getElementById('cities_name').value;
    let cities_id      = edit_button.getAttribute('cities_id');
    let cities_district    = document.getElementById('cities_district').value;
    
    $.ajax({
        url: '/admin/system/server.php',
        type: 'POST',
        data: {
            'action' : 'cities_edit',
            'name' : cities_name,
            'id' : cities_id,
            'district' : cities_district
        },
        success: function( response ) {
            let data = JSON.parse(response);

            if(data['success'] == false){

                for(let index in data['errors']){
                    document.getElementById('cities_label_' + index).innerHTML = data['errors'][index];
                }
                edit_button.removeAttribute("disabled");
            }else{
                UIkit.notification({message: data['success'], status: 'success'})  
                setTimeout(cities_list_location, 1500); 
            }

            edit_button.removeAttribute("disabled");
        },
    }); 

}