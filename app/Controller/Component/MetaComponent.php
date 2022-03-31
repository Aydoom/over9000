<?php
App::uses('Component', 'Controller');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class MetaComponent extends Component {
    
    public $meta = array(
        "home" => array(
            "title" => "Over9000 - главная страница",
            "desc" => "Здесь собраны все обзоры и статью рунет о компьютерном железе, ноутбуках, мониторах и обо всем остальном, что как нибудь связано с миром компьютерных технологий",
            "keyw" => "Обзоры статьи ноутбуки процессоры мониторы софт видеокарты"
        ),
        "basic" => array(
            "title" => "Over9000 - последние обзоры",
            "desc" => "Самые последние - новые - свежие обзоры компьютерных комплектующих, ноутбуков, мониторов, процессоров и т.п. ",
            "keyw" => "Обзоры статьи свежие новые нетбуки процессоры мониторы планшеты видеокарты"
        ),
        "pc" => array(
            "title" => "Over9000 - платформы пк обзоры",
            "desc" => null,
            "keyw" => null
        ),
        "pc" => array(
            "title" => "Over9000 - платформы пк обзоры",
            "desc" => null,
            "keyw" => null
        ),
        "display" => array(
            "title" => "Over9000 - обзоры мониторов",
            "desc" => null,
            "keyw" => null
        ),
        "notebook" => array(
            "title" => "Over9000 - обзоры ноутбуков и планшетов",
            "desc" => null,
            "keyw" => null
        ),
        "mobile" => array(
            "title" => "Over9000 - обзоры мобильных устройств",
            "desc" => null,
            "keyw" => null
        ),
        "network" => array(
            "title" => "Over9000 - обзоры сетевых устройств",
            "desc" => null,
            "keyw" => null
        ),
        "perepheria" => array(
            "title" => "Over9000 - обзоры переферии",
            "desc" => null,
            "keyw" => null
        ),
        "soft&game" => array(
            "title" => "Over9000 - обзоры софта и игр",
            "desc" => null,
            "keyw" => null
        ),
        "other" => array(
            "title" => "Over9000 - прочие обзоры и статьи",
            "desc" => null,
            "keyw" => null
        ),
    );
    
    
    // Главная страница
    public function html($teg,$key){
        return $this->meta[$key][$teg];
    }
}
?>
