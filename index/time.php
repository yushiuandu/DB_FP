<?php session_start();
   
    date_default_timezone_set('Asia/Taipei');
    $datetime = date ("Y-m-d H:i:s" , mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y'))) ;
    $yesterday = date ("Y-m-d H:i:s" , mktime(date('H'), date('i'), date('s'), date('m'), date('d')-1, date('Y'))) ;
     // connect to sql
	$link = mysqli_connect("localhost","taigun","ELn3yv07F567MwOF","taigun");//連結伺服器//選擇資料庫
	if(!$link){
		echo "no connect!";
    }
    if(isset($_GET['igid'])){
        $igid = $_GET['igid'];
    }

    // 刪除限時，
    if(isset($_GET['delete'])){
        $sql = "DELETE FROM `instagram` WHERE `igid` = '$_GET[delete]'";
        if(mysqli_query($link,$sql)){
            $sql = "UPDATE `chat` SET `igid` = 0 WHERE `igid` = '$_GET[delete]'";
            mysqli_query($link,$sql);

            header("Location:../index/index.php");
            exit;
        }
    }

    $sql = "SELECT * FROM `instagram` WHERE `post_time` BETWEEN \"$yesterday\" AND \"$datetime\"";
    $result = mysqli_query($link,$sql);
    $row = mysqli_fetch_assoc($result);
    $num = mysqli_num_rows($result);
    $head = $row['igid'];//最頭的igid

    // 算尾巴的igid
    // 如果此時間段只有一則限時動態，則尾巴的igid等於變數head
    if($num == 1){
        $tail = $head;
    }else{ //假如超過一則，則開始計算最末端的限時動態的igid
        while($row = mysqli_fetch_assoc($result)){
            $tail = $row['igid'];
        }
    }

    // 算下一個的igid
    $sql = "SELECT * FROM `instagram` WHERE `post_time` BETWEEN \"$yesterday\" AND \"$datetime\"";
    $result = mysqli_query($link,$sql);

    // 如果此igid不為最後一則的話
    if($igid != $tail){
        while($row = mysqli_fetch_assoc($result)){
            // 如果row的igid等於當前頁面的igid
            if($row['igid'] == $igid){
                // 則將下一則igid存入right變數
                if( $row = mysqli_fetch_assoc($result)){
                    $right = $row['igid'];
                }
            }
        }
    }else{
        $right = $head;
    }
    
   
    // 算前一個igid
    $left = $head;
    $sql = "SELECT * FROM `instagram` WHERE `post_time` BETWEEN \"$yesterday\" AND \"$datetime\"";
    $result = mysqli_query($link,$sql);
    $row = mysqli_fetch_assoc($result);
    //如果此igid並非第一個
    if($row['igid']!=$igid){
        // 如果此列的igid等於當前頁面的igid，則停止while
        while($row["igid"] != $igid){
            //將left不斷update
            $left = $row['igid'];
            $row = mysqli_fetch_assoc($result);
        }
    }else{
        $left = $row['igid'];
    }


    $sql = "SELECT * FROM `instagram` WHERE `post_time` BETWEEN \"$yesterday\" AND \"$datetime\"";
    $result = mysqli_query($link,$sql);
    $row = mysqli_fetch_assoc($result);
    

    include("../index/forum.php"); #匯入function
	if(isset($_SESSION['nickname'])){
		$uid = finduid($_SESSION['nickname']);
    }
    
    // 限時動態的回覆
    if(isset($_GET['chat'])){

        $other = $_GET['chat'];
        $content = $_SESSION['nickname']."已回復您的限時動態：<br>".$_POST['chat'];

		$sql = "INSERT INTO `chat` (`UId`,`other`,`chat`,`igid`, `sendtime`) VALUES 
                ('$_GET[chat]','$uid','$content', '$_GET[igid]' ,'$datetime')";
		if(mysqli_query($link, $sql)){
            $content = $_SESSION["nickname"]."已回復你新增的限時動態";
            $sql = "INSERT INTO `notification` (`UId`, `friendid`, `content`,`type`)
                    VALUES ('$_GET[chat]', '$uid', '$content', 11)";
            mysqli_query($link, $sql);
			exit(json_encode(array("success"=>"OK","content"=>$content)));
		}else{
			mysqli_error();
		}
    }
    
?>
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
            var time = 0;
            var time2 = 0; //算時間
            var second; //數秒數
            var done=0; //結束秒數
            var temp=0; //暫存下面還要有多久
            var oh=0;

            window.onload = view();

            function count(){ //數時間到 換頁 
                second=((new Date()).getSeconds()+60)%60; //現在秒數
                if( second<done ){
                    time2 = setTimeout(function(){count()},1000);
                }else{
                    right();
                }
            }

        //    function lest(){
        //         done=((new Date()).getSeconds()+65)%60; //換頁秒數
        //         count();
        //         oh=0;
        //         go();
        //         i=(i-1+4)%4;
                
        //         // document.getElementById('change').src="../index/image/test"+num[i]+".jpg";
        //         // time=setTimeout(function(){next()},2000);
        //     }
            function next(){
                done=((new Date()).getSeconds()+65)%60; //換頁秒數
                count();
                oh=0;
                go();
                i=(i+1+4)%4;
                time = setTimeout(function(){next()},1000);
                location.href="../index/time.php?igid=<?=$right;?>";
                // document.getElementById('change').src="../index/image/test"+num[i]+".jpg";
                
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
            // function left(){
            //     stop();
            //     lest();
            // }
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
            function delet(){
                subtraction();
                stop();
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
        <?php
            $sql = "SELECT * FROM `instagram` JOIN `member` 
                    WHERE instagram.UId = member.UId AND instagram.igid = '$igid' ";
            $result = mysqli_query($link,$sql);

            if($num > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $date = date('Y年m月d日 H:i',strtotime($row['post_time']));
                    // find forum 
                    $Link = "../index/ig.php?igid=".$row['igid'];
                    
        ?>
        <div class="view">
            <!-- head -->
            <div class="time-head">
                <div id="progressbar"><div class="progress-label"></div></div>
                    <div class="row justify-content-start mid">
                        <div class="col-lg-2 col-md-3 col-sm-3 col-2">
                            <div class="user-con">
                                <?php if($row['anonymous'] == 1){?>
                                    <img src="data:pic/png;base64,<?=base64_encode($row["profile"]);?>" id="user-pic">
                                <?php }else{?>
                                    <img src="../index/image/user.png" id="user-pic">
                                <?php }?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-5 col-5 p0">
                            <?php if($row['anonymous'] == 1){?>
                                <p class="time-ww"><?=$row['Nickname'];?></p>
                            <?php }else{?>
                                <p class="time-ww">匿名</p>
                            <?php }?>
                            <p class="time-ww"><?=$date?></p>
                        </div>
                        <?php if(isset($_SESSION['nickname'])){
                                    if($row['UId'] == $uid){?>
                        <div class="col-lg-4 col-md-2 col-sm-2 col-2 p0">
							<img src='../index/image/delete.png' data-toggle="modal" data-target="#sure" class="bttn pointer" onclick="delet();">
						    <div class="modal fade bd-example-modal-sm" id="sure" tabindex="-1" data-backdrop="false" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content login-page">

                                        <div class="modal-body">
                                            <p>你確定要刪除嗎?</p>
                                            <a href="../index/time.php?delete=<?=$row['igid'];?>">
                                            <button type="button" class="btn">確定</button></a>
                                            <button type="button" class="btn" data-dismiss="modal">取消</button>
                                        </div>
                                    </div>
                                </div>
						    </div>
                        </div>
                        <?php    }//end if 
                            }//end session if
                        ?>
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
                        <button type="button" class="btn btn-light left" onclick="location.href='../index/time.php?igid=<?=$left;?>'">◀</button>
                        <div class="share-con">
                            <img src="data:pic/png;base64,<?=base64_encode($row["img"]);?>" id="change" class="share-pic">
                        </div>
                        <button type="button" class="btn btn-light right" onclick="location.href='../index/time.php?igid=<?=$right;?>'">▶</button>
                    </div>
                </div>
            </div>
            
            <!-- footer -->
            <div class="time-footer">
                <?php if(isset($_SESSION['nickname'])){ ?>
                <form action="" method="post" style="">
                    <!-- emoji -->
                    <div class="row justify-content-center"> 
                        <div class="col-md-10 col-sm-8 col-8 p0 emoji">
                            <div class="row justify-content-center">
                                <div class="col-md-2 col-sm-2 col-2 p0">
                                    <div class="pointer laugh" data-url="<?=$Link."&emoji=laugh";?>" id="laugh">😂</div>
                                    <p class="emoji-ww" id="laugh_count"><?=$row['laugh'];?></p>
                                </div>
                                <div class="col-md-2 col-sm-2 col-2 p0">
                                    <div class="pointer wow" data-url="<?=$Link."&emoji=wow";?>" id="wow">😮</div>
                                    <p class="emoji-ww" id="wow_count"><?=$row['wow'];?></p>
                                </div>
                                <div class="col-md-2 col-sm-2 col-2 p0">
                                    <div class="pointer cry" data-url="<?=$Link."&emoji=cry";?>" id="cry">😢</div>
                                    <p class="emoji-ww" id="cry_count"><?=$row['cry'];?></p>
                                </div>
                                <div class="col-md-2 col-sm-2 col-2 p0">
                                    <div class="pointer love" data-url="<?=$Link."&emoji=love";?>" id="love">🥰</div>
                                    <p class="emoji-ww" id="love_count"><?=$row['love'];?></p>
                                </div>
                                <div class="col-md-2 col-sm-2 col-2 p0">
                                    <div class="pointer clap" data-url="<?=$Link."&emoji=clap";?>" id="clap">👏</div>
                                    <p class="emoji-ww" id="clap_count"><?=$row['clap'];?></p>
                                </div>
                                <div class="col-md-2 col-sm-2 col-2 p0">
                                    <div class="pointer hundred" data-url="<?=$Link."&emoji=hundred";?>" id="hundred">💯</div>
                                    <p class="emoji-ww" id="hundred_count"><?=$row['hundred'];?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- emoji end-->
                    <?php 
                        $sql_friend = "SELECT * FROM `friend` WHERE `UId` = '$uid' AND `otherId` = '$row[UId]'";
                        $result_friend = mysqli_query($link, $sql_friend);
                        $num_friend = mysqli_num_rows($result_friend);
                        if($num_friend > 0 and $row['anonymous'] != 0){
                    ?>
                    <div class="row justify-content-start">
                        <div class="col-md-10 col-sm-8 col-8 p0">
                            <input id="time-ww" name="chat" type="text" placeholder='說點什麼吧...' onclick="input();">
                        </div>
                        <div class="col-md-2 col-sm-4 col-4 p0">
                            <div id="igsub" data-url="../index/time.php?chat=<?=$row['UId'];?>&igid=<?=$row['igid'];?>" type="submit" class="time-btn" onclick="enter();">傳送</div>
                        </div>
                    </div>
                    <?php }//end friend num ?>
                </form>
                <?php } //end session if?>
            </div>
            
        </div>
        <?php 
                } //end while
            }//end if num
        ?>
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

        <!-- 提交回復&emoji -->
        <script>
            $(".laugh").click(function(){
				var url = $(this).data("url");
				console.log(url);
				$.ajax({
					type: 'POST',
					url: url,
					data: {type : "ajax"},
					dataType :"json"
					
				}).done(function(data) {
					console.log(data);
                    if(data['success'] == "OK"){
                        $("#laugh_count").html(data['count']);
                    }
				});
			});

            $(".wow").click(function(){
				var url = $(this).data("url");
				

				console.log(url);
				$.ajax({
					type: 'POST',
					url: url,
					data: {type : "ajax"},
					dataType :"json"
					
				}).done(function(data) {
					console.log(data);
                    if(data['success'] == "OK"){
                        $("#wow_count").html(data['count']);
                    }
				});
            });

            $(".love").click(function(){
				var url = $(this).data("url");
				

				console.log(url);
				$.ajax({
					type: 'POST',
					url: url,
					data: {type : "ajax"},
					dataType :"json"
					
				}).done(function(data) {
					console.log(data);
                    if(data['success'] == "OK"){
                        $("#love_count").html(data['count']);
                    }
				});
            });

            $(".wow").click(function(){
				var url = $(this).data("url");
				

				console.log(url);
				$.ajax({
					type: 'POST',
					url: url,
					data: {type : "ajax"},
					dataType :"json"
					
				}).done(function(data) {
					console.log(data);
                    if(data['success'] == "OK"){
                        $("#wow_count").html(data['count']);
                    }
				});
            });

            $(".cry").click(function(){
				var url = $(this).data("url");
				

				console.log(url);
				$.ajax({
					type: 'POST',
					url: url,
					data: {type : "ajax"},
					dataType :"json"
					
				}).done(function(data) {
					console.log(data);
                    if(data['success'] == "OK"){
                        $("#cry_count").html(data['count']);
                    }
				});
            });

            $(".clap").click(function(){
				var url = $(this).data("url");

				console.log(url);
				$.ajax({
					type: 'POST',
					url: url,
					data: {type : "ajax"},
					dataType :"json"
					
				}).done(function(data) {
					console.log(data);
                    if(data['success'] == "OK"){
                        $("#clap_count").html(data['count']);
                    }
				});
            });

            $(".hundred").click(function(){
				var url = $(this).data("url");
				

				console.log(url);
				$.ajax({
					type: 'POST',
					url: url,
					data: {type : "ajax"},
					dataType :"json"
					
				}).done(function(data) {
					console.log(data);
                    if(data['success'] == "OK"){
                        $("#hundred_count").html(data['count']);
                    }
				});
            });

            // 提交回復
            $("#igsub").click( function(e){
				var url = $(this).data("url");

				$.ajax({
					type: "POST",
					url: url,
					data: { //傳送資料
						chat: $("#time-ww").val(), 
					},
					dataType :"json"
				}).done(function(data) {
					console.log(data);
                    if(data['success'] == "OK"){
                        alert("已成功傳送");
                        window.location.href="../index/time.php?igid=<?=$right;?>";
                    }
				});

				e.preventDefault(); // avoid to execute the actual submit of the form.
			
			});

        </script>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>
