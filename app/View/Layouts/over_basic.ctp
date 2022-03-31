<?php
//echo $this->element('sql_dump');exit;
// Тип документа
echo $this->Html->docType('html5')."\n";

if(empty($description)) $description = "Здесь собраны все обзоры и статью рунет о компьютерном железе, ноутбуках, мониторах и обо всем остальном, что как нибудь связано с миром компьютерных технологий";
if(empty($keywords)) $keywords = "Обзоры статьи ноутбуки процессоры мониторы софт видеокарты";
?>
<html>
<head>
    <?php
        // Кодировка
        echo $this->Html->charset(); 
        // Заголовок
        echo "<title>".$title_for_layout."</title>"."\n";
        // Иконка
        echo $this->Html->meta('icon', $this->Html->url('/img/favicon.png'))."\n";
        // Описание
        echo $this->Html->meta('description',$description)."\n";
        // Ключевые слова
        echo $this->Html->meta('keywords',$keywords)."\n";
        // Стили
        echo $this->Html->css(array('basic.css?i=' . rand(0, 1000),'grid','tcf','elements','module'))."\n";
    ?>
	<meta name='yandex-verification' content='43451463f12b3086' />
</head>
<body>
<!-- begin navigation partfolio -->
<div class="nav-partf">
	<a class="nav-partf__link" href="/aydoom2/gallery.html">Выход</a>
</div>
<!-- end navigation partfolio -->
<?php echo $this->fetch('content'); ?>
        <!--<div id="footer">
            <?php echo $this->Html->link(
                    $this->Html->image('cake.power.gif', array('alt' => 'cakephp', 'border' => '0')),
                    'http://www.cakephp.org/',
                    array('target' => '_blank', 'escape' => false)
                );
            ?>
        </div>-->
    <?php 
        echo $this->Html->script(array('jquery','jquery_ui','scrollbar',"jquery.cookie", $script_layout . ".js?i=" . rand(0,1000)));
		echo $this->element('google_analitics');
        echo '<script> var dir = "http://'.$_SERVER['SERVER_NAME'].'/";</script>';
        //echo $this->fetch('script');
    ?>
</body>
</html>
