<?php
	#get page
	$page = "index";
	if(isset($_GET['page'])){
		$page = $_GET['page'];
	}
	#connect to sql
	$link = mysqli_connect("localhost","taigun","ELn3yv07F567MwOF","taigun");
	if(!$link){
		echo "no connect!";
	}
	#get article id
	$aid = "";
	if(isset($_GET['aid'])){
		$aid = $_GET['aid'];
		$_SESSION['aid'] = $aid;
	}

	$sql = "SELECT * FROM `article` WHERE `AId` = \"$aid\" ";
	$result = mysqli_query($link,$sql);
	if($result){
		$rank = 0;
		include("../index/fourm.php");
		$row = mysqli_fetch_assoc($result);
		$category = findFourm($row['category']);
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
	<script>
		var str1=["../index/image/bell-white","../index/image/bell-black"];
		var str2=["../index/image/bookmark-white","../index/image/bookmark-black"];
		var str3=["../index/image/good-white","../index/image/good-black"];
		var i=0; j=0; k=0;
		function bell() {
			i=(i+1)%2;
			document.getElementById('change1').src=str1[i]+".png";
		}
		function bookmark() {
			j=(j-1+2)%2;
			document.getElementById('change2').src=str2[j]+".png";
		}
		function good() {
			k=(k-1+2)%2;
			document.getElementById('change3').src=str3[k]+".png";
		}


	</script>
	
	</head>
  <body>
	<!-- 文章 -->
    <div class="article">
        <!-- 文章內容(上) -->
		<div class="row article-head">
			<!-- 作者(照片+名稱) -->
			<div class="col-md-9 col-sm-8 col-6 mid">
				<img src="../index/image/user.png" class="img-fluid rounded-circle pic" >
				<p style="display: inline; font-size:3vmin; margin:0px 0px 0px 5px; font-family: setofont; font-weight:600">
				<?php
				if($row['anonymous']==0){
					echo '匿名';
				}else{
					echo $row['post_name'];
				}
				?></p>
			</div>
			<!-- 作者(照片+名稱) end-->
			<div class></div>
			<!-- 看板+發文時間 --> 
			<div class="col-md-4 col-sm-5 col-7 bottom">
                <p style=' font-size:2.2vmin; margin:0px; font-family: setofont; font-weight:600;'>
				<?php echo $category.' - '.$row['post_time']; ?>
				</p>
			</div>
			<!-- 看板+發文時間 end-->
		</div>
		<!-- 文章內容(上) end-->
				
		<!-- 文章內容(中) -->
		<div class="row article-body mid">
			<div class="col-md-12 col-sm-12 col-12 col-lg-12">
  				<!-- 標題 -->
				<p class="font-weight-bold" style='font-size:5vmin; margin:20px 10px 20px 10px; font-family: 微軟正黑體; font-weight:400;'>
                <?php echo $row['title'];?></p>
				<!-- 文章內容 -->
				<p class='article-word'><?php echo $row['content'];?></p>				
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
			<!-- 按鈕們-->
			<!-- 再修 -->
			<div class="col-md-12 col-sm-12 col-12">
				<img class="pointer gbb" id="change1" src="../index/image/bell-white.png" title="追蹤" onclick="bell();">
				<img class="pointer gbb" id="change2" src="../index/image/bookmark-white.png" title="收藏" onclick="bookmark();">
				<img class="pointer gbb" id="change3" src="../index/image/good-white.png" title="喜歡" onclick="good();">
			</div>
			<!-- 按鈕們 end -->
		</div>
		<!-- 文章內容(下) end-->
	</div>
	<!-- article end -->
	<?php } //end if ?>
	<!-- 熱門留言區 -->
	<div class="article">
        <!-- 熱門排行榜(上) -->
		<div class="row hmes-head mid" style='border-bottom: 1px black solid;'>
			<p class='mes-head'>火辣辣排行榜</p>
		</div>
		<!-- 熱門排行榜(上) end-->

		<?php 
		
			$sql_hot = "SELECT * FROM `comment` WHERE `AId` = \"$aid\" ORDER BY `likeCount` DESC";
			$result_hot = mysqli_query($link,$sql_hot);
			if($result_hot){
				for ($rank=1 ;$rank < 4; $rank++){
					$row_hot = mysqli_fetch_assoc($result_hot);
					
		?>
				
		<!-- 熱門排行榜(下) -->
		<div class="row mid hmes-head">
			<!-- 顯示名次 -->
			<div class="col-md-2 col-sm-2 col-3">
			<?php 
				if($rank == 1){
					echo '<img src="../index/image/1.png" class="img-fluid rounded-circle" style="height:8vh; width:auto;">';
				}else if ($rank == 2){
					echo '<img src="../index/image/2.png" class="img-fluid rounded-circle" style="height:8vh; width:auto;">';
				}else{
					echo '<img src="../index/image/3.png" class="img-fluid rounded-circle" style="height:8vh; width:auto;">';
				}
			?>	
			</div>
			<!-- 顯示熱門留言 -->
			<div class="col-md-10 col-sm-10 col-9 hmes-body">
				<div class="row mid">
					<!-- 作者照片-->
					<div class="col-md-1 col-sm-1 col-2" style="margin:0px; padding:0px;">
						<img src="../index/image/user.png" class="img-fluid rounded-circle" id="writer-pic">
					</div>
					<!-- 作者照片 end-->
					<!-- 作者-->
					<div class="col-md-8 col-sm-8 col-5" style="margin:0px; padding:0px;">
						<p class='w'><?php 
						if($row_hot['anonymous'] == 0){
							echo '匿名';
						}else{
							echo $row_hot['post_name'];
						}
						?></p>
					</div>
					<!-- 作者 end-->

					<!-- 按讚數 --> 
					<div class="col-md-3 col-sm-3 col-5">
						<p style="display: inline; font-size:2.5vmin; font-weight:400; font-family:jf-openhuninn;"><?php echo $row_hot['likeCount'];?></p>
						<img src="../index/image/good-white.png" class="img-fluid" id="good-pic">
					</div>
					<!-- 按讚數 end-->
					
					<div class="col-md-1 col-sm-1 col-1" style="margin:0px; padding:0px;">
						
					</div>
					<!-- 留言內容-->
					<div class="col-md-11 col-sm-11 col-11" style="margin:0px; padding:0px;">
						<p class="hmes"><?php echo 'B'.$row_hot['floor'].' - '.$row_hot['time'];?></p>
						<p class="hmes"><?php echo $row_hot['content'];?></p>
					</div>
					<!-- 留言內容 end-->
				</div>
			</div>				
		</div>
		<?php }
		} ?>
	</div>

	
	<!-- 留言區 -->
	<div class="article">
        <!-- 留言區(上) -->
		<div class="row hmes-head mid" style='border-bottom: 1px black solid;'>
			<p class='mes-head'>留言區</p>
		</div>
		<!-- 留言區(上) end-->

		<?php 
		
			$sql_c = "SELECT * FROM `comment` WHERE `AId` = \"$aid\" ORDER BY `time` ASC";
			$result_c = mysqli_query($link,$sql_c);
			if($result_c){
				
				while($row_c = mysqli_fetch_assoc($result_c)){
		?>
	
		<!-- 留言區(下) -->
		<div class="row mid hmes-head justify-content-center">
			<!-- 圖片 -->
			<!-- <div class="col-md-2 col-sm-2 col-3">
				<img src="../index/image/mes.png" class="img-fluid rounded-circle" style="height:8vh; width:auto;">
			</div> -->
			<!-- 圖片 end-->
			<!-- 留言區 -->
			<div class="col-md-10 col-sm-10 col-9 hmes-body ">
				<div class="row mid ">
					<!-- 作者照片-->
					<div class="col-md-1 col-sm-1 col-2" style="margin:0px; padding:0px;">
						<img src="../index/image/user.png" class="img-fluid rounded-circle" id="writer-pic">
					</div>
					<!-- 作者照片 end-->
					<!-- 作者-->
					<div class="col-md-8 col-sm-8 col-5" style="margin:0px; padding:0px;">
						<p class='w'><?php 
							if($row_c['anonymous'] == 0){
								echo '匿名';
							}else{
								echo $row_c['post_name'];
							}
						?></p>
					</div>
					<!-- 作者 end-->

					<!-- 按讚數 --> 
					<div class="col-md-3 col-sm-3 col-5">
						<p style="display: inline; font-size:2.5vmin; font-weight:400; font-family:jf-openhuninn;"><?php echo $row_c['likeCount'];?></p>
						<img src="../index/image/good-white.png" class="img-fluid" id="good-pic">
					</div>
					<!-- 按讚數 end-->
					
					<div class="col-md-1 col-sm-1 col-1" style="margin:0px; padding:0px;"></div>
					<!-- 留言內容-->
					<div class="col-md-11 col-sm-11 col-11" style="margin:0px; padding:0px;">
						<p class="hmes"><?php echo 'B'.$row_c['floor'].' - '.$row_c['time'];?></p>
						<p class="hmes"><?php echo $row_c['content'];?></p>
					</div>
					<!-- 留言內容 end-->
				</div>
			</div>
			<!-- 留言區end -->
		</div>
		<!-- 留言區(下) end-->

		<?php 
					}//end while
				}//end if
		?>

		<!-- 留言輸入區 -->
		<div class = "row mid hmes-head justify-content-center">
			<div class="col-md-10 col-sm-10 col-9 hmes-body ">
				<div class="row mid "> 
					<!-- 作者照片-->
					<div class="col-md-1 col-sm-1 col-2" style="margin:0px; padding:0px;">
						<img src="../index/image/user.png" class="img-fluid rounded-circle" id="writer-pic">
					</div>
					<!-- 作者照片 end-->

					<?php 
						if(isset($_SESSION['user'])){
					?>
					<!-- 留言內容-->
					<div class="col-md-11 col-sm-11 col-11" style="margin:0px; padding:0px;">
						<form method="post" action="../Article/addcom.php">
						<div class="form-row">
							<div class="col-md-4">
								<label for="inputState">是否匿名</label>
								<select id="inputState" class="form-control" name="anonymous">
									<option selected value = "0">匿名</option>
									<option value = "1">顯示暱稱</option>
								</select>
							</div>
						</div>

						<div class="form-row">
							<div class="col-md-10 mb-5">
								<label for="comment" class = "hmes">請輸入留言</label>
								<textarea class="form-control" id="comment" placeholder="請輸入留言" required name="content"></textarea>
								<button type="submit" class="btn btn-secondary btn-sm my-1">Submit</button>	
							</div>
						</div>
						</form>
					</div>
					<!-- 留言內容 end-->
						<?php }
								else{
						?>
					<div class="col-md-11 col-sm-11 col-11" style="margin:0px; padding:0px;">
						<div class="alert alert-dark" role="alert">
						請先登入再輸入留言
						</div>

					</div>

					<?php
					}?>
				</div>
				<!-- row end -->
			</div>
			<!-- col end -->
		</div>
		<!-- 留言輸入區end -->


	</div>
	
	
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>