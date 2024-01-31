window.addEventListener("DOMContentLoaded", (event) => {

    let edit_button = document.getElementById('category_edit_button');
    let category_delete_button = document.getElementById('category_delete_button');
    let delete_button = document.querySelectorAll('a[href="#modal_delete_table"]');
    let add_button = document.getElementById('category_add_button');

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

    if(category_delete_button)
        category_delete_button.addEventListener("click", delete_category);
    
});

function delete_category() {
    let category_delete_button = document.getElementById('category_delete_button');
    let category_id = category_delete_button.getAttribute('category_id');
    $.ajax({
        url: 'system/server.php',
        type: 'POST',
        data: {
            'action' : 'category_delete',
            'id' : category_id 
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

    document.getElementById('category_delete_button').setAttribute('category_id', item.getAttribute('data-id'));
}

function add_function(){
    let add_button = document.getElementById('category_add_button');

    add_button.setAttribute('disabled', true);

    let category_name    = document.getElementById('category_name').value;

    $.ajax({
        url: 'system/server.php',
        type: 'POST',
        data: {
            'action' : 'category_add',
            'name' : category_name,
        },
        success: function( response ) {
            let data = JSON.parse(response);

            if(data['success'] == false){

                console.log(data['errors']);
                for(let index in data['errors']){
                    //console.log(index);
                    document.getElementById('category_label_' + index).innerHTML = data['errors'][index];
                }
                add_button.removeAttribute("disabled");
            }else{
                UIkit.notification({message: data['success'], status: 'success'})  
            }

            add_button.removeAttribute("disabled");
        },
    });
}

function edit_func(){

    let edit_button = document.getElementById('category_edit_button');

    edit_button.setAttribute('disabled', true);

    let category_name    = document.getElementById('category_name').value;
    let category_id      = edit_button.getAttribute('category_id');
    
    $.ajax({
        url: 'system/server.php',
        type: 'POST',
        data: {
            'action' : 'category_edit',
            'name' : category_name,
            'id' : category_id 
        },
        success: function( response ) {
            let data = JSON.parse(response);

            if(data['success'] == false){

                for(let index in data['errors']){
                    document.getElementById('category_label_' + index).innerHTML = data['errors'][index];
                }
                edit_button.removeAttribute("disabled");
            }else{
                UIkit.notification({message: data['success'], status: 'success'})  
            }

            edit_button.removeAttribute("disabled");
        },
    }); 

}