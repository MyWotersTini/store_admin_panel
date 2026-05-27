window.addEventListener("DOMContentLoaded", (event) => {

    let edit_button = document.getElementById('orders_edit_button');
    let orders_delete_button = document.getElementById('orders_delete_button');
    let delete_button = document.querySelectorAll('a[href="#modal_delete_table"]');
    let add_button = document.getElementById('orders_add_button');

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

    if(orders_delete_button)
        orders_delete_button.addEventListener("click", delete_orders);
    
});

function delete_orders() {
    let orders_delete_button = document.getElementById('orders_delete_button');
    let orders_id = orders_delete_button.getAttribute('orders_id');
    $.ajax({
        url: '/admin/system/server.php',
        type: 'POST',
        data: {
            'action' : 'orders_delete',
            'id' : orders_id 
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

    document.getElementById('orders_delete_button').setAttribute('orders_id', item.getAttribute('data-id'));
}

function orders_list_location(){
    location.replace('/admin/orders'); 
}

function add_function(){
    let add_button = document.getElementById('orders_add_button');

    add_button.setAttribute('disabled', true);

    let orders_type   = document.getElementById('orders_type').value;
    let orders_district   = document.getElementById('orders_district').value;
    let orders_name   = document.getElementById('orders_name').value;

    $.ajax({
        url: '/admin/system/server.php',
        type: 'POST',
        data: {
            'action' : 'orders_add',
            'type' : orders_type,
            'district_id' : orders_district,
            'name' : orders_name,
        },
        success: function( response ) {
            let data = JSON.parse(response);

            if(data['success'] == false){

                console.log(data['errors']);
                for(let index in data['errors']){
                    //console.log(index);
                    document.getElementById('orders_label_' + index).innerHTML = data['errors'][index];
                }
                add_button.removeAttribute("disabled");
            }else{
                UIkit.notification({message: data['success'], status: 'success'})
                // location.replace('/orders'); 
                setTimeout(orders_list_location, 1500); 
            }
        },
    });
}

function edit_func(){

    let edit_button = document.getElementById('orders_edit_button');

    edit_button.setAttribute('disabled', true);

    let orders_name    = document.getElementById('orders_name').value;
    let orders_id      = edit_button.getAttribute('orders_id');
    let orders_district    = document.getElementById('orders_district').value;
    
    $.ajax({
        url: '/admin/system/server.php',
        type: 'POST',
        data: {
            'action' : 'orders_edit',
            'name' : orders_name,
            'id' : orders_id,
            'district' : orders_district
        },
        success: function( response ) {
            let data = JSON.parse(response);

            if(data['success'] == false){

                for(let index in data['errors']){
                    document.getElementById('orders_label_' + index).innerHTML = data['errors'][index];
                }
                edit_button.removeAttribute("disabled");
            }else{
                UIkit.notification({message: data['success'], status: 'success'})  
                setTimeout(orders_list_location, 1500); 
            }

            edit_button.removeAttribute("disabled");
        },
    }); 

}