<p class="h3 fl">Страницы:</p>
<?php
    echo $this->Paginator->numbers(array(
        'first' => '1 ... ',
        'modulus' => 10,
        'ellipsis' => true
    ));
?>