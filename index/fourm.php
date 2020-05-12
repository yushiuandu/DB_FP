<?php
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
?>