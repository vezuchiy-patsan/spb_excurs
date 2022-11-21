<?php 
/*   ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  ini_set('error_reporting', E_ALL); */
/*header("Content-Type: text/html; charset=UTF-8"); */
session_start();
require ("points.php");
require("notif.php");
require("history.php");
/* header('Location: pdf.php'); */

$eURL = json_encode($exc_URLSQL);
$Earray = json_encode($array);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    if(isset($_POST['submitExc']) || isset($_POST['SubmitOrder'])){
      ?>
      <script type="text/javascript">
        location.replace("validateMain.php");
      </script>
      <noscript>
      <meta http-equiv="refresh" content="0; url=validateMain.php">
      </noscript>
    <?php
    }
    
    ?>
    <script type="text/javascript"> let coordsPHP = JSON.parse('<?php echo $json; ?>'); 
      let excursMass = JSON.parse('<?php echo $Earray ?>');
      let historyMass = JSON.parse('<?php echo $array_with_coordiantes ?>');
      let photo  = JSON.parse('<?php echo $eURL ?>')
    </script>
    <script src="https://api-maps.yandex.ru/2.1/?apikey=9a3a56a6-f665-417b-87b2-b0df644b6e8c&lang=ru_RU&mode=debug" type="text/javascript">
    </script>
    <script type="text/javascript"> let coordsPHP = JSON.parse('<?php echo $json; ?>'); </script>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
    <link href="./css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./css/media.css">
    <link rel="stylesheet" type="text/css" href="./cal/daterangepicker-master/daterangepicker.css" />
    <title>Клиент-зашёл</title>
</head>
<body>
    <div class="mainSide">
        <nav>
            <div class="head">
                <div class="nav_buttons invisible">
                    <div class="log_in">
                        <!-- <div class="border"></div> -->
                        <button  class="btn btn-light btn-lg" data-bs-toggle="modal" data-bs-target="#log_inModal">Вход</button>
                        
                        <div class="modal fade" id="log_inModal" tabindex="-1" aria-labelledby="log_inModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header ">
                                  <h5 class="modal-title" id="titleModalLabel">Вход</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                                        <label for="floatingInput">Email</label>
                                      </div>
                                      <div class="form-floating">
                                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                                        <label for="floatingPassword">Пароль</label>
                                      </div>
                                </div>
                                <div class="modal-footer" id="buttonIn">
                                    <form action="" target="">
                                        <button type="button" class="btn btn-primary butIn">Войти</button> 
                                    </form>                      
                                </div>
                              </div>
                            </div>
                          </div>
                    </div>
                    <div class="reg">
                      <a  class="btn btn-light btn-lg" href="#" role="button">Регистрация</a>
                    </div>         
                </div>
                <button type="button" class="btn btn-link" id="notificate" data-bs-toggle="modal" data-bs-target="#notificateModal"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
                  <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z"/>
                </svg>
                </button>
                <div class="account_side">
                  <div>
                    <button class="btn btn-light accountButton" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_accountSide" aria-expanded="false" aria-controls="collapse_accountSide">
                          <div class="d-flex justify-content-between">
                          <p class="me-3"></p>
                          <p class="m-0"><?php 
                          $name = $_SESSION['FirstName']." ".$_SESSION['Surname'];
                          echo $name ?></p>
                            <div class="arrow-8"></div>
                          </div>
                        </button>
                      </div>
                      <div class="collapse" id="collapse_accountSide">
                        <div class="card card-body mt-3" >
                            <div class="btn-group-vertical" id="buttonGroup" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-outline-dark mb-2" data-bs-toggle="modal" data-bs-target="#data_accModal">Редактировать данные</button>
                                <button type="button" class="btn btn-outline-dark mb-5" data-bs-toggle="modal" data-bs-target="#excursionModal" id="history_list">История покупок</button>
                                <a role="button" class="btn btn-outline-dark" href="close.php" name="exit">Выйти</a>
                              </div>
                        </div>
                      </div>
                </div>
                <div  class="excursion_text"><p class="heading">Экскурсии по крышам Санкт-Петербурга</p></div>
              </div>           
            <!-- Modal -->
            <div class="modal fade" id="notificateModal" tabindex="-1" aria-labelledby="notificateModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="notificateModalLabel">Уведомления</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                  <div class="container">
                      <div class="row">
                        <?php 
                        if(isset($notif_arr[0])){
                          for($i = 0 ; $i < count($notif_arr); $i++){
                          ?>
                            <div class="col-7">
                            <?php
                            $arr_n = $notif_arr[$i][1];
                            echo "<p>Заказ экскурсии: $arr_n</p>";
                            ?>
                            </div>
                            <div class="col-5">
                          <?php
                            $arr_d = $notif_arr[$i][2];
                            echo "<p class='text-end'>$arr_d</p>";
                          ?>
                            </div>
                            <div class="line"></div>
                          <?php
                            }
                          }else{
                            echo "<p class='text-center'>Уведомлений нет.</p>";
                          }
                        ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </nav>
        <div class="modal fade" id="excursionModal" tabindex="-1" aria-labelledby="excursionModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-xl">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="excursionModalLabel">История покупок</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body table-responsive">
                  <?php 
                    if(isset($history_excursion_arr[0])){
                      ?>
                        <table class="table table-striped table-hover">
                        <thead class="table-dark">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Название</th>
                            <th scope="col">Адрес</th>
                            <th scope="col">Кол-во билетов</th>
                            <th scope="col">Цена (рублей)</th>
                            <th scope="col">Экскурсовод</th>
                            <th scope="col">Номер экскурсовода</th>
                            <th scope="col">Дата</th>
                            <th scope="col">Статус</th>
                            
                            
                          </tr>
                        </thead>
                        <tbody>
                          
                          <?php
                            for($i=0; $i < count($array_for_history); $i++){
                              $c = $i + 1;
                              echo "<tr>";
                              echo "<th scope='row'>$c</th>";
                              ?>
                              <td><?php echo ($array_for_history[$i][1]) ?></td>
                              <td id="<?= 'Addres'.$c ?>"></td>
                              <td><?=  $history_buy[$i][1]?></td>
                              <td><?= $history_excursion_arr[$i][3]*$history_buy[$i][1]?></td>
                              <td><?= $array_for_history[$i][4]." ".$array_for_history[$i][5]?></td>
                              <td><?= $array_for_history[$i][3]?></td>
                              <td><?= $history_buy[$i][3] ?>  </td>
                              <td><?php if($history_buy[$i][2] == 0){echo "Бронирование";}else{echo "Онлайн";};?></td>
                              
                            </tr>
                              <?php
                            }  

                          ?>
                      </tbody>
                    </table>
                      <?php
                    }else {
                      echo "<p class='text-center'>Нет заказов.</p>";
                    }
                  ?>
                    
                </div>
              </div>
            </div>
          </div>
          <div class="data_account">
            <div class="modal fade" id="data_accModal" tabindex="-1" aria-labelledby="data_accModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <form action="edit.php" method="POST">
                    <div class="modal-header ">
                      <h5 class="modal-title" id="data_accModalLabel">Редактировать</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Иван" value="<?php echo $_SESSION['FirstName'] ?>" name="NameEd">
                            <label for="floatingInput">Имя</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Иванович" value="<?php echo $_SESSION['Surname'] ?>" name="SurnameEd">
                            <label for="floatingInput">Фамилия</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" value="<?php echo $_SESSION['login'] ?>" name="loginEd">
                            <label for="floatingInput">Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingPassword" placeholder="Password" value="<?php echo $_SESSION['password'] ?>" name="passEd">
                            <label for="floatingPassword">Пароль</label>
                        </div>
                    </div>
                    <div class="modal-footer" id="buttonReg">            
                      <button type="submit" class="btn btn-primary btn-block butReg" data-bs-dismiss="modal" aria-label="Close" name="SubmitEd">Сохранить</button>                                           
                    </div>
                    </form>
                  </div>
                </div>
            </div>
          </div>
          <div class="map">
            <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                  <div class="modal-content">
                  <form action="validateMain.php" method="POST">
                    <div class="modal-header">
                      <h5 class="modal-title" id="orderModalLabel">Заказ</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body">
                          <input type="text" style="display:none;" id="idGeotag" name="idGeotag"/>
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" name="NameOrder"  placeholder="Иван" />
                            <label for="floatingInput">Имя</label>
                          </div>
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" name="SurNameOrder" placeholder="Иванович"  />
                            <label for="floatingInput">Фамилия</label>
                          </div>
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" name="TwoNameOrder" placeholder="Иванович"  />
                            <label for="floatingInput">Отчество</label>
                          </div>
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput"  name="CountOrder" placeholder="Количество" />
                            <label for="floatingInput">Количество</label>
                          </div>
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput"  name="PhoneOrder" placeholder="Номер" />
                            <label for="floatingInput">Номер телефона</label>
                          </div>
                          <div class="form-floating">
                            <input type="text" class="form-control" id="floatingInput"  name="datetimes" placeholder="" />
                            <label for="floatingInput">Дата</label>
                          </div>
                          <!-- <select class="form-select" aria-label="Default select example">
                            <option selected>Даты</option>
                            <option value="1">Дата 1</option>
                            <option value="2">Дата 2</option>
                            <option value="3">Дата 3</option>
                          </select> -->
                          <div class="mt-5 d-flex justify-content-center">
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="flexRadioCashlessOrder" id="flexRadioCahsOrder1" checked  disabled >
                              <label class="form-check-label" for="flexRadioCahsOrder1">
                                Наличные
                              </label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="flexRadioCashlessOrder" id="flexRadioCashOrder2"  disabled >
                              <label class="form-check-label" for="flexRadioCashOrder2">
                                Безналичные
                              </label>
                            </div>
                          </div>
                         
                        </div>
                      </div>
                    <div class="modal-footer"  id="buttonOrder">
                      <button type="submit" class="btn btn-primary" name="SubmitOrder" onclick="window.open('http://p90527sx.beget.tech/pdf.php', '_blank');">Заказать</button>
                    </div>
                  </form>
                  </div>
                </div>
            </div>
            <div class="map_api" id="mapApi1" width="1384" height="836" alt="Map"></div>
          </div>
        <?php require('sidePanel.php')?>
        <div class="why_we">
            <div class="line"></div>
            <div class="container button_forOrder">
              
              <button class="btn btn-primary" style="display: none;" id="offcanvasSidep_btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidepanel" aria-controls="offcanvasSidepanel">
              </button>
            </div>
        </div>
       
        <footer>
            <div class="footer">
                <div class="data_footer">
                    <div class="item"></div>
                    <div class="name_author item"><p>@Ахиян Д.Г.</p></div>
                    <div class="email item"><p>roofSPB@mail.ru</p></div>
                </div>
            </div>
        </footer>
      <script src="../index.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
      <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
      <script type="text/javascript" src="./cal/daterangepicker-master/moment.min.js"></script>
      <script type="text/javascript" src="./cal/daterangepicker-master/daterangepicker.js"></script>
      <script>
        $(function() {
          $('input[name="datetimes"]').daterangepicker({
            "singleDatePicker": true,
            timePicker: true,
            "timePicker24Hour": true,
            startDate: moment().startOf('hour'),
            /* endDate: moment().startOf('hour').add(3 , "day"), */
            "drops": "up",
            locale: {
              format: 'M/DD/YYYY hh:mm A'
            }
            
          }, function(start, end, label) {
          console.log('New date range selected: ' + start.format('YYYY-MM-DD hh:mm A') + ' to ' + end.format('YYYY-MM-DD hh:mm A') + ' (predefined range: ' + label + ')');
        } );
        });
      </script>
    
  </body>
</html>

<?php 
  if(isset($_POST['SubmitOrder'])){
    if(isset($_POST['NameOrder'])){
      $NameOrder = $_POST['NameOrder'];
      $_SESSION['name'] = $NameOrder;
      echo $NameOrder;
    }else{
      echo "Имя пусто";
    };
    if(isset($_POST['SurNameOrder'])){
      $SurNameOrder = $_POST['SurNameOrder'];
      $_SESSION['surname'] = $SurNameOrder;
    }else{
      echo "SurNameOrder пусто";
    };
    
    if(isset($_POST['TwoNameOrder'])){
      $TwoNameOrder = $_POST['TwoNameOrder'];
      $_SESSION['TwoNameOrder'] = $TwoNameOrder;
    }else{
      echo "2NameOrder пусто";
    };
    
    if(isset($_POST['CountOrder'])){
      $CountOrder = $_POST['CountOrder'];
      $_SESSION['CountOrder'] = $CountOrder;
    }else{
      echo "CountOrder пусто";
    };
    
    if(isset($_POST['PhoneOrder'])){
      $PhoneOrder = $_POST['PhoneOrder'];
    }else{
      echo "PhoneOrder пусто";
    };
    
    if(isset($_POST['datetimes'])){
      $date = $_POST['datetimes'];
      $_SESSION['date'] = $date;
    }else{
      echo "date пусто";
    };
    if(isset($_POST['idGeotag'])){
      $idGeotag = $_POST['idGeotag'];
      $_SESSION['idGeotag'] = $idGeotag;
    }else{
      echo "idGeotag пусто";
    };

    
    $NameOrder = stripslashes($NameOrder);
    $NameOrder = htmlspecialchars($NameOrder);

    $SurNameOrder = stripslashes($SurNameOrder);
    $SurNameOrder =htmlspecialchars($SurNameOrder);

    $TwoNameOrder = stripslashes($TwoNameOrder);
    $TwoNameOrder = htmlspecialchars($TwoNameOrder);

    $CountOrder = stripslashes($CountOrder);
    $CountOrder = htmlspecialchars($CountOrder);

    $PhoneOrder = stripslashes($PhoneOrder);
    $PhoneOrder = htmlspecialchars($PhoneOrder);
    $status = 0;
    $dateOrder = date("Y-m-d H:i:s"); 
    
    for($i = 0; $i < count($array); $i++){
      if($idGeotag == $array[$i][0]) $_SESSION['Exc_arr_pdf'] = $array[$i];
    }
    echo($_SESSION['Exc_arr_pdf'][2]);
    /* mail("daniil214888@gmail.com", "Экскурсии по крышам Санкт-Петербурга", "Здравствуйте, вы получили это письмо так как вы заказали экскурсию: "); */
    require('connect.php');
    /* require('pdf.php'); */
 
    if ($conn === false) {
      $_SESSION['result_order'] = "<p>Ошибка: </p>" . mysqli_connect_error();
      die();
      }else{ 
      
    };
    $id_cl = $_SESSION['id'];
    
    
    $sqlOrder = "INSERT INTO History_buy (accountID, ExcursionID, count, status, phone, date) VALUES ('$id_cl','$idGeotag','$CountOrder','$status','$PhoneOrder','$dateOrder')";
    
    
    if(mysqli_query($conn, $sqlOrder)){
      $idORDER = "SELECT id FROM History_buy ORDER BY id DESC LIMIT 1";
      $id_newOrder = mysqli_query($conn, $idORDER);
      $id_newOrder = mysqli_fetch_all($id_newOrder);
      $id_newOrder = $id_newOrder[0][0];
      $NameExc = "SELECT Name FROM Excursion WHERE id='$idGeotag'";
      $Discription = mysqli_query($conn, $NameExc);
      $Discription = mysqli_fetch_all($Discription);
      $Discription = $Discription[0][0];
  
      $sqlNotificate = "INSERT INTO notifications (id, Discription, Time) VALUES ('$id_newOrder','$Discription','$dateOrder')"; 
      
      if(mysqli_query($conn, $sqlNotificate)){
        mysqli_close($conn);
        exit;
        
      }else{
        echo mysqli_error($conn);
        mysqli_close($conn);
        exit;
      }
    }else{
      echo mysqli_error($conn);
      mysqli_close($conn);
      exit;
    }
  }
?>