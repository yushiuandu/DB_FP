<?php

    $link = mysqli_connect("localhost","taigun","ELn3yv07F567MwOF","taigun");//連結伺服器//選擇資料庫
    if(!$link){
    echo "no connect!";
    }

    function findFourm ($category){
        if($category == "relationship"){
            $category = '感情版';
        }

        if($category == "food"){
            $category = '食物版';
        }

        if($category == "makeup"){
            $category = '美妝版';
        }

        if($category == "travel"){
            $category = '旅遊版';
        }

        if($category == "trending"){
            $category = '新聞版';
        }

        if($category == "funny"){
            $category = '有趣版';
        }

        if($category == "other"){
            $category = '其他版';
        }

        return $category;
    }

    function finduid($nickname){
        $link = mysqli_connect("localhost","taigun","ELn3yv07F567MwOF","taigun");//連結伺服器//選擇資料庫
        if(!$link){
            echo "no connect!";
        }
        if(isset($_SESSION['nickname'])){
            $nick = $_SESSION['nickname'];
            $sql = "SELECT `UId` FROM `member` WHERE `Nickname` = \"$nick\"";
            $result = mysqli_query($link,$sql);
            $row = mysqli_fetch_assoc($result);
            $UId = $row['UId'];
            return $UId;
        }
        
    }
?>