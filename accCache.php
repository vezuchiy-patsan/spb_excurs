<?php


$accountData = "SELECT * FROM account WHERE id='$id'";
$dataResult = mysqli_query($conn, $accountData);
$dataResult = mysqli_fetch_array($dataResult);
/* print_r($dataResult); */

if (empty($dataResult['id']))
{
//если пользователя с введенным логином не существует
exit ("<p>Извините, введённый вами login или пароль неверный.</p>");
}else{
    $accountFirstName = $dataResult['FirstName'];
    $accountSurname = $dataResult['Surname'];
};
?>