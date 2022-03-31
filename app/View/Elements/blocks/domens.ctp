<?php //echo $this->User->RightBlock($domens,'name','name',$act_domen,'lfix-1 h4 bold drop-5 grid-7',"domen")?>
<?php
//pr($domens);exit;
    $params = (isset($this->params['pass'][0]) &&  isset($this->params['action']) && $this->params['action']=="domen") ? true : false;

    $text = '<ul class="put-1 under-20">';
    foreach ($domens as $key => $val){
        $text.='<li class="h3 hh20">';
        if ($params && $domens[$key]['alias']==$this->params['pass'][0])
            $text.=$this->Html->para("c_err",$domens[$key]['name']);
        else
            $text.=$this->Html->link($domens[$key]['name'],$this->User->getUrl($domens[$key]['alias'],"domen"),array("class"=>"un"));
        $text.="</li>";
    }
    
    if(!$params)
        $text.=$this->Html->para("c_err","Все сайты");
    else
        $text.=$this->Html->link("Все сайты",$this->User->getUrl(),array("class"=>"un"));
    
    $text.="</ul>";
    
   echo  $this->User->RightBlock("Сайты",$text);
?>