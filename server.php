<?php

header("Refresh: 6; url=http://p90527sx.beget.tech/");
header("Content-Type: text/html; charset=UTF-8");
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('error_reporting', E_ALL); */

//заносим введенный пользователем имя в переменную $FirstName, если он пустой, то уничтожаем 
if (isset($_POST['FirstName'])) 
{ $FirstName = $_POST['FirstName']; 
    
    if ($FirstName == '') { 
        
        unset($FirstName);
    } else{
        
    }
} 

//заносим введенный пользователем фамилию в переменную $SurName, если он пустой, то уничтожаем 
if (isset($_POST['FirstName1'])) 
{ 
    $Surname = $_POST['FirstName1']; 
    
    if ($Surname == '') { 
        
        unset($Surname);
    } else{
        
    }
} else{echo "пусто";};

//заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем 
if (isset($_POST['login'])) 
{ $login = $_POST['login']; 
    
    if ($login == '') { 
        
        unset($login);
    } else{
        
    }
} 

//заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем 
if (isset($_POST['password'])) { 
    $password=$_POST['password'];
    if ($password =='') { 
    
        unset($password);
    } 
}
if (isset($_POST['inlineRadioOptions'])) {
    $Radio = $_POST['inlineRadioOptions'];
}

    
  
    
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Регистрация</title>
</head>
<body>
    <div class="container">
    <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Регистрация</h5>
      </div>
      <div class="modal-body">
<?php

if (empty($login) or empty($password)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем
{
    exit ('<p>Вы не ввели ни логин ни пароль</p>');//не ввел логин или пароль
}
//если логин и пароль введены, то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
$login = stripslashes($login);
$login = htmlspecialchars($login);

$FirstName = stripslashes($FirstName);
$FirstName =htmlspecialchars($FirstName);

$SurName = stripslashes($Surname);
$SurName = htmlspecialchars($Surname);

$password = stripslashes($password);
$password = htmlspecialchars($password);
//удаляем лишние пробелы

$login = trim($login);
$password = trim($password);

//подключение бд
require("connect.php");
require("idFunction.php");
if ($conn === false) {
    die("<p>Ошибка: </p>" . mysqli_connect_error());
    }else{ 
    /* echo "<p>Подключение успешно установлено</p>"; */
};
//проверим нет ли такого же пользователя

$test_data = mysqli_query($conn, "SELECT id FROM log_Account WHERE login='$login'");

$result = mysqli_fetch_array($test_data);
if(!empty($result['id'])){
    
    echo("<p>Извините, введённый вами логин уже зарегистрирован. Введите другой логин.</p>");
    echo('<p class="h4 mb-3 text-md-center">Вы будете перенаправлены через 5 секунды...</p>');
    exit();
};

//сохраняем новые данные
$sql = "INSERT INTO log_Account (login, pass) VALUES ('$login','$password')";
$sql1 = "INSERT INTO account (FirstName, SurName, type) VALUES ('$FirstName','$Surname', '$Radio')";

if((mysqli_query($conn, $sql1)) and (mysqli_query($conn, $sql))){
 
    echo "<p>$FirstName ваши данные успешно добавлены</p>";
    
    mysqli_close($conn);
    
} else{
    echo "<p>Ошибка: </p>" . mysqli_error($conn);
    mysqli_close($conn);
}

?>


        <p class="h4 mb-3 text-md-center">Вы будете перенаправлены через 5 секунды...</p>
      </div>
    </div>
  </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>