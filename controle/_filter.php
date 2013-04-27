<?php
@session_start();

$_request = $_SERVER['SCRIPT_NAME'] . '?' . $_SERVER['QUERY_STRING'];

if(!isset($_SESSION['logged'])){
	header("Location: index.php?action=access");
}