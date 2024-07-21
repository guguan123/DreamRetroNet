if ($qq_id){
   if ($user_num > 0){
    $con->query("UPDATE `user` SET `name` = '".$arr['nickname']."', `qq_key` = '".$qq_key."', `avatar` = '' WHERE `qq_id` = '$qq_id'");
     setcookie('qq_id', $qq_id, time()+86400*365, '/');  
    }else{
      $con->query("INSERT INTO `user` (`id`, `qq_id`, `name`, `avatar`, `qq_key`, `data_reg`) VALUES (NULL, '{$qq_id}', '{$arr['nickname']}', '{}', '{$qq_key}', '".time()."')");

 }             
    }   
//header("Location: ".'/');


echo '<meta charset="UTF-8">';
echo "<p>";
echo "Gender:".$arr["gender"];
echo "</p>";
echo "<p>";
echo "NickName:".$arr["nickname"];
echo "</p>";
echo "<p>";
echo "<img src=\"".$arr['figureurl']."\">";
echo "<p>";
echo "<p>";
echo "<img src=\"".$arr['figureurl_1']."\">";
echo "<p>";
echo "<p>";
echo "<img src=\"".$arr['figureurl_2']."\">";
echo "<p>";
