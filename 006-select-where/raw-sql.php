<?php

use Darkterminal\TursoHttp\LibSQL;

require_once __DIR__ . '/../vendor/autoload.php';

$db = useDB();

try {
    $users = $db->query("SELECT id, name, age FROM users WHERE age > 30")->fetchArray(LibSQL::LIBSQL_ASSOC);
    foreach ($users as $user) {
        echo "ID: {$user['id']}, Name: {$user['name']} ({$user['age']})\n";
    }
} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
