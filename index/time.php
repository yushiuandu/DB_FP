<!doctype html>
<html lang="en">
  <head>
  
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="../index/my1.css" rel="stylesheet" type="text/css">

    <title>抬槓</title>
	<script src="//s3-ap-northeast-1.amazonaws.com/justfont-user-script/jf-60019.js"></script>
    <script src="//s3-ap-northeast-1.amazonaws.com/justfont-user-script/jf-60019.js"></script>
    <script>
            var num=["1","2","3","4"];
            var i=0;
            var time;
            var time2; //算時間
            var second; //數秒數
            var done=0; //結束秒數
            var temp=0; //暫存下面還要有多久

            window.onload= view();

            function count(){ //數到時間到 換頁 
                second=((new Date()).getSeconds()+60)%60; //現在秒數
                if( second<done ){
                    time2=setTimeout(function(){count()},1000);
                }else{
                    next();
                }
            }

           function lest(){
                done=((new Date()).getSeconds()+63)%60; //換頁秒數
                count();
                i=(i-1+4)%4;
                document.getElementById('change').src="../index/image/test"+num[i]+".jpg";
                // time=setTimeout(function(){next()},2000);
            }
            function next(){
                done=((new Date()).getSeconds()+63)%60; //換頁秒數
                count();
                i=(i+1+4)%4;
			    document.getElementById('change').src="../index/image/test"+num[i]+".jpg";
                // time=setTimeout(function(){next()},2000);
            }
            
            function view(){
                done=((new Date()).getSeconds()+63)%60;
                count();
                // time=setTimeout(function(){next()},2000);
            }
            function stop(){
                clearTimeout(time2);
            }

            function right(){
                stop();
                next();
            }
            function left(){
                stop();
                lest();
            }
            function subtraction(){
                if(done>second){
                    temp=done-second;
                }else{
                    temp=second-done;
                }
            }

            const status = document.querySelector('.status');
            //按下去
            document.addEventListener('mousedown', down);
            function down(e) {
                subtraction();
                stop();
                status.textContent = `${e.buttons} (mousedown)`;
            }
            //放開
            document.addEventListener('mouseup', up);
            function up(e) {
                done=((new Date()).getSeconds()+60 +temp)%60;
                count();
                status.textContent = `${e.buttons} (mouseup)`
            }
        </script>
  </head>
  <body>
    <div class="view">
        <!-- head -->
        <div class="time-head">
            <div>123123</div>
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
                <div class="emoji">
                    <div class="row justify-content-center">
                        <div class="col-md-2 col-sm-2 col-2">
                            <div class="pointer" id="laugh">😂</div>
                        </div>
                        <div class="col-md-2 col-sm-2 col-2">
                            <div class="pointer" id="wow">😮</div>
                        </div>
                        <div class="col-md-2 col-sm-2 col-2">
                            <div class="pointer" id="cry">😢</div>
                        </div>
                        <div class="col-md-2 col-sm-2 col-2">
                            <div class="pointer" id="love">🥰</div>
                        </div>
                        <div class="col-md-2 col-sm-2 col-2">
                            <div class="pointer" id="clap">👏</div>
                        </div>
                        <div class="col-md-2 col-sm-2 col-2">
                            <div class="pointer" id="hundred">💯</div>
                        </div>
                    </div>
                </div>
				<input id="time-ww" type="text" placeholder='說點什麼吧...'>
				<button type="submit" class="btn btn-secondary btn-sm my-1" style="margin-left: 10px;">傳送</button>
			</form>
        </div>
    </div>
    <script>
        var laugh = '\u{1F602}'; //笑
        var wow = '\u{1F62E}'; //哇
        var cry = '\u{1F622}'; //哭
        var love = '\u{1F970}'; //愛
        var clap = '\u{1F44F}'; //拍手
        var hundred = '\u{1F4AF}'; //一百分

        document.getElementById("laugh").innerHTML = laugh;
        document.getElementById("wow").innerHTML = wow;
        document.getElementById("cry").innerHTML = cry;
        document.getElementById("love").innerHTML = love;
        document.getElementById("clap").innerHTML = clap;
        document.getElementById("hundred").innerHTML = hundred;
    </script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>