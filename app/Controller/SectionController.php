<?php
/**
 * Контроллер для ботов - категории.
 *
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 *
 */
App::uses('AppController', 'Controller');
class SectionController extends AppController {
    public $layout = "over_basic";
    
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

    public $meta = null;
    
    public function beforeFilter() {
        parent::beforeFilter();
            $this->cat = $this->categories->find('all',array(
                "order"=>array('code' => 'asc')
            ));
            $domens = $this->Domens->find();
            foreach($this->ancor as $key => $val){
                    $this->ancor[$key] = array("cat"=>$this->ancor[$key][0],"domen"=>$this->ancor[$key][1]);
            }
            foreach($this->cat as $k => $val){
                    $key = strtolower($this->cat[$k]['categories']['alias']);
                    $this->ancor[$key] = array(
                        "cat"=>"d".$this->cat[$k]['categories']['code'],
                        "domen"=>"all");
            }
            foreach($domens as $k => $val){
                    $key = strtolower($domens[$k]['name']);
                    $this->ancor[$key] = array(
                        "cat"=>"all",
                        "domen"=>"d".$domens[$k]['id_domens']);
            }
        
            $this->set("domens",$domens);
            $this->view = "/Index/index";
    }
    
    // Функция стандартных разделов
    public function type($aliace,$page=false){
        if(!isset($this->ancor[$aliace])) exit;
        $this->User->data = $this->ancor[$aliace];
        if($page) $this->User->data['page'] = $page;
        $this->set("articles", $this->Article->find('all',$this->User->Conditions()));
        // Формируем ссылку назад
        $this->Session->write("back",array($aliace,$page));
        
        // Якорь на страницу для мета - данных
        $this->meta = $aliace;
    }
    
    // Функция отображения разделов
    public function menu(){
        // Преобразуем в требуемый формат
        foreach($this->cat as $key => $val){
            $ok[$key] = array(
                "alias" => strtolower($this->cat[$key]['categories']['alias']),
                "ancor" => "d".$this->cat[$key]['categories']['code'],
                "name" => $this->cat[$key]['categories']['title']
            );
        }
        $this->set('categories',$ok);
        $this->view = "/Index/menu";
    }
    
    // Функция отображения разделов
    public function id($id = false){
        // Преобразуем в требуемый формат
        if(is_numeric($id)){
            $this->set("articles", $this->Article->find('all',array("conditions"=>array("id"=>$id))));
            $this->set("back",$this->Session->read("back"));
        }
    }
   
    // Функция поиска
    public function search($page=0,$data=false){
		$this->User->data['page'] = $page;
        if(!$this->request->is('post')) $data = $this->Session->read("words");
		else $this->Session->write("words",trim(mysql_real_escape_string($this->request->data['search']['text'])));
		parent::search($page,$data);
    }

    public function beforeRender() {
        parent::beforeRender("html"); // С подгрузкой мета данных
        // Настройки вида
        $this->set("Vtitle"," off");
        $this->set("Varticles","");
   }
}
