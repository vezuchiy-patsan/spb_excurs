<?php
$pathSQL = "SELECT id FROM Excursion ORDER BY id DESC";
$pathSQL = mysqli_query($conn, $pathSQL);
$pathSQL = mysqli_fetch_array($pathSQL);
$path = $pathSQL['id'];
$pathSTR = "./image/"."$path";
if (!file_exists($pathSTR)) {
    mkdir($pathSTR, 0777);
}

$pathSTR = $pathSTR."/";
/* $p = "image/82/"; */
// Массив допустимых значений типа файла
$types = array('image/png', 'image/jpeg');

echo count($_FILES['image']);
 
// Обработка запроса
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if (!@copy($_FILES['image']['tmp_name'], $pathSTR . $_FILES['image']['name']))
		echo 'Что-то пошло не так';
	else{
		echo 'Загрузка удачна <a href="' . $pathSTR . $_FILES['image']['name'] . '">Посмотреть</a> ' ;
		$URL = $pathSTR . $_FILES['image']['name'];
		$sqlURL = "INSERT INTO Excursion_photos (Excursion_id, URL) VALUES ('$path', '$URL')";
		if(mysqli_query($conn, $sqlURL)){
			echo "Успех URL";
		}else{
			echo mysqli_error($conn);
		}
	}
		 	

	

}
?>