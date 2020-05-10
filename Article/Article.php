<?php
  $page = "index";
  if(isset($_GET['page'])){
    $page = $_GET['page'];
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
    <link href="../index/my.css" rel="stylesheet" type="text/css">
    <title>抬槓</title>
	<script src="//s3-ap-northeast-1.amazonaws.com/justfont-user-script/jf-60019.js"></script>
	<script src="//s3-ap-northeast-1.amazonaws.com/justfont-user-script/jf-60019.js"></script>
</head>
  <body>
    <div class="article">
        <!-- 文章內容(上) -->
		<div class="row article-head">
			<!-- 作者(照片+名稱) -->
			<div class="col-md-9 col-sm-8 col-6 mid">
				<img src="./image/user.png" class="img-fluid rounded-circle pic" >
				<p style="display: inline; font-size:3vmin; margin:0px 0px 0px 5px; font-family: setofont; font-weight:600">淡江大學</p>
			</div>
			<!-- 作者(照片+名稱) end-->

		<!-- 看板+發文時間 --> 
			<div class="col-md-3 col-sm-4 col-6 bottom">
                <p style=' font-size:2vmin; margin:0px; font-family: setofont; font-weight:600;'>有趣版 - 5月5日 20:35</p>
			</div>
		<!-- 看板+發文時間 end-->
		</div>
		<!-- 文章內容(上) end-->
				
		<!-- 文章內容(中) -->
		<div class="row article-body mid">
			<div class="col-md-12 col-sm-12 col-12 col-lg-12">
  				<!-- 標題 -->
                <p class="font-weight-bold" style='font-size:5vmin; margin:20px 10px 30px 10px; font-family: setofont; font-weight:400;'>
                    每年母親節，我都覺得我像個智障
				</p>
				<!-- 標題 end -->
				<!-- 文章內容 -->
<pre style="font-size:2.5vmin; margin:0px 30px 0px 30px; font-family: setofont; font-weight:600">
不知道我是不是專門生下來氣我媽的
幾乎每年母親節禮物我都踢到鐵板
外加我媽又毛很多
每年禮物都被嫌的一無是處
每年被澆的冷水我不知道可以挑戰多少次ice bucket challenge 了
要加s

所以
前年我放棄 我只帶他去吃飯
餐廳我也做了很多功課
but
沒送禮物還是被唸沒心@&*@!&(*$#*@(#^&
我真的把我媽醒派ki  

但 肥我越挫越勇
去年送蠟燭，還是女孩的夢想牌
(是嗎? 是吧?)

結果

：你是多急著要幫我點蠟燭 ???????

啊 忘記他(我媽)不是女孩了

所以這莫名其妙貴到靠北的東西才在這呀
WTF
</pre>
<!-- 文章內容 end-->
  				<!-- 文章tag -->
				<div style="margin:10px 10px 0px 10px; font-family: setofont; font-weight:600;">
					<button type="button" class="btn btn-sm btn-light">#討好媽媽</button>
					<button type="button" class="btn btn-sm btn-light">#好難</button>
				</div>
				<!-- 文章tag end-->
			</div>		
		</div>
		<!-- 文章內容(中) end-->
				
		<!-- 文章內容(下) -->
		<div class="row article-fotter right">
			<!-- 按鈕們 -->
			<div class="col-md-12 col-sm-12 col-12">
				<button type="button" class="btn btn-sm btn-secondary"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></button>
				<button type="button" class="btn btn-sm btn-secondary">討好媽媽</button>
				<button type="button" class="btn btn-sm btn-secondary">討好媽媽</button>
			</div>
			<!-- 按鈕們 end -->
		</div>
		<!-- 文章內容(下) end-->
	</div>
	<div class="article">
        <!-- 熱門排行榜(上) -->
		<div class="row hmes-head mid">
			<p style='font-size:3vmin; margin:20px;'>火辣辣排行榜</p>
		</div>
		<!-- 熱門排行榜(上) end-->
				
		<!-- 熱門排行榜(下) -->
		<div class="row mid hmes-head">
			<!-- 第一名 -->
			<div class="col-md-2 col-sm-2 col-2">
				<img src="./image/1.png" class="img-fluid rounded-circle" style="height:8vh; width:auto;">
			</div>
			<!-- 第一名 end-->
			<div class="col-md-10 col-sm-10 col-10 hmes-body">
				<div class="row mid">
					<!-- 作者照片-->
					<div class="col-md-1 col-sm-1 col-1" style="margin:0px; padding:0px;">
						<img src="./image/user.png" class="img-fluid rounded-circle" id="writer-pic">
					</div>
					<!-- 作者照片 end-->
					<!-- 作者-->
					<div class="col-md-8 col-sm-8 col-8" style="margin:0px; padding:0px;">
						<p style="display: inline; font-size:3vmin; margin:0px; font-weight:400; font-family:jf-openhuninn;">淡江大學</p>
					</div>
					<!-- 作者 end-->

					<!-- 按讚數 --> 
					<div class="col-md-3 col-sm-3 col-3">
						<p style="display: inline; font-size:2.5vmin; font-weight:400; font-family:jf-openhuninn;">598</p>
						<img src="./image/good-white.png" class="img-fluid" id="good-pic">
					</div>
					<!-- 按讚數 end-->
					
					<div class="col-md-1 col-sm-1 col-1" style="margin:0px; padding:0px;"></div>
					<!-- 留言內容-->
					<div class="col-md-11 col-sm-11 col-11" style="margin:0px; padding:0px;">
						<p class="mes">包紅包！！！！
沒得嫌了吧</p>
					</div>
					<!-- 留言內容 end-->
				</div>
			</div>
		</div>
		<div class="row mid hmes-head">
			<!-- 第二名 -->
			<div class="col-md-2 col-sm-2 col-2">
				<img src="./image/2.png" class="img-fluid rounded-circle" style="height:8vh; width:auto;">
			</div>
			<!-- 第二名 end-->
			<div class="col-md-10 col-sm-10 col-10 hmes-body">
				<div class="row mid">
					<!-- 作者照片-->
					<div class="col-md-1 col-sm-1 col-1" style="margin:0px; padding:0px;">
						<img src="./image/user.png" class="img-fluid rounded-circle" id="writer-pic">
					</div>
					<!-- 作者照片 end-->
					<!-- 作者-->
					<div class="col-md-8 col-sm-8 col-8" style="margin:0px; padding:0px;">
						<p style="display: inline; font-size:3vmin; margin:0px; font-weight:400; font-family:jf-openhuninn;">中原大學</p>
					</div>
					<!-- 作者 end-->

					<!-- 按讚數 --> 
					<div class="col-md-3 col-sm-3 col-3">
						<p style="display: inline; font-size:2.5vmin; font-weight:400; font-family:jf-openhuninn;">501</p>
						<img src="./image/good-white.png" class="img-fluid" id="good-pic">
					</div>
					<!-- 按讚數 end-->
					
					<div class="col-md-1 col-sm-1 col-1" style="margin:0px; padding:0px;"></div>
					<!-- 留言內容-->
					<div class="col-md-11 col-sm-11 col-11" style="margin:0px; padding:0px;">
						<p class="mes">你好用心喔😂 但我覺得口紅同牌應該沒問題吧
如果你媽喜歡她現在自己用的那隻
一樣的顏色 喔耶續命+1
不一樣顏色 喔耶有不同顏色了</p>
					</div>
					<!-- 留言內容 end-->
				</div>
			</div>
		</div>
		<div class="row mid hmes-head">
			<!-- 第三名 -->
			<div class="col-md-2 col-sm-2 col-2">
				<img src="./image/3.png" class="img-fluid rounded-circle" style="height:8vh; width:auto;">
			</div>
			<!-- 第三名 end-->
			<div class="col-md-10 col-sm-10 col-10 hmes-body">
				<div class="row mid">
					<!-- 作者照片-->
					<div class="col-md-1 col-sm-1 col-1" style="margin:0px; padding:0px;">
						<img src="./image/user.png" class="img-fluid rounded-circle" id="writer-pic">
					</div>
					<!-- 作者照片 end-->
					<!-- 作者-->
					<div class="col-md-8 col-sm-8 col-8" style="margin:0px; padding:0px;">
						<p style="display: inline; font-size:3vmin; margin:0px; font-weight:400; font-family:jf-openhuninn;">嘉南藥理大學</p>
					</div>
					<!-- 作者 end-->

					<!-- 按讚數 --> 
					<div class="col-md-3 col-sm-3 col-3">
						<p style="display: inline; font-size:2.5vmin; font-weight:400; font-family:jf-openhuninn;">375</p>
						<img src="./image/good-white.png" class="img-fluid" id="good-pic">
					</div>
					<!-- 按讚數 end-->
					
					<div class="col-md-1 col-sm-1 col-1" style="margin:0px; padding:0px;"></div>
					<!-- 留言內容-->
					<div class="col-md-11 col-sm-11 col-11" style="margin:0px; padding:0px;">
						<p class="mes">我已經被嫌到放棄了
日式嫌生，台式嫌沒心意，歐式嫌不對味，韓式嫌東西難吃，泰式越式嫌酸甜辣，烤肉嫌臭，火鍋嫌熱，壽喜燒嫌重口味，問想吃什麼又說隨便
禮物送自己做的不對，送設計師品牌也不對，送專櫃還能被嫌敗家，然後又到處說我都不買禮物給他
這幾年都乾脆帶他隨便吃一頓千元餐廳…</p>
					</div>
					<!-- 留言內容 end-->
				</div>
			</div>
		</div>
		<!-- 熱門排行榜(下) end-->
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>