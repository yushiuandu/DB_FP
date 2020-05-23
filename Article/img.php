<?php
// 上傳圖片至imgur
    //imgur api 
    $client_id="21620b882fef7ec";
    
    $image = base64_encode(fread( fopen( $_FILES["YouFile"]["tmp_name"] , "r") ,  filesize( $_FILES["YouFile"]["tmp_name"]) ));

    $curl_post_array = [
        'image' => $image,
    ];

    $timeout = 30;
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
    curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_array);

    $curl_result = curl_exec($curl);
    curl_close ($curl);
    $Received = json_decode($curl_result,true);

    // print_r($Received);

    if ($Received['success'] == true) {
        $Imgid = $Received['data']['id'];
        echo $Imgid;
        // if($_POST['type'] == 'ajax'){
            exit(json_encode(array("success"=>"OK")));
        // }
        // echo "\n".$ImgURL."\n";
    } else {
        echo "Error<br/><br/>".$Received['data']['error'];
        // if($_POST['type'] == 'ajax'){
            exit(json_encode(array("success"=>"NO")));
        // }
    }

?>
iRLijyf
RCDrTZQ
KuTKOqE
B5rugAA
0POa4oS