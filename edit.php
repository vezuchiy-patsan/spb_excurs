<?php 
header("Content-Type: text/html; charset=UTF-8");
session_start();
$url = "http://p90527sx.beget.tech/";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('error_reporting', E_ALL);

if (isset($_POST['SubmitEd'])) {
    if(isset($_POST['NameEd'])){
        $NameEd = $_POST['NameEd'];
        
    }else{
        echo "NameEd пусто";
    };
    if(isset($_POST['SurnameEd'])){
        $SurnameEd = $_POST['SurnameEd'];
    }else{
        echo "SurnameEd пусто";
    };
    
    if(isset($_POST['loginEd'])){
        $loginEd = $_POST['loginEd'];
    }else{
        echo "loginEd пусто";
    };
    
    if(isset($_POST['passEd'])){
        $passEd = $_POST['passEd'];
    }else{
        echo "passEd пусто";
    };

    $NameEd = stripslashes($NameEd);
    $NameEd = htmlspecialchars($NameEd);

    $SurnameEd = stripslashes($SurnameEd);
    $SurnameEd =htmlspecialchars($SurnameEd);

    $loginEd  = stripslashes($loginEd );
    $loginEd  = htmlspecialchars($loginEd );

    $passEd = stripslashes($passEd);
    $passEd = htmlspecialchars($passEd);

    $loginEd = trim($loginEd);
    $passEd = trim($passEd);
    
    require("connect.php");

    if ($conn === false) {
        $_SESSION['result_Ed'] = "<p>Ошибка: </p>" . mysqli_connect_error();
        die();
        }else{ 
        /* echo "<p>Подключение успешно установлено</p>"; */
    };
    $id_ed = $_SESSION['id'];
    $sqlID_ed = "SELECT * FROM log_Account WHERE id='$id_ed'";
    $sqlID_ed2 = "SELECT * FROM account WHERE id='$id_ed'";

    $result_edit = mysqli_query($conn, $sqlID_ed);
    $result_edit2 = mysqli_query($conn, $sqlID_ed2);

    $result_edit = mysqli_fetch_array($result_edit);
    $result_edit2 = mysqli_fetch_array($result_edit2);

    if(!empty($result_edit['id']) and !empty($result_edit2['id'])){
        $sql_up = "UPDATE account SET FirstName='$NameEd', Surname='$SurnameEd' WHERE id = '$id_ed'";
        $sql_up2 = "UPDATE log_Account SET login='$loginEd', pass='$passEd' WHERE id = '$id_ed'";

        
        
        if((mysqli_query($conn, $sql_up)) and (mysqli_query($conn, $sql_up2))){
            $_SESSION['login'] = $loginEd;
            $_SESSION['FirstName'] = $NameEd;
            $_SESSION['Surname'] = $SurnameEd;
            $_SESSION['password'] = $passEd;

            
            
            mysqli_close($conn);
            header("Location:" .$url);
            exit;       
            
        } else{
            echo "<p>Ошибка: </p>" . mysqli_error($conn);
            mysqli_close($conn);
            
            exit;     
        }
        
        
    }
    }
?>