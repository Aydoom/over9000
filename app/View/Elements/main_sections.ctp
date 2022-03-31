<div class="descript">
    <p class="h1 ta-j c1">Разделы:</p>
</div>
<div class="clear"></div>
<?php 
    $d1 = ceil(count($categories)/2);
    $d2 = count($categories) - $d1;
    echo $this->Html->div("put-1 grid-7 ta-l", $this->User->ShowLinks(0,$d1,$categories));
    echo $this->Html->div("put-1 grid-7 ta-l", $this->User->ShowLinks($d1,$d1+$d2,$categories));
?>

