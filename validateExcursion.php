<?php 
header("Content-Type: text/html; charset=UTF-8");
session_start(); 
require ("points.php");
require("history.php");

$eURL = json_encode($exc_URLSQL);
$array = json_encode($array);

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    if(isset($_POST['submitExc'])){
      ?>
      <script type="text/javascript">
        location.replace("validateExcursion.php");
      </script>
      <noscript>
      <meta http-equiv="refresh" content="0; url=validationExcursion.php">
      </noscript>
    <?php
    }
    
    ?>
    <script type="text/javascript"> let coordsPHP = JSON.parse('<?php echo $json; ?>'); 
      let excursMass = JSON.parse('<?php echo $array ?>');
      let historyMass = JSON.parse('<?php echo $excursion_coord ?>');
      var exc_history = JSON.parse('<?php echo $exc_list?>');
      let photo = JSON.parse('<?php echo $eURL?>');
    </script>
    <script src="https://api-maps.yandex.ru/2.1/?apikey=9a3a56a6-f665-417b-87b2-b0df644b6e8c&lang=ru_RU" type="text/javascript">
    </script>
    <link rel="stylesheet" href="daterangepicker/daterangepicker.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
    <link href="./css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./css/media.css">
    <link rel="stylesheet" type="text/css" href="./cal/daterangepicker-master/daterangepicker.css" />
    <title>Экскурсовод-зашёл</title>
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
                <button type="button" class="btn btn-link invisible" id="notificate" data-bs-toggle="modal" data-bs-target="#notificateModal">
                  <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
                  <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z"/>
                  </svg>
                </button>
                <div class="account_side">
                  
                    <div>
                        <button class="btn btn-light accountButton " type="button" data-bs-toggle="collapse" data-bs-target="#collapse_accountSide" aria-expanded="false" aria-controls="collapse_accountSide">
                          <div class="d-flex justify-content-between">
                            <p class="me-1"></p>
                            <p class=""><?php 
                          echo $_SESSION['Surname']." ".$_SESSION['FirstName'] ?></p>
                            <div class="arrow-8"></div>
                          </div>
                        </button>
                        
                      </div>
                      <div class="collapse" id="collapse_accountSide">
                        <div class="card card-body mt-3" >
                            <div class="btn-group-vertical" id="buttonGroup" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-outline-dark mb-2" data-bs-toggle="modal" data-bs-target="#data_accModal">Редактировать данные</button>
                                <button type="button" class="btn btn-outline-dark mb-2" data-bs-toggle="modal" data-bs-target="#exc_newModal">Создать экскурсию</button>
                                <button type="button" class="btn btn-outline-dark mb-2" data-bs-toggle="modal" data-bs-target="#excursionModal" id="history_list">История заказов</button>
                                <button type="button" class="btn btn-outline-dark mb-5" data-bs-toggle="modal" data-bs-target="#editExcursionModal">Экскурсии</button>
                                <a role="button" class="btn btn-outline-dark" href="close.php">Выйти</a>
                              </div>
                        </div>
                      </div>
                </div>
                <div  class="excursion_text"><p class="heading">Экскурсии по крышам Санкт-Петербурга</p></div>
            </div> 
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
                        <div class="col-10">
                          <p>Текст уведомления</p> 
                        </div>
                        <div class="col">
                          <p>Дата</p>
                        </div>
                      </div>
                      <div class="line"></div>
                      <div class="row">
                        <div class="col-10">
                          <p>Текст уведомления</p> 
                        </div>
                        <div class="col">
                          <p>Дата</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>          
        </nav>
        <div class="modal fade" id="excursionModal" tabindex="-1" aria-labelledby="excursionModalLabel" aria-hidden="true">
            <div class="modal-dialog .modal-dialog-scrollable modal-xl">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="excursionModalLabel">История заказов</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body table-responsive">
                <?php 
                    if(isset($excursion_order[0])){
                      ?>
                        <table class="table table-striped table-hover">
                        <thead class="table-dark">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Название</th>
                            <th scope="col">Адрес</th>
                            <th scope="col">Кол-во билетов</th>
                            <th scope="col">Цена (рублей)</th>
                            <th scope="col">Клиент</th>
                            <th scope="col">Номер клиента</th>
                            <th scope="col">Дата</th>
                            <th scope="col">Статус</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                          <?php
                            for($i=0; $i < count($excursion_order); $i++){
                              $c = $i + 1;
                              echo "<tr>";
                              echo "<th scope='row'>$c</th>";
                              ?>
                              <td><?php echo ($excursion_order[$i][10]) ?></td>
                              <td id="<?= 'Addres'.$c ?>"></td>
                              <td><?=  $excursion_order[$i][3]?></td>
                              <td><?= $excursion_order[$i][9]*$excursion_order[$i][3]?></td>
                              <td><?= $excursion_order[$i][7]." ".$excursion_order[$i][8]?></td>
                              <td><?= $excursion_order[$i][5]?></td>
                              <td><?= $excursion_order[$i][6] ?></td>
                              <td><?php if($excursion_order[$i][4] == 0){echo "Бронирование";}else{echo "Онлайн";};?></td>
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
          <div class="modal fade" id="exc_newModal" tabindex="-1" aria-labelledby="excursion_newModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title ms-auto" id="excursion_newModalLabel">Создать экскурсию</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex">
                  <div class="container ">
                  <form method="post" action="" enctype="multipart/form-data" >
                    <div class="row form_forInput">
                      <div class="col">
                        <div class="map_api" id="mapApi_order" alt="Map"></div>
                      </div>
                      <div class="col">
                     
                        <div class="mb-3">
                          <label class="form-label" id="basic-addon1">Название</label>
                          <input type="text" class="form-control" placeholder="Экскурсия..." aria-label="Name" aria-describedby="basic-addon1" name="Name" >
                        </div>
                        <div class="mb-3">
                          <label  class="form-label" id="basic-addon2">Адрес</label>
                          <input type="text" class="form-control" id="validationAddress"  placeholder="Поставьте точку на карте" aria-label="Address" aria-describedby="basic-addon2" >
                          <input type="text" class="form-control" id="validationAddressXY"  placeholder="" style="display: none;" name="XY">
                          <div class="invalid-feedback">
                           Укажите действующий город.
                         </div> 
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Описание</label>
                          <textarea class="form-control" aria-label="With textarea" placeholder="короткое описание" name="Discription"></textarea>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Цена</label>
                          <div class="input-group mb-3">
                            <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" placeholder="в рублях" name="Price">
                            <span class="input-group-text">₽</span>
                          </div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" >Email</label>
                          <input type="email" class="form-control" aria-label="Email" placeholder="email@mail.ru" name="Email"></input>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Телефон</label>
                          <input type="text" class="form-control" aria-label="Phone" placeholder="8**********" name="Phone"></input>
                        </div>
                        <div class='mb-3' id='datetimepicker1'>
                          <label class="form-label">Дата</label>
                          <input type="text" class="form-control" id="dating" name="datetimes" value="01/01/2022 - 01/15/2022" placeholder="Дата">
                          
                        </div>
                        <div class="mb-3" style="display: none;">
                          <label for="floatingInput">Номер счёта (необязательно)</label>
                          <input type="text" class="form-control" id="floatingInput" placeholder="">
                        </div>
                      </div>
                      <div class="input-group pt-5">
                          <input type="file" class="form-control " id="inputGroupFile02" name="image" multiple >
                          <label class="input-group-text " for="inputGroupFile02" >Загрузить</label>
                      </div>
                    </div>
                    <div class="modal-footer d-block p-0 ">
                      <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg" name="submitExc" >Сохранить</button>
                      </div>
                    </div>
                    </form>
                    <!-- <button type="button" class="btn btn-primary" name="submitExc" onclick="alert(document.getElementById('validationAddressXY').value)">Сохранить</button> -->
                  </div>
                </div>
              </div>
            </div>
          </div>       
        <?php 
          if(isset($_SESSION['result_newExc'])){
            ?>
            <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11" data-bs-delay="8000">
              <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                  <!-- <img src="..." class="rounded me-2" alt="..."> -->
                  <strong class="me-auto"><?php echo $_SESSION['FirstName']?></strong>
                  <small>Сейчас</small>
                  <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Закрыть"></button>
                </div>
                <div class="toast-body">
                  <p><?php echo $_SESSION['result_newExc']?></p>
                </div>
              </div>
            </div>
           
        <?php
            unset($_SESSION['result_newExc']);
          }
        ?>
        <div class="data_account">
            <div class="modal fade" id="data_accModal" tabindex="-1" aria-labelledby="data_accModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <form method="post" action="edit.php">
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
        <!-- Modal -->
        <div class="modal fade" id="editExcursionModal" tabindex="-1" aria-labelledby="editExcursionLabel" aria-hidden="true">
          <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="editExcursionLabel">Экскурсии</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="d-grid gap-2 buttonExc" id="">
                  <?php 
                    foreach($excursion_history as $key => $excursion){
                      $number = $excursion[0]; 
                      $id = "Exc".$number;
                      $count = $key + 1;
                      ?>
                      <button class='btn btn-outline-dark' id='<?= $id?>' type='button' data-bs-toggle='modal' data-bs-target='#editExcursData' onClick="">
                      <?php
                      echo "<div class='row' id='$id'>";
                      echo "<div class='col-3' id='$id'><p class='text-start' id='$id'>$count</p></div>"; 
                      echo "<div class='col-6' id='$id'><p class='text-center' id='$id'>$excursion[2]</p></div></div></button>";
                    }
                  ?>
                </div>
              </div>
              <div class="modal-footer">
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="editExcursData"  tabindex="-1" aria-labelledby="editExcursDataLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog modal-lg">
                  <div class="modal-content">
                    <form action="" method="POST">
                    <div class="modal-header">
                      <h5 class="modal-title" id="editExcursDataLabel">Экскурсия</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" " aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body">
                          <input type="text" class="form-control" id="id_exc" style="display: none;" name="id_exc">
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="edExc_Name" name="edExc_Name" placeholder="">
                            <label for="EditInput">Название</label>
                          </div>
                          <div class="form-floating mb-3">
                            <textarea class="form-control" aria-label="With textarea" name="edExcT" placeholder="" id="edExcT" name="DiscriptionExc"></textarea>
                            <label for="EditInput">Описание</label>
                          </div>
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="edExcAddr" name="edExcAddr" placeholder="">
                            <label for="EditInput">Адрес</label>
                          </div>
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="edExcPr" name="edExcPr" placeholder="">
                            <label for="EditInput">Цена</label>
                          </div>
                          <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="edExcEm" name="edExcEm" placeholder="">
                            <label for="EditInput">Email</label>
                          </div>
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="edExcPh" name="edExcPh" placeholder="">
                            <label for="EditInput">Телефон</label>
                          </div>
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="edExc_date" name="edExc_date" placeholder="" >
                            <label for="EditInput">Дата</label>
                          </div>
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="edExc_accNumber" placeholder="" disabled>
                            <label for="EditInput">Номер счёта (если вводили)</label>
                          </div>
                        </div>
                    </div>
                    <div class="modal-footer"  id="buttonOrder">
                      <button type="submit" class="btn btn-primary" name="delSub">Удалить</button>
                      <button type="submit" class="btn btn-primary" name="editSub">Сохранить</button>
                    </div>
                  </form>
                  </div>
                </div>
            </div>
        <div class="map">
<!--             <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="orderModalLabel">Заказ</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body">
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Иван" >
                            <label for="floatingInput">Имя</label>
                          </div>
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Иванович" >
                            <label for="floatingInput">Фамилия</label>
                          </div>
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Иванович">
                            <label for="floatingInput">Отчество</label>
                          </div>
                          <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Email</label>
                          </div>
                          
                          <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="floatingInput"  name="date" placeholder="Дата" required>
                            <label for="floatingInput">Дата</label>
                          </div>
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
                      <button type="button" class="btn btn-primary" onclick="alert('Агрегатор')" >Заказать</button>
                    </div>
                  </div>
                </div>
            </div> -->
            <div class="map_api" id="mapApi" width="1384" height="836" alt="Map">

            </div>
        </div>
        <?php require('sidePanel.php')?>
        <div class="why_we">
        <!-- <button type="button" class="btn btn-primary" id="submit_newExc" onclick="geoObj()">Сох</button> -->
          <div class="line"></div>
          <div class="container button_forOrder">
              
              <button class="btn btn-primary" style="display: none;" id="offcanvasSidep_btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidepanel" aria-controls="offcanvasSidepanel" name="subSide ">
              </button>
              
              <input type="text" class="form-control" id="return_XY"  placeholder="" style="display:none;" name="XYreturn">
              
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
      <script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
      <script src="../index.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
      
      <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
      <script type="text/javascript" src="./cal/daterangepicker-master/moment.min.js"></script>
      <script type="text/javascript" src="./cal/daterangepicker-master/daterangepicker.js"></script>
      <script>
        $(function() {
          $('input[name="datetimes"]').daterangepicker({
            timePicker: true,
            "timePicker24Hour": true,
            startDate: moment().startOf('hour'),
            endDate: moment().startOf('hour').add(3 , "day"),
            "drops": "up",
            locale: {
              format: 'M/DD/YYYY hh:mm A'
            }
            
          }, function(start, end, label) {
          console.log('New date range selected: ' + start.format('YYYY-MM-DD hh:mm A') + ' to ' + end.format('YYYY-MM-DD hh:mm A') + ' (predefined range: ' + label + ')');
        } );
        });
      </script>
     <!--  <script src="daterangepicker/moment.js"></script>
      <script src="daterangepicker/daterangepicker.js">
        $(function(){
          $('#dating').daterangepicker(
            {
              singleDatePicker: true,
              locale: {
              format: 'YYYY.DD.MM'
            }
            }
          );
        });
      </script>
      <script type="text/javascript">
        var toastLiveExample = document.getElementById('liveToast');
        var toast = new bootstrap.Toast(toastLiveExample);
        toast.show();
      </script> -->
    
      
 

    </body>
</html>

<?php 
require('newExcurs.php');

/* require('edit.php') */
require ('coord.php');
require ('del_editExc.php');


?>