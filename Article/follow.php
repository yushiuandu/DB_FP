<?php session_start();
    $link = mysqli_connect("localhost","taigun","ELn3yv07F567MwOF","taigun");
	if(!$link){
		echo "no connect!";
    }
    #找出uid
    include("../index/forum.php");
	if(isset($_SESSION['nickname'])){
		$uid = finduid($_SESSION['nickname']);
	}
	date_default_timezone_set('Asia/Taipei');
    $datetime = date ("Y-m-d H:i:s" , mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y'))) ;

	$aid = ''; $follow ="";

	// 追蹤文章
	if(isset($_GET['aid'])){
		$aid = $_GET['aid'];
		$sql = "SELECT * FROM `follow` WHERE `AId` = \"$aid\" AND `UId` = \"$uid\"";
		$result = mysqli_query($link, $sql);
		$num = mysqli_num_rows($result);

		if($num == 0){
			$sql = "INSERT INTO `follow` (`UId`,`AId`,`follow_time`) VALUES ('$uid', '$aid', '$datetime')";
		}else{
			$sql = "DELETE FROM `follow` WHERE `UId` = '$uid' AND `AId` = '$aid'";
		}

		if(mysqli_query($link,$sql)){
			if($_POST['type'] == 'ajax'){
				if($num == 0){
					exit(json_encode(array("success"=>"OK")));
				}else{
					exit(json_encode(array("success"=>"DEL_OK")));
				}
			}else{
				echo 'success';
				header("Location:../index/index.php?page=article&aid=$aid"); 
				exit;
				echo 'failQQ';
			}
		}else{
			echo 'failQQ';
		}
    }
	

	// 追蹤看板
	if(isset($_GET['forum'])){
		$forum = $_GET['forum'];
		$sql = "SELECT * FROM `follow` WHERE `category` = \"$forum\" AND `UId` = \"$uid\"";
		$result = mysqli_query($link, $sql);
		$num = mysqli_num_rows($result);

		if($num > 0){
			$sql = "DELETE FROM `follow` WHERE `UId` = \"$uid\" AND `Category` = \"$forum\"";
		}else{
			$sql = "INSERT INTO `follow` (`UId`,`Category`,`follow_time`) VALUES ('$uid', '$forum', '$datetime')";
		}

		if(mysqli_query($link,$sql)){
			if($_POST['type'] == 'ajax'){
				if($num == 0){
					exit(json_encode(array("success"=>"OK")));
				}else{
					exit(json_encode(array("success"=>"DEL_OK")));
				}
			}else{
				echo 'success';
				header("Location:../index/index.php?page=index&id=$forum"); 
				exit;
				echo 'failQQ';
			}
		}else{
			echo 'failQQ';
		}
	}

	// 追蹤人
	if(isset($_GET['followuid'])){
		$follow_uid = $_GET['followuid'];

		$sql = "SELECT * FROM `follow` WHERE `follow_id` = \"$follow_uid\" AND `UId` = \"$uid\"";
		$result = mysqli_query($link, $sql);
		$num = mysqli_num_rows($result);

		$sql_add = "SELECT `Fans_num` FROM `member` WHERE `UId` = \"$follow_uid\"";
		$result_add = mysqli_query($link, $sql_add);
		$row = mysqli_fetch_assoc($result_add);
		$fans_num = $row['Fans_num'] + 1;

		if($num == 0){
			$sql = "INSERT INTO	`follow` (`UId`, `follow_id`, `follow_time`) VALUES ('$uid', '$follow_uid', '$datetime')";
			$fans_num = $row['Fans_num'] + 1;
			$sql_num = "UPDATE `member` SET `Fans_num` = \"$fans_num\" WHERE `UId` = '$follow_uid'";
		}else{
			$sql = "DELETE FROM `follow` WHERE `follow_id` = \"$follow_uid\" AND `UId` = \"$uid\"";
			$fans_num = $row['Fans_num'] - 1;
			$sql_num = "UPDATE `member` SET `Fans_num` = \"$fans_num\" WHERE `UId` = '$follow_uid'";
		}

		if(mysqli_query($link,$sql)){
			mysqli_query($link,$sql_num);
			if($_POST['type'] == 'ajax'){

				if($num == 0){
					$content = "有<b>新的追隨者</b>開始追蹤你了！看來你的風格很受歡迎喔！";
					$sql = "SELECT * FROM `notification` WHERE `UId` = '$follow_uid' AND `is_read` = 0 AND `type` = 1";
					$result = mysqli_query($link,$sql);
					$num_r = mysqli_num_rows($result);
					if($num_r == 0){
						$sql = "INSERT INTO `notification` (`UId`,`content`,`type`) VALUES ('$follow_uid', '$content', 1)";
						mysqli_query($link,$sql);
					}
					
					exit(json_encode(array("success"=>"OK","fans_num"=>$fans_num)));
				}else{
					exit(json_encode(array("success"=>"DEL_OK","fans_num"=>$fans_num)));
				}
			}else{
				echo 'success';
				header("Location:../index/index.php?page=nickname&uid=$follow_uid"); 
				exit;
				echo 'failQQ';
			}
		}else{
			echo 'failQQ';
		}
	}

	if(isset($_GET['tag'])){
		$tag = $_GET['tag'];
		$sql = "SELECT * FROM `follow` WHERE `Tag` = \"$tag\" AND `UId` = \"$uid\"";
		$result = mysqli_query($link, $sql);
		$num = mysqli_num_rows($result);

		if($num > 0){
			$sql = "DELETE FROM `follow` WHERE `UId` = \"$uid\" AND `Tag` = \"$tag\"";
		}else{
			$sql = "INSERT INTO `follow` (`UId`,`Tag`,`follow_time`) VALUES ('$uid', '$tag', '$datetime')";
		}
		if(mysqli_query($link,$sql)){
			if($_POST['type'] == 'ajax'){
				if($num == 0){
					exit(json_encode(array("success"=>"OK")));
				}else{
					exit(json_encode(array("success"=>"DEL_OK")));
				}
			}else{
				echo 'success';
				header("Location:../index/index.php?page=tag&tag=$tag"); 
				exit;
				echo 'failQQ';
			}
		}else{
			echo 'failQQ';
		}
	}
	
	if($follow == 0){
		$sql = "INSERT INTO `follow` (`UId`,`AId`,`follow_time`) VALUES ('$uid', '$aid', '$datetime')";
		if(mysqli_query($link,$sql)){
			if($_POST['type'] == 'ajax'){
				exit(json_encode(array("success"=>"OK")));
			}
				
			else{
				echo 'success';
				header("Location:../index/index.php?page=article&aid=$aid"); 
				exit;
				echo 'failQQ';
			}
		}else{
			echo 'failQQ';
		}
	}else{
		$sql = "DELETE FROM `follow` WHERE `UId` = '$uid' AND `AId` = '$aid'";
		if(mysqli_query($link,$sql)){
			if($_POST['type'] == 'ajax'){
				exit(json_encode(array("success"=>"DEL_OK")));
			}else{
				echo 'success';
				header("Location:../index/index.php?page=article&aid=$aid"); 
			}

			exit;
		}else{
			echo 'failQQ';
		}
	}

?>