<?php
    $link = mysqli_connect("localhost","taigun","ELn3yv07F567MwOF","taigun");//連結伺服器//選擇資料庫
    if(!$link){
        echo "no connect!";
    }
    
    if(isset($_GET['igid'])){
        $ig = $_GET['igid'];

        $emoji = $_GET['emoji'];
        $sql = "SELECT * FROM `instagram` WHERE `igid` = '$ig'";
        $result_emoji = mysqli_query($link,$sql);
        $row_emoji = mysqli_fetch_assoc($result_emoji);
        $count = $row_emoji[$emoji];
        $count = $count + 1;

        $sql_emoji = "UPDATE `instagram` SET `$emoji` = '$count' WHERE `igid` = '$ig'";
        if(!(mysqli_query($link,$sql_emoji))){
            mysqli_error();
        }else{
            exit(json_encode(array("success"=>"OK","count"=>$count)));
        }

    }


?>