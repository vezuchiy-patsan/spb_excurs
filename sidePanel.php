<?php 
    
?>
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSidepanel" aria-labelledby="offcanvasSid">
<div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasSide"></h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Закрыть"></button>
</div>
<div class="offcanvas-body">
    <div>
        <div id="carouselPhotoControls" class="carousel slide mb-3" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img src="image\foto.jpg" class="d-block w-100" alt="..." id="image1">
            </div>
            <div class="carousel-item">
            <img src="image\foto.jpg" class="d-block w-100" alt="..." id="image2">
            </div>
            <div class="carousel-item">
            <img src="image\foto.jpg" class="d-block w-100" alt="..." id="image3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselPhotoControls"  data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Предыдущий</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselPhotoControls"  data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Следующий</span>
        </button>
        </div>
    <div>
    <div class="decrcipt mt-3">
        <strong class="">Описание</strong>
        <p id="sideDiscription"></p>
    </div>
    <div class="Price mt-3">
        <strong>Цена</strong>
        <p id="excPrice"></p>
    </div>
    <div class="exc mt-3">
        <strong class="mt-3">Экскурсовод</strong>
        <p id="excName"></p>
        <p id="excEmail"></p>
        <p id="excPhone"></p>
        
    </div>
    <div class="dateTime mt-3">
        <strong class="mt-3">Дата и время</strong>
        <p id="excDate"></p>
    </div>
    </div>
    </div>
    <div>
    <div class="d-flex justify-content-center">
    <button type="button" class="btn btn-primary mt-5 btn-lg" data-bs-toggle="modal" data-bs-target="#orderModal" >Заказать</button>
    </div>
    </div>
</div>
</div>
