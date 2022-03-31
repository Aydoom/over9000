<!--<div class="grid-5 ta-l title">
	<h1 class="h1 zagl bold title">Over 9000</h1>
</div>-->
<div class="grid-11">
<?php
    $search = (isset($search)) ? $search : '';
    echo $this->Form->create('search',array(
            'url'=>'search',
            'inputDefaults' => array(
                'div'=>array('class'=>'grid-13'))
        ));
            echo $this->Form->input('words',array(
                'type'=>'text',
                'value'=>$search,
                'label'=>'',
                'class'=>'search'
                ));
            echo $this->Form->submit('Найти',array('type'=>'submit','div'=>array('class'=>'grid-3')
        ));
    echo $this->Form->end();
?>
</div>