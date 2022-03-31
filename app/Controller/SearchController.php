<?php
/**
 * Search контроллер для получения обзоров.
 *
 * Этот файл переводит view в view/index/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 *
 */
App::uses('AppController', 'Controller');
class AjaxController extends AppController {
    
    public $components = array('Search.Prg');
    public $presetVars = array(array('field' => 'title', 'type' => 'value')); // using the model configuration
    
    // Таблицы БД
    public $NumArticles = 10; // Кол-во статей на странице

    public function beforeFilter() {
        $this->set("domens",$this->Session->read("domens"));
        // Если данные не пост то остановка скрипта
        if(!$this->request->is('post')) $this->_stop(0);
    }

    public function index(){
        $query = array(
            'conditions'=>$this->__decode(),
            'fields' =>array('title','id_cat_1','link','date','text','id_domens'),
            'order' => array('date desc','num desc'),
            'limit'=>'10',
            'offset' => $this->__limit()
        );
        $this->set("articles", $this->Article->find('all',$query));
        $this->Session->write('words',"");
        //pr($query);exit;
    }
    
    // Функция поиска
    public function search(){
        $data = trim(mysql_real_escape_string($this->request->data['text']));
        // Главная фраза
        /*$in[] = "%".$data."%";
        // Составные фразы
        $words = explode(" ",$data);
        $cW = count($words);
        // Из трех слов
        if($cW>2) $in[] = $this->__foreach($words, 3);
        if($cW>1) $in[] = $this->__foreach($words, 2);
        $in[] = $this->__foreach($words, 1);
        // Сам поиск
        $articles = $this->Article->find('all',$this->__query($in[1]));*/
        $this->Prg->commonProcess();
        $articles = $this->Article->parseCriteria($this->Prg->parsedParams());
        pr($articles);exit;
    }
    // Функция генерации запросов
    private function __foreach($words,$level=2,$text = false,$key_old = array()){
        foreach($words as $key => $val){
            if(!in_array($key, $key_old)){
                $val = trim($val);
                if(!$text){
                    $text2 = $t[] = "%".$val."%";
                    $key2 = array($key);
                }
                else{
                    $text2 = $t[] = $text.$val."%";
                    $key2 = array_merge(array($key),$key_old);
                }
                if($level>1){
                    $l = $level - 1;
                    $t2 = $this->__foreach($words, $l, $text2,$key2);
                    if(!is_array($t2)) $t2 = array($t2);
                    $t = array_merge($t,$t2);
                }
            }
        }
        if(!$text){
            foreach ($t as $v){
                if(substr_count($v, "%")>$level) $ok[] = $v;
            }
            if(count($ok)>20) $ok = array_splice($ok, 0, 20);
        }
        else $ok = $t;
        return $ok;
    }
    
    // Генерация запроса
    private function __query($in){
        if(is_array($in)){
            foreach($in as $val){
                $in2['OR']['title LIKE'][] = $val;
            }
        }
        $query = array(
            'conditions'=>$in2,
            'fields' =>array('title','id_cat_1','link','date','text','id_domens'),
            'order' => 'date desc',
            'limit'=>'10',
            'offset' => 1
        );
        return $query;
    }
    // Функция декодирования кода
    private function __decode(){
        $data = $this->request->data;
        //pr($this->request->data);exit;
        //$data['cat'] = mysql_escape_string($data['cat']);
        $data['cat'] = strip_tags($data['cat']);
        $data['domen'] = strip_tags($data['domen']);
        if(empty($data['cat']) || empty($data['domen'])) exit();
        // Категория
        $ok = array();
        if($data['cat']!==0 && $data['cat']!=="all"){
            $el = explode("21",$data['cat']);
            $cI = count($el);
            if($cI>0){
                for($i=1;$i<$cI;$i++){
                    $el[$i] = $el[$i] * 1;
                    if(strlen($el[$i])<3){
                        $ok['OR']['id_cat_1'][] = 2100 + $el[$i];
                        $ok['OR']['id_cat_2'][] = 2100 + $el[$i];
                     }
                    else{exit();}
                }
            }
        }
        // Домены
        if($data['domen']!==0 && $data['domen']!=="all"){
            $el = explode("d",$data['domen']);
            $cI = count($el);
            if($cI>0){
                for($i=1;$i<$cI;$i++){
                    $el[$i] = $el[$i]*1;
                    if($el[$i]!=0)$ok['id_domens'][] = $el[$i];
                    else{exit();}
                }
            }
        }
        return $ok;
    }

    // Функция лимита
    // Функция лимита
    private function __limit(){
        $limit = (isset($this->request->data['page'])) ? $this->request->data['page']*1 : 1;
        if($limit>0) $ok = ($limit-1)*$this->NumArticles;
        else $ok = 0;
        return $ok;
    }
    
    public function beforeRender() {
        parent::beforeRender();
        $this->view = "/index/ajax";
        $this->layout = "ajax";
    }
}
?>
