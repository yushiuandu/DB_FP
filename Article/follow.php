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