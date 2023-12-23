window.addEventListener("DOMContentLoaded", (event) => {

    let edit_button = document.getElementById('manufacture_edit_button');
    let delete_button = document.getElementById('a[href="modal_delete_table"]');

    if(delete_button)
        delete_button.forEach
    if(edit_button)
    edit_button.addEventListener("click", function(){

        this.setAttribute('disabled', true);

        let manufacture_name    = document.getElementById('manufacture_name').value;
        let manufacture_country = document.getElementById('manufacture_country').value;
        let manufacture_id      = this.getAttribute('manufacture_id');

        /*if(!(manufacture_name && manufacture_name.length > 2 && manufacture_name.length < 100 )){
            UIkit.notification({message: 'Кiлькiсть символiв назви має сягати вiд 2 до 100 символів', status: 'danger'});
            this.removeAttribute("disabled");

            return;
        }*/
        
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
    });
    
});