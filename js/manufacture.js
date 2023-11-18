window.addEventListener("DOMContentLoaded", (event) => {

    let edit_button = document.getElementById('manufacture_edit_button');
    
    edit_button.addEventListener("click", function(){

        this.setAttribute('disabled', true);

        let manufacture_name    = document.getElementById('manufacture_name').value;
        let manufacture_country = document.getElementById('manufacture_country').value;
        let manufacture_id      = this.getAttribute('manufacture_id');

        if(!(manufacture_name && manufacture_name.length > 2 && manufacture_name.length < 100 )){
            UIkit.notification({message: 'Кiлькiсть символiв назви має сягати вiд 2 до 100 символів', status: 'danger'});
            this.removeAttribute("disabled");;
        }

        if(!(manufacture_name && manufacture_name.length > 2 && manufacture_name.length < 100 )){
            
        }

        // перевірити ці значення (не пусті й не перевищували ліміт символів-1 в базі даних) 
        // Якщо значення погані то підсвітлюєш те поле червоним, виводиш поруч помилку та дизейбле фолсе для кнопки

        // за допомогою ajax відправити дані на сервак для обробки (воно заміню по id в базе даних й повертає результат)

        // Отримуєш результат, бачиш що все гуд, видаєш вспливаюче повідомлення що все гуд (uikit)

    });
    
});