window.addEventListener("DOMContentLoaded", (event) => {

    let edit_button = document.getElementById('manufacture_edit_button');
    let manufacture_delete_button = document.getElementById('manufacture_delete_button');
    let delete_button = document.querySelectorAll('a[href="#modal_delete_table"]');

    if(delete_button)
        delete_button.forEach((item) => {
            item.addEventListener("click", function(){
                open_delete_modal(this);
            });
    });

    if(edit_button)
        edit_button.addEventListener("click", edit_func);
    if(manufacture_delete_button)
    manufacture_delete_button.addEventListener("click", delete_manufacture);
    
});

function delete_manufacture() {
    let manufacture_delete_button = document.getElementById('manufacture_delete_button');
    let manufacture_id = manufacture_delete_button.getAttribute('manufacture_id');
    $.ajax({
        url: 'system/server.php',
        type: 'POST',
        data: {
            'action' : 'manufacture_delete',
            'id' : manufacture_id 
        },
        success: function( response ) {
            let data = JSON.parse(response);

        }
    }); 

    console.log(manufacture_id);
}

function open_delete_modal(item){
    UIkit.modal('#modal_delete_table').show();

    document.querySelector('#modal_delete_table .uk-modal-title span').innerHTML = 
    item.getAttribute('data-name') + ' (' + 
    item.getAttribute('data-country') + ')';

    document.getElementById('manufacture_delete_button').setAttribute('manufacture_id', item.getAttribute('data-id'));
}

function edit_func(){

    let edit_button = document.getElementById('manufacture_edit_button');

    edit_button.setAttribute('disabled', true);

    let manufacture_name    = document.getElementById('manufacture_name').value;
    let manufacture_country = document.getElementById('manufacture_country').value;
    let manufacture_id      = edit_button.getAttribute('manufacture_id');
    
    $.ajax({
        url: 'system/server.php',
        type: 'POST',
        data: {
            'action' : 'manufacture_edit',
            'name' : manufacture_name,
            'country' : manufacture_country,
            'id' : manufacture_id 
        },
        success: function( response ) {
            let data = JSON.parse(response);

            if(data['success'] == false){

                console.log(data['errors']);
                for(let index in data['errors']){
                    //console.log(index);
                    document.getElementById('manufacture_label_' + index).innerHTML = data['errors'][index];
                }
                edit_button.removeAttribute("disabled");
            }else{
                UIkit.notification({message: data['success'], status: 'success'})  
            }

            edit_button.removeAttribute("disabled");
        },
    }); 

}