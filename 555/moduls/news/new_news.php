<?php

#################################################################################
###  ЭТОТ ФАЙЛ БУДЕТ ИНКЛУДИТСЯ НА ГЛАВНУЮ И БУДЕТ ВЫВОДТЬ ПОСЛЕДНЮЮ НОВОСТЬ  ###
#################################################################################

$b_c = $con->query('SELECT * FROM `news`')->num_rows;
if($b_c == 0){
}else{

	echo "<div class='razdel'><a href='/news'>Новости (".$con->query('SELECT * FROM `news`')->num_rows.")</a></div>"; // РАЗДЕЛ

$b = $con->query("SELECT * FROM `news` ORDER BY `id` DESC LIMIT 1")->fetch_assoc();
$a = $b['text'];
$lenght = 250;
$be = mb_substr($a, 0, $lenght);
if (mb_strlen($a) > $lenght) {
    $be .= '...';
}



echo '<div class="news"><b>Название</b> : '.$b['name'].'<br>
'.text($be).'<br>

<b>Автор :</b> '.user($b['author']).'</br><a href="/news_'.$b['id'].'">Подробнее...</a></div>';

}

?>