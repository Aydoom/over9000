<?php // Страница Меню разделов ?>
<div class="layout">
    <?php // Шапка ?>
    <section class="h75 drop-5" id="header">
        <?php echo $this->element("header",array("menu"=>"off")); ?>
		<!-- Страницы -->
		<div>
			<div class="hh25 grid-3 put-1">
			<?php echo $this->Html->link(
				'<< на главную',
				array('controller' => 'index'),
				array('class' => 'link_in_title ta-l h4 c1'));
			?>
			</div>
		</div>
    </section>
    <section class="drop-75 ov-x" id="main">
        <div id="main2" class="">
            <div id="title" class="he">
                <section class="put-1 grid-14 pull-1 drop-30">
                    <?php echo $this->element("main_sections"); ?>
                </section>
			</div>
        </div>
    </section>
    <?php // Массив с доменами ?>
    <script><?php //echo $this->element("js"); ?></script>
</div>
<!-- Облако для пагинатора -->
