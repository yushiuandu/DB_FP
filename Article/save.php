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
	$aid = ''; $save ="";

	if(isset($_GET['aid'])){
        $aid = $_GET['aid'];
    }
	if(isset($_GET['save'])){
        $save = $_GET['save'];
	}
	
	if($save == 0){
		$sql = "INSERT INTO `save` (`UId`,`AId`,`save_group`) VALUES ('$uid', '$aid', 'ALL')";
	}else{
		$sql = "DELETE FROM `save` WHERE `UId` = '$uid' AND `AId` = '$aid'";
	}

	if(mysqli_query($link,$sql)){
		echo 'success';
	}else{
		echo 'failQQ';
	}

?>