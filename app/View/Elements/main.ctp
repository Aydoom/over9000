<?php
    $links = array(
        array(
            "alias" => "basic",
            "ancor" => "all/all",
            "name" => "последние"
        ),
        array(
            "alias" => "pc",
            "ancor" => "d2101d2102d2103/all",
            "name" => "платформы пк"
        ),
        array(
            "alias" => "display",
            "ancor" => "d2106/all",
            "name" => "мониторы"
        ),
        array(
            "alias" => "notebook",
            "ancor" => "d2105d2107/all",
            "name" => "ноутбуки и планшеты"
        ),
        array(
            "alias" => "mobile",
            "ancor" => "d2119/all",
            "name" => "мобильные"
        ),
        array(
            "alias" => "network",
            "ancor" => "d2104/all",
            "name" => "сеть и сервера"
        ),
        array(
            "alias" => "perepheria",
            "ancor" => "d2115/all",
            "name" => "переферия"
        ),
        array(
            "alias" => "soft&game",
            "ancor" => "d2116d2121/all",
            "name" => "софт и игры"
        ),
        array(
            "alias" => "other",
            "ancor" => "d2117/all",
            "name" => "прочее"
        ),
    );
?>   
<?php echo $this->Html->div("put-4 grid-12 ta-l", $this->User->ShowLinks(0,5,$links)); ?>
<div class="clear"></div>
<div class="descript">
    <p class="h1 ta-j c1">Все обзоры компьютерного железа, гаджетов и софта здесь.</p>
</div>
<div class="clear"></div>
<?php echo $this->Html->div("put-4 grid-12 ta-l", $this->User->ShowLinks(5,9,$links)); ?>
