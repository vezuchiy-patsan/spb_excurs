// Определяем функции для отображения сообщения об ошибке
function printError(elemId, hintMsg) {
    document.getElementById(elemId).innerHTML = hintMsg;
}
//валидация
(function () {

  
    // Получите все формы, к которым мы хотим применить пользовательские стили проверки Bootstrap
    var forms = document.querySelectorAll('.needs-validation')
    var Password = document.getElementById('password');
    var r_password = document.getElementById('r_password');
    
    // Зацикливайтесь на них и предотвращаем отправку
    Array.prototype.slice.call(forms)
      .forEach(function (form) {
        form.addEventListener('submit', function (event) {
          if (!form.checkValidity() && (Password != r_password)) {
            event.preventDefault()
            event.stopPropagation()
          }
          var check = function (){
            if(Password == r_password) 
                alert('Пароли верны');
            else 
                alert('Пароли неверны');
            }
          
          form.classList.add('was-validated')
        }, false)
      }
    )
    
  })()