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
?>

<?php 
	$aid = ''; $follow ="";

	if(isset($_GET['aid'])){
        $aid = $_GET['aid'];
    }
	if(isset($_GET['follow'])){
        $follow = $_GET['follow'];
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
			echo 'success';
			header("Location:../index/index.php?page=index&id=$forum"); 
			exit;
		}else{
			echo 'failQQ';
		}

	}

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
			echo 'success';
			header("Location:../index/index.php?page=nickname&uid=$follow_uid"); 
			exit;
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
			echo 'success';
			header("Location:../index/index.php?page=tag&tag=$tag"); 
			exit;
		}else{
			echo 'failQQ';
		}
	}
	
	if($follow == 0){
		$sql = "INSERT INTO `follow` (`UId`,`AId`,`follow_time`) VALUES ('$uid', '$aid', '$datetime')";
		if(mysqli_query($link,$sql)){
			echo 'success';
			header("Location:../index/index.php?page=article&aid=$aid"); 
			exit;
		}else{
			echo 'failQQ';
		}
	}else{
		$sql = "DELETE FROM `follow` WHERE `UId` = '$uid' AND `AId` = '$aid'";
		if(mysqli_query($link,$sql)){
			echo 'success';
			header("Location:../index/index.php?page=article&aid=$aid"); 
			exit;
		}else{
			echo 'failQQ';
		}
	}

?>