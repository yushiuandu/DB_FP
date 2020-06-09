<?php
	date_default_timezone_set('Asia/Taipei');
	$datetime = date ("Y-m-d H:i:s" , mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y'))) ;
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
	if(isset($_GET['other'])){
		$other = $_GET['other'];

	}

	if(isset($_GET['NId'])){
		$sql = "UPDATE `notification` SET `is_read` = 1 WHERE `NId` = '$_GET[NId]'";
		mysqli_query($link,$sql);
		header("Location:../index/index.php?page=chat&other=$_GET[other]");
        exit;
	}
	// 找到對方的綽號
	$sql = "SELECT `Nickname` FROM `member` WHERE `UId` = \"$other\"";
	$result = mysqli_query($link,$sql);
	$row = mysqli_fetch_assoc($result);
	$other_name = $row['Nickname'];

	//找尋聊天紀錄
	$sql = "SELECT * FROM `chat` 
			WHERE (`UId` = \"$uid\" AND `other` = \"$other\") OR (`UId` = \"$other\" AND `other` = \"$uid\")
			ORDER BY `sendtime` ASC";
	$result = mysqli_query($link, $sql);


	$sql_pic = "SELECT * FROM `member` WHERE `UId` = \"$other\"";
	$result_pic = mysqli_query($link,$sql_pic);
	$row_pic_other = mysqli_fetch_assoc($result_pic);

	$sql_pic = "SELECT * FROM `member` WHERE `UId` = \"$uid\"";
	$result_pic = mysqli_query($link,$sql_pic);
	$row_pic = mysqli_fetch_assoc($result_pic);

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
		<script type="text/javascript">
			$(document).ready(function(){
				$('#chatting').scrollTop( $('#chatting')[0].scrollHeight);
				$('#chatting').scrollLeft( $('#chatting')[0].scrollWidth);
			});
			function add(){
				var now = new Date();
				var div = document.getElementById('chatting');
				div.scrollTop = div.scrollHeight;
			}
		</script>
	</head>
  <!-- 聊天室 -->
	<body>
		<!-- 聊天室的頭 -->
		
		<div class="chat-head">
			<div class="row mid">
				<div class="col-md-6 col-sm-6 col-6">
					<p style='font-size:18pt; font-weight:600; margin:0px;'><?php echo $other_name; ?></p>
				</div>

				<div class="col-md-6 col-sm-6 col-6 right">
					<div class="chat-con">
						<a href="../index/index.php?page=nickname&uid=<?php echo $other;?>">
						<img src="data:pic/png;base64,<?=base64_encode($row_pic_other["profile"]);?>" id="chat-pic">   
						</a>
					</div>    
				</div>
			</div>
		</div>
		<!-- 聊天室的頭 end -->
		<!-- 聊天室的中間段(對話區) -->
		<div class="chat-body" id="chatting">

			<?php 
				if((mysqli_num_rows($result)) > 0 ){
					while($row = mysqli_fetch_assoc($result)){
						if($row['is_read'] == 0){
							$sql_2 = "UPDATE `chat` SET `is_read` = 1 WHERE `CId` = '$row[CId]'";
							mysqli_query($link,$sql_2);
						}
						
						if($row['UId'] == $other){
			?>
			<!-- 對方的對話框 -->
			<div style='text-align:left;'>
				<!-- 假如回覆限時-->
				<?php if($row['igid'] != 0){
					$sql_ig = "SELECT * FROM `instagram` WHERE `igid` = '$row[igid]'";
					$result_ig = mysqli_query($link,$sql_ig);
					$row_ig = mysqli_fetch_assoc($result_ig);
				?>	
					<div class="uu_left">
						<!-- 自己的頭貼 -->
						<img src="data:pic/png;base64,<?=base64_encode($row_pic_other["profile"]);?>" class="img-fluid rounded-circle c-pic" >
						<div class="talk3">
							<div class="chat-con2">
								<img class="chat-pic" src="data:pic/png;base64,<?=base64_encode($row_ig["img"]);?>">
							</div>
						</div>
					</div>
				<?php	} //end ig if?>
				<!-- 假如回覆限時 end-->

				<!-- 假如限時被刪除 -->
				<?php if($row['igid'] == -1){
				?>	
					<!-- <div class="uu_left"> -->
						<!-- 自己的頭貼 -->
						<!-- <img src="data:pic/png;base64,<?=base64_encode($row_pic_other["profile"]);?>" class="img-fluid rounded-circle c-pic" >
						<div class="talk">
							<pre class='talk-word'>該限時已被刪除</pre>
						</div>
					</div> -->
				<?php	} //end ig if?>
				<!-- 假如限時被刪除 -->

				<!-- 對方頭貼 -->
				<img src="data:pic/png;base64,<?=base64_encode($row_pic_other["profile"]);?>" class="img-fluid rounded-circle c-pic" >
				<!-- 對方的話 -->
				<div class="talk">
					<pre class='talk-word'><?php echo $row['chat']; ?></pre>
				</div>
				
			</div>
				
			<p class="time-ww1"><?=date('Y/m/d H:i',strtotime($row['sendtime']));?></p>

			<!-- 對方的對話框 end -->
			<?php }//end if 對方
					else if($row['UId'] == $uid){?>

			<!-- 假如回覆限時-->
			<?php if($row['igid'] != 0){
				$sql_ig = "SELECT * FROM `instagram` WHERE `igid` = '$row[igid]'";
				$result_ig = mysqli_query($link,$sql_ig);
				$row_ig = mysqli_fetch_assoc($result_ig);
			?>	
				<div class="uu">
					<div class="talk3">
						<div class="chat-con2">
							<!-- style="width:50%;float:right;" -->
							<img class="chat-pic" src="data:pic/png;base64,<?=base64_encode($row_ig["img"]);?>">
						</div>
					</div>
					<!-- 自己的頭貼 -->
					<img src="data:pic/png;base64,<?=base64_encode($row_pic["profile"]);?>" class="img-fluid rounded-circle c-pic" >
				</div>
			<?php	} //end ig if?>
			<!-- 假如回覆限時 end-->

			<!-- 假如限時被刪除 -->
			<?php if($row['igid'] == 0){
			?>	
				<!-- <div class="uu"> -->
					<!-- 自己的話 -->
					<!-- <div class="talk2"> 
						<pre class='talk-word'>該限時已被刪除</pre>
					</div>
					<div class="u"> 
						<p class="time-ww2"><?=date('Y/m/d H:i',strtotime($row['sendtime']));?></p>
					</div> -->
					<!-- 自己的頭貼 -->
					<!-- <img src="data:pic/png;base64,<?=base64_encode($row_pic["profile"]);?>" class="img-fluid rounded-circle c-pic" >
				</div> -->
			<?php	} //end ig if?>
			<!-- 假如限時被刪除 -->

			<!-- 自己的對話框 -->
			<div class="uu">
				<!-- 自己的話 -->
				<div class="talk2"> 
					<pre class='talk-word'><?php echo $row['chat']; ?></pre>
				</div>
				<div class="u"> 
					<p class="time-ww2"><?=date('Y/m/d H:i',strtotime($row['sendtime']));?></p>
				</div>
				<!-- 自己的頭貼 -->
				<img src="data:pic/png;base64,<?=base64_encode($row_pic["profile"]);?>" class="img-fluid rounded-circle c-pic" >
			</div>
			<!-- 自己對話框 end -->

			<?php 		}//end else if
					}//end while
				}//end if?>
			<div><a id="msg_end" name="1" href="#1">&nbsp</a></div>
		</div>
		<!-- 聊天室的中間段(對話區) -->
		<!-- 聊天室的尾段(輸入區) -->
		<div class="chat-fotter">
			<form method="post" style="position: relative; left: 15px;">
				<input id="chat" name="chat" type="text" placeholder='說點什麼吧...'>
				<button type="submit" data-url="../index/addchat.php?send=<?php echo $other;?>" style="margin-left: 10px;" class="btn btn-secondary btn-sm my-1" id="chat_sub">傳送</button>
			</form>
		</div>
		<!-- 聊天室的尾段(輸入區) -->
		
		<script>
			
			$(function(){
				setInterval(getalarm_chat,100)
			});

			function getalarm_chat (){
				var url = "../index/notify.php?other=<?php echo $other;?>";

				$.ajax({
					type: 'POST',                     //GET or POST
					url: url,  //請求的頁面
					cache: false,   //是否使用快取
					dataType : 'json'
				}).done(function(data) {
					console.log(data);
					if(data['success'] == "YES"){
						var content_chat = data["content"];
						console.log(content_chat);
						var chat = "<div style='text-align:left;'>"+'<img src="data:pic/png;base64,<?=base64_encode($row_pic_other["profile"]);?>" class="img-fluid rounded-circle c-pic" >'+
									'<div class="talk">'+"<pre class='talk-word'>"+content_chat+"</pre>" + "</div></div><p class='time-ww2'>"+data['date']+"</p>";
						console.log(chat); 
						$("#chatting").append(chat);
						add();
					}
				});
			};


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

			$("#chat_sub").click( function(e){
				var url = $(this).data("url");

				$.ajax({
					type: "POST",
					url: url,
					data: { //傳送資料
						chat: $("#chat").val(), 
					},
					dataType :"json"
				}).done(function(data) {
					console.log(data);
					if(data['success'] == "OK"){
						var chat = data['content'];
						var content = "<div style='text-align:right;'><div class='talk2'><pre class='talk-word'>"+chat+"</pre></div>"
									+'<div class="u"> <p class="time-ww2">'+data['date']+'</p></div>'+
									'<img src="data:pic/png;base64,<?=base64_encode($row_pic["profile"]);?>" class="img-fluid rounded-circle c-pic" ></div>';
						console.log(content);
						$("#chatting").append(content);
						$("#chat").val('');
						add();
					}
				});

				e.preventDefault(); // avoid to execute the actual submit of the form.
			
			});
		
		
		</script>
		
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	</body>
</html>
