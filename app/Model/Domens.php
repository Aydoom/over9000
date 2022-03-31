<?php
class Domens extends AppModel {
    public $name = 'Domens';
    //public $actsAs = array('Domen'=>array("My_alias"=>null));

    public function find($type="number"){
        $domens = parent::find($type);
        foreach($domens['Domens'] as $k => $v){
            $id = $domens['Domens'][$k]['id_domens'];
            $dom[$id] = $domens['Domens'][$k];
            $el = explode("/",$domens['Domens'][$k]['url']);
            $el = explode("www.",$el[2]."www.");
            $dom[$id]['domen'] = $el[1];
            $dom[$id]['model'] = "ok";
        }
		//print_r($dom);exit;
        return $dom;
    }
}
?>
