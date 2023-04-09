<?php
include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

session_unset();
session_destroy();

unset($_SESSION);
unset($_COOKIE);

gotourl("/signin.php");
?>