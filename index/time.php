<!doctype html>
<html lang="en">
  <head>
  
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="../index/my1.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
    <script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="jqueryui/style.css">
    <title>抬槓</title>
    <link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
    <script>
            var num=["1","2","3","4"];
            var i=0;
            var time;
            var time2; //算時間
            var second; //數秒數
            var done=0; //結束秒數
            var temp=0; //暫存下面還要有多久
            var oh=0;

            window.onload= view();

            function count(){ //數時間到 換頁 
                second=((new Date()).getSeconds()+60)%60; //現在秒數
                if( second<done ){
                    time2=setTimeout(function(){count()},1000);
                }else{
                    right();
                }
            }

           function lest(){
                done=((new Date()).getSeconds()+65)%60; //換頁秒數
                count();
                oh=0;
                go();
                i=(i-1+4)%4;
                document.getElementById('change').src="../index/image/test"+num[i]+".jpg";
                // time=setTimeout(function(){next()},2000);
            }
            function next(){
                done=((new Date()).getSeconds()+65)%60; //換頁秒數
                count();
                oh=0;
                go();
                i=(i+1+4)%4;
                document.getElementById('change').src="../index/image/test"+num[i]+".jpg";
                // time=setTimeout(function(){next()},2000);
            }
            
            function view(){
                done=((new Date()).getSeconds()+65)%60;
                count();
                //進度條
                go();
            }
            function stop(){ //停止倒數
                clearTimeout(time2);
                clearTimeout(time);
                clearTimeout(time3);
            }
            //右翻
            function right(){
                stop();
                next();
            }
            //左翻
            function left(){
                stop();
                lest();
            }
            //剩餘秒數
            function subtraction(){
                if(done>second){
                    temp=done-second;
                }else{
                    temp=second-done;
                }
            }
            function pro(){
                oh=(5-temp)*20;
            }

            const status = document.querySelector('.status');
            //按下去
            document.addEventListener('mousedown', down);
            function down(e) {
                subtraction();
                stop();
                pro();
                status.textContent = `${e.buttons} (mousedown)`;
            }
            //放開
            document.addEventListener('mouseup', up);
            function up(e) {
                done=((new Date()).getSeconds()+60 +temp)%60;
                count();
                //進度條
                go();
                status.textContent = `${e.buttons} (mouseup)`
            }
            //輸入文字時暫停
            function input(){
                subtraction();
                stop();
                pro();
            }
            //傳送後繼續
            function enter(){
                done=((new Date()).getSeconds()+60 +temp)%60;
                count();
                go();
            }
            //進度條
            function go(){
                $(function() {
                    var progressbar = $( "#progressbar" ),
                    progressLabel = $( ".progress-label" );
                
                    progressbar.progressbar({
                    value: false,
                    change: function() {
                        
                    },
                    complete: function() {
                        
                    }
                    });
                
                    function progress() {
                    
                    var val = progressbar.progressbar( "value" ) || oh;
                
                    progressbar.progressbar( "value", val + 1 );
                
                        if ( val < 99 ) {
                            time=setTimeout( progress, 50 );
                        }
                    }
                
                    time3=setTimeout( progress, 0000 );
                });
            }
        </script>
  </head>
  <body>
    <div class="view">
        <!-- head -->
        <div class="time-head">
            <div id="progressbar"><div class="progress-label"></div></div>
                <div class="row justify-content-start mid">
                    <div class="col-lg-2 col-md-3 col-sm-4 col-4">
                        <div class="user-con">
                            <img src="../index/image/test1.jpg" id="user-pic">
                        </div>
                    </div>
                    <div class="col-lg-10 col-md-9 col-sm-8 col-8 p0">
                        <p class="time-ww">匿名</p>
                        <p class="time-ww">2020年5月28日 1:11</p>
                    </div>
                    <button type="button" class="close">
                        <a href="../index/index.php" class="link-ww">
                            <span aria-hidden="true">&times;</span>
                        </a>
                    </button>
                </div>
        </div>
        <!-- body -->
        <div class="time-body status">
            <div class="row justify-content-start">
                <div class="col-md-12 body-con">
                    <button type="button" class="btn btn-light left" onclick="left()">◀</button>
                    <div class="share-con">
                        <img src="../index/image/test1.jpg" id="change" class="share-pic">
                    </div>
                    <button type="button" class="btn btn-light right" onclick="right()">▶</button>
                </div>
            </div>
        </div>
        <!-- footer -->
        <div class="time-footer">
            <form action="" method="post" style="">
                <!-- emoji -->
                <div class="row justify-content-center"> 
                    <div class="col-md-8 col-sm-8 col-8 p0 emoji">
                        <div class="row justify-content-center">
                            <div class="col-md-2 col-sm-2 col-2 p0">
                                <div class="pointer" id="laugh">😂</div>
                            </div>
                            <div class="col-md-2 col-sm-2 col-2 p0">
                                <div class="pointer" id="wow">😮</div>
                            </div>
                            <div class="col-md-2 col-sm-2 col-2 p0">
                                <div class="pointer" id="cry">😢</div>
                            </div>
                            <div class="col-md-2 col-sm-2 col-2 p0">
                                <div class="pointer" id="love">🥰</div>
                            </div>
                            <div class="col-md-2 col-sm-2 col-2 p0">
                                <div class="pointer" id="clap">👏</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-3 p0 r">
                        <p class="good-ww">20000</p>
                    </div>

                    <img src="../index/image/good-white.png" class="good pointer" onmouseout="this.src='../index/image/good-white.png';" onmouseover="this.src='../index/image/good-black.png';"/>

                </div>
                <!-- emoji end-->
                <div class="row justify-content-start">
                    <div class="col-md-10 col-sm-8 col-8 p0">
                        <input id="time-ww" type="text" placeholder='說點什麼吧...' onclick="input();">
                    </div>
				    <div class="col-md-2 col-sm-4 col-4 p0">
                        <div type="submit" class="time-btn" onclick="enter();">傳送</div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        var laugh = '\u{1F602}'; //笑
        var wow = '\u{1F62E}'; //哇
        var cry = '\u{1F622}'; //哭
        var love = '\u{1F970}'; //愛
        var clap = '\u{1F44F}'; //拍手
        var good = '\u{1F44D}'; //按讚

        document.getElementById("laugh").innerHTML = laugh;
        document.getElementById("wow").innerHTML = wow;
        document.getElementById("cry").innerHTML = cry;
        document.getElementById("love").innerHTML = love;
        document.getElementById("clap").innerHTML = clap;
        document.getElementById("good").innerHTML = good;
    </script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>