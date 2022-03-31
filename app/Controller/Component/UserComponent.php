<?php

App::uses('Component', 'Controller');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class UserComponent extends Component {

    // Таблицы БД
    public $NumArticles = 10; // Кол-во статей на странице
	// Данные переданные методом POST
	public $data;
	
	// Функция построения условий для запроса к бд
	public function Conditions(){
		// Параметры запроса
		$query = array(
			'conditions'=>$this->Decode(),
			'fields' =>array('title','id_cat_1','link','image','date','text','id_domens','id'),
			'order' => array('date desc','num desc'),
			'limit'=>'10',
			'offset' => $this->Limit()
		);
		return $query;
	}
	// Функция декодирования кода
    public function Decode(){
        $data = $this->data;
        //pr($this->data);exit;
        //$data['cat'] = mysql_escape_string($data['cat']);
        $data['cat'] = strip_tags($data['cat']);
        $data['domen'] = strip_tags($data['domen']);
        if(empty($data['cat']) || empty($data['domen'])) exit();
        // Категория
        $ok = array();
        if($data['cat']!==0 && $data['cat']!=="all"){
            $el = explode("d21",$data['cat']);
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
	
	// Функция генерации запросов
    public function GenQuery($words,$level=2,$text = false,$key_old = array()){
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
                    $t2 = $this->GenQuery($words, $l, $text2,$key2);
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
    public function Query($in,$page){
        if(is_array($in)){
            foreach($in as $val){
                $in2['OR'][]['title LIKE'] = $val;
            }
        }
        $query = array(
            'conditions'=>$in2,
            'fields' =>array('title','id_cat_1','link','image','date','text','id_domens','id'),
            'order' => 'date desc',
            'limit'=> 10,
            'offset' => $page
        );
        //pr($query);
        return $query;
    }
	
    // Функция лимита
    private function Limit(){
        $limit = (isset($this->data['page'])) ? $this->data['page']*1 : 1;
        if($limit>0) $ok = ($limit-1)*$this->NumArticles;
        else $ok = 0;
        return $ok;
    }
}
 ?>
