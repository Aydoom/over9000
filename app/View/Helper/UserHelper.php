<?php

App::uses('Helper', 'View');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class UserHelper extends AppHelper {
    
    public $helpers = array('Html');
    public $countRightBlocks = 0;
    
    public function __construct($View) {
        parent::__construct($View);
    }

        public function ArticleBlock($data = array(),$domens){
            $id_domen = $data['id_domens'];
        $n = "\n";
        $t = "\t";
        $html = '<div class="grid-15 art_main">';
        $html.= '<div class="rfix-1 lfix-1 grid-14 art_head">';
        $html.= '<a href="#" class="art_title">'.$data['title'].'</a>';
        $html.="</div>";
        /*$html.='<div class="rfix-1 lfix-1 grid-14 art_info">
                    <p class="h4 fl">Статья от : '.$data['date'].'</p>
                    <p class="h4 fl lfix-1">Сайт: '.$data['id_domens'].'</p>
                    <p class="h4 fl lfix-1">Раздел: '.$data['id_cat_1'].'</p>
                    <a href="'.$data['id_cat_1'].'" class="h3 bold fr">Читать с '.$data['id_domens'].'</a>
                </div>';*/
        $html.='<div class="rfix-1 lfix-1 grid-14 art_info">
                    <p class="">Статья от : '.$data['date'].'</p>
                </div>';
        $html.='<div class="put-1 grid-14 ta-l art_text"><p class="h4">'.mb_substr($data['text'],0,350).' ...</p></div>';
        $html.='<div class="grid-15 rfix-1 hh15 art_footer">
                    <p class="h4 fl art_more">Подробнее &#9650;</p>
                    <a href="'.$data['id_cat_1'].'" class="h3 bold fr c1">Читать с <i>'.$domens[$id_domen]['domen'].'</i></a>
                </div>';
        $html.="</div>";
        
        return $html;
    }
        public function ArticleBlock2($data = array(),$domens,$id = false){

        $id_domen = $data['id_domens'];
        if($id){
            $link1 = '<p class="h3 c1 ta-j">'.$data['title'].'</p>';
            $link2 = $this->Html->link(
                    'Читать с '.$domens[$id_domen]['domen'],
                    array('controller' => 'section', 'action' => 'id', $data['id']),
                    array('class' => 'h5 bold ta-r c2'));
        }
        else{
            $link1 = '<a href="'.$data['link'].'" target="_blank" class="h3 c2 ta-j">'.$data['title'].'</a>';
            $link2 = '<a href="'.$data['link'].'" target="_blank" class="h5 bold ta-r c2">Читать с '.$domens[$id_domen]['domen'].'</a>';
        }
        
        $domen = (!empty($domens[$id_domen]['domen'])) ? $domens[$id_domen]['domen'] : $id_domen;
        $src = (!empty($data['image'])) ? $data['image'] : "../";
            
        $n = "\n";
        $t = "\t";
        $html = '<div class="put-1 grid-14 art_main drop-35">';
        $html.= '<div class="art_title">';
        $html.= $link1;
        $html.="</div>";
        $html.='<div class="drop-10">
                    <p class="h6 ta-l">Статья от : '.date("d.m.Y",strtotime($data['date'])).'</p>
                </div>';
        $html.='<div class="fl ta-j art_text drop-10">
                    <p class="h4 fl">
                        <img src="'.$src.'" class="fl" style="margin:0 2em 1em 0.5em; width: 180px;">
                        '.mb_substr($data['text'],0,350,"utf-8").' ...
                    </p>
                </div>';
        $html.='<div class="grid-15 rfix-1 hh20 drop-10 art_footer">'.$link2.'</div>';
        $html.="</div>";
        
        return $html;
    }
    
    // Функция выведения ссылок на главной странице
    public function ShowLinks($stert,$end,$links){
        $html = "";
        $html.= "<ul>";
            for($i=$stert;$i<$end;$i++){
                $html.= '<li class="hh40">';
                $html.= $this->Html->link(
                    $links[$i]['name'],
                    array('controller' => 'section', 'action' => 'type', $links[$i]['alias']),
                    array('class' => 'h3 c1 nav', 'ancor' => $links[$i]['ancor']));
                $html.= '</li>';
            }
        $html.= "</ul>";
        return $html;
    }
    
    /*
     * @data    - массив с ссылками
     * @key     - ключ поля, по которому идет сравнение с активной ссылкой
     * @title   - ключ поля, в котором находиться название ссылки 
     */
    /*public function RightBlock($data=array(),$key='code',$title='title',$active=null,$class='lfix-1 h4 bold drop-5',$path_link="category"){
        // Опции для ссылок категории
         $options['class'] = $class." line";
         // Ссылка на главную страницы
         $mainLink = $this->Html->link("Главная",$this->getUrl(),$options);
         // Ссылки на активные рубрики
         $ds = '<p class="'.$options['class'].'">>></p>';
         $activeLink = "";
         if($active!=null){
             foreach ($data as $k=>$val){
                 if($data[$k][$key]==$active){
                     if(isset($data[$k]['p_id'])){
                        $p_id = $data[$key]['p_id'];
                        if(!empty($data[$k]['p_id'])){
                            $activeLink.= $ds.$this->Html->link($data[$p_id][$title],$this->getUrl($data[$p_id][$key],$path_link),$options);
                        }
                     }
                     $activeLink.= $ds.$this->Html->link($data[$k][$title],$this->getUrl($data[$k][$key],$path_link),$options);
                     break;
                 }
             }
         }
         // Остальные ссылки рубрики 
         $otherLinks ="";
         $options['class'] = $class." fl";
         foreach($data as $k => $val){
             $otherLinks.=$this->Html->link($data[$k][$title],$this->getUrl($data[$k][$key],$path_link),$options);
         }
         $html = '
             <div class="bo drop-20">
             <div class="ta-l">'.$mainLink.$activeLink.'</div>
                <hr style="width: 90%" />
                <div class="ta-l ov-y">'.$otherLinks.'</div>
            </div>';
         return $html;
    }*/
    
    // Функция конструирования блока
    public function RightBlock($name,$content){
        $drop = ($this->countRightBlocks>0) ? "drop-30" : "drop-15";
        $text = '
                <div class="rightBlock '.$drop.' fl bg4">
                    <div class="title fl">
                        <p class="h2 c0 hh35 zagl bold">'.$name.'</p>
                        <hr class="grid-14 put-1" style="margin-top: 0px;"/>
                    </div>
                    <div class="body ta-l fl">
                        '.$content.'
                    </div>
                </div>';
        $this->countRightBlocks++;
        return $text;
    }
    
    // Функция определения URL
    public function getUrl($cat=false,$act=false,$cont=false){
        $url = array(
            "controller" => "index",
            "action" => "index"
        );
        if($cat) array_push ($url, $cat);
        if($act) $url['action'] = $act;
        if($cont) $url['controller'] = $cont;
        
        return $url;
    }
    
    // Строим Ul список
    public function Ul($array,$classLi = false,$classA = false){
        $classLi = ($classLi) ? ' class="'.$classLi.'"' : null;
        $classA = ($classA) ? ' class="'.$classA.'"' : null;
        echo "<ul>";
        foreach ($array as $href => $text){
            echo "<li$classLi>";
            $h = (is_numeric($href)) ? "#" : $href;
            echo '<a href="'.$h.'"'.$classA.'>'.$text.'</a>';
            echo "</li>";
        }
        echo "</ul>";
    }

    public function Json($array){
        $arr_replace_utf = array('\u0410', '\u0430','\u0411','\u0431','\u0412','\u0432',
        '\u0413','\u0433','\u0414','\u0434','\u0415','\u0435','\u0401','\u0451','\u0416',
        '\u0436','\u0417','\u0437','\u0418','\u0438','\u0419','\u0439','\u041a','\u043a',
        '\u041b','\u043b','\u041c','\u043c','\u041d','\u043d','\u041e','\u043e','\u041f',
        '\u043f','\u0420','\u0440','\u0421','\u0441','\u0422','\u0442','\u0423','\u0443',
        '\u0424','\u0444','\u0425','\u0445','\u0426','\u0446','\u0427','\u0447','\u0428',
        '\u0448','\u0429','\u0449','\u042a','\u044a','\u042b','\u044b','\u042c','\u044c',
        '\u042d','\u044d','\u042e','\u044e','\u042f','\u044f');
        $arr_replace_cyr = array('А', 'а', 'Б', 'б', 'В', 'в', 'Г', 'г', 'Д', 'д', 'Е', 'е',
        'Ё', 'ё', 'Ж','ж','З','з','И','и','Й','й','К','к','Л','л','М','м','Н','н','О','о',
        'П','п','Р','р','С','с','Т','т','У','у','Ф','ф','Х','х','Ц','ц','Ч','ч','Ш','ш',
        'Щ','щ','Ъ','ъ','Ы','ы','Ь','ь','Э','э','Ю','ю','Я','я');
        $str1 = json_encode($array);
        $str2 = str_replace($arr_replace_utf,$arr_replace_cyr,$str1);
        return $str2;
    }

}
