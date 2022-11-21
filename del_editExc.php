<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('error_reporting', E_ALL);
if(isset($_POST['delSub'])){
    if(isset($_POST['id_exc'])){
        $id_exc = $_POST['id_exc'];
    }
    require("connect.php");

    $sqlDelete = "DELETE FROM Excursion WHERE id='$id_exc'";
    $result_delete = mysqli_query($conn, $sqlDelete);
}
if(isset($_POST['editSub'])){
    if(isset($_POST['id_exc'])){
        $id_exc = $_POST['id_exc'];
    }
    if(isset($_POST['edExc_Name'])){
        $edExc_Name = $_POST['edExc_Name'];
    }
    if(isset($_POST['edExcT'])){
        $edExcT = $_POST['edExcT'];
    }
    if(isset($_POST['edExcAddr'])){
        $edExcAddr = $_POST['edExcAddr'];
    }
    if(isset($_POST['edExcPr'])){
        $edExcPr = $_POST['edExcPr'];
    }
    if(isset($_POST['edExcEm'])){
        $edExcEm = $_POST['edExcEm'];
    }
    if(isset($_POST['edExcPh'])){
        $edExcPh = $_POST['edExcPh'];
    }
    if(isset($_POST['edExc_date'])){
        $edExc_date = $_POST['edExc_date'];
    }
    
    $id_exc = stripslashes($id_exc);
    $id_exc = htmlspecialchars($id_exc);

    $edExc_Name = stripslashes($edExc_Name);
    $edExc_Name = htmlspecialchars($edExc_Name);

    $edExcT = stripslashes($edExcT);
    $edExcT = htmlspecialchars($edExcT);

    $edExcAddr = stripslashes($edExcAddr);
    $edExcAddr = htmlspecialchars($edExcAddr);

    $edExcPr = stripslashes($edExcPr);
    $edExcPr = htmlspecialchars($edExcPr);

    $edExcEm = stripslashes($edExcEm);
    $edExcEm = htmlspecialchars($edExcEm);

    $edExcPh = stripslashes($edExcPh);
    $edExcPh = htmlspecialchars($edExcPh);

    $edExc_date = stripslashes($edExc_date);
    $edExc_date = htmlspecialchars($edExc_date);

    require("connect.php");

    $sql_EDexcursion = "UPDATE Excursion SET Name='$edExc_Name', Discription='$edExcT', Price='$edExcPr', email='$edExcEm', Phone='$edExcPh', Time='$edExc_date' WHERE id = '$id_exc'";
    $edit_exc_res = mysqli_query($conn, $sql_EDexcursion);

    mysqli_close($conn);

}

?>