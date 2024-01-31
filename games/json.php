
<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$sql = $con->query("SELECT * FROM `game` ORDER BY `id` DESC LIMIT 10"); //SQL
//$result =mysql_query($sql);//执行SQ
//file_put_contents('games.json', $s);
class Emp {
       public $id = "";
       public $name = "";
       public $chinese  = "";
       public $system = "";
       public $category = "";
       public $vendor = "";
       public $download_num = "";
       public $comment_num = "";
   }
   $rowArr = new Emp();
$str="";
foreach($sql as $row){
    $rowArr = json_encode(array("id" => "".$row['id']."","name" => "".$row['name']."","chinese" => null,"system" => "J2ME","category" => "ETC","vendor" => "Bjorn Carlin, www .arktos .se",
    "download_num" => "0","comment_num" => "0"));
    $str=$str.$rowArr."###";
}
$jsonArr=rtrim($str,"###");
echo "{\"games\":[".str_replace("###",",",$jsonArr)."]}";
    ?>
  