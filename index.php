<?php 
    require ("points.php");
?>

<!DOCTYPE html> 
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script src="https://api-maps.yandex.ru/2.1/?apikey=9a3a56a6-f665-417b-87b2-b0df644b6e8c&lang=ru_RU&mode=debug" type="text/javascript">
    </script>
    <script type="text/javascript"> let coordsPHP = JSON.parse('<?php echo $json; ?>'); </script>
    <link rel="icon" href="svg\a.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
    <link href="./css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./css/media.css">
    <title>Это дефф!!!</title>
</head>
<body>
    <div class="mainSide">
        <nav>
            <div class="head">
                <div class="log_in">
                    <button  class="btn btn-light btn-lg" data-bs-toggle="modal" data-bs-target="#log_inModal">Вход</button>
                    
                    <div class="modal fade" id="log_inModal" tabindex="-1" aria-labelledby="log_inModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header ">
                              <h5 class="modal-title" id="titleModalLabel">Вход</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="auth.php" method="post">
                            <div class="modal-body">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name='login'>
                                    <label for="floatingInput">Email</label>
                                  </div>
                                  <div class="form-floating">
                                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name='password'>
                                    <label for="floatingPassword">Пароль</label>
                                  </div>
                            </div>
                            <div class="modal-footer" id="buttonIn">            
                                <button type="submit"  class="btn btn-primary butIn" name="submit">Войти</button> 
                                <!-- <a  role="button" type="button" href="validateMain.html" class="btn btn-primary butIn">Войти</a>                                           
                                <a  role="button" type="button" href="validateExcursion.html" class="btn btn-primary butIn">Экскурсия</a>   -->                                         
                            </div>
                            </form>
                          </div>
                        </div>
                    </div>
                </div>
             
                <div class="reg">
                        <button  class="btn btn-light btn-lg" role="button" data-bs-toggle="modal" data-bs-target="#regModal">Регистрация</и>
                </div>
                
                <div class="modal fade" id="regModal" tabindex="-1" aria-labelledby="regModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header ">
                          <h5 class="modal-title" id="title_regModalLabel">Регистрация</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                        <form id="reg_sub" method="post" action="server.php" class="needs-validation form_reg" novalidate> 
                            <div class="modal-body">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="Иван" name="FirstName" required>
                                    <label for="floatingInput">Имя</label>
                                    <div class="invalid-feedback">Укажите имя</div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="Иванович" name="FirstName1" required>
                                    <label for="floatingInput">Фамилия</label>
                                    <div class="invalid-feedback">Укажите фамилию</div>
                                </div>
                                <div class="form-floating mb-3">
                                    
                                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="login" required>
                                    <label for="floatingInput">Email</label>
                                    <div class="invalid-feedback">Укажите email</div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="floatingPassword password" placeholder="Password" name="password" required>
                                    <label for="floatingPassword">Пароль</label>
                                    <div class="invalid-feedback">Укажите пароль</div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="floatingPassword" placeholder="name@example.com" id="r_password" required>
                                    <label for="floatingPassword">Повторите пароль</label>
                                    <div class="invalid-feedback">Повторите пароль</div>
                                </div>
                                <div class="mb-3 mt-3 d-flex justify-content-center">
                                    <div class="form-check form-check-inline radBut1">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="0" required>
                                        <label class="form-check-label" for="inlineRadio1">Покупатель</label>
                                    </div>
                                    <div class="form-check form-check-inline radBut2">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="1" >
                                        <label class="form-check-label" for="inlineRadio2">Экскурсовод</label>
                                    </div>
                                    
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="politics" required>
                                    <label class="form-check-label" for="politics" >
                                    Нажимая кнопку "Регистрация", вы даёте <a href="/Privicy_policy.html">согласие на обработку персональных данных.</a>
                                    </label>
                                </div>
                            </div>
                            <div class="modal-footer" id="buttonReg"> 
                                    <button type="submit" class="btn btn-primary btn-block butReg" id="liveToastBtn" name="submit" >Регистрация</button> 
                                 
                            </div>
                         </form> 
                      </div>
                    </div>
                </div>
           
                <div  class="excursion_text"><p class="heading">Экскурсии по крышам Санкт-Петербурга <?php $login?></p></div>
            </div>    
            
        </nav>
        <div class="map" >
            <div class="map_api" id="mapApi1" width="1384" height="836" alt="Map">
            </div>
        </div>
        <div class="why_we">
            <div class="line"></div>
            
        </div>
        <footer>
            <div class="footer" >
                <div class="data_footer">
                    <div class="item"></div>
                    <div class="name_author item"><p>@Ахиян Д.Г.</p></div>
                    <div class="email item"><p>roofSPB@mail.ru</p></div>
                </div>
            </div>
        </footer>
      </div>
  
      <script src="../index.js"></script>
      <script src="../validate.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    </body>
</html>

