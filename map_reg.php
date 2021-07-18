<?php
// ini_set('display_errors',1);
session_start();
require_once __DIR__ . '/map/functions.php';
?>

<script>
    var arr = <?php echo json_encode($arr_loc) ?>;
    // console.log(arr.length);
</script>


<!DOCTYPE html>

<html lang="kr">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1.0, minimum-scale=1.0" />
    <title>Ocean.Net 2021 - Sea Shepherd Korea</title>
    <link rel="stylesheet" href="css/style.css" />
    <!-- <link rel="stylesheet" href="css/mobile.css" media="screen (mid-width:512px) and (max-width: 1024px)" rel="stylesheet"> -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--[if lt IE 9]>
      <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>

  <body>
  
    <div class="container_map">

      <!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
      <!-- HEADER -->
      <!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->

      <div class="map__header">
        <a href="./index.php"><h1>SEA SHEPHERD KOREA</h1></a>
        <p class="map__info__id"> <?php echo "{$_SESSION['userId']}"; ?> </p>
      </div> 

      <!-- show the map -->
      <div class="hAddr">
          <!-- <span class="title">현재위치</span> -->
        <span id="centerAddr"></span>
      </div>
      <div id="map"></div>
          
      <script src="//dapi.kakao.com/v2/maps/sdk.js?appkey=52602574ee61be6c3643b3abb7cbbfe4&libraries=services,clusterer,drawing"></script>
      <!-- <script src="//dapi.kakao.com/v2/maps/sdk.js?appkey=75eca38292b44cb8e486cb4eb3577dbd&libraries=services,clusterer,drawing"></script> -->
    
      <!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
      <!-- MAP USER AREA - CONTROL / INFORMATION -->
      <!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
      
      <div class="map__user">

        <!-- input search address -->

        <div class="map__form">

          <form action="./map_reg.php" method="post">

            <div class="int-area">
              <label for="search_addr">찾을 주소</label><br>
              <input type="text" name="search_addr" id="search_addr" autocomplete="off" required>
            </div>

            <div class="btn-area">
              <button id="btn_search_addr" type="submit">주소 찾기</button>
            </div>

          </form>
        </div>
        <!-- map__form -->
  
        <!-- map information -->
    
        <div class="map__info">
          
          <!-- <p class="map__info__caption">좌표</p> -->
          <p class="map__info__msg">&nbsp;</p>

          <div class="map__reg">
            <input type="button" id="btnReg" value="등록하기">
            <!-- <script>console.log("btnReg");</script> -->
          </div>

        </div>
        <!-- map__info -->

      </div>
      <!-- map__user -->
            
      <script src="./map/map.js"></script>

        <script>
          var data = <?php echo json_encode($_POST['search_addr']); ?>;
          console.log(data);
          if(data != null) {searchAddressFromHTML(data);}
        </script>

      <script>importRegisteredLocation();</script>
      <!-- <script>currentLocation();</script> -->
      <script>setFlagMainpage(false);</script>
  
      <!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
      <!-- END OF MAP CONTROL / INFORMATION -->
      <!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
          
    </div>
    <!-- container_map -->

  </body>

</html>