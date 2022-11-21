<?php
session_start();
header("Content-Type: text/html; charset=UTF-8");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('error_reporting', E_ALL);

if (isset($_POST['submitExc'])) 
{ 
    if(isset($_POST['Name'])){
        $Name = $_POST['Name'];
        
    }else{
        echo "Имя пусто";
    };
    if(isset($_POST['Discription'])){
        $Discription = $_POST['Discription'];
    }else{
        echo "Discription пусто";
    };
    
    if(isset($_POST['Price'])){
        $Price = $_POST['Price'];
    }else{
        echo "Price пусто";
    };
    
    if(isset($_POST['Email'])){
        $Email = $_POST['Email'];
    }else{
        echo "Email пусто";
    };
    
    if(isset($_POST['Phone'])){
        $Phone = $_POST['Phone'];
    }else{
        echo "Phone пусто";
    };
    
    if(isset($_POST['date'])){
        $date = $_POST['date'];
    }else{
        echo "date пусто";
    };
    if(isset($_POST['XY'])){
        $XY = explode("," ,$_POST['XY']);
        
    }
    
    $Name = stripslashes($Name);
    $Name = htmlspecialchars($Name);

    $Discription = stripslashes($Discription);
    $Discription =htmlspecialchars($Discription);

    $Price = stripslashes($Price);
    $Price = htmlspecialchars($Price);

    $Email = stripslashes($Email);
    $Email = htmlspecialchars($Email);

    $Phone = stripslashes($Phone);
    $Phone = htmlspecialchars($Phone);

    /* $Phone = stripslashes($Phone);
    $Phone = htmlspecialchars($Phone); */

    $date = stripslashes($date);
    $date = htmlspecialchars($date);

    require("connect.php");

    if ($conn === false) {
        $_SESSION['result_newExc'] = "<p>Ошибка: </p>" . mysqli_connect_error();
        die();
        }else{ 
        /* echo "<p>Подключение успешно установлено</p>"; */
    };

    $id_acc = $_SESSION['id'];
    $sqlID_acc = "SELECT id FROM Excursion ORDER BY id DESC";
    $sqlExc_new = "INSERT INTO Excursion (accountID, Name, Discription, Price, email, Phone, Time) VALUES ('$id_acc','$Name','$Discription','$Price','$Email','$Phone','$date')";
   
    require ('image.php');
     


    if((mysqli_query($conn, $sqlExc_new))){
        $id_result = mysqli_query($conn, $sqlID_acc); 
        $id_result = mysqli_fetch_array($id_result);
        $sqlXY = "INSERT INTO Geotag (id, X, Y) VALUES ('$id_result[0]','$XY[0]', '$XY[1]')";
      
        if(mysqli_query($conn, $sqlXY)){
 
            $_SESSION['result_newExc']="Ваши данные успешно добавлены";
        
            mysqli_close($conn);
            exit;
        }else{
            mysqli_close($conn);
            exit;
        };
        
        
    } else{
        $_SESSION['result_newExc_Err']="Ошибка: " . mysqli_error($conn);
        $_SESSION['result_newExc']="Ошибка отправки данных";
        
        mysqli_close($conn);
        exit;
    };

};



?>