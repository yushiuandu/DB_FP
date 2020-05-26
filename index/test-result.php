<!doctype html>
<html lang="en">
  <head>
  
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="../index/my.css" rel="stylesheet" type="text/css">

    <title>抬槓</title>
	<script src="//s3-ap-northeast-1.amazonaws.com/justfont-user-script/jf-60019.js"></script>
	<script src="//s3-ap-northeast-1.amazonaws.com/justfont-user-script/jf-60019.js"></script>
    </head>
    <!-- 心理測驗-result -->
    <body>
        <?php    
            $choice = $_POST['choice'];
            $tid = $_GET['tid'];

            $link = mysqli_connect("localhost","taigun","ELn3yv07F567MwOF","taigun");//連結伺服器//選擇資料庫
			if(!$link){
			echo "no connect!";
			}

            $sql = "INSERT INTO `user_ans`(`UId`,`Ans`) VALUES ('$uid','$choice')";
            mysqli_query($link,$sql);

            $sql = "SELECT * FROM `ans` WHERE `testid` = \"$tid\"";
            $result = mysqli_query($link,$sql);
        
            for($i = 0; $i < $choice ; $i++){
                $row = mysqli_fetch_assoc($result);
            }
        ?>
        <div class='test'>
            <div class='result'>
                <p class='test2-ww'><?=$row['ans'];?></p>
            </div>
            <div class='result-btn'>
                <div class='link-ww pointer' data-toggle="modal" data-target="#match">EXIT</div> <!--data-target後面要#!!!-->
                <!--配對畫面-->
                <!-- data-backdrop點背景不會關閉視窗/data-keyboard可用esc關閉 -->
				<div class="modal fade bd-example-modal-sm match-ww" id="match" aria-hidden="true" data-backdrop="false" data-keyboard="true">
					<div class="modal-dialog modal-dialog-centered"> <!--centered重直置中-->
						<div class="modal-content match-page"> 
                            <!-- 配對頁面內容 -->
                            <p class="match-title">夢中情人</p>
							<div class="modal-body match-con">
                                <div class="row justify-content-center">
                                    <!-- 配對到的人照片 -->
                                    <div class="col-md-7 mid">
                                        <img class='match-pic' src='../index/image/test1.JPG'></img>
                                    </div>
                                    <!-- 配對到的人簡介 -->
                                    <div class="col-md-5 match-intro left">
                                        <p class='match-ww'>姓名：　　許淑美</p>
                                        <p class='match-ww'>暱稱：　　小黑</p>
                                        <p class='match-ww'>文章：　　56篇</p>
                                        <p class='match-ww'>追蹤者：　66個</p>
                                        <p class='match-ww'>追隨者：　88個</p>
                                    </div>
                                </div>
							</div>
							<!--下面選項-->
							<div class='match-fotter'>
                                <!-- 開始聊天 -->
								<button class="btn btn-secondary">
                                    <a href='../index/index.php?page=chat' class='link-ww'>開始聊天</a>
                                </button>
                                <!-- 拒絕聊天 -->
                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#match2">下次再說...</button>
                                <div class="modal fade bd-example-modal-sm match-ww" id="match2" aria-hidden="true" data-backdrop="static" data-keyboard="true">
                                    <div class="modal-dialog modal-dialog-centered"> <!--centered重直置中-->
                                        <div class="modal-content match-page"> 
                                            <!-- 配對頁面內容 -->
                                            <p class="match-title">Oh...No...</p>
                                            <div class="modal-body match-con">
                                                <img src='../index/image/cry.png' class='sorry-pic'></img>
                                                <p class='match-ww'>你錯過進一步認識他/她的機會</p>
                                            </div>
                                            <!--下面選項-->
                                            <div class='match-fotter'>
                                                <!-- bye -->
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.href='../index/index.php'">關閉</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>
					</div>
				</div>
				<!--配對頁面end-->
            </div>
				
        </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>