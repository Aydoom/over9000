<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Controller', 'Controller');
App::uses('Sanitize','Utility');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $helper = array("Html","Form");
    public $uses = array("Article","categories","Domens");
    public $components = array("Session","User","Meta");

    public function beforeFilter() {
        $this->set("script_layout",null);
    }
    function afterFilter() {
            if ($this->response->statusCode() == '404')
            {
                    $this->redirect(array(
                            'controller' => 'index',
                            'action' => 'index')
                    );
            }
    }
	
    public function search($page=0,$data=false){
        $data = (!$data) ? trim(Sanitize::escape($this->request->data['text'])) : $data;
        // Главная фраза
        $in[] = "%".$data."%";
        // Составные фразы
        $words = explode(" ",$data);
        $cW = count($words);
        // Из трех слов
        if($cW>2) $in[] = $this->User->GenQuery($words, $cW);
        if($cW>1) $in[] = $this->User->GenQuery($words, 2);
        $in[] = $this->User->GenQuery($words, 1);
        // Сам поиск
        $this->set("articles", $this->Article->find('all',$this->User->Query($in[1],$page)));
        $this->set("search", $words);
    }
    
    public function beforeRender($meta = false) {
        parent::beforeRender();
	// Устанавливаем мета данные
        if($meta === "html"){
            $this->set("title_for_layout",$this->Meta->html("title",$this->meta));
            $this->set("description",$this->Meta->html("desc",$this->meta));
            $this->set("kewords",$this->Meta->html("keyw",$this->meta));
        }
    }
}