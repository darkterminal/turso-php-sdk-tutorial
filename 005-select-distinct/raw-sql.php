<?php

use Darkterminal\TursoHttp\LibSQL;

require_once __DIR__ . '/../vendor/autoload.php';

$db = useDB();

try {
    $users = $db->query("SELECT DISTINCT name, email FROM users")->fetchArray(LibSQL::LIBSQL_ASSOC);
    foreach ($users as $user) {
        echo "Name: {$user['name']}, Email: {$user['email']}\n";
    }
} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
