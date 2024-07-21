<?php
if (!is_file($_SERVER["DOCUMENT_ROOT"] . '/system/conn.php')) {
    header('Location: /install/');
}
include_once $_SERVER["DOCUMENT_ROOT"] . '/system/base.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/M/c/header.php';

include_once $_SERVER["DOCUMENT_ROOT"] . "/main.php";
//include_once $_SERVER["DOCUMENT_ROOT"] . "/M/c/menu.php";
include_once $_SERVER["DOCUMENT_ROOT"] . '/M/c/foot.php';
?>