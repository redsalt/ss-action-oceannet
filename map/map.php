<?php
// @ob_start();
session_start();
require_once __DIR__ . '/functions.php';
?>

<script>
    var arr = <?php echo json_encode($arr_loc) ?>;
    console.log(arr.length);
</script>

<!-- dev -->
<!--<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>-->
<!-- release -->
<!-- <script src="https://cdn.jsdelivr.net/npm/vue"></script> -->

<!-- jquery -->
<script src="https://code.jquery.com/jquery-latest.js"></script>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="index.css">
	<title>Register a location</title>
</head>

<body>
    
    <!--<div id="app">-->
    <!--    {{ message }}-->
    <!--</div>-->
    
    <!-- ============================================================================== -->
    <!-- ACCOUNT INFORMATION -->
    <!-- ============================================================================== -->

    <div class="account">
    	<ul class="nav justify-content-end">
            
            <?php
            if (isset($_SESSION['userId'])) {
                echo "{$_SESSION['userId']}";
            ?>
    
                <li class="nav-item d-flex align-items-center" onclick="logout()">로그아웃</li>
    
            <?php
            } else {
            ?>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="signup.html">계정생성</a>
                </li>
    
                <li class="nav-item">
                    <a class="nav-link" href="../login/login.html">로그인</a>
                </li>
    
            <?php
            }
            ?>
        </ul>
    	<script>
    		function logout() {
    			console.log("bye");
    			const data = confirm("로그아웃 하시겠습니까?");
    			if (data) {
    				location.href = "../login/logout.php";
    			}
    		}
    	</script>
    </div>
    
    <!-- ============================================================================== -->
    <!-- MAP -->
    <!-- ============================================================================== -->
	
	<div class="map">

    	<div class="map__info">
    	    <ul>Position: </ul>
    	    <p class="map__info__msg">.&nbsp;</p>
    	</div>

        <div id="map"></div>
    	
    	<script src="//dapi.kakao.com/v2/maps/sdk.js?appkey=52602574ee61be6c3643b3abb7cbbfe4&libraries=services,clusterer,drawing"></script>
    	
    	<div class="map__reg">
    	    <p><input type="button" id="btnReg" value="등록"></p>
        </div>
        
        <script src="map.js"></script>
    
	</div>


</body>
</html>

<?php
// ob_flush();
?>