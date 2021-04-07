<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/board.css">
    <link rel="icon" href="images/favicon%20(1).ico" type="image/x-icon">
    <meta name="viewport" content="initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <title>꿈을 향한 첫걸음</title>
    <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
    <script type="text/java script" src="https://maps.googleapis.com/maps/api/js? sensor=true"></script>
</head>

<body>
    <?php 
            session_start(); 
            include ("connect.php");
            $con = dbconn();
            $result = mysqli_query($con, "SELECT * FROM test");
    
            if($_COOKIE['menu'] == '1') {
                echo '<script>
                
                $(document).ready(function() {
                onloada();
                });

                </script>';
                setcookie('menu','0','0','/');
                
            } 
            if($_COOKIE['menu'] == '2') {
                echo '<script>
                
                $(document).ready(function() {
                onloada2();
                });
                
                </script>';
                setcookie('menu','0','0','/');
            }
            if($_COOKIE['lg'] == '1') {
                echo '<script>
                
                $(document).ready(function() {
                onloada3();
                });

                </script>';
                setcookie('lg','0','0','/');
                
            }
            if($_COOKIE['lg'] == '2') {
                echo '<script>
                
                $(document).ready(function() {
                onloada4();
                });

                </script>';
                setcookie('lg','0','0','/');
                
            } 

        ?>
    <div class="menu">
        <div id="gnb">
            <ul>
                <li class="menu1">
                    <a>강상원</a>
                    <div class="underbar1"></div>
                    <div class="opcity_zero"></div>
                    <dl class="dropdown2">
                        <dd><a onclick="vision();">Vision</a></dd>
                        <dd><a onclick="history();">History</a></dd>
                        <dd><a onclick="facebook_api();">Facebook</a></dd>
                        <dd><a onclick="map_api();">Map</a></dd>
                    </dl>
                </li>
                <li class="menu2">
                    <a onclick="home();">홈</a>
                    <div class="underbar2"></div>
                </li>
                <li class="menu3">
                    <a>게시판</a>
                    <div class="underbar3"></div>
                    <dl class="dropdown">
                        <dd><a role="button" onclick="menu_notice();">공지사항</a></dd>
                        <dd><a role="button" onclick="menu_free();">자유게시판</a></dd>
                        <dd><a role="button" onclick="menu_qna();">방명록</a></dd>
                    </dl>
                </li>
            </ul>
        </div>
        <div id="user_menu">
            <?php
                if(!isset($_SESSION['user_id']) || !isset($_SESSION['name'])) {
                    echo '<p id="logina">로그인</p> <p id="registera">회원가입</p>';
                }else { 
                    $name = $_SESSION['name'];
                    echo '<a id="logouta" href="logout.php">로그아웃<a>';
                    echo '<a id="helloa"><strong>'.$name.'</strong>님 환영합니다.</a>';
                } 
                ?>
        </div>
    </div>

    <div class="content">

        <div class="inner">
            <img src="images/board.png">
            <div class="notice_board">
                <p>공지사항</p>
                <div class="notice_list">
                    <nav>
                       <ul class="im">
                           <li style="width:150px;">
                               No.
                           </li>
                           <li style="width:150px;">
                               작성자
                           </li>
                           <li style="width:150px;">
                               제목
                           </li>
                           <li style="width:150px;">
                               조회수
                           </li>
                       </ul>
                        <ol>
                           <div class="in_load">
                            <?php
                                    while($row = mysqli_fetch_assoc($result)){
                                        $strim = mb_strimwidth($row['title'],'0','20','...','utf-8');
                                        echo '<ul class="load_story"><li style="width:150px; text-align:center;">'.$row['no'].'</li><li style="width:150px; text-align:center;">'.$row['user_id'].'<li>';
                                        echo '<li style="width:150px; margin-left:10px;"><a class="load_story_a" href="http://nekst.co.kr/in_story.php?no='.$row['no'].'">'.$strim.'</a></li><li style="width:150px; text-align: center; margin-left:-10px;">'.$row['hit'].'</li></ul>';
                                        echo "<br/>";
                                    }
                                ?>
                            </div>
                        </ol>
                    </nav>

                    <input onclick="login_check();" class="notice_go_write" type="button" name="notice_go_write" value="글쓰기" />
                </div>
                <div class="notice_write">
                    <form name="notice_writer" action="write_no.php" method="post">
                        <input class="title" type="text" name="title" placeholder="제목">
                        <TEXTAREA class="story" name="story" placeholder="내용"></TEXTAREA>
                        <input type="button" value="뒤로" class="no_back_list" onclick="no_back_list();" />
                        <input class="write_button" type="submit" value="입력" style="font-family: 'Noto Sans KR', sans-serif;" />
                    </form>
                </div>
            </div>
            <div class="free_board">
                <p>자유게시판</p>
                <div class="free_list">
                    <nav>
                       <ul class="im">
                           <li style="width:150px;">
                               No.
                           </li>
                           <li style="width:150px;">
                               작성자
                           </li>
                           <li style="width:150px;">
                               제목
                           </li>
                           <li style="width:150px;">
                               조회수
                           </li>
                       </ul>
                        <ol>
                           <div class="in_load">
                            <?php
                                    $result2 = mysqli_query($con, "SELECT * FROM board2");
                                    while($row2 = mysqli_fetch_assoc($result2)){
                                        $strim = mb_strimwidth($row2['title'],'0','20','...','utf-8');
                                        echo '<ul class="load_story"><li style="width:150px; text-align:center;">'.$row2['no'].'</li><li style="width:150px; text-align:center;">'.$row2['user_id'].'<li>';
                                        echo '<li style="width:150px; margin-left:10px;"><a class="load_story_a" href="http://nekst.co.kr/in_story_fr.php?no='.$row2['no'].'">'.$strim.'</a></li><li style="width:150px; text-align: center; margin-left:-10px;">'.$row2['hit'].'</li></ul>';
                                        echo "<br/>";
                                    }
                                ?>
                            </div>
                        </ol>
                    </nav>
                    <input onclick="login_check2();" class="notice_go_write" type="button" name="notice_go_write" value="글쓰기" />
                </div>
                <div class="free_write">
                    <form name="notice_writer" action="write_fr.php" method="post">
                        <input class="title" type="text" name="title" placeholder="제목">
                        <TEXTAREA class="story" name="story" placeholder="내용"></TEXTAREA>
                        <input type="button" value="뒤로" class="no_back_list" onclick="fr_back_list();" />
                        <input class="write_button" type="submit" value="입력" style="font-family: 'Noto Sans KR', sans-serif;" />
                    </form>
                </div>
            </div>
            <div class="QnA_board">
                <p>방명록</p>
                <div>
                    <div id="disqus_thread" style="width:90%; height: 540px; margin: auto; overflow-y: scroll; margin-top: -50px;"></div>
                    <script>
                        /**
                         *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                         *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
                        /*
                        var disqus_config = function () {
                        this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
                        this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                        };
                        */
                        (function() { // DON'T EDIT BELOW THIS LINE
                            var d = document,
                                s = d.createElement('script');
                            s.src = 'https://ksw-prof.disqus.com/embed.js';
                            s.setAttribute('data-timestamp', +new Date());
                            (d.head || d.body).appendChild(s);
                        })();

                    </script>
                    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                </div>
            </div>
        </div>

        <div class="home_home">
            <div class="wise">
                <img src="/images/vision.png">
            </div>
            <div class="one-box">
            </div>
            <div class="two-box">
            <img src="images/notice.png">
            </div>
            <div class="three-box">
            <img src="images/vision_img.png">
            </div>
        </div>

        <div class="ksw">
            <img src="images/board.png">
            <div class="vision">
                <p class="big">Vision</p>
                <div class="vision_inner">
                    <img class="vision_img" src="images/google-959059_640.jpg">
                    <img src="images/work-731198_640.jpg" class="vision_img2">
                    <p>안녕하세요. 강상원입니다.<br><br> 저의 비전에 관해 간략히 설명하자면, 일단 저의 인생의 궁극적인 목표는 <br>저의 행위로 다수의 사람들에게 긍정적인 영향을 끼치는 것입니다.<br><br>그리하여 저는 고등학교와 대학교를 거쳐서<br>공동 작업, 회사의 구조등을 파악하기 위해 먼저 취직을 하려합니다.ex)구글<br> 그 이후 경력을 쌓은 후,IT계열로의 스타트업을 도전하여 천천히 자금을 모아 <br>투자쪽으로 사업을 확장한 이후 사회적인 명성과 자금을 확보하려 합니다.<br><br>마지막으로는 정치계로 입문해 국회의원을 역임하고 <br> 교육부 장관까지 다다르는 것이 저의 최종적 목표입니다.<br><br>저는 한번 뿐인 인생 즐겁고, 다이나믹하고, 글로벌하게 살아야<br> 의미가 있는 삶이 아닌가 생각해 왔기에<br> 저는 타인과는 다르게 전세계를 바꾸는 인생을 사려고 합니다.<br><br>감사합니다.</p>
                </div>
            </div>
            <div class="history">
                <p class="big">History</p>
                <div class="history_inner">
                    <p>안녕하세요. 강상원입니다.<br><br>저는 2002년, 안양에서 태어나 안양동초등학교를 입학한 후,<br> 군포시의 흥진초등학교로 전학을 왔습니다.<br><br>그리고 흥진중학교로 진학하여 방송부 엔지니어, 학생회 영상편집부,<br>IT동아리 기장을 역임하며 입지를 확보하였고,<br><br> 그 외의 활동에도 동아리 사이트 제작, 팀 SPT소속으로 앱제작, <br> 취미로 게임 개발, 영상편집, 프로그래밍 등 여러 활동을 하였습니다.<br>현재는 공부에 취미를 두고 공부에 매진하고 있습니다.<br><br>전 어릴때부터 컴퓨터를 스스로 다루어 오면서<br>게임개발, 프로그래밍 등에 자연스럽게 접하게 되었고<br>다른 아이들보다 더 능숙하게 컴퓨터를 다룰 수 있게 되었습니다.<br><br>이상 저의 자랑아닌 자랑이였습니다. 감사합니다.</p>
                    <img class="history_img" src="images/me.PNG">
                </div>
            </div>
            <div class="facebook">
                <p class="big">Facebook_API</p>
                <div class="facebook_inner">
                    <div class="face_div"></div>
                    <p>흥진중 IT동아리 NULL</p>
                    <div class="facebook_page">
                        <div class="fb-page" data-href="https://www.facebook.com/hjnull/" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-width="550" data-height="470">
                            <blockquote cite="https://www.facebook.com/hjnull/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/hjnull/">NULL</a></blockquote>
                        </div>
                    </div>
                </div>
            </div>
            <div class="naver">
                <p class="big">Map</p>
                <div id="map" style=" margin:auto; margin-top:-30px;width:530px; height:500px;"></div>
            </div>
        </div>
    </div>

    <div class="blackbar"></div>

    <div class="wrap">
        <div class="login">
            <p class="login_form_text">LOGIN</p>
            <form method="post" action="login.php">
                <div clSass="logintext id_bt">
                    <input placeholder="ID" class="id_input" type="text" name="user_id" />
                </div>
                <div class="logintext pw_bt">
                    <input placeholder="PASSWORD" class="pw_input" type="password" name="pw" />
                </div>
                <input class="submit_bt" type="submit" value="LOGIN" style="font-family: 'Noto Sans KR', sans-serif;" />
            </form>
        </div>
        <div class="register">
            <p class="login_form_text">REGISTER</p>
            <form action="register.php" method="post">
                <div class="registertext name_bt">
                    <input placeholder="Name" class="name_input" type="text" name="name" />
                </div>
                <div class="registertext id_bt2">
                    <input placeholder="ID" class="id_input2" type="text" name="user_id" />
                </div>
                <div class="registertext pw_bt2">
                    <input placeholder="PASSWORD" class="pw_input2" type="password" name="pw" />
                </div>
                <div class="registertext repw_bt">
                    <input placeholder="PASSWORD" class="repw_input" type="password" name="repw" />
                </div>
                <div class="registertext memo_bt">
                    <input placeholder="Memo" class="memo_input" type="text" name="memo" />
                </div>
                <input class="submit_bt2" type="submit" value="REGISTER" style="font-family: 'Noto Sans KR', sans-serif;" />
            </form>
        </div>
    </div>
    <script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=6KQs7FCTORCcp9N9le3n&submodules=geocoder"></script>
    <script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=6KQs7FCTORCcp9N9le3n&callback=CALLBACK_FUNCTION"></script>
    <script>/*   
      var map = new naver.maps.Map('map');
      var myaddress = '경기 군포시 오금로 118 군포고등학교';// 도로명 주소나 지번 주소만 가능 (건물명 불가!!!!)
      naver.maps.Service.geocode({address: myaddress}, function(status, response) {
          if (status !== naver.maps.Service.Status.OK) {
              return alert(myaddress + '의 검색 결과가 없거나 기타 네트워크 에러');
          }
          var result = response.result;
          // 검색 결과 갯수: result.total
          // 첫번째 결과 결과 주소: result.items[0].address
          // 첫번째 검색 결과 좌표: result.items[0].point.y, result.items[0].point.x
          var myaddr = new naver.maps.Point(result.items[0].point.x, result.items[0].point.y);
          map.setCenter(myaddr); // 검색된 좌표로 지도 이동
          // 마커 표시
          var marker = new naver.maps.Marker({
            position: myaddr,
            map: map,
            mapTypeControl: true,
            zoomControl: true
          });
          // 마커 클릭 이벤트 처리
          naver.maps.Event.addListener(marker, "click", function(e) {
            if (infowindow.getMap()) {
                infowindow.close();
            } else {
                infowindow.open(map, marker);
            }
          });
          // 마크 클릭시 인포윈도우 오픈
          var infowindow = new naver.maps.InfoWindow({
              content: '<h4> [네이버 개발자센터]</h4><a href="https://developers.naver.com" target="_blank"><img src="https://developers.naver.com/inc/devcenter/images/nd_img.png"></a>'
          });
      });  */
        
        function onloada() {
            $(".inner").css("display", "block");
            $(".notice_list").css("display", "block");
            $(".notice_story").css("display", "none");
            $(".notice_board").css("display", "block");
            $(".free_board").css("display", "none");
            $(".QnA_board").css("display", "none");
            $(".home_home").css("display", "none");
            $(".history").css("display", "none");
            $(".vision").css("display", "none");
            $(".ksw").css("display", "none");
            $(".facebook").css("display", "none");
            $(".naver").css("display", "none");
        }
        
        function onloada2() {
            $(".inner").css("display", "block");
            $(".notice_list").css("display", "none");
            $(".free_list").css("display", "block");
            $(".notice_board").css("display", "none");
            $(".free_board").css("display", "block");
            $(".QnA_board").css("display", "none");
            $(".home_home").css("display", "none");
            $(".history").css("display", "none");
            $(".vision").css("display", "none");
            $(".ksw").css("display", "none");
            $(".facebook").css("display", "none");
            $(".naver").css("display", "none");
        }
        
        function onloada3() {
            $(".blackbar").css({
                "display": "block",
                "opacity": "1"
            });
            $(".login").css("display", "block");
            $(".wrap").css({
                "display": "block",
                "height": "400px",
                "margin-top": "0",
                "opacity": "1"
            });
        }
        
        function onloada4() {
            $(".blackbar").css({
                "display": "block",
                "opacity": "1"
            });
            $(".register").css("display", "block");
            $(".wrap").css({
                "display": "block",
                "height": "550px",
                "margin-top": "0",
                "opacity": "1"
            });
        }
        
        
        $("#logina").click(function() {
            $(".blackbar").css("display", "block");
            $(".blackbar").animate({
                "opacity": "1"
            }, 500);
            $(".login").css("display", "block");
            $(".register").css("display", "none");
            $(".wrap").css({
                "display": "block",
                "height": "400px",
                "margin-top": "100px"
            });
            $(".wrap").animate({
                'marginTop': '0',
                "opacity": "1"
            }, 300);
        });

        $("#registera").click(function() {
            $(".blackbar").css("display", "block");
            $(".blackbar").animate({
                "opacity": "1"
            }, 500);
            $(".register").css("display", "block");
            $(".login").css("display", "none");
            $(".wrap").css({
                "display": "block",
                "height": "550px",
                "margin-top": "100px"
            });
            $(".wrap").animate({
                'marginTop': '0px',
                "opacity": "1"
            }, 300);

        });

        $(".blackbar").click(function() {
            $(".blackbar").animate({
                "opacity": "0"
            }, 500);

            $(".blackbar").promise().done(function() {
                $(".blackbar").css("display", "none");
            });

            $(".wrap").animate({
                'marginTop': '100px',
                "opacity": "0"
            }, 300);

            $(".blackbar").promise().done(function() {
                $(".wrap").css("display", "none");
            });
        });

        function menu_free() {
            $(".inner").css("display", "block");
            $(".free_board").css("display", "block");
            $(".free_list").css("display", "block");
            $(".notice_board").css("display", "none");
            $(".QnA_board").css("display", "none");
            $(".home_home").css("display", "none");
            $(".history").css("display", "none");
            $(".vision").css("display", "none");
            $(".ksw").css("display", "none");
            $(".facebook").css("display", "none");
            $(".naver").css("display", "none");
        }

        function menu_notice() {
            $(".inner").css("display", "block");
            $(".notice_list").css("display", "block");
            $(".notice_board").css("display", "block");
            $(".free_board").css("display", "none");
            $(".QnA_board").css("display", "none");
            $(".home_home").css("display", "none");
            $(".history").css("display", "none");
            $(".vision").css("display", "none");
            $(".ksw").css("display", "none");
            $(".facebook").css("display", "none");
            $(".naver").css("display", "none");
        }

        function menu_qna() {
            $(".inner").css("display", "block");
            $(".QnA_board").css("display", "block");
            $(".notice_board").css("display", "none");
            $(".free_board").css("display", "none");
            $(".home_home").css("display", "none");
            $(".history").css("display", "none");
            $(".vision").css("display", "none");
            $(".ksw").css("display", "none");
            $(".facebook").css("display", "none");
            $(".naver").css("display", "none");
        }

        function home() {
            $(".inner").css("display", "none");
            $(".QnA_board").css("display", "none");
            $(".free_board").css("display", "none");
            $(".notice_board").css("display", "none");
            $(".home_home").css("display", "block");
            $(".history").css("display", "none");
            $(".vision").css("display", "none");
            $(".ksw").css("display", "none");
            $(".facebook").css("display", "none");
            $(".naver").css("display", "none");
        }

        function map_api() {
            $(".inner").css("display", "none");
            $(".free_board").css("display", "none");
            $(".notice_board").css("display", "none");
            $(".QnA_board").css("display", "none");
            $(".home_home").css("display", "none");
            $(".history").css("display", "none");
            $(".vision").css("display", "none");
            $(".ksw").css("display", "block");
            $(".facebook").css("display", "none");
            $(".naver").css("display", "block");
        }
        
        $(".two-box").click(function() {
            $(".inner").css("display", "block");
            $(".notice_list").css("display", "block");
            $(".notice_board").css("display", "block");
            $(".free_board").css("display", "none");
            $(".QnA_board").css("display", "none");
            $(".home_home").css("display", "none");
            $(".history").css("display", "none");
            $(".vision").css("display", "none");
            $(".ksw").css("display", "none");
            $(".facebook").css("display", "none");
            $(".naver").css("display", "none"); 
        });
        
        $(".three-box").click(function() {
            $(".vision").css("display", "block");
            $(".history").css("display", "none");
            $(".ksw").css("display", "block");
            $(".inner").css("display", "none");
            $(".QnA_board").css("display", "none");
            $(".free_board").css("display", "none");
            $(".notice_board").css("display", "none");
            $(".home_home").css("display", "none");
            $(".facebook").css("display", "none");
            $(".naver").css("display", "none");

            $(".vision_img").css({
                "display": "block",
                "margin-top": "150px"
            });
            $(".vision_img").animate({
                'marginTop': '30',
                "opacity": "1"
            }, 300);

            $(".history img").css({
                "display": "none",
                "opacity": "0"
            });

            $(".vision_img2").css({
                "display": "block",
                "margin-top": "150px"
            });
            $(".vision_img2").animate({
                'marginTop': '30',
                "opacity": "1"
            }, 300);
        });

        function vision() {
            $(".vision").css("display", "block");
            $(".history").css("display", "none");
            $(".ksw").css("display", "block");
            $(".inner").css("display", "none");
            $(".QnA_board").css("display", "none");
            $(".free_board").css("display", "none");
            $(".notice_board").css("display", "none");
            $(".home_home").css("display", "none");
            $(".facebook").css("display", "none");
            $(".naver").css("display", "none");

            $(".vision_img").css({
                "display": "block",
                "margin-top": "150px"
            });
            $(".vision_img").animate({
                'marginTop': '30',
                "opacity": "1"
            }, 300);

            $(".history img").css({
                "display": "none",
                "opacity": "0"
            });

            $(".vision_img2").css({
                "display": "block",
                "margin-top": "150px"
            });
            $(".vision_img2").animate({
                'marginTop': '30',
                "opacity": "1"
            }, 300);
        }

        function history() {
            $(".history").css("display", "block");
            $(".vision").css("display", "none");
            $(".facebook").css("display", "none");
            $(".ksw").css("display", "block");
            $(".inner").css("display", "none");
            $(".QnA_board").css("display", "none");
            $(".free_board").css("display", "none");
            $(".notice_board").css("display", "none");
            $(".home_home").css("display", "none");
            $(".naver").css("display", "none");
            
            $(".history img").css({
                "display": "block",
                "margin-top": "-20px"
            });
            $(".history img").animate({
                'marginTop': '-130px',
                "opacity": "1"
            }, 300);
            $(".vision_img").css({
                "display": "none",
                "opacity": "0"
            });
            $(".vision_img2").css({
                "display": "none",
                "opacity": "0"
            });
        }

        function facebook_api() {
            $(".history").css("display", "none");
            $(".vision").css("display", "none");
            $(".facebook").css("display", "block");
            $(".ksw").css("display", "block");
            $(".inner").css("display", "none");
            $(".QnA_board").css("display", "none");
            $(".free_board").css("display", "none");
            $(".notice_board").css("display", "none");
            $(".home_home").css("display", "none");
            $(".naver").css("display", "none");
            $(".vision_img").css({
                "display": "none",
                "opacity": "0"
            });
            $(".vision_img2").css({
                "display": "none",
                "opacity": "0"
            });
            $(".history img").css({
                "display": "none",
                "opacity": "0"
            });
        }

        function no_back_list() {
            $(".notice_list").css("display", "block");
            $(".notice_write").css("display", "none");
        }
        
        function fr_back_list() {
            $(".free_list").css("display", "block");
            $(".free_write").css("display", "none");
        }

        function login_check() {
            var request = "request"
            $.ajax({
                type: "POST",
                url: "/write.php",
                data: request,
                success: function(data) {
                    $(".notice_list").css("display", "none");
                    $(".notice_write").css("display", "block");
                },
                error: function(xhr, status, error) {
                    alert("로그인 후에 이용해주세요.");
                }
            });
        }
        
        function login_check2() {
            var request = "request"
            $.ajax({
                type: "POST",
                url: "/write.php",
                data: request,
                success: function(data) {
                    $(".free_list").css("display", "none");
                    $(".free_write").css("display", "block");
                },
                error: function(xhr, status, error) {
                    alert("로그인 후에 이용해주세요.");
                }
            });
        }

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/ko_KR/sdk.js#xfbml=1&version=v2.10&appId=222275151594219';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
        
    </script>
    <div class="footer">
        <p><!--주소:
            <a href="https://www.google.co.kr/maps/place/경기도+군포시+금정동+875-6/@37.3532136,126.924803,15.54z/data=!4m13!1m7!3m6!1s0x357b67a0a1f89c71:0x8a6769f1bb758287!2z6rK96riw64-EIOq1sO2PrOyLnCDquIjsoJXrj5kgODc1LTY!3b1!8m2!3d37.3529873!4d126.92855!3m4!1s0x357b67a0a1f89c71:0x8a6769f1bb758287!8m2!3d37.3529873!4d126.92855?hl=ko">
                <font color="#4B4B4B" onmouseover="this.style.color='#FF0000'" onmouseout="this.style.color='#4B4B4B'">경기도 군포시 금정동 875-6</font>-->
            </a> I 대표전화:
            <a href="tel:010-4013-3263">
                <font color="#4B4B4B" onmouseover="this.style.color='#FF0000'" onmouseout="this.style.color='#4B4B4B'">010-4013-3263</font>
            </a> I 이메일:
            <a href="mailto:eksovus@gmail.com">
                <font color="#4B4B4B" onmouseover="this.style.color='#FF0000'" onmouseout="this.style.color='#4B4B4B'">eksovus@gmail.com</font>
            </a>
        </p>
        <p>Copyright ⓒ 강상원 All Right Reserved.</p>
    </div>
</body>

</html>
