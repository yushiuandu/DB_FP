<?php

    $link = mysqli_connect("localhost","taigun","ELn3yv07F567MwOF","taigun");
    if(!$link){
		echo "no connect!";
    }

    function check($num1,$num2){
        $link = mysqli_connect("localhost","taigun","ELn3yv07F567MwOF","taigun");
        $sql = "SELECT * FROM `friend` WHERE `UId` = '$num1' and `otherId` = '$num2'";
        $result = mysqli_query($link,$sql);
        if(mysqli_num_rows($result) == 0){
            return true;
        }else{
            return false;
        }
    }

    function add_to_database($num,$num2){
        $link = mysqli_connect("localhost","taigun","ELn3yv07F567MwOF","taigun");

        $sql = "SELECT * FROM `member` WHERE `UId` = '$num' OR `UId` = '$num2'";
        $result = mysqli_query($link,$sql);
        // 讀取第一個人的綽號
        $row = mysqli_fetch_assoc($result);
        $nickname1 = $row['Nickname'];
         // 讀取第二個人的綽號
        $row = mysqli_fetch_assoc($result);
        $nickname2 = $row['Nickname'];

        if(check($num,$num2) == true){
            // 加好友
            $sql = "INSERT INTO `friend` (`UId`,`otherId`) VALUES ('$num','$num2')";
            mysqli_query($link,$sql);
            $sql = "INSERT INTO `friend` (`UId`,`otherId`) VALUES ('$num2','$num')";
            mysqli_query($link,$sql);

            // 通知有新朋友了
            // 待做：如果有通知就不用進去了
            $content = "你有新朋友了！趕快來查看吧！";
            
            $sql = "INSERT INTO `notification` (`UId`,`friendid`,`content`,`type`) VALUES ('$num','$num2','$content',9)";
            mysqli_query($link,$sql);
            
            
            $sql = "INSERT INTO `notification` (`UId`,`friendid`,`content`,`type`) VALUES ('$num2','$num','$content',9)";
            mysqli_query($link,$sql);
            
            
        }
        
    }

    function match ($num,$arr){
        //配對
            if($num % 2 == 0){ //如果選擇這個選項的人是偶數
                $random_num = rand(1,$num-1);

                echo $arr[0]."對象：".$arr[$random_num]."<br>";

                // 加好友
                add_to_database($arr[0],$arr[$random_num]);
                
                // 清除array裡的UId
                if (($key = array_search($arr[$random_num], $arr)) !== false) {
                    unset($arr[$key]);
                }
                if (($key = array_search($arr[0], $arr)) !== false) {
                    unset($arr[$key]);
                }
                // 重整array
                $arr = array_values($arr);
                print_r($arr);
                

                if($num - 2 != 0){
                    match($num-2,$arr);
                }
    
            }else{ //奇數
                $random_num = rand(1,$num-1);
                $random_2 = rand(1,$num-1);

                while($random_2 == $random_num ){
                    $random_2 = rand(1,$num-1);
                }

                echo $arr[0]."對象：".$arr[$random_num]."+".$arr[$random_2]."<br>";

                // 加好友
                add_to_database($arr[0],$arr[$random_num]);
                add_to_database($arr[0],$arr[$random_2]);
                add_to_database($arr[$random_2],$arr[$random_num]);
                

                if (($key = array_search($arr[$random_num], $arr)) !== false) {
                    unset($arr[$key]);
                }
                if (($key = array_search($arr[$random_2], $arr)) !== false) {
                    unset($arr[$key]);
                }
                if (($key = array_search($arr[0], $arr)) !== false) {
                    unset($arr[$key]);
                }

                $arr = array_values($arr);
                print_r($arr);

                
                if($num - 3 != 0){
                    match($num-3,$arr);
                }
            }
    }

    // 找出它有幾個ans
    $sql = "SELECT `ansid` FROM `ans` WHERE `testid` = 1";
    $result = mysqli_query($link,$sql);

    // 把選這個答案的user存進陣列
    while($row = mysqli_fetch_assoc($result)){
        $sql = "SELECT `UId` FROM `user_ans` WHERE `Ans` = '$row[ansid]'";//選擇這個答案的user
        $result_a = mysqli_query($link, $sql);
        $user = array();    //創建新陣列
        $num = mysqli_num_rows($result_a); //計算有幾個user

        // 將user 存進陣列方便隨機配對
        for($i = 0 ; $i < $num ; $i++){
            $row_user = mysqli_fetch_assoc($result_a);
            $user[$i] = $row_user['UId'];
        }

        
        echo "<br>第".$row['ansid']."個答案<br>";
        print_r($user);
        match($num,$user);
        echo "<br>";

    }
    

?>