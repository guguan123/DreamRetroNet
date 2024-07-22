<?php
include "lib/function.php";
?>
<script src="js/language.js"></script>
<?php
if(isset($_GET["language"])){
  $_SESSION["language"] = $_GET["language"];
}else{
  $_SESSION["language"] = getDefalutlanguage();
}
$language_name = getLanguageName($_SESSION["language"]);
include "lang/".$language_name.".inc";
?>
<SELECT NAME="language" id="language" onchange="changeLanguage(this)">
<?php
  $language_array = array_language();
  foreach($language_array as $key => $value){
    if($_SESSION["language"] == $value){
      $selected = "selected = 'selected' ";
    }else{
      $selected = "";
    }
?>
<OPTION VALUE="<?php echo $value;?>" <?php echo $selected;?>><?php echo getLanguageName($value);?></OPTION>;
<?
  }
?>
</SELECT>
<?php
  if($_GET["language"] == $value){
      //$selected = "selected = 'selected' ";
    }
echo "语言：".$_SESSION["language"];
echo "测试：".$name;
?>
