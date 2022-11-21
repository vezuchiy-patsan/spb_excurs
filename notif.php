<?php 

require("connect.php");

$id_history = $_SESSION['id'];
//id истории покупок
$history_b = "SELECT id FROM History_buy WHERE accountID='$id_history'";
$sqlNotific = mysqli_query($conn, $history_b);
$sqlNotific = mysqli_fetch_all($sqlNotific);

$notif = 54;
$notif_arr = array();


for($i = 0; $i < count($sqlNotific); $i++){
    $notif = $sqlNotific[$i][0];
    $Notif_id = "SELECT * FROM notifications WHERE id='$notif'";
    $Notification_id = mysqli_query($conn, $Notif_id);
    $Notification_id = mysqli_fetch_all($Notification_id);
    /* print_r($Notification_id);  */ 
    for($j = 0; $j < count($Notification_id); $j++){
        array_push($notif_arr, $Notification_id[$j]);
    }
}

mysqli_close($conn);
?>