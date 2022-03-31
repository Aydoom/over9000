<?php

App::uses('ModelBehavior', 'Model');

class DomenBehavior extends ModelBehavior {
    public $My_alias = false;

    public function setup(Model $model, $settings = array()) {
        if (!isset($this->settings[$model->alias])) {
            // Свое
            $this->My_alias = $settings['My_alias'];
        }
        // Обязательно
        $this->settings[$model->alias] = $settings;
    }        
    // Отборка у домена
    public function paginate(Model $model, $conditions, $fields, $order, $limit, $page = 1, $recursive = null, $extra = array()) {
        if($this->My_alias){
            $this->recursive = $recursive;
            $start = $limit*($page-1);
            $sql = "
                SELECT * FROM `ov_articles` as Article  WHERE `id_domens` = 
                (SELECT `id_domens` FROM `ov_domens` WHERE `alias` = '".$this->My_alias."' LIMIT 1)
                            ORDER BY `date` DESC
                            LIMIT ".$start.",".$limit."
                            ;
                ";
            return $model->query($sql);}
        else{
            return $model->find('all', compact('conditions', 'fields', 'order', 'limit', 'page', 'recursive', 'group'));
        }
    }
    public function paginateCount(Model $model,$conditions = null, $recursive = 0, $extra = array())  {
        if($this->My_alias){
            $this->recursive = $recursive;
            $sql = "
                SELECT * FROM `ov_articles` WHERE `id_domens` = 
                (SELECT `id_domens` FROM `ov_domens` WHERE `alias` = '".$this->My_alias."' LIMIT 1);
                ";
            return count($model->query($sql));
        }
    }
    
}
?>
