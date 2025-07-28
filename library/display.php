<?php

function display($view_name, $title, $css_name, $data = []) {
    extract($GLOBALS);
    extract($data);
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Views/Layout/header.php";

}
