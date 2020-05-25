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
    $sql = "SELECT article.UId as `UId` ,max(floor) as `floor`, article.title as `title`
            FROM `article`JOIN `comment` 
            WHERE article.AId = '$aid' AND comment.AId =\"$aid\"";
    $result = mysqli_query($link,$sql);
    $row = mysqli_fetch_assoc($result); 
    $author = $row['UId'];
    $floor = $row["floor"] +1;
    $title = $row['title'];
    
    // 看誰follow
    $sql_follow = "SELECT `UId` FROM `follow` WHERE `AId` = '$aid'";
    $result_f = mysqli_query($link,$sql_follow);
    $num_f = mysqli_num_rows($result_f);

    $sql = "INSERT INTO `comment`(`AId`, `UId`, `content`, `likeCount`, `time`, `anonymous`, `post_name`, `floor`) 
    VALUES('$aid', '$uid','$content',0 ,'$datetime','$anonymous', '$_SESSION[nickname]','$floor')";
    
    if (!mysqli_query($link,$sql))
    {die('Error: ' . mysqli_error());}
    else{
        // 通知作者
        $content = "你的貼文「<b>".$title."</b>」有人來留言拉，趕快去看看吧！！";
        $sql = "SELECT * FROM `notification` WHERE `AId` = '$aid' AND `is_read` = 0 AND `type` = 3";
        $result = mysqli_query($link,$sql);
        $num = mysqli_num_rows($result);

        if($num == 0){
            $sql = "INSERT INTO `notification`(`UId`,`AId`,`content`,`type`) VALUES ('$author', '$aid','$content', 3)";
            mysqli_query($link,$sql);
        }

        $content = "你追蹤的貼文「<b style='margin:0px; font-weight:700;'>".$title."</b>」有新的留言拉，趕快去看看吧！！";
        if($num_f > 0){
            while($row = mysqli_fetch_assoc($result_f)){
                $sql = "INSERT INTO `notification`(`UId`,`AId`,`content`,`type`) VALUES ('$row[UId]', '$aid','$content', 5)";
                mysqli_query($link,$sql);
            }
        }
        header("Location:../index/index.php?page=article&aid=$aid"); 
    exit;
    }
    }
?>