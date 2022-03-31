<?php
/**
 * Ajax контроллер для получения обзоров.
 *
 * Этот файл переводит view в view/index/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 *
 */
App::uses('AppController', 'Controller');
App::uses('Sanitize','Utility');

class AjaxController extends AppController {
    
    public $presetVars = array(array('field' => 'title', 'type' => 'value')); // using the model configuration
    
    // Таблицы БД
    public $NumArticles = 10; // Кол-во статей на странице

    public function beforeFilter() {
        $this->set("domens",$this->Session->read("domens"));
        // Если данные не пост то остановка скрипта
        if(!$this->request->is('post')) $this->_stop(0);
		else $this->User->data = $this->request->data;
    }

    public function index(){
        $this->set("articles", $this->Article->find('all',$this->User->Conditions()));
        //pr($query);exit;
    }
    
    // Функция поиска
    public function search(){

		$data = trim(Sanitize::escape($this->request->data['text']));
		//$data = trim(mysql_real_escape_string($this->request->data['text']));
		//pr($this->request->data);exit;
		if(is_numeric($this->request->data['page'])) $page = $this->request->data['page']*1;
		else{
			$el = explode("/",$this->request->data['page']);
			$page = $el[2]*1;
		}
		parent::search($page,$data);
	}
    
    public function beforeRender() {
        parent::beforeRender();
        $this->view = "/Index/ajax";
        $this->layout = "ajax";
    }
}
?>