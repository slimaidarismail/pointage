<?php
	include("config.php");
	include("functions.php");
	
	deleteColumn($_GET["table"], $_GET["column"], $_GET['value'], $_GET["link"]);