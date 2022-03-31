<?php
/**
 * Стартовый и основной контроллер.
 *
 * Этот файл переводит view в view/index/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 *
 */
App::uses('AppController', 'Controller');
class IndexController extends AppController {
    public $helpers = array("Html");
    
    public $request = null;
    public $act_domen = null;
    public $act_rubric = null;
    
    public $layout = "over_basic";
    public $meta = null;
   
    public $cat = array();
    public $ancor = array(
        'basic' => array('all','all'),
        'pc' => array('d2101d2102d2103','all'),
        "display" => array("d2106","all"),
        "notebook" => array( "d2105d2107","all"),
        "mobile" => array("d2119","all"),
        "network" => array("d2104","all"),
        "perepheria" => array("d2115","all"),
        "soft&game" => array("d2116d2121","all"),
        "other" => array("d2117","all"),
    );
    
    public function beforeFilter() {
        parent::beforeFilter();
            //print_r($this->Domens->find());exit();
        $domens = $this->Domens->find();
        $this->Session->write("domens",$domens);
        // Получаем категории
        $this->cat = $this->categories->find('all',array(
            "order"=>array('code' => 'asc')
        ));
        $html = "<script> cat = new Array(); ";
        foreach($this->ancor as $key => $val){
            $k = $this->ancor[$key][0]."+".$this->ancor[$key][1];
            $html.="cat['".$k."'] = '".$key."'; ";
        }
        foreach($this->cat as $key => $val){
            $k = "d".$this->cat[$key]['categories']['code']."+all";
            $html.="cat['".$k."'] = '".strtolower($this->cat[$key]['categories']['alias'])."'; ";
        }
        foreach($domens as $key => $val){
            $k = "all+d".$domens[$key]['id_domens'];
            $html.="cat['".$k."'] = '".strtolower($domens[$key]['name'])."'; ";
        }
        $html.="</script>";
        $this->set("cat",$html);
    }

    public function index(){
        $this->view = "/Index/index";
        $this->set("script_layout","script");
        // Якорь на страницу для мета - данных
        $this->meta = "home";
    }
	
    public function beforeRender() {
        parent::beforeRender("html");  // С подгрузкой мета данных
        // Настройки вида
        $this->set("Vtitle","");
        $this->set("Varticles"," off");
    }

}