<?php
    //print_r($domens);exit;
    //print_r($articles);exit;
    if(isset($articles) && is_array($articles)){
        foreach($articles as $key => $val){
            echo $this->User->ArticleBlock2($articles[$key]['Article'],$domens);
        }
    }
?>