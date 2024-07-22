<?php
if (!is_file($_SERVER["DOCUMENT_ROOT"] . '/system/conn.php')) {
    header('Location: /install/');
}
include_once $_SERVER["DOCUMENT_ROOT"] . '/system/base.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/style/head.php';

include_once $_SERVER["DOCUMENT_ROOT"] . "/moduls/main.php";
//include_once $_SERVER["DOCUMENT_ROOT"] . '/style/menu.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/style/foot.php';
?>