<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
//echo "<title>续梦网MRP</title>";
include_once $_SERVER["DOCUMENT_ROOT"].'/system/system.php';
$new = $con->query("SELECT * FROM `game` WHERE `platform` = 'MRP' ORDER BY `id` DESC");
function binadd($f,$n)

{

while(strlen($f)<$n)

$f='0'.$f;

$f=substr($f,0,$n);

return $f;

}

function gb2u0($f)

{return mb_convert_encoding(str_replace(chr(0),'',$f),'utf-8','gb2312');} function u2gb0($f,$n)

{

$f=mb_convert_encoding($f,'gb2312','utf-8');

for($a=strlen($f);$a<=$n;$a++)

{$f.=chr(0);}

$f=substr($f,0,$n);

return $f;

}

function getmrp($f)

{

/*

参数：文件路径

返回一个包含mrp信息的数组（UTF-8编码）

*/

$f=fopen($f,'rb');

if(fread($f,4)!='MRPG')

{fclose($f);

return false;}

fseek($f,52,SEEK_SET);

$ch=gb2u0(fread($f,16));

fseek($f,192,SEEK_SET);

$bb=hexdec(bin2hex(fread($f,4)));

fseek($f,196,SEEK_SET);

$id=hexdec(bin2hex(fread($f,4)));

fseek($f,16,SEEK_SET);

$nn=gb2u0(fread($f,12));

fseek($f,28,SEEK_SET);

$xn=gb2u0(fread($f,24));

fseek($f,88,SEEK_SET);

$zz=gb2u0(fread($f,40));

fseek($f,68,SEEK_SET);

$bb2=hexdec(bin2hex(strrev(fread($f,4))));
fseek($f,72,SEEK_SET);

$id2=hexdec(bin2hex(strrev(fread($f,4))));

fseek($f,128,SEEK_SET);

$js=gb2u0(fread($f,64));

fclose($f);

return array(

'id'=>$id,

'id2'=>$id2,

'ch'=>$ch,

'bb'=>$bb,

'bb2'=>$bb2,

'nn'=>$nn,

'xn'=>$xn,

'zz'=>$zz,

'js'=>$js);

}
foreach($new as $row){
$size = getFilesize($_SERVER['DOCUMENT_ROOT'].'/download/'.$row['down'].'');
$sizes = getFilesizes($_SERVER['DOCUMENT_ROOT'].'/download/'.$row['down'].'');
$v=getmrp("../../download/".$row['id'].".mrp");
$fid = str_replace('&','&',$v['id']);
$gid = str_replace('&','&',$v['id2']); 
$vid = $fid ?: $gid;
$fbb = str_replace('&','&',$v['bb']);
$gbb = str_replace('&','&',$v['bb2']); 
$vbb = $fbb ?: $gbb;
//$number = $con->query('SELECT * FROM `comment` WHERE `id_obmen` = "'.$row['id'].'"')->num_rows;
     $rowArr = json_encode(array("res" => "","scr" => "".$row['dpi']."","icon" => "/M/i/".$row['icon']."","label" => "".$row['name']."","version" => $vid,"down" => "/download/".$row['id'].".mrp","size" => "".$size."","len" => "".$sizes."".$row['downs']."","vendor" => "".$row['author']."","name" => "".$v['nn']."","resLen" => "0","reslnfo" => "","resSize" => "","id" => "".$vbb."","detail" => "".$v['js'].""));
    $str=$str.$rowArr."###";
  }
    $jsonArr=rtrim($str,"###");
 echo "[".str_replace("###",",",$jsonArr)."]";