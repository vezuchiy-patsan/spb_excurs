"use strict"
// Функция ymaps.ready() будет вызвана, когда
// загрузятся все компоненты API, а также когда будет готово DOM-дерево.
ymaps.ready(init);



function init(){
    /* [59.939098, 30.315868] */
    var coords = [];
    //добавим данные из БД
    for(let i = 0 ; i <= coordsPHP.length; i++){
        coords.push(coordsPHP[i]);
    }
    //занесём имя файла
    var fileName = document.documentURI;
    let massiveUrl = fileName.split('/');
    // Создание карты.

    
    
    if(massiveUrl[massiveUrl.length-1] == 'validateExcursion.php'){
        var myMap = new ymaps.Map("mapApi", {
            // Координаты центра карты.
            // Порядок по умолчанию: «широта, долгота».
            // Чтобы не определять координаты центра карты вручную,
            // воспользуйтесь инструментом Определение координат.
            center: [59.939098, 30.315868],
            // Уровень масштабирования. Допустимые значения:
            // от 0 (весь мир) до 19.
            zoom: 11,
            controls: ['zoomControl'] 
        },{
        // Зададим ограниченную область прямоугольником, 
        // примерно описывающим Санкт-Петербург.
        restrictMapArea: [
        [59.729409, 29.862390],
        [60.196089, 30.905570]
        ]});
        var myPlacemark2;
        var myMap2 = new ymaps.Map("mapApi_order", {
            // Координаты центра карты.
            // Порядок по умолчанию: «широта, долгота».
            // Чтобы не определять координаты центра карты вручную,
            // воспользуйтесь инструментом Определение координат.
            center: [59.939098, 30.315868],
            // Уровень масштабирования. Допустимые значения:
            // от 0 (весь мир) до 19.
            zoom: 11,
            controls: ['zoomControl'] 
        },{
        // Зададим ограниченную область прямоугольником, 
        // примерно описывающим Санкт-Петербург.
        restrictMapArea: [
            [59.729409, 29.862390],
            [60.196089, 30.905570]
        ]});
        myMap2.events.add('click', function (e) {
        var coords2 = e.get('coords');

        // Если метка уже создана – просто передвигаем ее.
        if (myPlacemark2) {
            myPlacemark2.geometry.setCoordinates(coords2);
        }
        // Если нет – создаем.
        else {
            myPlacemark2 = createPlacemark(coords2);
            myMap2.geoObjects.add(myPlacemark2);
            
            // Слушаем событие окончания перетаскивания на метке.
            myPlacemark2.events.add('dragend', function () {
                getAddress(myPlacemark2.geometry.getCoordinates());
                
            });
        }
        getAddress(coords2);
        document.getElementById("validationAddressXY").value = coords2;
        });
        // Создание метки.
        function createPlacemark(coords2) {
            return new ymaps.Placemark(coords2, {
                iconCaption: 'поиск...'
            }, {
                preset: 'islands#blueIcon',
                draggable: true
            });
        }
    // Определяем адрес по координатам (обратное геокодирование).
        function getAddress(coords2) {
            myPlacemark2.properties.set('iconCaption', 'поиск...');
            ymaps.geocode(coords2).then(function (res) {
                var firstGeoObject = res.geoObjects.get(0);
                myPlacemark2.properties
                    .set({
                        // Формируем строку с данными об объекте.
                        iconCaption: [
                    
                        ],
                        // В качестве контента балуна задаем строку с адресом объекта.
                        balloonContent: firstGeoObject.getAddressLine()
                    });
                document.getElementById("validationAddress").value = firstGeoObject.getAddressLine().substring(8);
            });
        }
        
    }else{
        var myMap  = new ymaps.Map("mapApi1", {
            // Координаты центра карты.
            // Порядок по умолчанию: «широта, долгота».
            // Чтобы не определять координаты центра карты вручную,
            // воспользуйтесь инструментом Определение координат.
            center: [59.939098, 30.315868],
            // Уровень масштабирования. Допустимые значения:
            // от 0 (весь мир) до 19.
            zoom: 11,
            controls: ['zoomControl'] 
        },{
        // Зададим ограниченную область прямоугольником, 
        // примерно описывающим Санкт-Петербург.
        restrictMapArea: [
            [59.729409, 29.862390],
            [60.196089, 30.905570]
        ]}); 
    }
    // Слушаем клик на карте.
   
    // Создание геообъекта с типом точка (метка).
    var myGeoObject = new ymaps.GeoObjectCollection(
       {
        preset: 'islands#blueIcon'
    });

    for (var i = 0; i < coords.length; i++) {
        myGeoObject.add(new ymaps.Placemark(coords[i]));
    }
    
    myMap.geoObjects.add(myGeoObject);
    
   /*  myMap1.geoObjects.add(myGeoObject); */  
    history_list.onclick = function (){
        let adr_count;
        for(let i = 0; i <= historyMass.length; i++){
            ymaps.geocode(historyMass[i]).then(function (res) {
                var historyGeoObject = res.geoObjects.get(0);

                adr_count = "Addres"+String(i+1);
                document.getElementById(adr_count).innerHTML = historyGeoObject.getAddressLine().substring(25);
            })
        };
    };

    if(massiveUrl[massiveUrl.length-1] == 'validateExcursion.php'){
        const el = document.querySelector('.buttonExc');
        function getBut(e){
            var id_el = e.target.id;
            var letters = id_el.replace(/\D/g, ""); 
            
            exc_history.forEach(function(item, index){
                
                if(item[0].indexOf(Number(letters)) != -1){
                    document.getElementById("id_exc").value = item[0];
                    document.getElementById("edExc_Name").value = item[2];
                    document.getElementById("edExcT").innerHTML = item[3];
                    let getCoor = [item[8], item[9]];
                    ymaps.geocode(getCoor).then(function(res){ var historyCoor = res.geoObjects.get(0); document.getElementById("edExcAddr").value = historyCoor.getAddressLine().substring(25);});
                    document.getElementById("edExcPr").value = item[4];
                    document.getElementById("edExcEm").value = item[5];
                    document.getElementById("edExcPh").value = item[6];
                    document.getElementById("edExc_date").value = item[7] + " - 2022-05-17 07:00:00";
                }
                    
            });
        }
        el.addEventListener("click", getBut);
    }

 



   if(massiveUrl[massiveUrl.length-1] != 'index.php'){
        myGeoObject.events.add('click', function (e) {
            var click_coord = e.get('target').geometry.getCoordinates();
            console.log(click_coord);
            console.log(myGeoObject.toArray());

            let idPoint;
            /*document.getElementById("return_XY").value = click_coord; */
            document.getElementById("offcanvasSidep_btn").click();
            /* var click_coord = click_coord.map(function(arr){
                return String(arr);
            })  */
            
            
            for(let i = 0; i < excursMass.length; i++){
                let time_arr = excursMass[i];
                document.getElementById('image1').src = "image/foto.jpg";
                document.getElementById('image2').src = "image/foto.jpg";
                document.getElementById('image3').src = "image/foto.jpg";
                
                if(excursMass[i][0] /* && tmp_photo.length == 0 */){
                   
                   /*  for(let c = 0; c < photo.length; c++){
                        if(photo[c][0] == excursMass[i][0]){
                            tmp_photo.push(photo[c][1]);
                        }
                    }
                    if(tmp_photo != undefined){
                        tmp_photo[tmp_photo.length] = "82";
                    }
                    console.log(tmp_photo); */
                }
                if (click_coord[0] == excursMass[i][8]){
                    if(click_coord[1] == excursMass[i][9]){
                        if(massiveUrl[massiveUrl.length-1] != 'validateExcursion.php'){
                            document.getElementById('idGeotag').value = excursMass[i][0];
                        }
                        
                        document.getElementById('offcanvasSide').innerHTML = excursMass[i][2];
                        document.getElementById('sideDiscription').innerHTML = excursMass[i][2];
                        document.getElementById('sideDiscription').innerHTML = excursMass[i][3];
                        document.getElementById('excName').innerHTML = excursMass[i][10] + " " + excursMass[i][11];
                        document.getElementById('excEmail').innerHTML = excursMass[i][5];
                        document.getElementById('excPhone').innerHTML = excursMass[i][6];
                        document.getElementById('excDate').innerHTML = excursMass[i][7] + "   " + (Math.floor(Math.random() * (30 - 1 + 1)) + 1) + ".05.2022 07:00:00";
                        document.getElementById('excPrice').innerHTML = excursMass[i][4]+" RUB";
                        
                        var tmp_photo = [];
                        for(let n = 0; n < photo.length; n++){
                            if(photo[n][0] == excursMass[i][0]){
                                tmp_photo.push(photo[n][1]);
                            }
                        }
                        switch(tmp_photo.length){
                            case 3:
                                document.getElementById('image1').src = "http://p90527sx.beget.tech/" + tmp_photo[0];
                                document.getElementById('image2').src = "http://p90527sx.beget.tech/" + tmp_photo[1];
                                document.getElementById('image3').src = "http://p90527sx.beget.tech/" + tmp_photo[2];
                                break;
                            case 2:
                                document.getElementById('image1').src = "http://p90527sx.beget.tech/" + tmp_photo[0];
                                document.getElementById('image2').src = "http://p90527sx.beget.tech/" + tmp_photo[1];
                                break;
                            case 1:
                                console.log(tmp_photo);
                                document.getElementById('image1').src = "http://p90527sx.beget.tech/" + tmp_photo[0];
                                break;
                        }
                                
                                
                        tmp_photo.length = 0;
                        break;

                        /* tmp_photo.length = 0; */
                        
                    }
                    /* idPoint = time_arr.indexOf(click_coord[0]); */
                    
                    /* console.log(idPoint);
                    console.log(Number(click_coord[0]-Number(excursMass[1][8]))); */
                    
                }
            }

            
            /* $.get('http://p90527sx.beget.tech/validateExcursion.php', {message:message}, function(data)	{
                alert('Сервер ответил: '+data);
            }); */
            
        });
        
    }
}
