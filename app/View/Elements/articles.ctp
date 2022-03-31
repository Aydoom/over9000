    <!--Назад-->

<?php
    // Сами обзоры
    if(isset($articles)){
        if(is_array($articles)){
            if(!empty($Varticles) || count($articles)==1){
                foreach($articles as $key => $val){
                    echo $this->User->ArticleBlock2($articles[$key]['Article'],$domens);
                }
            }
            else{
                foreach($articles as $key => $val){
                    echo $this->User->ArticleBlock2($articles[$key]['Article'],$domens,true);
                }
            }
        }
        elseif(count($articles) == 0){
            echo "<h2>По данному запросу ни чего не найдено</h2>";
        }
    }
?>
