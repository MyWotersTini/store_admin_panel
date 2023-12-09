window.addEventListener("DOMContentLoaded", (event) => {

    let edit_button = document.getElementById('manufacture_edit_button');
    
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
                    data['errors'].forEach((el, index) => {
                        document.getElementById('manufacture_label_' + index).innerHTML = el;
                    });
                    this.removeAttribute("disabled");
                }else{

                }
            },
        }); 
        // за допомогою ajax відправити дані на сервак для обробки (воно заміню по id в базе даних й повертає результат)
        // Отримуєш результат, бачиш що все гуд, видаєш вспливаюче повідомлення що все гуд (uikit)

    });
    
});