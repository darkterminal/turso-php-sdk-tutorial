<?php

use Darkterminal\TursoHttp\LibSQL;

require_once __DIR__ . '/../vendor/autoload.php';

$db = useDB();

try {
    $users = $db->query("SELECT name, email FROM users")->fetchArray(LibSQL::LIBSQL_ASSOC);
    var_dump($users);
} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
