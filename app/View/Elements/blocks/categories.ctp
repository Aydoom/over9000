<?php //echo $this->User->RightBlock($rubrics,'code','title',$act_rubric,'lfix-1 h4 bold drop-5 minW',"category")?>
<?php
//pr($rubrics);
    $params = (isset($this->params['pass'][0]) &&  isset($this->params['action']) && $this->params['action']=="category") ? true : false;

    $text = '<ul class="put-1 under-20">';
    foreach ($rubrics as $key => $val){
        $text.='<li class="h3 hh20">';
        if ($params && $rubrics[$key]['code']==$this->params['pass'][0])
            $text.=$this->Html->para("c_err",$rubrics[$key]['title']);
        else
            $text.=$this->Html->link($rubrics[$key]['title'],$this->User->getUrl($rubrics[$key]['code'],"category"),array("class"=>"un"));
        $text.="</li>";
    }
    
    if(!$params)
        $text.=$this->Html->para("c_err","Все разделы");
    else
        $text.=$this->Html->link("Все разделы",$this->User->getUrl(),array("class"=>"un"));
    
    $text.="</ul>";
    
   echo  $this->User->RightBlock("Разделы",$text);
?>
