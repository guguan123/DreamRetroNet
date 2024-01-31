<?php
if (!is_file($_SERVER["DOCUMENT_ROOT"] . '/system/conn.php')) {
    header('Location: /install/');
}
include_once $_SERVER["DOCUMENT_ROOT"] . '/wap/system/base.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/wap/M/c/header.php';

include_once $_SERVER["DOCUMENT_ROOT"] . "/wap/main.php";
//include_once $_SERVER["DOCUMENT_ROOT"] . "/wap/M/c/menu.php";
include_once $_SERVER["DOCUMENT_ROOT"] . '/wap/M/c/foot.php';
?>