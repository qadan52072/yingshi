<?php
$plug->listen('index','before');
include('index/index.php');
$plug->listen('index','after');
?>