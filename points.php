<?php 
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('error_reporting', E_ALL);   */
    require ("connect.php");
    $sqlCoord = "SELECT X, Y FROM Geotag";
    $coords = mysqli_query($conn, $sqlCoord);
    $coords = mysqli_fetch_all($coords);
    $json = json_encode($coords);


    $sqlCoord2 = "SELECT id FROM Geotag";
    $coords2 = mysqli_query($conn, $sqlCoord2);
    $coords2 = mysqli_fetch_all($coords2);


    $sqlExc = "SELECT * FROM Excursion";
    $coordsExc = mysqli_query($conn, $sqlExc);
    $coordsExc = mysqli_fetch_all($coordsExc);

    $sqlExcName = "SELECT id, FirstName, Surname FROM account";
    $coordsName = mysqli_query($conn, $sqlExcName);
    $coordsName = mysqli_fetch_all($coordsName);
    /* print_r($coordsExc); */
    /* print_r($coordsName); */
    $array = array();
    
    /* $exc_URL = array(); */
    $sql_URL = "SELECT Excursion_id, URL FROM Excursion_photos";
    $exc_URLSQL = mysqli_query($conn, $sql_URL);
    $exc_URLSQL = mysqli_fetch_all($exc_URLSQL);
    
    for($i = 0; $i <= count($coords2); $i++){
        /* if($coords2[$i][0]){
            array_push($exc_URL[$i], $coords2[$i][0]);
        } */
        for($j = 0; $j < count($coordsExc); $j++){

            if($coords2[$i][0] == $coordsExc[$j][0]){
               for($k = 0; $k < 2; $k++){
                    array_push($coordsExc[$j], $coords[$i][$k]);
                }
                foreach($coordsName as $key => $value){
                    foreach($value as  $value1){
                       if($value1[0] == $coordsExc[$j][1]){
                            array_push($coordsExc[$j], $coordsName[$key][1], $coordsName[$key][2]);
                        }
                    }
                }
                array_push($array, $coordsExc[$j]);
            } 
        }
    }
/*     for($it = 0; $it <= count($exc_URLSQL); $i++){
        if($coords2[$i][0] == $exc_URLSQL[$it][0]){
            array_push($exc_URL[$i], $exc_URLSQL[$it][1]); 
        }
    } */
    
    //Excursion_photo
    

    
    mysqli_close($conn);
?>