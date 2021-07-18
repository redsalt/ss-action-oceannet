// VUE

// var app = new Vue({
//     el: '#app',
//     data: {
//         message: ''
//     }
// });

// ====================================================================================================================================
// DEFINE
// ====================================================================================================================================

// define('_DB_host', 'localhost');

// ====================================================================================================================================

// I N I T.

// ====================================================================================================================================

// create map
var map; 
var mapContainer;
var mapOption; 
var locPosition;

// information window
var infowindow;

// marker
var marker;

// address and coordinates
var geocoder;

// current information
var currentAddress;

// registered marker flag
var flagSelectedRegisteredMarker;
// mainpage flag
var flagMainpage;

// ---------------------------------------------------------------------------------------------
// SET/GET VARIABLES
// ---------------------------------------------------------------------------------------------

function setLocationCoordinates(latng) {locPosition = latng; console.log('setLocationCoordinates():' + locPosition);}
function getLocationCoordinates() {return locPosition;}
function initLocationCoordinates() { 
    locPosition = new kakao.maps.LatLng(0,0); currentAddress='';
    marker = new kakao.maps.Marker({ draggable : false, map: map, position: locPosition});
}

function setCurrentAddress(current_address) { currentAddress = current_address; }
function getCurrentAddress() { return currentAddress; }
function setRegisteredMarker(flag) {flagSelectedRegisteredMarker=flag;}
function getRegisteredMarker() { return flagSelectedRegisteredMarker; }
function setFlagMainpage(flag) { flagMainpage=flag; }
function getFlagMainpage() { return flagMainpage; }

function initVariables(){
    
    var mapContainer = document.getElementById('map'),
    mapOption = {
        center: new kakao.maps.LatLng(37.56727, 126.97733),
        level: 13,
        mapTypeId : kakao.maps.MapTypeId.ROADMAP
    }; 

    map = new kakao.maps.Map(mapContainer, mapOption); 

    // locPosition = new kakao.maps.LatLng(33.450701, 126.570667);
    locPosition = new kakao.maps.LatLng(0.0, 0.0);
    console.log(locPosition);

    // 클릭한 위치에 대한 주소를 표시할 인포윈도우입니다
    infowindow = new kakao.maps.InfoWindow({zindex:1});
    
    marker = new kakao.maps.Marker({ draggable : false, map: map, position: locPosition});

    // CONVERT BETWEEN ADDRESS AND COORDINATE
    geocoder = new kakao.maps.services.Geocoder();

    setCurrentAddress('');
    setRegisteredMarker(false);
    setFlagMainpage(false);

    // console.log("initialised.");
}

initVariables();

// ---------------------------------------------------------------------------------------------
// ZOOM CONTROL
// ---------------------------------------------------------------------------------------------

var zoomControl = new kakao.maps.ZoomControl();
map.addControl(zoomControl, kakao.maps.ControlPosition.RIGHT);

// ---------------------------------------------------------------------------------------------
// GEOLOCATION
// ---------------------------------------------------------------------------------------------

function currentLocation() {
 
    if (navigator.geolocation) {
        
        navigator.geolocation.getCurrentPosition(function(position) {
            
            var lat = position.coords.latitude,
                lon = position.coords.longitude;
            
            locPosition = new kakao.maps.LatLng(lat, lon);
            var message = '<span style="padding:5px;margin:auto;text-align:center;">Here?</span>';
                
            // displayMarker(locPosition, message);
            getDetailAddressHTML(locPosition);
                
          });
        
    } else { // IMPOSSIBLE TO GET THE GEOLOCATION
        
        locPosition = new kakao.maps.LatLng(33.450701, 126.570667),    
            message = 'no geolocation'
            
        // displayMarker(locPosition, message);
        getDetailAddressHTML(locPosition);
    }

}


// ---------------------------------------------------------------------------------------------
// INFO WINDOW
// ---------------------------------------------------------------------------------------------

function displayInfowindow(message) {
    
    // var iwContent = message,    // message
    //     iwRemoveable = false;

    // infowindow = new kakao.maps.InfoWindow({
    //     content : iwContent,
    //     removable : iwRemoveable
    // });
    
    // open the window above the marker
    infowindow.open(map, marker);
}



// ====================================================================================================================================

// M A R K E R

// ====================================================================================================================================

// ---------------------------------------------------------------------------------------------
// DISPLAY MARKER
// ---------------------------------------------------------------------------------------------

function displayMarker(locPosition, message) {

    // marker = new kakao.maps.Marker({
    //     draggable : true,
    //     map: map, 
    //     position: locPosition
    // });

    searchAddrFromCoords(map.getCenter(), displayCenterInfo);
    
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

// ---------------------------------------------------------------------------------------------
// SET CURRENT MAP AND MARKER
// ---------------------------------------------------------------------------------------------

function setCurrentInformation() {

    // locPosition = latLng;
    setLocationCoordinates(locPosition);

    // 마커를 클릭한 위치에 표시합니다 
    marker.setPosition(locPosition);
    marker.setMap(map);

    // 인포윈도우에 클릭한 위치에 대한 법정동 상세 주소정보를 표시합니다
    infowindow.setContent(currentAddress);
    infowindow.open(map, marker);

    // 마커에 클릭이벤트를 등록합니다
    kakao.maps.event.addListener(marker, 'click', function() {

        setRegisteredMarker(false);
    
        // 마커를 클릭하면 장소명이 인포윈도우에 표출됩니다
        // infowindow.setContent('<div style="padding:5px;font-size:12px;color:black;opacity:0.7">' + 'where?' + '</div>');
        infowindow.setContent(currentAddress);
        console.log(currentAddress);
        infowindow.open(map, marker);
        // locPosition = marker.getPosition();
        setLocationCoordinates(marker.getPosition());
    });
}

// ---------------------------------------------------------------------------------------------
// CLICK ON MAP
// NEW MARKER (MAIN MARKER) TO REGISTER
// ---------------------------------------------------------------------------------------------

kakao.maps.event.addListener(map, 'click', mapClick);

function mapClick(mouseEvent) {

    if (!getFlagMainpage()) {
        
        locPosition = mouseEvent.latLng;
        getDetailAddressHTML(mouseEvent.latLng);
        // console.log(address_text);    
    }
}

function getDetailAddressHTML(latLng) {

    searchDetailAddrFromCoords(latLng, function(result, status) {

        if (status === kakao.maps.services.Status.OK) {
            
            var detailAddr = !!result[0].road_address ? '<div>도로명: ' + result[0].road_address.address_name + '</div>' : '';
            detailAddr += '<div>지번: ' + result[0].address.address_name + '</div>';
            
            // var content = '<div class="bAddr">' + '<span class="title">법정동 주소정보</span>' + detailAddr + '</div>';
            currentAddress = '<div class="bAddr">' + detailAddr + '</div>';
            setCurrentInformation();
            console.log(currentAddress);

        }

    });
}

function hideMarker() {
    marker.setMap(null);
}

// ====================================================================================================================================
// C O O R D I N A T E S   A N D   A D D R E S S
// ====================================================================================================================================

// ---------------------------------------------------------------------------------------------
// COORDINATES TO ADDRESS
// ---------------------------------------------------------------------------------------------

// 중심 좌표나 확대 수준이 변경됐을 때 지도 중심 좌표에 대한 주소 정보를 표시하도록 이벤트를 등록합니다
kakao.maps.event.addListener(map, 'idle', function() {
    searchAddrFromCoords(map.getCenter(), displayCenterInfo);
});

function searchAddrFromCoords(coords, callback) {
    // 좌표로 행정동 주소 정보를 요청합니다
    geocoder.coord2RegionCode(coords.getLng(), coords.getLat(), callback);         
}

function searchDetailAddrFromCoords(coords, callback) {
    // 좌표로 법정동 상세 주소 정보를 요청합니다
    geocoder.coord2Address(coords.getLng(), coords.getLat(), callback);
}

// 지도 좌측상단에 지도 중심좌표에 대한 주소정보를 표출하는 함수입니다
function displayCenterInfo(result, status) {
    if (status === kakao.maps.services.Status.OK) {
        var infoDiv = document.getElementById('centerAddr');

        for(var i = 0; i < result.length; i++) {
            // 행정동의 region_type 값은 'H' 이므로
            if (result[i].region_type === 'H') {
                infoDiv.innerHTML = result[i].address_name;
                break;
            }
        }
    }    
}

// ---------------------------------------------------------------------------------------------
// SEARCH ADDRESS
// ---------------------------------------------------------------------------------------------

var address_text;

function searchAddressFromHTML(address_text) {

    // geocoder.addressSearch(address_text, function(result, status) {

    //      if (status === kakao.maps.services.Status.OK) {
    
    //         var coords = new kakao.maps.LatLng(result[0].y, result[0].x);
    //         getDetailAddressHTML(coords);
    //         map.setLevel(4);
    //         map.setCenter(coords);
    //     } 
    // }); 

    // 장소 검색 객체를 생성합니다
    var ps = new kakao.maps.services.Places(); 

    // 키워드로 장소를 검색합니다
    ps.keywordSearch(address_text, placesSearchCB); 
}

// 키워드 검색 완료 시 호출되는 콜백함수 입니다
function placesSearchCB (data, status, pagination) {
    if (status === kakao.maps.services.Status.OK) {

        // 검색된 장소 위치를 기준으로 지도 범위를 재설정하기위해
        // LatLngBounds 객체에 좌표를 추가합니다
        var bounds = new kakao.maps.LatLngBounds();

        for (var i=0; i<data.length; i++) {
            displayMarker(data[i]);    
            bounds.extend(new kakao.maps.LatLng(data[i].y, data[i].x));
        }       

        // 검색된 장소 위치를 기준으로 지도 범위를 재설정합니다
        map.setBounds(bounds);
    } 
}

// 지도에 마커를 표시하는 함수입니다
function displayMarker(place) {
    
    // 마커를 생성하고 지도에 표시합니다
    var marker = new kakao.maps.Marker({
        map: map,
        position: new kakao.maps.LatLng(place.y, place.x) 
    });

    // 마커에 클릭이벤트를 등록합니다
    kakao.maps.event.addListener(marker, 'click', function() {

        setRegisteredMarker(false);
        // 마커를 클릭하면 장소명이 인포윈도우에 표출됩니다
        infowindow.setContent('<div style="padding:5px;font-size:12px;color:black;opacity:0.7">' + place.place_name + '</div>');
        infowindow.open(map, marker);
        // locPosition = marker.getPosition();
        setLocationCoordinates(marker.getPosition());
        // console.log(locPosition);
    });
}

// ====================================================================================================================================

// R E G I S T E R   N E W   L O C A T I O N

// ====================================================================================================================================

// ---------------------------------------------------------------------------------------------
// REGISTER MARKER LOCATION
// ---------------------------------------------------------------------------------------------

// console.log("REGISTER MARKER LOCATION");
var reg = document.getElementById('btnReg');

if(reg){
  //reg.addEventListener('click', registerLocation, false);
  reg.addEventListener('click', registerLocation);
} else {
    console.log("it can't find btnReg.");
}

function registerLocation() {
    
    console.log('registerLocation(), ' + locPosition);
    var pos = marker.getPosition();

    if (!getRegisteredMarker()) {
        var msg = "lat: " + pos.getLat() + ", lng: " + pos.getLng();
        displayMsginfo(msg);
        displayRegisteredMarker(pos);
        
        $.ajax({
            url: './map/functions.php',
            type: 'post',
            data: { "callFunc1": [pos.getLat(), pos.getLng()]},
            success: function(response) {
                // alert(response);
                // console.log("registerLocation(), response:");
                console.log(response);
            }
        });    
    } else {
        console.log('PLEASE SET NEW LOCATION.');
    }
}

// ---------------------------------------------------------------------------------------------
// DISPLAY REGISTERED MARKERS
// ---------------------------------------------------------------------------------------------

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

    var registeredAddress = '';
    searchDetailAddrFromCoords(locPosition, function(result, status) {

        if (status === kakao.maps.services.Status.OK) {
            
            var detailAddr = !!result[0].road_address ? '<div>도로명: ' + result[0].road_address.address_name + '</div>' : '';
            detailAddr += '<div>지번: ' + result[0].address.address_name + '</div>';
            
            registeredAddress = '<div class="bAddr">' + detailAddr + '</div>';
            console.log(registeredAddress);
        }   
    });

    // 마커에 클릭이벤트를 등록합니다
    kakao.maps.event.addListener(regmarker, 'click', function() {

        // init. current information
        // initLocationCoordinates();
        setRegisteredMarker(true);

        // 마커를 클릭하면 장소명이 인포윈도우에 표출됩니다
        // infowindow.setContent('<div style="padding:5px;font-size:12px;color:black;opacity:0.7">' + 'where?' + '</div>');
        infowindow.setContent(registeredAddress);
        infowindow.open(map, regmarker);
        // locPosition = marker.getPosition();
        setLocationCoordinates(regmarker.getPosition());
        // console.log(locPosition);
    });
}

// ---------------------------------------------------------------------------------------------
// IMPORT REGISTERED MARKERS
// ---------------------------------------------------------------------------------------------

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

// ====================================================================================================================================
// END OF SCRIPT
// ====================================================================================================================================
