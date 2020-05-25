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

	// 如果有那個分類
	if(isset($_GET['group'])){
		$group = $_GET['group'];
		
		$sql = "INSERT INTO `save`(`UId`,`AId`,`save_group`) VALUES ('$uid', '$_SESSION[aid]','$group')";
		if(mysqli_query($link,$sql)){
			if($_POST['type'] == 'ajax'){
				exit(json_encode(array("success"=>"SAVE_OK")));
			}
		}else{
			echo 'failQQ';
		}
	}else{ // 從收藏刪除
		$sql = "DELETE FROM `save` WHERE `UId` = '$uid' AND `AId` = '$_SESSION[aid]'";
		if(mysqli_query($link,$sql)){
			if($_POST['type'] == 'ajax'){
				exit(json_encode(array("success"=>"SAVE_DEL_OK")));
			}
		}else{
			echo 'failQQ';
		}
	}

?>