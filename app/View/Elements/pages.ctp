<?php // Страницы => Пагинатор ?>
<?php // Основной блок пагинатора ?>
<div class="hh25 put-1 grid-11 inline ov-y" id="top_article">
    <?php echo $shadow; ?>
    <ul class="fl pages ta-l rel">
        <li><p class="h4 c1">страницы: </p></li>
        <?php
            if(isset($this->params['pass'][0]))
               $second_active = $this->params['pass'][0];
            else $second_active = null;
            
            if($this->params['action'] == 'search'){
				$second_active = null;
				if(isset($this->params['pass'][0]))
					$page = $this->params['pass'][0];
			}
            
            
            if(isset($this->params['pass'][1])){
                $s = $this->params['pass'][1] - 4;
                $f = $this->params['pass'][1] + 5;
                if($s<1){
                    $s = 1;
                    $f = 11;
                }
                $page = $this->params['pass'][1];
            }
			elseif(isset($page)){
                $s = $page - 4;
                $f = $page + 5;
                if($s<1){
                    $s = 1;
                    $f = 11;
                }
 			}
            else{
                $s = 1;
                $f = 11;
                if(empty($page)) $page = 1;
            }
            for($i=$s;$i<$f;$i++){
                $un = (empty($color) && $i == $page) ? "c_err" : "c1";
                echo '<li>';
                echo $this->Html->link(
                    $i,
                    array(
                        'controller' => $this->params['controller'], 
                        'action' =>$this->params['action'],
                        $second_active,
                        $i),
                    array('class' => 'page ta-c h5 '.$un));
                echo '</li>';
            }
        ?>
    </ul>
</div>
