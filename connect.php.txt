<?php
$conn = mysqli_connect("localhost", "p90527sx_1", "danfom2000!");
if ($conn === false) {
  die("Ошибка: " . mysqli_connect_error());
} 
mysqli_select_db($conn,"p90527sx_1")

/* mysqli_close($conn); */
?>