window.addEventListener("DOMContentLoaded", (event) => {

    let edit_button = document.getElementById('regions_edit_button');
    let category_delete_button = document.getElementById('category_delete_button');
    let delete_button = document.querySelectorAll('a[href="#modal_delete_table"]');
    let add_button = document.getElementById('regions_add_button');

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

// function delete_category() {
//     let category_delete_button = document.getElementById('category_delete_button');
//     let category_id = category_delete_button.getAttribute('category_id');
//     $.ajax({
//         url: '/system/server.php',
//         type: 'POST',
//         data: {
//             'action' : 'category_delete',
//             'id' : category_id 
//         },
//         success: function( response ) {

//             location.reload();
//         }
//     }); 
// }

// function open_delete_modal(item){
//     UIkit.modal('#modal_delete_table').show();

//     document.querySelector('#modal_delete_table .uk-modal-title span').innerHTML = 
//     item.getAttribute('data-name');

//     document.getElementById('category_delete_button').setAttribute('category_id', item.getAttribute('data-id'));
// }

function regions_list_location(){
    location.replace('/regions'); 
}

function add_function(){
    let add_button = document.getElementById('regions_add_button');

    add_button.setAttribute('disabled', true);

    let regions_name    = document.getElementById('regions_name').value;

    $.ajax({
        url: '/system/server.php',
        type: 'POST',
        data: {
            'action' : 'regions_add',
            'name' : regions_name,
        },
        success: function( response ) {
            let data = JSON.parse(response);

            if(data['success'] == false){

                console.log(data['errors']);
                for(let index in data['errors']){
                    //console.log(index);
                    document.getElementById('regions_label_' + index).innerHTML = data['errors'][index];
                }
                add_button.removeAttribute("disabled");
            }else{
                UIkit.notification({message: data['success'], status: 'success'})
                // location.replace('/category'); 
                setTimeout(regions_list_location, 1500); 
            }
        },
    });
}

function edit_func(){

    let edit_button = document.getElementById('regions_edit_button');

    edit_button.setAttribute('disabled', true);

    let regions_name    = document.getElementById('regions_name').value;
    let regions_id      = edit_button.getAttribute('regions_id');
    
    $.ajax({
        url: '/system/server.php',
        type: 'POST',
        data: {
            'action' : 'regions_edit',
            'name' : regions_name,
            'id' : regions_id 
        },
        success: function( response ) {
            let data = JSON.parse(response);

            if(data['success'] == false){

                for(let index in data['errors']){
                    document.getElementById('regions_label_' + index).innerHTML = data['errors'][index];
                }
                edit_button.removeAttribute("disabled");
            }else{
                UIkit.notification({message: data['success'], status: 'success'})  
                setTimeout(regions_list_location, 1500); 
            }

            edit_button.removeAttribute("disabled");
        },
    }); 

}