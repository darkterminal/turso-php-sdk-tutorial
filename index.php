<?php

require_once __DIR__ . '/vendor/autoload.php';

$db = useDB();
echo $db->version() . PHP_EOL;
