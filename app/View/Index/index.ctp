<?php 
// Стартовая старана 
//pr($this->params);exit;
// Сокращения
// Ссылка на главную страницу
$div['A']['LinkHome'] = $this->Html->div("hh25 grid-3 put-1",
    $this->Html->link("<< на главную",
    array("controller" => "index"),
    array("class" => "link_in_title ta-l h4 c1")));
// Ссылка на страницу назад
$div['A']['LinkBack'] = null;
// Блок с облаком для страниц
$div['Div']['Shadow'] = '<div class="shadow"></div>';

// Подкрашивание активной страницы пагинатора
$key['color'] = true;
// Ключ для подключения пагинатора
$key['pages'] = true;
// Ключ для подгрузки статей
$key['article'] = true;

// В случае работы со статьями при отстутствии AJAX запроса
if(isset($articles)){
    // Количество статей
    $cA = count($articles);
    // Хапрещаем вывод категорий
    if(!isset($cat)) $cat = null;
    // Удаляем блок с облаком
    $div['Div']['Shadow'] = null;
	$key['color'] = false;
    
    if($cA < 2 && $cA!=0){
        // Отключаем пагинатор
        if(!isset($this->params['pass'][1])) $key['pages'] = false;
        // Ссылка назад
            if(isset($back) && !$back[1]) $back[1] = null;
            if(isset($back[0])){
                $div['A']['LinkBack'] = $this->Html->div("hh25 grid-3",
                        $this->Html->link("<< назад к обзорам",
                        array('controller' => 'section',"action" => "type", $back[0],$back[1]),
                        array("class" => "link_in_title ta-l h4 c1")));
            }
    }
    elseif($cA == 0 && $this->params['action'] == 'search'){
        $key['article'] = false;    
        $key['pages'] = false;
    }
    elseif($cA <9){
        $key['pages'] = false;
    }
    elseif($cA>9){// Подгружаем страницы если в них есть необходимость
        $key['pages'] = true;
    }
}
// Подгружаем страницы если в них есть необходимость
$pages = ($key['pages']) ? $this->element("pages",array("shadow"=>$div['Div']['Shadow'],"color"=>$key['color'])) : null;
/*
 * Построение
 */
?>
<div class="layout">
    <!-- Шапка -->
    <section class="h75 drop-5" id="header">
        <?php echo $this->element("header"); ?>
    </section>
    <section class="drop-75 ov-x" id="main">
        <div id="main2">
            <div id="title" class="he<?php echo $Vtitle;?>">
                <section class="put-1 grid-14 pull-1">
                    <?php echo $this->element("main"); ?>
                </section>
            </div>
            <div class="fl<?php echo $Varticles;?> he rel" id="articles">
                <?php 
                    echo $div['A']['LinkHome']; // Ссылка на главную страницу 
                    echo $div['A']['LinkBack']; // Ссылка на страницу назад
                    echo $pages; // Подключаем страницы
                ?>
                <div class="clear"></div>
                <section class="wi scroll">
                    <div id="ds">
                        <?php 
                            if($key['article']) echo $this->element("articles");
                            else echo "<h4 class='c_err put-1 drop-20'>По данному запросу ни чего не найдено!!!</h2>";
                        ?>
                    </div>
                </section>
            </div>
        </div>
    </section>
    <?php echo $cat; ?>
</div>
<!-- Облако для пагинатора -->
