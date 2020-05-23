<?php session_start();?>
<?php 

    $link = mysqli_connect("localhost","taigun","ELn3yv07F567MwOF","taigun");//連結伺服器//選擇資料庫
        if(!$link){
        echo "no connect!";
    }
    //修改留言
    if(isset($_GET['cid'])){
		$aid = $_GET['aid'];
		$cid = $_GET['cid'];
		$sql = "UPDATE `comment` SET `content` = \"$_POST[content]\" WHERE CId = \"$cid\"";
		if(mysqli_query($link, $sql)){
			header("Location:../index/index.php?page=article&aid=$aid");
			exit;
		}else{
			echo "fail";
		}
	}else{

    // 先找出輸入留言者的UID
    include("../index/forum.php");
    if($_SESSION['nickname']){
        $uid = finduid($_SESSION['nickname']);
    }

    // 取得變數
    date_default_timezone_set('Asia/Taipei');
    $datetime = date ("Y-m-d H:i:s" , mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y'))) ;
    $content = $_POST["content"];
    $anonymous = $_POST["anonymous"];
    $aid = $_SESSION["aid"];

    // 找出作者
    $sql = "SELECT `UId` FROM `article` WHERE `AId` = '$aid'";
    $result = mysqli_query($link,$sql);
    $row = mysqli_fetch_array($result); 
    $author = $row['UId'];
    
    $sql = "SELECT max(floor) FROM `comment` WHERE `AId` = \"$aid\"";
    $result = mysqli_query($link,$sql);
    $row = mysqli_fetch_array($result); 
    $floor = $row["0"] +1;

    $sql = "INSERT INTO `comment`(`AId`, `UId`, `content`, `likeCount`, `time`, `anonymous`, `post_name`, `floor`) 
    VALUES('$aid', '$UId','$content',0 ,'$datetime','$anonymous', '$_SESSION[nickname]','$floor')";
    
    if (!mysqli_query($link,$sql))
    {die('Error: ' . mysqli_error());}
    else{
        $content = "你的貼文有人來留言拉，趕快去看看吧！！";
        $sql = "INSERT INTO `notification`(`UId`,`AId`,`content`,`is_read`) VALUES ('$author', '$aid','$content', 0)";
        mysqli_query($link,$sql);
        
        header("Location:../index/index.php?page=article&aid=$aid"); 
    exit;
    }}
?>