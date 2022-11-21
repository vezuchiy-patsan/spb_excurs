<?php 
if($_SESSION['type'] == 0){
    $user_id = $_SESSION['id'];
    require('connect.php');
    $history_sql = "SELECT ExcursionID, count, status, date FROM History_buy WHERE accountID='$user_id'";
    $history_buy = mysqli_query($conn, $history_sql);
    $history_buy = mysqli_fetch_all($history_buy);

    $history_excursion_arr = array();
    $array_for_history = array();
    $array_with_coordiantes = array();
    for($i = 0; $i < count($history_buy); $i++){
        $excursion_id = $history_buy[$i][0];
        $history_excursion_sql = "SELECT id, accountID, Name, Price, Phone FROM Excursion WHERE id='$excursion_id'";
        $history_excursion_query = mysqli_query($conn, $history_excursion_sql);
        $history_excursion_query = mysqli_fetch_all($history_excursion_query);
        for($j = 0; $j < count($history_excursion_query); $j++){
            array_push($history_excursion_arr, $history_excursion_query[$j]);
        }
        for($q = 0; $q < count($array); $q++){
            
            if($array[$q][0] == $history_excursion_query[0][0]){
              array_push($array_for_history, [$array[$q][0], $array[$q][2],$array[$q][4], $array[$q][6], $array[$q][10], $array[$q][11]]);
              array_push($array_with_coordiantes, [$array[$q][8], $array[$q][9]]);
            }else{
                /* print_r($array);
                break; */
            }
        }
    }
    $array_with_coordiantes = json_encode($array_with_coordiantes);
    mysqli_close($conn);
}else if($_SESSION['type'] == 1){
    $user_id = $_SESSION['id'];
    require('connect.php');

    $excursion_history = array();
    $excursion_order = array();
    $excursion_coord = array();
    $id_users = 0;
    for($i = 0; $i <= count($array); $i++){
        if($array[$i][1] == $user_id){
            array_push($excursion_history, $array[$i]);
            $id_excursion_arr = $array[$i][0];
            $list_order_sql = "SELECT * FROM History_buy WHERE ExcursionID='$id_excursion_arr'";
            $list_order_query = mysqli_query($conn, $list_order_sql);
            $list_order_query = mysqli_fetch_all($list_order_query);
            
            
            
            if(isset($list_order_query[0])){
                foreach($list_order_query as $k => $value){
                    $arr_coord = array();
                   
                    $list_user_sql = "SELECT FirstName, Surname FROM account WHERE id='$value[1]'";
                    $list_user_query = mysqli_query($conn, $list_user_sql);
                    $list_user_query = mysqli_fetch_all($list_user_query);
                    foreach($list_user_query as  $value1){
                        foreach($value1 as $name)
                        array_push($value, $name);
                    }
                    /* if($k == 2){
                        if(in_array($value, $excursion_history[0])){
                            array_push($arr_coord, $excursion_history[8], $excursion_history[9]);
                            array_push($excursion_coord, $arr_coord);
                        }
                        
                    } */
                    
                    foreach($excursion_history as $val_coor){
                        $arr_coord = array();

                        if($val_coor[0] == $list_order_query[0][2]){

                            array_push($arr_coord, $val_coor[8], $val_coor[9]);
                            array_push($value, $val_coor[4]);

                        }
                        if(isset($arr_coord[0])){
                            array_push($excursion_coord, $arr_coord);
                        }
                    } 
                    foreach($value as $key => $id){
                        
                        if($key == 2){
                            foreach($excursion_history as $name){
                                if(in_array($id, $name)){
                                    
                                    array_push($value, $name[2]);
                                }
                            }
                        }
                      
                    }
                    
                    array_push($excursion_order, $value);
                }
            }
        }
    }
    $exc_list = json_encode($excursion_history);
/*     print("<br>");
    print("Список экскурсий аккаунта<br>");
    print_r($excursion_history);
    print("<br>Список покупок <br>");
    print_r($excursion_order);
    echo "<br>";
    print_r($excursion_coord); */
    $excursion_coord = json_encode($excursion_coord);
}
?>