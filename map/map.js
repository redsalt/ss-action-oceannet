// VUE

// var app = new Vue({
//     el: '#app',
//     data: {
//         message: ''
//     }
// });


// ==================================================================
// CREATE A MAP

var mapContainer = document.getElementById('map'),
    mapOption = {
        center: new kakao.maps.LatLng(37.56727, 126.97733),
        level: 13,
        mapTypeId : kakao.maps.MapTypeId.ROADMAP
    }; 

var map = new kakao.maps.Map(mapContainer, mapOption); 



// ==================================================================
// ZOOM CONTROL

var zoomControl = new kakao.maps.ZoomControl();
map.addControl(zoomControl, kakao.maps.ControlPosition.RIGHT);



// ==================================================================
// GEOLOCATION

function currentLocation() {
 
    if (navigator.geolocation) {
        
        navigator.geolocation.getCurrentPosition(function(position) {
            
            var lat = position.coords.latitude,
                lon = position.coords.longitude;
            
            var locPosition = new kakao.maps.LatLng(lat, lon), 
                message = '<span style="padding:5px;margin:auto;text-align:center;">Here?</span>';
                
            displayMarker(locPosition, message);
                
          });
        
    } else { // IMPOSSIBLE TO GET THE GEOLOCATION
        
        var locPosition = new kakao.maps.LatLng(33.450701, 126.570667),    
            message = 'no geolocation'
            
        displayMarker(locPosition, message);
    }

}


// ==================================================================
// INFO WINDOW

var infowindow;

function displayInfowindow(message) {
    
    var iwContent = message,    // message
        iwRemoveable = false;

    infowindow = new kakao.maps.InfoWindow({
        content : iwContent,
        removable : iwRemoveable
    });
    
    // open the window above the marker
    infowindow.open(map, marker);
}



// ==================================================================
// MARKER

var marker;

function displayMarker(locPosition, message) {

    marker = new kakao.maps.Marker({
        draggable : true,
        map: map, 
        position: locPosition
    });
    
    kakao.maps.event.addListener(marker, 'dragstart', markerDragStart);
    kakao.maps.event.addListener(marker, 'dragend', markerDragEnd);
    
    displayInfowindow(message);
    map.setCenter(locPosition);
}   

function markerDragStart() {
    //console.log('marker - dragstart');
}

function markerDragEnd() {
    //console.log('marker - dragend');
    markerMoved();
}

function markerMoved() {
    var latlng = marker.getPosition();
    displayMsginfo(latlng.toString());
    
    // console.log(latlng);
    infowindow.setPosition(latlng);
    //map.setCenter(latlng);
}

function displayMsginfo(message) {
    // document.getElementsByClassName('map__info__msg')[0].textContent = message;
    document.querySelector('.map__info__msg').textContent = message;
    // console.log(message);
}



// ==================================================================
// CLICK ON MAP

kakao.maps.event.addListener(map, 'click', mapClick);

function mapClick(mouseEvent) {
    //alert(mouseEvent.latLng instanceof kakao.maps.LatLng); // true
    // displayMsginfo(mouseEvent.latLng.toString());
    // console.log(mouseEvent.latLng.toString());
    // console.log(marker.getPosition());
    marker.setPosition(mouseEvent.latLng);
    markerMoved();
}



// ==================================================================
// REGISTER MARKER LOCATION

var reg = document.getElementById('btnReg');

if(reg){
  //reg.addEventListener('click', registerLocation, false);
  reg.addEventListener('click', registerLocation);
} else {
    console.log("it can't find btnReg.");
}

function registerLocation() {
    var pos = marker.getPosition();
    var msg = "lat: " + pos.getLat() + ", lng: " + pos.getLng();
    displayMsginfo(msg);
    displayRegisteredMarker(pos);
    
    $.ajax({
        url: 'functions.php',
        type: 'post',
        data: { "callFunc1": [pos.getLat(), pos.getLng()]},
        success: function(response) {
            //alert(response);
            console.log(response);
        }
    });
}



// ==================================================================
// REGISTERED MARKERS

var titleNum = 1;
var imageSrc = "https://t1.daumcdn.net/localimg/localimages/07/mapapidoc/markerStar.png";

function displayRegisteredMarker(locPosition)
{
    // size of the marker image
    var imageSize = new kakao.maps.Size(24, 35); 
    var markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize); 
    var regmarker = new kakao.maps.Marker({
        map: map,
        position: locPosition,
        title : titleNum,
        image : markerImage
    });
    titleNum++;
}

// var list = '';
function importRegisteredLocation()
{
    console.log(arr.length);
    var count = arr.length;
    for (i = 0; i < count; i++) {
        var latlng = new kakao.maps.LatLng(parseFloat(arr[i][1]), parseFloat(arr[i][2]));
        displayRegisteredMarker(latlng);
        // console.log(parseFloat(arr[i][1]), parseFloat(arr[i][2]));
    }
    //var latlng = new kakao.maps.LatLng();
    
    // for (i=count ; i > count-5 ; i--) {
    //     list = list + '<p>' + arr[i][0] + ', ' + arr[i][1] + ', ' + arr[i][2] + ', ' + arr[i][3] + '</p>';
    // }
    // console.log(list);
    
}




// ==================================================================
// TEST 

// function testFunc()
// {
//     console.log("test -- test() -- start");
//     // register in db
    
//     /*
//     $.ajax({
//         method: "POST",
//         url: "index.php",
//         data: { text: $("p.unbroken").text() }
//     })
//     .done(function( response ) {
//         $("p.broken").html(response);
//     });
//     */
    
//     /*
//     jQuery.ajax({
//         type: "POST",
//         url: 'index.php',
//         dataType: 'json',
//         data: {functionname: 'register_location', arguments: [pos.getLat(), pos.getLng()]},
    
//         success: function (obj, textstatus) {
            
//             if( !('error' in obj) ) {
//                   //yourVariable = obj.result;
//                   console.log('jQuery success');
//             }
//             else {
//                 console.log(obj.error);
//             }
//         }
//     });
//     */
    
//     /*
//     $.ajax({
//         url: 'index.php',
//         data: {action: 'test'},
//         type: 'post',
        
//         success: function(output) {
//             console.log(output);
//         }
//     });
//     */
    
//     $.ajax({
//         url: 'functions.php',
//         type: 'post',
//         data: { "callFunc1": ["1", "2"]},
//         success: function(response) {
//             //alert(response);
//             console.log(response);
//         }
//     });
    
//     console.log("test -- test() -- end");
// }


// ==================================================================
// Checking current version

//displayMsginfo('2021-04-18.Sun, 14:42');


// ==================================================================
// Initialise

//console.log(arr);
importRegisteredLocation();