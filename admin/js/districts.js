window.addEventListener("DOMContentLoaded", (event) => {

    let edit_button = document.getElementById('districts_edit_button');
    let districts_delete_button = document.getElementById('districts_delete_button');
    let delete_button = document.querySelectorAll('a[href="#modal_delete_table"]');
    let add_button = document.getElementById('districts_add_button');
    

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

    if(districts_delete_button)
        districts_delete_button.addEventListener("click", delete_districts);
    
});

function delete_districts() {
    let districts_delete_button = document.getElementById('districts_delete_button');
    let districts_id = districts_delete_button.getAttribute('districts_id');
    $.ajax({
        url: '/admin/system/server.php',
        type: 'POST',
        data: {
            'action' : 'districts_delete',
            'id' : districts_id 
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

    document.getElementById('districts_delete_button').setAttribute('districts_id', item.getAttribute('data-id'));
}

function districts_list_location(){
    location.replace('/admin/districts'); 
}

function add_function(){
    let add_button = document.getElementById('districts_add_button');

    add_button.setAttribute('disabled', true);

    let districts_name    = document.getElementById('districts_name').value;
    let districts_region = document.getElementById('districts_region').value;

    $.ajax({
        url: '/admin/system/server.php',
        type: 'POST',
        data: {
            'action' : 'districts_add',
            'name' : districts_name,
            'region' : districts_region,
        },
        success: function( response ) {
            let data = JSON.parse(response);

            if(data['success'] == false){

                console.log(data['errors']);
                for(let index in data['errors']){
                    //console.log(index);
                    document.getElementById('districts_label_' + index).innerHTML = data['errors'][index];
                }
                add_button.removeAttribute("disabled");
            }else{
                UIkit.notification({message: data['success'], status: 'success'})  
                setTimeout(districts_list_location, 1500); 
            }

            add_button.removeAttribute("disabled");
        },
    });
}

function edit_func(){

    let edit_button = document.getElementById('districts_edit_button');

    edit_button.setAttribute('disabled', true);

    let districts_name    = document.getElementById('districts_name').value;
    let districts_id      = edit_button.getAttribute('districts_id');
    let districts_region  = document.getElementById('districts_region').value;
    
    $.ajax({
        url: '/admin/system/server.php',
        type: 'POST',
        data: {
            'action' : 'districts_edit',
            'name' : districts_name,
            'id' : districts_id,
            'region' : districts_region
        },
        success: function( response ) {
            let data = JSON.parse(response);

            if(data['success'] == false){

                for(let index in data['errors']){
                    document.getElementById('districts_label_' + index).innerHTML = data['errors'][index];
                }
                edit_button.removeAttribute("disabled");
            }else{
                UIkit.notification({message: data['success'], status: 'success'})  
                setTimeout(districts_list_location, 1500); 
            }

            edit_button.removeAttribute("disabled");
        },
    }); 

}