<?php
$env_items = array();
$dirfile_items = array(
		array('type' => 'dir', 'path' => '/'),
		array('type' => 'dir', 'path' => '/install'),
		array('type' => 'dir', 'path' => '/config')
);

$func_items = array(
		array('name' => 'fsockopen'),
		array('name' => 'file_get_contents'),
        array('name' => 'file_put_contents'),
		array('name' => 'mb_convert_encoding'),
		array('name' => 'json_encode'),
        array('name' => 'json_decode'),
		array('name' => 'curl_init')
);