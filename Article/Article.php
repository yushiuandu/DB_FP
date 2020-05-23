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

	#找到UId
	include("../index/forum.php");
	$uid = "";
	if(isset($_SESSION['nickname'])){
		$uid = finduid($_SESSION['nickname']);
	}
	#get article id
	$aid = "";
	if(isset($_GET['aid'])){
		$aid = $_GET['aid'];
		$_SESSION['aid'] = $aid;
		$_SESSION['local'] = "../index/index.php?page=article&aid=$aid";
	}

	$cid = "";
	if(isset($_GET['edit'])){
		$cid = $_GET['edit'];
	}

	#顯示文章
	$sql = "SELECT * FROM `article` JOIN `member` WHERE `AId` = \"$aid\" AND article.UId = member.UId";
	$result = mysqli_query($link,$sql);
	if($result){
		$rank = 0;
		// include("../index/forum.php");   //將分類變成中文
		$row = mysqli_fetch_assoc($result);
		$category = findForum($row['category']);
		
?>

<!doctype html>
<html lang="en">
  <head>
  
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link href="../index/my.css" rel="stylesheet" type="text/css">
	
	<title>抬槓</title>
	<!-- <script src="//code.jquery.com/jquery-1.10.2.js"></script> -->
	<script src="//s3-ap-northeast-1.amazonaws.com/justfont-user-script/jf-60019.js"></script>
	<script src="//s3-ap-northeast-1.amazonaws.com/justfont-user-script/jf-60019.js"></script>
  </head>

  <body>
	<!-- 文章 -->
    <div class="article">
        <!-- 文章內容(上) -->
		<div class="row article-head">
			<!-- 作者(照片+名稱) -->
			<div class="col-md-9 col-sm-8 col-6 mid">
				<?php
				if($row['anonymous']==0){?>
				<img src="../index/image/user.png" class="img-fluid rounded-circle pic" >
				<?php } else{?>
					<img src="data:pic/png;base64,<?=base64_encode($row["profile"]);?>" class="img-fluid rounded-circle pic" >
				<?php }?>
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
			<!-- 文章編輯、刪除 -->
			<div class="col-md-3 col-sm-4 col-6 right">
				<!-- <button type="button" class="btn btn-sm btn-info">
					<a href="../index/index.php?page=edit" style='text-decoration:none; color:white;'>編輯文章</a>
				</button>
				<button type="button" class="btn btn-sm btn-info">刪除文章</button> -->
				<?php if($uid == $row['UId'] AND isset($_SESSION['nickname'])){?> 
				<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
					<img src='../index/image/pen.png' id="btnGroupDrop1" class="edit-pic dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></img>
					<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
						<a class="dropdown-item" href="../index/index.php?page=edit&aid=<?php echo $row['AId'];?>">文章編輯</a>
						<a class="dropdown-item" href="../Article/edit.php?delete=<?php echo $row['AId'];?>">文章刪除</a>
					</div>
				</div>
				<?php } ?>
			</div>
			<!-- 文章編輯、刪除 end-->

			<div class></div>
			<!-- 看板+發文時間 --> 
			<div class="col-md-12 col-sm-12 col-12 bottom">
                <p style=' font-size:2.2vmin; margin:0px; font-family: setofont; font-weight:600;'>
				<?php echo $category.' - '.date('Y-m-d H:i',strtotime($row['post_time'])); ?>
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
					<?php 
						$sql_tag = "SELECT tag FROM article_tag WHERE AId = \"$aid\"";
						$result_tag = mysqli_query($link, $sql_tag);
						$row_tag = mysqli_fetch_assoc($result_tag);
						if($result_tag AND isset($row_tag)){
							while($row_tag){
					?>
					<a href = "../index/index.php?page=tag&tag=<?php echo $row_tag['tag'];?>">
					<button type="button" class="btn btn-sm btn-light">#<?php echo $row_tag['tag'];?></button></a>
					<?php
							$row_tag = mysqli_fetch_assoc($result_tag);}
						}
					?>
				</div>
				<!-- 文章tag end-->
			</div>		
		</div>
		<!-- 文章內容(中) end-->
				
		<!-- 文章內容(下) -->
		<div class="row article-fotter right">
			<!-- 按鈕們-->
			<div class="col-md-12 col-sm-12 col-12">
				<!-- 文章按讚數 -->
				<p style="display: inline; margin:0px; font-size:16pt; position:relative; top:5px; left:5px;"><?php echo $row['agree'];?></p>
				<?php 
					if(isset($_SESSION['nickname'])){
						$sql_good = "SELECT * FROM `good` WHERE `UId` = \"$uid\" AND `AId` = \"$row[AId]\"";
						$result_good = mysqli_query($link,$sql_good);
						$row_good = mysqli_fetch_assoc($result_good);
						$num = mysqli_num_rows($result_good);

						$Link = "../Article/good.php?aid=".$row['AId']."";

						if($num > 0){
							echo '<img class="good pointer gbb" data-url="'.$Link.'" src="../index/image/good-black.png">';
						}else{
							echo '<img class="good pointer gbb" data-url="'.$Link.'" src="../index/image/good-white.png">';
						}
					}else{
						echo '<img class="pointer gbb" src="../index/image/good-white.png">';
					}
				?>
				<!-- 追蹤 -->
				<?php 
					if(isset($_SESSION['nickname'])){
						$Link = "../Article/follow.php?aid=".$aid;
						$sql_follow = "	SELECT `AId` FROM `follow` WHERE `UId` = \"$uid\" AND `AId` =\"$row[AId]\"";
						$result_follow = mysqli_query($link, $sql_follow);
						$row_follow = mysqli_fetch_assoc($result_follow);
							
						if(isset($row_follow['AId'])){
							// 已追蹤
							//echo '<a href ="../Article/follow.php?aid='.$row['AId'].'&follow=1">';
							echo '<img class="pointer gbb follow_bell" data-url="'.$Link.'" src="../index/image/bell-black.png" title="追蹤">';

						}else{
							// 未追蹤
							//echo '<a href ="../Article/follow.php?aid='.$row['AId'].'&follow=0">';
							echo '<img class="pointer gbb follow_bell"  data-url="'.$Link.'" src="../index/image/bell-white.png" title="追蹤">';
						}
					}else{
						echo '<img class="pointer gbb"  src="../index/image/bell-white.png" title="追蹤">';
					}
				?>
				<!-- 收藏 -->
				<?php 
				//	if(isset($_SESSION['nickname'])){
					//	$sql_save = "	SELECT AId FROM `save` WHERE UId = \"$uid\" AND `AId` =\"$row[AId]\"";
					//	$result_save = mysqli_query($link, $sql_save);
					//	$num - mysqli_num_rows($result_save);
							
					//	if($num>0){
							// 已收藏
					//		echo '<a href ="../Article/save.php?aid='.$row['AId'].'&save=1">';
					//		echo '<img class="pointer gbb"  src="../index/image/bookmark-black.png" title="追蹤"></a>';

					//	}else{
							// 未收藏
					//		echo '<a href ="../Article/save.php?aid='.$row['AId'].'&save=0">';
					//		echo '<img class="pointer gbb"  src="../index/image/bookmark-white.png" title="追蹤"></a>';
						}
				//	}else{
				//		echo '<img class="pointer gbb"  src="../index/image/bookmark-white.png" title="追蹤">';
				//	}
				?>
				<img class="pointer gbb"  src="../index/image/bookmark-white.png" title="追蹤" data-toggle="modal" data-target="#collect">
					<div class="modal fade bd-example-modal-sm match-ww middle" id="collect" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered"> <!--centered重直置中-->
                            <div class="modal-content match-page"> 
                                <!-- 收藏內容 -->
                                <p class="match-title">請選擇一個收藏分類</p>
                                <div class="modal-body">
									<div class='collect-add'>
										<!-- 可以新增收藏選項並加入 -->
										<input type='text' name='collect' placeholder='輸入分類名稱'>
										<button type="submit" class="btn btn-sm btn-secondary">新增</button>
									</div>
									<div class='collect'>
										<button type="button" class="btn collect-btn">網美店</button>
										<button type="button" class="btn collect-btn">桌布分享</button>
										<button type="button" class="btn collect-btn">狗狗貓貓</button>
										<button type="button" class="btn collect-btn">狗狗貓貓</button>
										<button type="button" class="btn collect-btn">狗狗貓貓</button>
									</div>	
                                </div>
                                <!--下面選項-->
                                <div class='collect-fotter'>
									<!-- 取消收藏 -->
									<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">取消</button>
                                </div>
                            </div>
                        </div>
					</div>
			</div>
			<!-- 按鈕們 end -->
		</div>
		<!-- 文章內容(下) end-->
	</div>
	<!-- article end -->
				<?php 
			// }
			?>
	<!-- 熱門留言區 -->
	<?php 
		
			$sql_hot = "SELECT * FROM `comment` WHERE `AId` = \"$aid\" ORDER BY `likeCount` DESC";
			$result_hot = mysqli_query($link,$sql_hot);
			$row_hot = $row_hot = mysqli_fetch_assoc($result_hot);
			if(isset($row_hot)){
				
					
	?>
	<?php 
		$sql_hot = "SELECT * FROM `comment` WHERE `AId` = \"$aid\" ORDER BY `likeCount` DESC";
		$result_hot = mysqli_query($link,$sql_hot);
		$num = mysqli_num_rows($result_hot);

		if($num >2){?>
	<div class="article">
        <!-- 熱門排行榜(上) -->
		<div class="row hmes-head mid" style='border-bottom: 1px black solid;'>
			<p class='mes-head'>火辣辣排行榜</p>
		</div>
		<!-- 熱門排行榜(上) end-->

		<?php 
			if($result_hot){
				for ($rank=1 ;$rank < 4; $rank++){
					$row_hot = mysqli_fetch_assoc($result_hot);
					
		?>
				
		<!-- 熱門排行榜(下) -->
		<div class="row mid hmes-head">
			<!-- 顯示名次 -->
			<div class="col-md-2 col-sm-2 col-3 middle">
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
						<?php 
							// 如果不是匿名
							if($row_hot['anonymous'] == 1){
								echo '<a href="../index/index.php?page=nickname&uid='.$row['UId'].'">';	
						?>
							<img src="../index/image/user.png" class="img-fluid rounded-circle" id="writer-pic"></a>
						<?php
							}else{ ?>
								<img src="../index/image/user.png" class="img-fluid rounded-circle" id="writer-pic">
						<?php	}//end else
						?>
					</div>
					<!-- 作者照片 end-->
					<!-- 作者-->
					<div class="col-md-8 col-sm-8 col-5" style="margin:0px; padding:0px;">
						<p class='w'><?php 
						if($row_hot['anonymous'] == 0){
							echo '匿名';
						}
						else if ($row_hot['anonymous'] == 1){
							echo $row_hot['post_name'];
						}
						?></p>
					</div>
					<!-- 作者 end-->

					<!-- 熱門按讚數 --> 
					<div class="col-md-3 col-sm-3 col-5 right" id = 'test'>
						<p style="display: inline; font-size:2.5vmin; font-weight:400; font-family:jf-openhuninn;"><?php echo $row_hot['likeCount'];?></p>
						<?php 
							if(isset($_SESSION['nickname'])){
								$sql_good = "SELECT * FROM good WHERE `UId` = \"$uid\" AND `CId` = \"$row_hot[CId]\"";
								
								$result_good = mysqli_query($link,$sql_good);
								$num = mysqli_num_rows($result_good);
								$Link = "../Article/good.php?cid=".$row_hot['CId'];

								if($num > 0){
									echo '<img class="good img-fluid pointer gbb" data-url="'.$Link.'" src="../index/image/good-black.png" id="good-pic">';
								}else {
									echo '<img class="good img-fluid pointer gbb" data-url="'.$Link.'" src="../index/image/good-white.png" id="good-pic">';
								}
							}else{
								echo '<img class="img-fluid pointer gbb" src="../index/image/good-white.png" id="good-pic">';
							}
						?>
						<?php if($row_hot['UId'] == $uid AND $row_hot['anonymous']!=2){?>
						<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
							<img src='../index/image/pen.png' id="btnGroupDrop1" class="edit-pic dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></img>
							<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
								<a class="dropdown-item" href="#">留言編輯</a>
								<a class="dropdown-item" href="../Article/edit.php?deletec=<?php echo $row_hot['CId'];?>">留言刪除</a>
							</div>
						</div>
						<?php }?>
					</div>
					<!-- 按讚數 end-->
					
					<div class="col-md-1 col-sm-1 col-1" style="margin:0px; padding:0px;">
						
					</div>
					<!-- 留言內容-->
					<div class="col-md-11 col-sm-11 col-11" style="margin:0px; padding:0px;">
						<p class="hmes"><?php echo 'B'.$row_hot['floor'].' - '.date('Y-m-d H:i',strtotime($row_hot['time']));?></p>
						<p class="hmes"><?php echo $row_hot['content'];?></p>
					</div>
					<!-- 留言內容 end-->
				</div>
				
			</div>				
		</div>
		<?php }//end for
		} //end if?>
	</div>
	<?php }//end if?>

	<?php } //如果沒有熱門留言?>
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
	
		<!-- 一般留言區(下) -->
		<div class="row mid hmes-head justify-content-center">
			<!-- 圖片 -->
			<!-- <div class="col-md-2 col-sm-2 col-3">
				<img src="../index/image/mes.png" class="img-fluid rounded-circle" style="height:8vh; width:auto;">
			</div> -->
			<!-- 圖片 end-->
			<!-- 樓層 -->
			<div class="col-md-2 col-sm-2 col-3 cir mid" style="text-align: center;">
				<p style='margin:0px; font-size:12pt; font-weight:400;'> <?=$row_c['floor'];?>F </p>
			</div>
			<!-- 樓層 end-->
			<!-- 留言區 -->
			<div class="col-md-10 col-sm-10 col-9 hmes-body ">
				<div class="row mid ">
					<!-- 作者照片-->
					<div class="col-md-1 col-sm-1 col-2" style="margin:0px; padding:0px;">
					
						<?php 
							// 如果不是匿名
							if($row_c['anonymous'] == 1){
								echo '<a href="../index/index.php?page=nickname&uid='.$row['UId'].'">';	
						?>
							<img src="../index/image/user.png" class="img-fluid rounded-circle" id="writer-pic"></a>
						<?php
							}else{ ?>
								<img src="../index/image/user.png" class="img-fluid rounded-circle" id="writer-pic">
						<?php	}//end else
						?>
					</div>
					<!-- 作者照片 end-->
					<!-- 作者-->
					<div class="col-md-8 col-sm-8 col-5" style="margin:0px; padding:0px;">
						<p class='w'><?php 
							if($row_c['anonymous'] == 0){
								echo '匿名';
							}else if ($row_c['anonymous'] == 1){
								echo $row_c['post_name'];
							}else{
								echo '掰掰用戶';
							}
						?></p>
					</div>
					<!-- 作者 end-->
					
					<!-- 留言按讚數 --> 
					<div class="col-md-3 col-sm-3 col-5">
					<?php if($row_c['anonymous']!=2){?>
						<p style="display: inline; font-size:2.5vmin; font-weight:400; font-family:jf-openhuninn;"><?php echo $row_c['likeCount'];?></p>
						<?php 
							if(isset($_SESSION['nickname'])){
								$sql_good = "SELECT * FROM good WHERE `UId` = \"$uid\" AND `CId` = \"$row_c[CId]\"";
								$result_good = mysqli_query($link,$sql_good);
								$num = mysqli_num_rows($result_good);
								$Link = "../Article/good.php?cid=".$row_c['CId'];

								if($num>0){
									echo '<img class="good img-fluid pointer gbb" data-url="'.$Link.'" src="../index/image/good-black.png" id="good-pic">';
								}else{
									echo '<img class="good img-fluid pointer gbb" data-url="'.$Link.'" src="../index/image/good-white.png" id="good-pic">';
								}
							}
							else{
								echo '<img class="img-fluid pointer gbb" src="../index/image/good-white.png" id="good-pic">';
							}
						?>

						<?php if($row_c['UId'] == $uid){?>
							<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
								<img src='../index/image/pen.png' id="btnGroupDrop1" class="edit-pic dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></img>
								<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
									<a class="dropdown-item" href="../index/index.php?page=article&aid=<?php echo $row_c['AId'];?>&edit=<?php echo $row_c['CId'];?>">留言編輯</a>
									<a class="dropdown-item" href="../Article/edit.php?deletec=<?php echo $row_c['CId'];?>">留言刪除</a>
								</div>
							</div>
						<?php }?>
					<?php }//如果anonymous != 2 end?>
					</div>
					<!-- 按讚數 end-->
						
					
					
					<div class="col-md-1 col-sm-1 col-1" style="margin:0px; padding:0px;"></div>
					<!-- 留言內容-->
					<div class="col-md-11 col-sm-11 col-11" style="margin:0px; padding:0px;">
						<p class="hmes"><?php echo 'B'.$row_c['floor'].' - '.date('Y-m-d H:i',strtotime($row_c['time']));?></p>
						<?php if($cid == $row_c['CId']){?>
							<form method="post" action="../Article/addcom.php?cid=<?php echo $row_c['CId'];?>&aid=<?php echo $row_c['AId'];?>">
								<div class="form-row">
									<div class="col-md-10 mb-5">
										<textarea class="form-control" id="comment" required name="content"><?php echo $row_c['content'];?></textarea>
										<a href="../index/index.php/?page=article&aid=<?php echo $row_c['AId'];?>"><button type="submit" class="btn btn-secondary btn-sm my-1">離開</button></a>
										<button type="submit" class="btn btn-secondary btn-sm my-1">修改</button>	
									</div>
								</div>
							</form>
						<?php }else{ ?>
							<p class="hmes"><?php echo $row_c['content'];?></p>
						<?php }?>
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
	
	<!-- 手動呼叫 -->
	<script>
		 function prevent_reloading(){
			var pendingRequests = {};
				jQuery.ajaxPrefilter(function( options, originalOptions, jqXHR ) {
					var key = options.url;
					console.log(key);
					if (!pendingRequests[key]) {
						pendingRequests[key] = jqXHR;
					}else{
						//jqXHR.abort();    //放棄後觸發的提交
						pendingRequests[key].abort();   // 放棄先觸發的提交
					}
					var complete = options.complete;
					options.complete = function(jqXHR, textStatus) {
						pendingRequests[key] = null;
						if (jQuery.isFunction(complete)) {
						complete.apply(this, arguments);
						}
					};
				});
			}

		$(document).ready(function(){
  			$(".dropdown-toggle").dropdown();
		});

		// 追蹤ajax
		$(".follow_bell").click(function(){
			var url = $(this).data("url");
			var eq = $(".follow_bell").index($(this));
			
			console.log(eq);

			$.ajax({
				type: 'POST',
				url: url,
				data: {type : "ajax"},
				dataType :"json"
			}).done(function( data ) {
				console.log(data);
				if(data['success'] == "OK"){
						$(".follow_bell").eq(eq).attr("src","../index/image/bell-black.png");
						console.log("black");
					}else if(data['success'] == "DEL_OK"){
						console.log(eq);
						$(".follow_bell").eq(eq).attr("src","../index/image/bell-white.png");
						console.log("white");
					}
			});
		});

		$(".good").click(function(){
            var url = $(this).data("url");
            var good = $(".good").index($(this));

			prevent_reloading();

            console.log(good);
            $.ajax({
                type: 'POST',
				url: url,
				data: {type : "ajax"},
				dataType :"json"
				
            }).done(function(data) {
				console.log(data);
				if(data['success'] == "OK"){

					$(".good").eq(good).attr("src","../index/image/good-black.png");
					console.log(good);
					// console.log(good_c);
				}else if(data['success'] == "DEL_OK"){

					// $(".Count").eq(count).html('0');
					$(".good").eq(good).attr("src","../index/image/good-white.png");
						// console.log("white");
						// console.log(good_c);	
				}
			});
        });
		
	</script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
