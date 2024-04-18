window.addEventListener("DOMContentLoaded", (event) => {
   

    let login_button = document.getElementById('login-button');
    let logout_button = document.getElementById('logout');
    let login_input = document.querySelector("#login-line input");
    let pass_input  = document.querySelector("#pass-line input");

if (login_button) {
    login_button.addEventListener("click", function(){
    
        // console.log(login_input);
        // console.log(pass_input);

        let is_error = false;


        if(!login_input.value){
            let error_div = document.getElementById('login_error');
            error_div.removeAttribute("hidden"); 
            error_div.innerHTML = 'Не заповненно поле логiну!';
            is_error = true;
        }else{
            let error_div = document.getElementById('login_error');
            error_div.setAttribute("hidden","hidden"); 
        }

        if(!pass_input.value){
            let error_div = document.getElementById('pass_error');
            error_div.removeAttribute("hidden"); 
            error_div.innerHTML = 'Не заповненно поле паролю!';
            is_error = true;
        }else{
            let error_div = document.getElementById('pass_error');
            error_div.setAttribute("hidden","hidden"); 
        }

        if (is_error)
            return;

        $.ajax({
            url: 'system/server.php',
            type: 'POST',
            data: {
                'action' : 'review_access',
                'login' : login_input.value,
                'pass' : pass_input.value
            },
            success: function( data1 ) {
                let decode = JSON.parse(data1);
                // console.log(decode);
                if (decode['status'] == 'success') {
                    UIkit.notification({message: 'Success message…', status: 'success'})
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                }else{
                    UIkit.notification({message: decode['massage'], status: 'danger'})
                }
            },
        }); 
        

            // var action = 'review_access';
            // switch (action) {
            //     case 'review_access':
            //         document.write('QQ')
            //         break;

            //     default:

            // }
    });
}

if(logout_button){
    logout_button.addEventListener("click", function(){
        $.ajax({
            url: 'system/server.php',
            type: 'POST',
            data: {
                'action' : 'session_unset',               
            },
            success: function( data ) {
                // console.log(data);
                location.reload();
                
            }
        });
    });
}



});