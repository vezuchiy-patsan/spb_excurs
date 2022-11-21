<?php
//id таблицы account
$id_SQL = mysqli_query($conn ,"SELECT MAX(`id`)  FROM account");
$id_SQL1 = mysqli_fetch_array($id_SQL);
if(empty($id_SQL1)){
    $id_SQL1 = array_push($id_SQL1, 1);
}

/* $id_SQL1 = (int)(implode('', $id_SQL1)); */
$id_SQL1 = array_pop($id_SQL1);

