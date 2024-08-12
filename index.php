<?php

require_once __DIR__ . '/vendor/autoload.php';

$db = useDB();
$db->execute("CREATE TABLE users (name)");
echo "Done\n";
