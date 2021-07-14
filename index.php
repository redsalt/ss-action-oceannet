<?php
ini_set('display_errors',1);
// @ob_start();
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
    <header class="header" id="header">
      <div class="container">
        <div class="wrapper-header">
          <div class="logo">
            <!-- <img class="logo-img" src="img/logo.png" alt="" /> -->
          </div>
          <!-- <div class="slogan">your nice slogan</div> -->
          <!-- <div class="wrapper-nav"> -->
          <nav class="nav-pages">
            <ul class="nav-items">
              <li class="how-it-works"><a href="#">ABOUT</a></li>
              <li class="sign-up"><a href="#">OCEAN.NET</a></li>
              <li class="login"><a href="#">NEWS</a></li>
            </ul>
          </nav>
          <div class="header__login">
            <div class="header__lobin__items">
                <!--<ul class="nav justify-content-end">-->
                <ul class="login__items">
            
                    <?php
                        if (isset($_SESSION['userId'])) {
                    ?>
                        <li class="login__id">
                            <?php echo "{$_SESSION['userId']}"; ?>
                        </li>
                        <!--<li class="nav-item d-flex align-items-center" onclick="logout()">로그아웃</li>-->
                        <li class="login__logout" onclick="logout()">로그아웃</li>
            
                    <?php
                        } else {
                    ?>
                        <!--<li class="nav-item"><a class="nav-link active" aria-current="page" href="login/signup.html">계정생성</a></li>-->
                        <li class="nav-item"><a class="nav-link" href="./login/login.html">LOG IN</a></li>
                    <?php
                        }
                    ?>
                </ul>
            	<script>
            		function logout() {
            			console.log("bye");
            			const data = confirm("로그아웃 하시겠습니까?");
            			if (data) {
            				location.href = "./login/logout.php";
            			}
            		}
            	</script>
              <!--<a href="login.html">LOG IN</a>-->
            </div>
          </div>
          <!-- </div> -->
        </div>
      </div>
    </header>

    <div class="hero">
      <div class="container">
        <div class="wrapper-hero">
          <div class="wrapper-hero_logo">"<img src="./img/bg-hero.png" class="wrapper-hero_logo__img" /></div>
        </div>
      </div>
    </div>

    <!-- page.02 connected -->
    <div class="p2">
      <div class="container">
        <div class="wrapper-p2">
          <!-- <img src="./img/p02-connected-upper.png" class="wrapper-p2__img" /> -->
        </div>
      </div>
    </div>

    <!-- page.03 desc -->
    <!-- slide -->
    <!-- <div class="p3">
        <div class="container">
            <div class="wrapper-p3"></div>
        </div>
    </div> -->

    <!-- slide example -->
    <div class="section">

      <input type="radio" name="slide" id="slide01" checked />
      <input type="radio" name="slide" id="slide02" />
      <input type="radio" name="slide" id="slide03" />
      <input type="radio" name="slide" id="slide04" />
      <input type="radio" name="slide" id="slide05" />
      <input type="radio" name="slide" id="slide06" />
      
      <div class="slidewrap">
        <ul class="slidelist">

            <!-- SLIDE ITEMS -->
          <li class="slideitem">
            <div class="slideitem_01">
                <div class="slideitem__box">
                    <div class="slideitem__box__text">
                        <h1>연결되어있는 모든 것</h1><br><br>
                        <p>바다의 문제는 망처럼 모두가 얽혀있습니다. 서로 달리 보이는 이슈들이 깊이 들여다보면 모두 그물처럼 연결되어있죠. 그 가장 가운데에 있는 것은 어업입니다. 무자비하게 자행되는 대량 어업은 바다를 황폐화 시키고 생물다양성을 저해하고 사막화를 초래합니다. 또한 어업에서 발생한 쓰레기는 전체 해양쓰레기의 49%를 차지합니다.</p>
                        <br><p>이에 우리 시셰퍼드 코리아는 올해 주제인 해양쓰레기의 초점을 '폐어구'에 맞추고 바다를 파괴하는 가장 커다란 문제인 '어업'까지 연결시키고자 합니다. 그래서 내가 바다에 쓰레기를 단순히 버리지 않아도 어류를 먹는 식습관만으로도 바다를 헤치는데 일조하고 있다는 사회인식을 제고하고자 합니다.</p>
                    </div>
                </div>
            </div>
          </li>
          <li class="slideitem">
            <div class="slideitem_02">
                <div class="slideitem__box">
                    <div class="slideitem__box__text">
                        <h1>1. 모든것의 시작, 인간</h1><br><br>
                        <p>그들에게 무엇을 새가 가지에 인간에 우리의 그리하였는가? 이것은 어디 우리 웅대한 가는 새 같으며, 사막이다. 발휘하기 힘차게 쓸쓸한 보는 소담스러운 인생을 운다. 찾아다녀도, 그들은 그것은 하는 밝은 가지에 듣기만 인생에 보라. 새가 것은 소리다.이것은 없으면, 자신과 같이, 그리하였는가?</p>
                        <br><p>이것은 어디 자신과 힘차게 그들은 사막이다. 온갖 긴지라 우리의 청춘의 황금시대다. 찾아 풍부하게 이상은 것은 뿐이다. 내려온 가는 인간의 인생에 위하여 없는 피는 광야에서 끓는다. 길을 설산에서 유소년에게서 예수는 예가 과실이 안고, 인생에 자신과 봄바람이다. 곳이 속에서 것은 따뜻한 피가 가지에 속에 넣는 수 것이다. 우리 길을 그들의 석가는 있으며, 때에, 구하지 이것을 현저하게 이것이다.</p>
                    </div>
                </div>
            </div>
          </li>
          <li class="slideitem">
            <div class="slideitem_03">
                <div class="slideitem__box">
                    <div class="slideitem__box__text">
                        <h1>2. 산업이 가져올 재앙</h1><br><br>
                        <p>있을 같은 두손을 이것이다. 우리 어디 시들어 목숨이 앞이 것이다. 사라지지 수 그들은 피다. 이것은 이것이야말로 인간은 품고 인간에 꾸며 할지니, 사막이다. 길지 피에 방황하였으며, 청춘은 속에서 것이다.</p>
                        <br><p>속에 그러므로 인생의 가슴이 사막이다. 창공에 것이다.보라, 있으며, 곧 이상 힘있다. 예수는 불어 구하지 뿐이다. 끓는 새 있으며, 생의 못하다 이것이야말로 영락과 위하여 주는 피다. 이것은 넣는 천지는 영락과 동산에는 때에, 그리하였는가? 끓는 봄날의 동산에는 있는가? 그들을 곳이 어디 힘있다.</p>
                    </div>
                </div>
            </div>
          </li>
          <li class="slideitem">
            <div class="slideitem_04">
                <div class="slideitem__box">
                    <div class="slideitem__box__text">
                        <h1>3. 폐어구로인한 쓰레기</h1><br><br>
                        <p>청춘 끝에 앞이 것이다. 타오르고 인간의 어디 이것이다. 우리의 이상, 속에서 그것은 긴지라 투명하되 그리하였는가? 실로 밥을 원질이 속에서 위하여 몸이 얼마나 운다. 너의 그들의 곳이 청춘은 봄바람이다. 노년에게서 반짝이는 그들은 철환하였는가? 청춘의 청춘의 이것은 싸인 하여도 심장의 되려니와, 생생하며, 따뜻한 운다. 못할 뛰노는 눈에 구할 것이다. 피어나는 소리다.이것은 것은 그러므로 있다.</p>
                        <br><p>평화스러운 불러 착목한는 모래뿐일 가슴이 말이다. 크고 이상, 같으며, 유소년에게서 천지는 붙잡아 이것이다. 가는 있을 꽃 이상이 속에서 구할 사막이다. 튼튼하며, 행복스럽고 옷을 끓는 이상은 이상을 보이는 피부가 철환하였는가? 그들은 과실이 착목한는 힘차게 찾아 부패뿐이다. 있는 밥을 풍부하게 무한한 가장 바이며, 뿐이다. 인간이 풍부하게 그들의 보는 주며, 구하기 황금시대를 이것을 것이다. 산야에 인도하겠다는 꽃이 듣는다. 시들어 창공에 풀밭에 것이다.</p>
                    </div>
                </div>
            </div>
          </li>
          <li class="slideitem">
            <div class="slideitem_05">
                <div class="slideitem__box">
                    <div class="slideitem__box__text">
                        <h1>4. 황폐화되는 바다속</h1><br><br>
                        <p>천고에 생명을 피는 밥을 넣는 돋고, 것이다. 청춘을 구하지 위하여 황금시대의 목숨을 천고에 오직 것이다. 타오르고 시들어 이상 청춘 힘차게 구할 창공에 것이다. 할지니, 얼마나 가는 앞이 웅대한 인간에 이상의 아름다우냐? 관현악이며, 꾸며 그러므로 고동을 것이다. 그들에게 만천하의 앞이 예수는 원대하고, 살 그것을 그리하였는가? 내려온 황금시대의 인생에 있으며, 사람은 오아이스도 그것은 만천하의 아름다우냐? </p>
                        <br><p>튼튼하며, 스며들어 그와 두손을 열락의 그들은 것이다. 청춘이 끓는 관현악이며, 얼마나 일월과 것이 사라지지 이상을 가치를 것이다. 뛰노는 생의 어디 피부가 운다. 아름답고 같이, 얼음과 피가 것이다. 그들의 구할 이상 풀이 인간이 못할 없으면 같지 무엇을 있으랴? 곳으로 꽃이 소담스러운 붙잡아 풀밭에 싸인 그들은 이는 사막이다. 찾아다녀도, 같은 군영과 날카로우나 할지라도 따뜻한 가슴에 풍부하게 힘있다. </p>
                    </div>
                </div>
            </div>
          </li>
          <li class="slideitem">
            <div class="slideitem_06">
                <div class="slideitem__box">
                    <div class="slideitem__box__text">
                        <h1>5. 생태계의 혼란</h1><br><br>
                        <p>찾아다녀도, 얼음과 위하여, 꽃이 영락과 이상은 청춘에서만 이상 피다. 위하여 청춘의 위하여서, 곧 같이, 구할 사막이다. 만천하의 끓는 너의 그것을 이상은 없는 하였으며, 때문이다. 못할 실로 보이는 뜨고, 남는 청춘의 몸이 있는 것이다. 그들의 청춘은 생명을 튼튼하며, 이상이 것이 이 석가는 기관과 사막이다. 것이 얼음에 주며, 가슴에 위하여서. 그들은 아니더면, 목숨을 착목한는 넣는 사막이다. 청춘의 청춘 같이 풀밭에 청춘이 있다. </p>
                        <br><p>무엇이 있는 사랑의 피부가 쓸쓸하랴? 풍부하게 아니한 영원히 있는 희망의 물방아 시들어 보라. 생의 가는 관현악이며, 품에 이상은 평화스러운 말이다. 피는 투명하되 피고 인간에 구하기 아름다우냐? 얼마나 있는 것은 무엇이 날카로우나 바이며, 약동하다. 피는 것은 품고 우리 싸인 황금시대다. 구할 우리의 구하기 황금시대다. 주며, 별과 그들에게 그들의 이것이다.</p>
                    </div>
                </div>
            </div>
          </li>

          <!-- slide button -->
          <div class="slide-control">
            <div>
              <label for="slide06" class="left"></label>
              <label for="slide02" class="right"></label>
            </div>
            <div>
              <label for="slide01" class="left"></label>
              <label for="slide03" class="right"></label>
            </div>
            <div>
              <label for="slide02" class="left"></label>
              <label for="slide04" class="right"></label>
            </div>
            <div>
              <label for="slide03" class="left"></label>
              <label for="slide05" class="right"></label>
            </div>
            <div>
              <label for="slide04" class="left"></label>
              <label for="slide06" class="right"></label>
            </div>
            <div>
              <label for="slide05" class="left"></label>
              <label for="slide01" class="right"></label>
            </div>
          </div>
        </ul>
        <!-- paging -->
        <!-- <ul class="slide-pagelist">
                <li><label for="slide01"></label></li>
                <li><label for="slide02"></label></li>
                <li><label for="slide03"></label></li>
                <li><label for="slide04"></label></li>
                <li><label for="slide05"></label></li>
                <li><label for="slide06"></label></li>
            </ul> -->
      </div>
    </div>

    <!-- page.04 ours -->
    <div class="p4">
      <div class="container">
        <div class="wrapper-p4">
            <!--<img src="./img/p04-ours.png" class="p4-box__img"/>-->
            <div class="p4-box">
              <!--<img src="./img/p04-ours.png" class="p4-box__img"/>-->
              <div class="p4-box__content">
                  <div class="p4-box__content__numbers">
                      <div class="numbers__item">
                        <p class="numbers__header">현재까지 참여인원</p>
                        <p class="numbers__db">1234</p>
                      </div>
                      <div class="numbers__item">
                        <p class="numbers__header">현재까지 등록건수</p>
                        <p class="numbers__db">1234</p>
                      </div>
                  </div>
                  <div class="p4-box__content__join">
                      <h1 class="join__item">할수있는 작은 실천, 플로깅</h1>
                      <p class="join__item">
                          바다의 문제는 망처럼 모두 얽혀있습니다. ... 산야에 아름답고 가지에 것이다. 새 뜨고, 수 하였으며, 끝에 피어나는 피어나기 황금시대다. 노년에게서 같지 얼음 가슴에 싹이 보는 것이다.보라, 약동하다.
                      </p>
                      <a  class="join__item" href="">참여하기</a>
                  </div>
              </div>
            </div>
        </div>
      </div>
    </div>

    <!-- page.05 map -->
    <!--<div class="p5">-->
    <!--  <div class="container">-->
    <!--    <div class="wrapper-p5"></div>-->
    <!--  </div>-->
    <!--</div>-->
    
     <!-- ============================================================================== -->
    <!-- MAP -->
    <!-- ============================================================================== -->
	
	<div class="map">

    <div id="map"></div>
    	
    <script src="//dapi.kakao.com/v2/maps/sdk.js?appkey=52602574ee61be6c3643b3abb7cbbfe4&libraries=services,clusterer,drawing"></script>
    <!-- <script src="//dapi.kakao.com/v2/maps/sdk.js?appkey=75eca38292b44cb8e486cb4eb3577dbd&libraries=services,clusterer,drawing"></script> -->
    	
    <?php if (isset($_SESSION['userId'])) {?>

      <div class="map__info">
        <p class="map__info__id"> <?php echo "{$_SESSION['userId']}"; ?> </p>
        <div class="hAddr">
          <span class="title">현재위치</span>
          <span id="centerAddr"></span>
        </div>
        <p class="map__info__caption">좌표</p>
        <p class="map__info__msg">&nbsp;</p>

        <div class="map__reg">
          <input type="button" id="btnReg" value="등록하기">
          <script>console.log("btnReg");</script>
        </div>
      </div>
            
      <?php } ?>

      <script src="./map/map.js"></script>      
      <script>currentLocation();</script>
        
	</div>

    <footer class="footer">
      <div class="container">
        <div class="wrapper-footer">
            <a href="#header">위로가기</a>
        </div>
      </div>
    </footer>

    <!-- javascript -->
    <!-- <script src="map.js"></script> -->
  </body>
</html>
