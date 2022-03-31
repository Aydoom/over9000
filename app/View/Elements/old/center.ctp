<?php
    //pr($articles);exit; 
    foreach($articles as $key => $val){
        echo $this->User->ArticleBlock($articles[$key]['Article'],$domens);
    }
        echo "&nbsp;";
?>
