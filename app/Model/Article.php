<?php
class Article extends AppModel {
    public $name = 'Article';
    public $actsAs = array('Domen'=>array("My_alias"=>null));
}
?>
