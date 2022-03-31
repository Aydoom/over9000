<div class="drop-30">
<?php
    //pr($articles);exit; 
    foreach($articles as $key => $val){
        echo $this->User->ArticleBlock2($articles[$key]['Article'],$domens);
    }
        echo "&nbsp;";
?>
</div>