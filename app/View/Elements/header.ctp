<!-- Заголовок -->
<div class="put-1 grid-7 ta-l hh75">
    <?php 
        echo $this->Html->link('Over9000',
            array('controller' => 'index'),
            array('class' => 'c2 link_in_title h1','title' => 'Over9000 все обзоры и статьи рунета о компьютерном железе '));
    ?>
</div>
<!-- Поле поиска -->
<div class="grid-7">
    <?php
        $search = (isset($search)) ? $search : '';
        echo $this->Form->create('search',array(
                'url'=> array('controller'=>'section','action'=>'search'),
                'inputDefaults' => array(
                    'div'=>array('class'=>'grid-13'))
            ));
                echo $this->Form->input('text',array(
                    'type'=>'text',
                    'value'=>$search,
                    'label'=>'',
                    'class'=>'search'
                    ));
                echo $this->Form->submit('O',array(
                    'type'=>'submit',
                    'class'=>'searchS bg0',
                    'div'=>array('class'=>'grid-2')
            ));
        echo $this->Form->end();
    ?>
</div>

<nav class="grid-7 ta-l inline drop-15">
    <ul>
        <li class="grid-4 put-12">
            <?php echo $this->Html->link(
                'разделы',
                array('controller' => 'section', 'action' => 'menu'),
                array('class' => 'h4 c0 ta-l','id' => 'link_sect'));
            ?>
        </li>
        <!--<li class="grid-4">
            <?php echo $this->Html->link(
                'настройки',
                array('controller' => 'index', 'action' => 'options', 'full_base' => true),
                array('class' => 'h4 c0 ta-l','id' => 'link_options'));
            ?>
        </li>
        <li class="grid-4">
            <?php echo $this->Html->link(
                'о проекте',
                array('controller' => 'index', 'action' => 'about', 'full_base' => true),
                array('class' => 'h4 c0 ta-l','id' => 'link_about'));
            ?>
        </li>
        <li class="grid-4">
            <?php echo $this->Html->link(
                'войти',
                array('controller' => 'index', 'action' => 'enter', 'full_base' => true),
                array('class' => 'h4 c0 ta-l','id' => 'link_enter'));
            ?>
        </li>-->
    </ul>
</nav>
<div class="clear"></div>
<div class="fl off" id="sections">
    <div class="grid-11 bor">
        <h4 class="un ta-c h20">
            Разделы:
        </h4>
        <?php 
            //if(isset($menu) && $menu!=="off"){
        ?>
        <div class="pull-1 grid-5">
            <ul class="up up_menu">
                <li><a href="#" class="h4 c0 topM" ancor="d2101/all">процессоры</a></li>
                <li><a href="#" class="h4 c0 topM" ancor="d2102/all">видеокарты</a></li>
                <li><a href="#" class="h4 c0 topM" ancor="d2103/all">материн.платы</a></li>
                <li><a href="#" class="h4 c0 topM" ancor="d2104/all">сеть и серверы</a></li>
                <li><a href="#" class="h4 c0 topM" ancor="d2105/all">ноутбуки</a></li>
                <li><a href="#" class="h4 c0 topM" ancor="d2106/all">мониторы</a></li>
                <li><a href="#" class="h4 c0 topM" ancor="d2107/all">планшеты</a></li>
                <li><a href="#" class="h4 c0 topM" ancor="d2109/all">аудио,видио и фото</a></li>
            </ul>
        </div>
        <div class="grid-5">
            <ul class="up up_menu">
                <li><a href="#" class="h4 c0 topM" ancor="d2110/all">системы охлаждени</a></li>
                <li><a href="#" class="h4 c0 topM" ancor="d2111/all">корпуса и БП</a></li>
                <li><a href="#" class="h4 c0 topM" ancor="d2112/all">USB накопители</a></li>
                <li><a href="#" class="h4 c0 topM" ancor="d2113/all">жесткие диски</a></li>
                <li><a href="#" class="h4 c0 topM" ancor="d2114/all">память</a></li>
                <li><a href="#" class="h4 c0 topM" ancor="d2115/all">перефирия</a></li>
                <li><a href="#" class="h4 c0 topM" ancor="d2116/all">софт</a></li>
                <li><a href="#" class="h4 c0 topM" ancor="d2118/all">эл.книги</a></li>
            </ul>
        </div>
        <div class="grid-4">
            <ul class="up up_menu">
                <li><a href="#" class="h4 c0 topM" ancor="d2119/all">мобильные</a></li>
                <li><a href="#" class="h4 c0 topM" ancor="d2120/all">оптич.приводы</a></li>
                <li><a href="#" class="h4 c0 topM" ancor="d2121/all">игры</a></li>
                <li><a href="#" class="h4 c0 topM" ancor="d2117/all">прочее</a></li>
                <li><a href="#" class="h4 c0 topM" ancor="all/all">все</a></li>
            </ul>
        </div>
        <?php //} ?>
    </div>
    <div class="grid-4">
         <h4 class="un ta-c h20">
            Сайты:
        </h4>
        <ul class="up suits">
            <li><a href="#" class="h4 c0 topS" ancor="d1">IXBIT</a></li>
            <li><a href="#" class="h4 c0 topS" ancor="d2">Overclockers</a></li>
            <li><a href="#" class="h4 c0 topS" ancor="d3">THG</a></li>
            <li><a href="#" class="h4 c0 topS" ancor="d4">3DNews</a></li>
            <li><a href="#" class="h4 c0 topS" ancor="d5">FCenter</a></li>
            <li><a href="#" class="h4 c0 topS" ancor="d6">Ferra</a></li>
            <li><a href="#" class="h4 c0 topS Sall" ancor="all">все</a></li>
        </ul>
    </div>
    <div class="fl" id="menu_out">
        <a href="#" class="ta-c">x</a>
    </div>
</div>