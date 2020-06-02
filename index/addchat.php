<?php 
    session_start();
    date_default_timezone_set('Asia/Taipei');
	$datetime = date ("Y-m-d H:i:s" , mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y'))) ;
    $link = mysqli_connect("localhost","taigun","ELn3yv07F567MwOF","taigun");
	if(!$link){
		echo "no connect!";
    }
    include("../index/forum.php");
		$uid = "";
		if(isset($_SESSION['nickname'])){
			$uid = finduid($_SESSION['nickname']);
		}
    if(isset($_GET['send'])){
		$other = $_GET['send'];
		$content = $_POST['chat'];

		$sql = "INSERT INTO `chat` (`UId`,`other`,`chat`,`sendtime`) VALUES ('$uid','$_GET[send]','$content','$datetime')";
		$datetime = date('Y/m/d H:i',strtotime($datetime));
		
		if(mysqli_query($link, $sql)){
			exit(json_encode(array("success"=>"OK","content"=>$content,"date"=>$datetime)));
		}else{
			mysqli_error();
		}
	}
?>