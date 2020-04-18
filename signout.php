<?php
include 'class/main_class.php';

$obj = new main;
if (isset($_SESSION['login'])) {
    unset($_SESSION['login']);
    $obj->redir('login');
} else {
    $obj->redir('index');
}
