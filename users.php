<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
include_once $_SERVER["DOCUMENT_ROOT"].'/system/system.php';
$pagesize = abs(intval($_GET['pagesize']));
$new = $con->query("SELECT * FROM `user` ORDER BY `id` DESC LIMIT 30");
if ($pagesize==30){
$str="";

foreach($new as $row){
     $rowArr = json_encode(array("id" => "".$row['id']."","nickname" => "".$row['name']."","avatar" => "".avatar($row['id']).""));
    $str=$str.$rowArr."###";    
    }
$jsonArr=rtrim($str,"###");
echo "{\"users\":[".str_replace("###",",",$jsonArr)."]}";
exit();
}
?>