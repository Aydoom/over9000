<?php
    $text = "var domens = new Array('',";
    foreach ($domens as $key => $val){
            $text.="'".$val['name']."',";
        /*foreach ($val as $k => $v){
            $text.="domens['".$key."']['".$k."'] = '".$v."';\n";
        }*/
    }
    echo $text."'');";
?>